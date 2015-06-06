<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $log = mysqli_real_escape_string($connection, $_POST['log']);
    $datetime = date('Y-m-d H:i:s');

    if($log == 'Login') {
        $log = 'has logged in.';
    } else if($log == 'Logout') {
        $log = 'has logged out.';
    } else {
        $log = 'accessed the ' . $log . '.';
    }

    $query = mysqli_query($connection, "INSERT INTO logs (Account_Username, Log, Log_Datetime) VALUES ('$username', '$log', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

    mysqli_close($connection);
?>