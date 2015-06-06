<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Status='Active' AND (Account_Username LIKE '%$search%' OR First_Name LIKE '%$search%' OR Middle_Name LIKE '%$search%' OR Last_Name LIKE '%$search%' OR CONCAT(First_Name, ' ', Middle_Name, ' ', Last_Name) LIKE '%$search%' OR CONCAT(First_Name, ' ', LEFT(Middle_Name, 1), ' ', Last_Name) LIKE '%$search%' OR CONCAT(First_Name, ' ', LEFT(Middle_Name, 1), '. ', Last_Name) LIKE '%$search%' OR CONCAT(First_Name, ' ', Last_Name) LIKE '%$search%') ORDER BY Account_Type") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            $middleInitial = isset($row['Middle_Name']) && strlen($row['Middle_Name']) > 1 ? substr($row['Middle_Name'], 0, 1) . '. ' : '';

            echo '<tr>';
            echo '<td><img class="new-profile-picture img-rounded" src="user_files/' . $row['User_Image'] . '"></td>';
            echo '<td>' . $row['Account_Username'] . '</td>';
            echo '<td>' . $row['First_Name'] . ' ' . $middleInitial . $row['Last_Name'] . '</td>';
            echo '<td>' . $row['Account_Type'] . '</td>';
            echo '<td align="center"><button class="btn btn-xs btn-primary" data-execute="View User Info" data-var="' . $row['Account_Username'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Info</button>&nbsp;<button class="btn btn-xs btn-success" data-execute="Edit User Info" data-var="' . $row['Account_Username'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Edit Info</button>&nbsp;<button class="btn btn-xs btn-danger" data-execute="Delete User Info" data-var="' . $row['Account_Username'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Delete User</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="3" align="center">No Results Found</td>';
        echo '</tr>';
    }

    mysqli_close($connection);
?>