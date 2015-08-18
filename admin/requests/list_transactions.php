<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM waybills INNER JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN trucks ON waybills.Truck_ID=trucks.Truck_ID WHERE (waybills.Waybill_Number LIKE '%$search%' OR clients.First_Name LIKE '%$search%' OR clients.Middle_Name LIKE '%$search%' OR clients.Last_Name LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', clients.Middle_Name, ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), ' ', clients.Last_Name) LIKE '%$search%' OR CONCAT(clients.First_Name, ' ', LEFT(clients.Middle_Name, 1), '. ', clients.Last_Name) LIKE '%$search%') AND waybills.Status='Active' ORDER BY waybills.Transaction_Date") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            if($row['Display'] == 'Show') {
                $disp = 'Hide';
                $eye = 'close';
            } else {
                $disp = 'Show';
                $eye = 'open';
            }

            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            echo '<tr>';
            echo '<td><a class="copy-to-clipboard" data-clipboard-text="' . $row['Waybill_Number'] . '" title="Click to copy">' . $row['Waybill_Number'] . '</a></td>';
            echo '<td>' . $name . '</td>';
            echo '<td>' . $row['Truck_Name'] . '</td>';
            echo '<td>' . $row['Delivery_Status'] . '</td>';
            echo '<td>&#8369; ' . number_format($row['Credit'], 2, '.', '') . '</td>';
            echo '<td>&#8369; ' . number_format($row['Debit'], 2, '.', '') . '</td>';
            echo '<td align="center">';
            echo '<button class="btn btn-primary btn-xs btn-block" data-execute="View Transaction Info" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Information</button>';
            
            if($row['Display'] == 'Show') {
                echo '<button class="btn btn-warning btn-xs btn-block" data-execute="' . $disp . ' Transaction" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-eye-' . $eye . '"></span>&nbsp;&nbsp;' . $disp . ' Transaction to Client</button>';
            }

            echo '<button class="btn btn-success btn-xs btn-block" data-execute="Set Payment" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Set Payment</button>';
            echo '<button class="btn btn-danger btn-xs btn-block" data-execute="Delete Transaction Info" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Transaction</button>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="7" align="center">No Results Found</td>';
        echo '</tr>';
    }

    echo '<script>var client = new ZeroClipboard($(".copy-to-clipboard"));</script>';

    mysqli_close($connection);
?>