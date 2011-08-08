<?php
    require(SERVER_ROOT."/config/config.php");
    require(SERVER_ROOT."/config/mysql.php");
    require(SERVER_ROOT."/script/util.php");
        
    function new_user($username, $password) {
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        $salt = substr(hash('sha256', $username.microtime().rand(0,1000000)), 0, 10);
        $password_hash = hash_pass($password.$salt.PASSWORD_SALT);
        $query = "INSERT INTO users(username, password ,salt) VALUES ('$username', '$password_hash', '$salt')"
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
      return mysql_result($result,0,"address")
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
