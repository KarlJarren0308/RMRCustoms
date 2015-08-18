<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search']) && $_GET['search'] != '') {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM ladings INNER JOIN clients ON ladings.Bill_of_Lading_ID=clients.Client_ID WHERE (clients.First_Name LIKE '%$search%' OR clients.Middle_Name LIKE '%$search%' OR clients.Last_Name LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Middle_Name, ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), '. ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Last_Name) LIKE '%$search%' OR ladings.Consignee LIKE '%$search%') AND ladings.Status='Active'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            echo '<tr>';
            echo '<td>' . $name . '</td>';
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