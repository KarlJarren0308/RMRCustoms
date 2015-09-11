<?php
    require('connection.php');

    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'View') {
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

        $query = mysqli_query($connection, "SELECT * FROM misc WHERE Waybill_Number='$waybillNumber'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        echo '<table class="table table-hover table-striped">';
        echo '<thead class="bg-dark">';
        echo '<tr>';
        echo '<th>Amount</th>';
        echo '<th width="50"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody id="misc-table-body">';

        if($scan > 0) {
            while($row = mysqli_fetch_array($query)) {
                echo '<tr data-id="' . $row['Miscellaneous_ID'] . '">';
                echo '<td>&#8369; ' . $row['Miscellaneous'] . '</td>';
                echo '<td align="center"><button class="btn btn-danger btn-xs btnMisc" data-var="' . $row['Miscellaneous_ID'] . '"><span class="glyphicon glyphicon-remove"></span></button></td>';
                echo '</tr>';
            }echo '';
        } else {
            echo '<tr>';
            echo '<td colspan="2" align="center">No Miscellaneous Found.</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<label>Set Miscellaneous:</label><div class="input-group"><input type="number" min="0" max="999999999999" id="set-miscellaneous" class="form-control" placeholder="Enter Miscellaneous here..."><span class="input-group-btn"><button id="set-miscellaneous-locker-button" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span></button></span></div>';
        echo '<br>';
        echo '<div class="text-right"><button id="set-miscellaneous-button" class="btn btn-primary">Add Miscellaneous</button></div>';
    } else if($action == 'Add') {
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
        $payment = mysqli_real_escape_string($connection, $_POST['payment']);

        $query = mysqli_query($connection, "INSERT INTO misc (Waybill_Number, Miscellaneous) VALUES ('$waybillNumber', '$payment')") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            echo 'Miscelaneous has been added.';
        } else {
            echo 'Failed to add miscellaneous.';
        }
    } else if($action == 'Delete') {
        $id = mysqli_real_escape_string($connection, $_POST['quantum']);

        $query = mysqli_query($connection, "DELETE FROM misc WHERE Miscellaneous_ID='$id'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
        
        if($query) {
            echo 'Miscellaneous has been removed.';
        } else {
            echo 'Failed to remove miscellaneous.';
        }
    }
?>