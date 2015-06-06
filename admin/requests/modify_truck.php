<?php
    require('connection.php');

    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'View') {
        $truckName = mysqli_real_escape_string($connection, $_POST['truckName']);
        $imeiNumber = mysqli_real_escape_string($connection, $_POST['imeiNumber']);

        $query = mysqli_query($connection, "SELECT * FROM trucks WHERE Truck_Name='$truckName' AND IMEI_Number='$imeiNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';
            echo '<tr>';
            echo '<td width="30%" align="right">Truck Name:</td>';
            echo '<td>' . $row['Truck_Name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td width="30%" align="right">IMEI Number:</td>';
            echo '<td>' . $row['IMEI_Number'] . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '<div id="pending-transactions-well" class="well">';
            echo '<h3 class="no-margin">Pending Transactions</h3><br>';
            echo '<div class="input-group"><select id="add-pending-transactions" class="form-control" name="addPendingTransactions"><option value="" selected disabled>Choose waybill number here...</option>';

            $queryTransactions1 = mysqli_query($connection, "SELECT * FROM waybills WHERE Status='Active' AND Delivery_Status='Inactive' AND Truck_ID='-1'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            while($rowTransactions1 = mysqli_fetch_array($queryTransactions1)) {
                echo '<option value="' . $rowTransactions1['Waybill_Number'] . '">' . $rowTransactions1['Waybill_Number'] . '</option>';
            }

            echo '</select><span class="input-group-btn"><button id="add-pending-transactions-button" class="btn btn-primary" data-var="' . $row['Truck_ID'] . '"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Transaction</button></span></div>';
            echo '<br>';
            echo '<table id="pending-transactions-table" class="table table-hover table-striped bg-white">';
            echo '<thead>';
            echo '<tr class="bg-dark">';
            echo '<th width="25%">Waybill Number</th>';
            echo '<th>Delivery Address</th>';

            $queryTransactions2 = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$row[Truck_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scanTransactions = mysqli_num_rows($queryTransactions2);
            $complyAll = '';
            $flag = true;

            if($scanTransactions > 0) {
                while($rowTransactions2 = mysqli_fetch_array($queryTransactions2)) {
                    if($flag) {
                        $complyAll .= $rowTransactions2['Waybill_Number'];
                        $flag = false;
                    } else {
                        $complyAll .= ';' . $rowTransactions2['Waybill_Number'];
                    }
                }
            } else {
                $complyAll = 'None';
            }

            echo '<th><button id="comply-all-button" class="btn btn-success btn-xs pull-right" data-execute="Comply All Pending Transaction" data-var="' . $row['Truck_ID'] . ';' . $complyAll . '"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Comply All</button></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $queryTransactions2 = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$row[Truck_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            while($rowTransactions3 = mysqli_fetch_array($queryTransactions2)) {
                echo '<tr>';
                echo '<td><a class="copy-to-clipboard" data-clipboard-text="' . $rowTransactions3['Waybill_Number'] . '" title="Click to copy">' . $rowTransactions3['Waybill_Number'] . '</a></td>';
                echo '<td>' . $rowTransactions3['Delivery_Location'] . '</td>';
                echo '<td align="right"><button id="comply-pending-transaction-button" class="btn btn-success btn-xs" data-execute="Comply Pending Transaction" data-var="' . $row['Truck_ID'] . ';' . $rowTransactions3['Waybill_Number'] . '"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Comply</button>&nbsp;&nbsp;<button id="remove-pending-transaction-button" class="btn btn-danger btn-xs" data-execute="Remove Pending Transaction" data-var="' . $row['Truck_ID'] . ';' . $rowTransactions3['Waybill_Number'] . '"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove</button></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
    } else if($action == 'Add') {
        $truckName = mysqli_real_escape_string($connection, $_POST['truckName']);
        $imeiNumber = mysqli_real_escape_string($connection, $_POST['imeiNumber']);

        $query1 = mysqli_query($connection, "SELECT * FROM trucks WHERE Truck_Name='$truckName'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan1 = mysqli_num_rows($query1);

        $query2 = mysqli_query($connection, "SELECT * FROM trucks WHERE IMEI_Number='$imeiNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan2 = mysqli_num_rows($query2);

        if($scan1 == 0 && $scan2 == 0) {
            $query = mysqli_query($connection, "INSERT INTO trucks (Truck_Name, IMEI_Number) VALUES ('$truckName', '$imeiNumber')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'Truck successfully added.';
            } else {
                echo 'Failed to add truck.';
            }
        } else {
            if($scan1 > 0 && $scan2 > 0) {
                echo 'Truck already exist.';
            } else if($scan1 > 0 && $scan2 == 0) {
                echo 'Truck Name has already been used.';
            } else {
                echo 'IMEI Number has already been used.';
            }
        }
    } else if($action == 'Edit') {
        $truckName = mysqli_real_escape_string($connection, $_POST['truckName']);
        $imeiNumber = mysqli_real_escape_string($connection, $_POST['imeiNumber']);

        echo '<table class="table table-hover table-striped">';
        echo '<tr>';
        echo '<td><label>Truck Name:</label><br><input class="form-control" type="text" name="newTruckName" placeholder="Enter Truck Name here..." value="' . $truckName . '"></td>';
        echo '<td><label>IMEI Number:</label><br><input class="form-control" type="text" name="newImeiNumber" placeholder="Enter IMEI Number here..." value="' . $imeiNumber . '"></td>';
        echo '</tr>';
        echo '</table>';
        echo '<div class="text-right"><button id="save-changes-button" class="btn btn-primary">Save Changes</button></div>';
    } else if($action == 'Delete') {
        $truckName = mysqli_real_escape_string($connection, $_POST['truckName']);
        $imeiNumber = mysqli_real_escape_string($connection, $_POST['imeiNumber']);

        $query = mysqli_query($connection, "SELECT * FROM trucks WHERE Truck_Name='$truckName' AND IMEI_Number='$imeiNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $row = mysqli_fetch_array($query);

        $queryWaybills = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$row[Truck_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scanWaybills = mysqli_num_rows($queryWaybills);

        if($scanWaybills > 0) {
            echo 'Unable to delete truck. Please remove all pending transactions first before deleting truck.';
        } else {
            $query = mysqli_query($connection, "DELETE FROM trucks WHERE Truck_Name='$truckName' AND IMEI_Number='$imeiNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'Truck successfully deleted.';
            } else {
                echo 'Failed to delete truck.';
            }
        }
    } else if($action == 'Save') {
        $oldTruckName = mysqli_real_escape_string($connection, $_POST['oldTruckName']);
        $oldImeiNumber = mysqli_real_escape_string($connection, $_POST['oldImeiNumber']);
        $newTruckName = mysqli_real_escape_string($connection, $_POST['newTruckName']);
        $newImeiNumber = mysqli_real_escape_string($connection, $_POST['newImeiNumber']);

        if($newTruckName != '' && $newImeiNumber != '') {
            $query = mysqli_query($connection, "UPDATE trucks SET Truck_Name='$newTruckName', IMEI_Number='$newImeiNumber' WHERE Truck_Name='$oldTruckName' AND IMEI_Number='$oldImeiNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            echo 'Saved Changes.';
        } else {
            echo 'All fields should not be empty.';
        }
    }

    echo '<script>var client = new ZeroClipboard($(".copy-to-clipboard"));</script>';

    mysqli_close($connection);
?>