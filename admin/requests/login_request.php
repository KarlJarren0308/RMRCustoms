<?php
    require('connection.php');

    $username = mysqli_real_escape_string($connection, $_GET['username']);
    $password = mysqli_real_escape_string($connection, $_GET['password']);

    $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$username' AND Account_Password='$password'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan == 1) {
        $row = mysqli_fetch_array($query);

        $middlename = strlen($row['Middle_Name']) > 1 ? substr($row['Middle_Name'], 0, 1) . '. ' : '';

        $_SESSION['rmr_username'] = $row['Account_Username'];
        $_SESSION['rmr_type'] = $row['Account_Type'];
        $_SESSION['rmr_profile'] = $row['User_Image'];
        $_SESSION['rmr_name'] = $row['First_Name'] . ' ' . $middlename . $row['Last_Name'];

        echo 'Login Successful.';
    } else {
        echo 'Login Failed.';
    }
?>