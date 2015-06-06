<?php
    require('connection.php');

    $query = mysqli_query($connection, "SELECT * FROM logs INNER JOIN accounts ON logs.Account_Username=accounts.Account_Username ORDER BY logs.Log_Datetime DESC") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

    while($row = mysqli_fetch_array($query)) {
        if(strlen($row['Middle_Name']) > 1) {
            $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
        } else {
            $name = $row['First_Name'] . ' ' . $row['Last_Name'];
        }

        echo '<div class="noti"><h4 class="noti-title shadow">System Notification</h4><h4 class="noti-time">' . date('F d, Y (h:iA)', strtotime($row['Log_Datetime'])) . '</h4><p class="noti-body">' . $name . ' ' . $row['Log'] . '</p></div>';
    }

    mysqli_close($connection);
?>