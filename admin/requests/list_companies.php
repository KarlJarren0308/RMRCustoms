<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Status='Active' AND (clients.First_Name LIKE '%$search%' OR clients.Middle_Name LIKE '%$search%' OR clients.Last_Name LIKE '%$search%' OR companies.Company_Name LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Middle_Name, ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), '. ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Last_Name) LIKE '%$search%') ORDER BY clients.Client_ID") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            if($row['First_Name'] == 'Not Available' && $row['Middle_Name'] == 'Not Available' && $row['Last_Name'] == 'Not Available') {
                $middleInitial = isset($row['Middle_Name']) && strlen($row['Middle_Name']) > 1 ? substr($row['Middle_Name'], 0, 1) . '. ' : '';

                echo '<tr>';
                echo '<td align="center">' . $row['Company_ID'] . '</td>';
                echo '<td>' . $row['Company_Name'] . '</td>';
                echo '<td align="center"><button class="btn btn-xs btn-primary" data-execute="View Client Info" data-var="' . $row['Client_ID'] . ';' . $row['First_Name'] . ';' . $row['Middle_Name'] . ';' . $row['Last_Name'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Info</button>&nbsp;<button class="btn btn-xs btn-primary" data-execute="View Cheques" data-var="' . $row['Client_ID'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Cheques</button>&nbsp;<button class="btn btn-xs btn-success" data-execute="Edit Client Info" data-var="' . $row['Client_ID'] . ';' . $row['First_Name'] . ';' . $row['Middle_Name'] . ';' . $row['Last_Name'] . ';' . $row['Company_ID'] . '"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit Info</button>&nbsp;<button class="btn btn-xs btn-danger" data-execute="Delete Client Info" data-var="' . $row['Client_ID'] . ';' . $row['First_Name'] . ';' . $row['Middle_Name'] . ';' . $row['Last_Name'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Company</button></td>';
                echo '</tr>';
            }
        }
    } else {
        echo '<tr>';
        echo '<td colspan="3" align="center">No Results Found</td>';
        echo '</tr>';
    }

    mysqli_close($connection);
?>