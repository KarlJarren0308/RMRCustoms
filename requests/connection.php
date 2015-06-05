<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
    
    $connection = mysqli_connect('localhost', 'root', '', 'billing_system') or die('Cannot connect to Server.');
?>