<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM trucks WHERE Truck_Name LIKE '%$search%'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td>' . $row['Truck_Name'] . '</td>';
            echo '<td>' . $row['IMEI_Number'] . '</td>';
            echo '<td>' . $row['Status'] . '</td>';
            echo '<td align="center"><button class="btn btn-xs btn-primary" data-execute="View Truck Info" data-var="' . $row['Truck_Name'] . ';' . $row['IMEI_Number'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Info</button>&nbsp;&nbsp;<button class="btn btn-xs btn-success" data-execute="Edit Truck Info" data-var="' . $row['Truck_Name'] . ';' . $row['IMEI_Number'] . '"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit Info</button>&nbsp;&nbsp;<button class="btn btn-xs btn-danger" data-execute="Remove Truck Info" data-var="' . $row['Truck_Name'] . ';' . $row['IMEI_Number'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Truck</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="4" align="center">No Results Found</td>';
        echo '</tr>';
    }

    mysqli_close($connection);
?>