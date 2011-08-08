<?php
    require(SERVER_ROOT."/config/config.php");
    mysql_connect('localhost',MYSQL_USER,MYSQL_PASS) or die("Unable to connect to mysql");
    @mysql_select_db($mysql_db) or die("Unable to select database");
?>
