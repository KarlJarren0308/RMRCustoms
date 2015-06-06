<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search']) && $_GET['search'] != '') {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM ladings WHERE Bill_of_Lading_ID LIKE '%$search%' AND Status='Active'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td>' . $row['Bill_of_Lading_ID'] . '</td>';
            echo '<td>' . $row['Consignee'] . '</td>';
            echo '<td>' . date('F d, Y', strtotime($row['Date_of_Transaction'])) . '</td>';
            echo '<td align="center"><button class="btn btn-xs btn-success" data-execute="Edit Lading Info" data-var="' . $row['Bill_of_Lading_ID'] . '"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit Info</button>&nbsp;<button class="btn btn-xs btn-danger" data-execute="Delete Lading Info" data-var="' . $row['Bill_of_Lading_ID'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Lading</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="4" align="center">No Results Found</td>';
        echo '</tr>';
    }

    mysqli_close($connection);
?>