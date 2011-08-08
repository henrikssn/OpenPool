<?php
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        if (!new_user($_POST["username"], $_POST["password"])) {
            $error = "An error has occured, please try again.";
        } else {
            header("Location: /profile.php");
        }
    }
?>