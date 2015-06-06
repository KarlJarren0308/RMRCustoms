<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'View') {
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
        $query = mysqli_query($connection, "SELECT * FROM waybills LEFT JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN companies ON clients.Company_ID=companies.Company_ID LEFT JOIN trucks ON waybills.Truck_ID=trucks.Truck_ID WHERE waybills.Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            if($row['First_Name'] == 'Not Available' && $row['Middle_Name'] == 'Not Available' && $row['Last_Name'] == 'Not Available') {
                $key = 'Company Name';
                $name = $row['Company_Name'];
            } else {
                $key = 'Client Name';

                if(strlen($row['Middle_Name']) > 1) {
                    $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
                } else {
                    $name = $row['First_Name'] . ' ' . $row['Last_Name'];
                }
            }

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';
            echo '<tr>';
            echo '<td width="30%" align="right">Waybill Number:</td>';
            echo '<td><a class="copy-to-clipboard" data-clipboard-text="' . $row['Waybill_Number'] . '" title="Click to copy">' . $row['Waybill_Number'] . '</a></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Description:</td>';
            echo '<td>' . $row['Description'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">' . $key . ':</td>';
            echo '<td>' . $name . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Truck Name:</td>';
            echo '<td>' . $row['Truck_Name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Credit:</td>';
            echo '<td>&#8369; ' . $row['Credit'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Debit:</td>';
            echo '<td>&#8369; ' . $row['Debit'] . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';

            $queryCheques = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$row[Waybill_Number]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($queryCheques) {
                $rowCheques = mysqli_fetch_array($queryCheques);

                $chequeNumber = json_decode($rowCheques['Cheque_Number']);
                $bankName = json_decode($rowCheques['Bank_Name']);
                $chequeDate = json_decode($rowCheques['Cheque_Date']);
                
                if(count($chequeNumber) > count($bankName)) {
                    if(count($chequeNumber) > count($chequeDate)) {
                        $countCheques = count($chequeNumber);
                    } else {
                        $countCheques = count($chequeDate);
                    }
                } else {
                    if(count($bankName) > count($chequeDate)) {
                        $countCheques = count($bankName);
                    } else {
                        $countCheques = count($chequeDate);
                    }
                }

                echo '<div class="well">';
                // echo '<h3 class="no-margin">Cheque Information <button id="add-new-cheque-button" class="btn btn-primary btn-xs pull-right" data-cheque-count="' . $countCheques . '">Add New Cheque</button></h3>';
                echo '<h3 class="no-margin">Cheque Information</h3>';
                echo '<br>';
                echo '<form id="cheque-form">';
                echo '<table id="cheque-table" class="table table-hover table-striped">';
                echo '<thead class="bg-dark">';
                echo '<tr>';
                echo '<th>Cheque Number</th>';
                echo '<th>Bank Name</th>';
                echo '<th>Cheque Date</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                for($i = 0; $i < $countCheques; $i++) {
                    /*
                    echo '<tr>';
                    echo '<td><textarea name="cChequeNumber-' . $i . '" class="form-control" required>' . @$chequeNumber[$i] . '</textarea></td>';
                    echo '<td><textarea name="cBankName-' . $i . '" class="form-control" required>' . @$bankName[$i] . '</textarea></td>';
                    echo '<td><textarea name="cChecqueDate-' . $i . '" class="form-control" required>' . @$chequeDate[$i] . '</textarea></td>';
                    echo '</tr>';
                    */

                    echo '<tr>';
                    echo '<td>' . @$chequeNumber[$i] . '</td>';
                    echo '<td>' . @$bankName[$i] . '</td>';
                    echo '<td>' . @date('F d, Y', strtotime($chequeDate[$i])) . '</td>';
                    echo '</tr>';
                }

                if($countCheques == 0) {
                    echo '<tr id="cheque-table-error">';
                    echo '<td colspan="3" align="center">No cheque found.</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>';
            echo '</table>';
            // echo '<div class="text-right"><button id="save-cheques-button" type="submit" class="btn btn-primary">Save Changes</button></div>';
            // echo '<div class="text-right"><input type="submit" class="btn btn-primary" value="Save Changes"></div>';
            // echo '</form>';
            echo '</div>';
            echo '<div id="bill-of-lading-well" class="well">';
            // echo '<h3 class="no-margin">Bill of Lading<button id="add-item-to-bill-button" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Item</button></h3>';
            echo '<h3 class="no-margin">Bill of Lading</h3>';
            echo '<br>';
            // echo '<form id="bill-of-lading-form">';
            // echo '<input type="hidden" name="waybillNumber" value="' . $row['Waybill_Number'] . '">';
            // echo '<input type="hidden" name="billID" value="' . $row['Bill_of_Lading_ID'] . '">';

            $queryBills = mysqli_query($connection, "SELECT * FROM ladings WHERE Bill_of_Lading_ID='$row[Bill_of_Lading_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($queryBills) {
                $rowBills = mysqli_fetch_array($queryBills);

                //echo '<div class="row">';
                // echo '<div class="col-lg-6 col-md-6"><label>Bill of Lading ID:</label><input type="text" class="form-control" name="newBill" placeholder="Enter Bill of Lading Number here..." value="' . $rowBills['Bill_of_Lading_ID'] . '" required></div>';
                // echo '<div class="col-lg-6 col-md-6"><label>Consignee:</label><input type="text" class="form-control" name="consignee" placeholder="Enter Consignee here..." value="' . $rowBills['Consignee'] . '" required></div>';
                // echo '</div><br><div class="row">';
                // echo '<div class="col-lg-6 col-md-6"><label>Export References:</label><input type="text" class="form-control" name="exportReferences" placeholder="Enter Export References here..." value="' . $rowBills['Export_References'] . '" required></div>';
                // echo '<div class="col-lg-6 col-md-6">';
                // echo '<label>Date:</label><div class="nested-group">';
                // echo '<input type="number" class="date-input-control input-group form-control" name="dateMonth" min="1" max="12" placeholder="Month" value="' . date('n', strtotime($rowBills['Date_of_Transaction'])) . '" required>';
                // echo '<input type="number" class="date-input-control form-control" name="dateDay" min="1" max="31" placeholder="Day" value="' . date('j', strtotime($rowBills['Date_of_Transaction'])) . '" required>';
                // echo '<input type="number" class="date-input-control form-control" name="dateYear" min="2000" max="' . date('Y') . '" placeholder="Year" value="' . date('Y', strtotime($rowBills['Date_of_Transaction'])) . '" required></div>';
                // echo '</div></div>';

                echo '<table class="table table-hover table-striped">';
                echo '<tbody>';
                echo '<tr>';
                echo '<td width="30%" align="right">Bill of Lading ID:</td>';
                echo '<td>' . $rowBills['Bill_of_Lading_ID'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right">Consignee:</td>';
                echo '<td>' . $rowBills['Consignee'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right">Export References:</td>';
                echo '<td>' . $rowBills['Export_References'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right">Date:</td>';
                echo '<td>' . date('F d, Y', strtotime($rowBills['Date_of_Transaction'])) . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<br>';
                echo '<table id="bill-of-lading-table" class="table table-hover table-striped">';
                echo '<thead>';
                echo '<tr class="bg-dark">';
                echo '<th width="25%">Mark</th>';
                echo '<th width="25%">Quantity</th>';
                echo '<th width="75%">Item Description</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                $mark = json_decode($rowBills['Item_Mark']);
                $quantity = json_decode($rowBills['Item_Quantity']);
                $description = json_decode($rowBills['Item_Description']);
                
                if(count($mark) > count($quantity)) {
                    if(count($mark) > count($description)) {
                        $count = count($mark);
                    } else {
                        $count = count($description);
                    }
                } else {
                    if(count($quantity) > count($description)) {
                        $count = count($quantity);
                    } else {
                        $count = count($description);
                    }
                }

                for($i = 0; $i < $count; $i++) {
                    echo '<tr>';
                    echo '<td>' . @$mark[$i] . '</td>';
                    echo '<td>' . @$quantity[$i] . '</td>';
                    echo '<td>' . @$description[$i] . '</td>';
                    echo '</tr>';
                }

                if($count == 0) {
                    echo '<tr>';
                    echo '<td colspan="3" align="center">No item found.</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>';
            echo '</table>';
            // echo '<input class="btn btn-primary" type="submit" value="Save">';
            // echo '</form>';
            echo '</div>';
        }
    } else if($action == 'Add') {
        $createTransactionClientID = mysqli_real_escape_string($connection, $_POST['createTransactionClientID']);
        $createTransactionDescription = mysqli_real_escape_string($connection, $_POST['createTransactionDescription']);
        $createTransactionModeOfTransaction = mysqli_real_escape_string($connection, $_POST['createTransactionModeOfTransaction']);
        $createTransactionContainerSize = mysqli_real_escape_string($connection, $_POST['createTransactionContainerSize']);
        //$createTransactionPickupLocation = mysqli_real_escape_string($connection, $_POST['createTransactionPickupLocation']);
        $createTransactionPickupLocation = '';
        $createTransactionDeliveryLocation = mysqli_real_escape_string($connection, $_POST['createTransactionDeliveryLocation']);
        $createTransactionBillOfLading = mysqli_real_escape_string($connection, $_POST['createTransactionBillOfLading']);
        $datetime = date('Y-m-d');
        $waybillNumber = date('Ymd') . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);

        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 0) {
            $query = mysqli_query($connection, "INSERT INTO waybills (Waybill_Number, Description, Transaction_Date, Mode_of_Transaction, Container_Size, Pickup_Location, Delivery_Location, Bill_of_Lading_ID, Client_ID) VALUES ('$waybillNumber', '$createTransactionDescription', '$datetime', '$createTransactionModeOfTransaction', '$createTransactionContainerSize', '$createTransactionPickupLocation', '$createTransactionDeliveryLocation', '$createTransactionBillOfLading', '$createTransactionClientID')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'You successfully created a transaction.';
            } else {
                echo 'Failed to created a transaction.';
            }
        } else {
            echo 'Transaction already exist.';
        }
    } else if($action == 'View Payment') {
        $totalCredit = 0;
        $totalDebit = 0;
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $row = mysqli_fetch_array($query);

        echo '<table class="table table-hover table-striped">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td align="right" width="30%">Waybill Number:</td>';
        echo '<td>' . $waybillNumber . '</td>';
        echo '</tr>';
        echo '<tr>';

        $query2 = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$row[Client_ID]' AND Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        while($row2 = mysqli_fetch_array($query2)) {
            $totalCredit += (double) $row2['Credit'];
            $totalDebit += (double) $row2['Debit'];
        }

        if($row['Credit'] > 0 && $row['Debit'] == 0) {
            /*
            echo '<td align="right">Cheque Number:</td>';
            echo '<td>' . $row['Cheque_Number'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Bank Name:</td>';
            echo '<td>' . $row['Bank_Name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Cheque Date [yyyy-mm-dd]:</td>';
            echo '<td>' . $row['Cheque_Date'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            */
        } else {
            echo '<td align="right">Cheque Number:</td>';
            echo '<td><input id="cheque-number" type="text" class="form-control" placeholder="Enter Cheque Number here..."></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Bank Name:</td>';
            echo '<td><input id="bank-name" type="text" class="form-control" placeholder="Enter Bank Name here..."></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Cheque Date [yyyy-mm-dd]:</td>';
            echo '<td><div class="row"><div class="col-lg-4 col-md-4"><input id="cheque-month" type="number" min="1" max="12" class="form-control" placeholder="Month"></div><div class="col-lg-4 col-md-4"><input id="cheque-day" type="number" min="1" max="31" class="form-control" placeholder="Day"></div><div class="col-lg-4 col-md-4"><input id="cheque-year" type="number" min="2000" max="' . (date('Y') + 5) . '" class="form-control" placeholder="Year"></div></div></td>';
            echo '</tr>';
            echo '<tr>';
        }
        
        if($row['Credit'] == 0 && $row['Debit'] == 0) {
            echo '<td align="right">Credit:</td>';
            echo '<td><div class="input-group"><input type="number" min="0" max="" id="transaction-credit" class="form-control" placeholder="Enter Credit here..."><span class="input-group-btn"><button id="transaction-credit-locker-button" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span></button></span></div></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Debit:</td>';
            
            // echo '<span style="display: none;">' . (800000 - $totalDebit) . '</span>';
            // echo '<td><input type="number" min="0" data-max="' . (800000 - $totalDebit) . '" id="transaction-debit" class="form-control" placeholder="Enter Debit here..."></td>';

            if($totalDebit <= 800000) {
                echo '<td><div class="input-group"><input type="number" min="0" max="' . (800000 - $totalDebit) . '" id="transaction-debit" class="form-control" placeholder="Enter Debit here..."><span class="input-group-btn"><button class="btn btn-default" id="transaction-debit-locker-button"><span class="glyphicon glyphicon-lock"></span></button></span></div></td>';
            } else {
                echo '<td><div class="input-group"><input type="number" min="0" max="0" id="transaction-debit" class="form-control" placeholder="Enter Debit here..."><span class="input-group-btn"><button class="btn btn-default" id="transaction-debit-locker-button"><span class="glyphicon glyphicon-lock"></span></button></span></div></td>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '<div class="text-right"><button id="set-new-payment-button" class="btn btn-primary">Set Initial Payment</button></div>';
        } else {
            echo '<td align="right">Credit:</td>';
            echo '<td>&#8369; <span id="transaction-credit">' . $row['Credit'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Debit:</td>';
            echo '<td>&#8369; <span id="transaction-debit">' . $row['Debit'] . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';

            if($row['Debit'] > 0) {
                echo '<div class="well">';
                echo '<div class="row"><div class="col-lg-3 col-md-3 text-right"><strong>Set Payment:</strong></div><div class="col-lg-9 col-md-9"><div class="input-group"><input id="transaction-payment" class="form-control" type="number" min="0" max="' . $row['Debit'] . '" value="0"><span class="input-group-btn"><button id="transaction-payment-locker-button" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span></button></span></div></div></div>';
                echo '</div>';
                echo '<div class="text-right"><button id="set-payment-button" class="btn btn-primary">Set Payment</button></div>';
            } else {
                echo '<div class="well-success">';
                echo '<div class="row"><div class="col-lg-3 col-md-3 text-right"><strong>Set Payment:</strong></div><div class="col-lg-9 col-md-9"><strong style="font-size: 25px;">Fully Paid</strong></div></div>';
                echo '</div>';
            }
        }
    } else if($action == 'Set Payment') {
        $newChequeNumber = [];
        $newBankName = [];
        $newChequeDate = [];
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
        $payment = mysqli_real_escape_string($connection, $_POST['payment']);
        $chequeNumber = mysqli_real_escape_string($connection, $_POST['chequeNumber']);
        $bankName = mysqli_real_escape_string($connection, $_POST['bankName']);
        $chequeMonth = mysqli_real_escape_string($connection, $_POST['chequeMonth']);
        $chequeDay = mysqli_real_escape_string($connection, $_POST['chequeDay']);
        $chequeYear = mysqli_real_escape_string($connection, $_POST['chequeYear']);

        $chequeDate = $chequeYear . '-' . $chequeMonth . '-' . $chequeDay;

        $queryCheques = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $rowCheques = mysqli_fetch_array($queryCheques);

        $newChequeNumber = json_decode($rowCheques['Cheque_Number']);
        $newBankName = json_decode($rowCheques['Bank_Name']);
        $newChequeDate = json_decode($rowCheques['Cheque_Date']);

        if(strlen($chequeNumber) > 0 && strlen($bankName) > 0 && strlen($chequeDate) > 0) {
            array_push($newChequeNumber, $chequeNumber);
            array_push($newBankName, $bankName);
            array_push($newChequeDate, $chequeDate);
        }

        $newChequeNumber = json_encode($newChequeNumber);
        $newBankName = json_encode($newBankName);
        $newChequeDate = json_encode($newChequeDate);

        $query = mysqli_query($connection, "UPDATE waybills SET Credit=Credit+$payment, Debit=Debit-$payment, Cheque_Number='$newChequeNumber', Bank_Name='$newBankName', Cheque_Date='$newChequeDate' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            echo 'Payment has been set.';
        } else {
            echo 'Failed to set payment.';
        }
    } else if($action == 'Set New Payment') {
        $newChequeNumber = [];
        $newBankName = [];
        $newChequeDate = [];
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
        $credit = mysqli_real_escape_string($connection, $_POST['credit']);
        $debit = mysqli_real_escape_string($connection, $_POST['debit']);
        $chequeNumber = mysqli_real_escape_string($connection, $_POST['chequeNumber']);
        $bankName = mysqli_real_escape_string($connection, $_POST['bankName']);
        $chequeMonth = mysqli_real_escape_string($connection, $_POST['chequeMonth']);
        $chequeDay = mysqli_real_escape_string($connection, $_POST['chequeDay']);
        $chequeYear = mysqli_real_escape_string($connection, $_POST['chequeYear']);

        $chequeDate = $chequeYear . '-' . $chequeMonth . '-' . $chequeDay;

        $queryCheques = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $rowCheques = mysqli_fetch_array($queryCheques);

        $newChequeNumber = json_decode($rowCheques['Cheque_Number']);
        $newBankName = json_decode($rowCheques['Bank_Name']);
        $newChequeDate = json_decode($rowCheques['Cheque_Date']);

        if(strlen($chequeNumber) > 0 && strlen($bankName) > 0 && strlen($chequeDate) > 0) {
            array_push($newChequeNumber, $chequeNumber);
            array_push($newBankName, $bankName);
            array_push($newChequeDate, $chequeDate);
        }

        $newChequeNumber = json_encode($newChequeNumber);
        $newBankName = json_encode($newBankName);
        $newChequeDate = json_encode($newChequeDate);

        $query = mysqli_query($connection, "UPDATE waybills SET Credit='$credit', Debit='$debit', Cheque_Number='$newChequeNumber', Bank_Name='$newBankName', Cheque_Date='$newChequeDate' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            echo 'Payment has been set.';
        } else {
            echo 'Failed to set payment.';
        }
    } else if($action == 'Delete') {
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $row = mysqli_fetch_array($query);

        $query = mysqli_query($connection, "UPDATE waybills SET Status='Inactive' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            if($row['Credit'] > 0 && $row['Debit'] == 0 && $row['Delivery_Status'] == 'Complied') {
                $query = mysqli_query($connection, "UPDATE ladings SET Status='Inactive' WHERE Bill_of_Lading_ID='$row[Bill_of_Lading_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                
                if($query) {
                    echo 'Transaction successfully deleted.';
                } else {
                    echo 'Failed to delete transaction\'s bill of lading.';
                }
            } else {
                echo 'Transaction successfully deleted.';
            }
        } else {
            echo 'Failed to delete transaction.';
        }
    } else if($action == 'Check Input') {
        $checker = $_POST['checker'];
        $input = (double) mysqli_real_escape_string($connection, $_POST['input']);
        $min = (double) mysqli_real_escape_string($connection, $_POST['min']);
        $max = (double) mysqli_real_escape_string($connection, $_POST['max']);

        if($checker == 'isNumeric') {
            if(preg_match('/0-9./', $input)) {
                echo 'Numeric';
            } else {
                echo 'Not Numeric';
            }
        } else if($checker == 'isAlpha') {
            if(preg_match('/^0-9/', $input)) {
                echo 'Alpha';
            } else {
                echo 'Not Alpha';
            }
        } else if($checker == 'isGreaterThan') {
            if($input > $max) {
                echo 'Greater Than';
            } else {
                echo 'Not Greater Than';
            }
        } else if($checker == 'isLessThan') {
            if($input < $max) {
                echo 'Less Than';
            } else {
                echo 'Not Less Than';
            }
        } else if($checker == 'isInRange') {
            if($input >= $min && $input <= $max) {
                echo 'In Range';
            } else {
                if($input <= $min) {
                    echo 'Lower';
                } else {
                    echo 'Higher';
                }
            }
        }
    }

    echo '<script>var client = new ZeroClipboard($(".copy-to-clipboard"));</script>';

    mysqli_close($connection);
?>