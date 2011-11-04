<?php
# This file is part of OpenPool.
#
#    OpenPool is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    OpenPool is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with OpenPool.  If not, see <http://www.gnu.org/licenses/agpl-3.0.html>.
?>
<?php
    require($_SERVER['DOCUMENT_ROOT']."/config/config.php");
    require($_SERVER['DOCUMENT_ROOT']."/script/mysql.php");
    require($_SERVER['DOCUMENT_ROOT']."/script/util.php");
        
    function new_user($username, $password) {
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        $salt = substr(hash('sha256', $username.microtime().rand(0,1000000)), 0, 10);
        $hash_password = hash_pass($password.$salt.PASSWORD_SALT);
        $query = "INSERT INTO users(username, hash_password ,salt) VALUES ('$username', '$hash_password', '$salt')";
        $ret = true;
        mysql_query($query) or $ret = false;
        return $ret;
    }
        
    function get_id_by_username($username) {
      $username = mysql_real_escape_string($username);
      $query = "SELECT id FROM users WHERE username='$username'";
      return mysql_result(mysql_query($query),0,"id");
    }

    function get_username_by_id($id) {
      $id = mysql_real_escape_string($id);
      $query = "SELECT username FROM users WHERE id=$id";
      return mysql_result(mysql_query($query),0,"username");
    }

    function get_salt($id) {
      $id = mysql_real_escape_string($id);
      $query = "SELECT salt FROM users WHERE id=$id";
      return mysql_result(mysql_query($query),0,"salt");
    }

    function get_balance($id) {
      #Returns balance of user with id
      $id = mysql_real_escape_string($id);
      global $aes_password;
      $salt = getSalt($id);
      $query = "SELECT AES_DECRYPT(enc_balance, '$aes_password$salt') AS balance FROM users WHERE id = $id";
      $result = mysql_query($query) or die(mysql_error());
      return mysql_result($result,0,"balance");
    }

    function set_balance($id, $balance) {
      #Sets balance of user with id
      $id = mysql_real_escape_string($id);
      $balance = mysql_real_escape_string($balance);
      global $aes_password;
      $salt = getSalt($id);
      $ret = true;
      $query = "UPDATE users SET enc_balance = AES_ENCRYPT($balance,'$aes_password$salt') WHERE id = $id";
      mysql_query($query) or $ret = false;
      return $ret;
    }

    function get_address($id) {
      $id = mysql_real_escape_string($id);
      $balance = mysql_real_escape_string($balance);
      $salt = getSalt($id);
      $query = "SELECT AES_DECRYPT(enc_address, '$aes_password$salt') AS address FROM users WHERE id = $id";
      $result = mysql_query($query) or die(mysql_error());
      return mysql_result($result,0,"address");      
    }

    function set_address($id,$address) {
      #Sets address of user with id
      $id = mysql_real_escape_string($id);
      $address = mysql_real_escape_string($address);
      global $aes_password;
      $salt = getSalt($id);
      $ret = true;
      $query = "UPDATE users SET enc_address = AES_ENCRYPT('$address', '$aes_password$salt') WHERE id = $id";
      mysql_query($query) or $ret = false;
      return $ret;
    }
?>
