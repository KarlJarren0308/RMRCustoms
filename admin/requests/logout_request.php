<?php
    require('connection.php');

    unset($_SESSION['rmr_username']);
    unset($_SESSION['rmr_name']);

    header('Location: ../home.php');
?>