<?php
    function hash_password($password) {
        for($i = 0; $i < 10000; $i++) {
            $password = hash('sha256', $password);
        }
        return $password;
    }
?>