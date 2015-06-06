<?php
    require('connection.php');

    $search = '';

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $query = mysqli_query($connection, "SELECT * FROM waybills INNER JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN trucks ON waybills.Truck_ID=trucks.Truck_ID WHERE waybills.Waybill_Number LIKE '%$search%' AND waybills.Status='Active' ORDER BY waybills.Transaction_Date") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td>' . $row['Waybill_Number'] . '</td>';
            echo '<td>' . $row['Description'] . '</td>';
            echo '<td>' . $row['Truck_Name'] . '</td>';
            echo '<td>' . $row['Delivery_Status'] . '</td>';
            echo '<td>&#8369; ' . number_format($row['Credit'], 2, '.', '') . '</td>';
            echo '<td>&#8369; ' . number_format($row['Debit'], 2, '.', '') . '</td>';
            echo '<td align="center"><button class="btn btn-primary btn-xs btn-block" data-execute="View Transaction Info" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;View Information</button><button class="btn btn-success btn-xs btn-block" data-execute="Set Payment" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Set Payment</button><button class="btn btn-danger btn-xs btn-block" data-execute="Delete Transaction Info" data-var="' . $row['Waybill_Number'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Transaction</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="7" align="center">No Results Found</td>';
        echo '</tr>';
    }

    mysqli_close($connection);
?>