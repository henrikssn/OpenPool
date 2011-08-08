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
require(SERVER_ROOT."/script/db/db.php");
require(SERVER_ROOT."/script/jsonRPCClient.php");

function credit($id, $amount) {
  #Takes a user id and an amount in btc and credits a user that amount

  $id = mysql_real_escape_string($id);
  $amount = mysql_real_escape_string($amount);

  # Convert to satoshi
  $amount = btcToSatoshi($amount);

  #Get old balance
  $balance = getBalance($id);

  #Add amount
  $balance += $amount;

  #Update new balance
  newBalance($id, $balance);
}

function btcToSatoshi($amount) {
  $satoshi = 100000000; #1 btc = 100 000 000 satoshi, the smallest unit in bitcoin
  return floor($amount * $satoshi);
}

function satoshiToBtc($amount) {
  $satoshi = 100000000;
  return floor($amount) / $satoshi;
}

function debit($id,$amount) {
  #Debit amount from user with id

  $id = mysql_real_escape_string($id);
  $amount = mysql_real_escape_string($amount);
  $amount = btcToSatoshi($amount);

  $balance = getBalance($id);

  #Make sure enough balance is present
  if ($balance < $amount) {
    return -1;
  }

  $balance -= $amount;

  if(!newBalance($id, $balance)) {
    return -2;
  }
  return 0;
}

function sendBtc($id, $amount) {
  #Send btc from id to address
  $bitcoin = new jsonRPCClient("http://$bitcoin_user:$bitcoin_pass@127.0.0.1:8332/");

  if($bitcoin->getbalance() < $amount) {
    return -1;
  }

  if(!debit($id,$amount)) {
    return -2;
  }

  $address = getAddress($id);

  if($address == -1) {
    return -3;
  }

  $comment = getUsernameById($id);
  $bitcoin->sendtoaddress($address, $amount, $comment);
  return 0;
}

?>
