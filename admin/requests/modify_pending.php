<?php
    require('connection.php');

    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'Add') {
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
        $truckId = mysqli_real_escape_string($connection, $_POST['truckId']);

        if(strlen($waybillNumber) == 13) {
            $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);

            if($scan == 1) {
                $query = mysqli_query($connection, "UPDATE waybills SET Truck_ID='$truckId', Delivery_Status='Active' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    echo 'Transaction has been added.';
                } else {
                    echo 'Failed to set truck\'s pending transaction.';
                }
            } else {
                echo 'Unable to add transaction as the truck\'s pending transaction. Transaction has already been deleted.';
            }
        } else {
            if($waybillNumber == '') {
                echo 'Please select a transaction first...';
            } else {
                echo 'Invalid Waybill Number.';
            }
        }

        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan > 0) {
            $query = mysqli_query($connection, "UPDATE trucks SET Status='Active' WHERE Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        }
    } else if($action == 'Comply') {
        $truckId = mysqli_real_escape_string($connection, $_POST['truckId']);
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

        $queryUpdate = mysqli_query($connection, "UPDATE waybills SET Delivery_Status='Complied' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        
        if($queryUpdate) {
            $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);

            if($scan == 0) {
                $queryUpdate = mysqli_query($connection, "UPDATE trucks SET Status='Inactive' WHERE Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            }

            $query = mysqli_query($connection, "SELECT * FROM waybills LEFT JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE waybills.Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);

            if($scan == 1) {
                $row = mysqli_fetch_array($query);
                $emails = array($row['Email_Address'], $row['Company_Email_Address'], $row['Primary_Contact_Email']);
                $counter = 0;

                foreach($emails as $email) {
                    if(mail($email, 'Delivery Notification', "Waybill Number: " . $waybillNumber . "\n\nYour package has been delivered. Thank you!\n\nIf you received this message and your package has not yet reached its destination, please contact us immediately.", 'From: RMR Customs Brokerage Corporation <corp@rmrcustoms.com>')) {
                        $counter += 1;
                    }
                }

                if($counter > 0) {
                    echo 'Congratulations! A transaction has been complied. A delivery notification has been sent to client.';
                } else {
                    echo 'Congratulations! A transaction has been complied. A delivery notification was not sent to client.';
                }
            } else {
                echo 'Oops! Something went wrong. Please check if this transaction exist and try again.';
            }
        } else {
            echo 'System Error: Failed to comply transaction.';
        }
    } else if($action == 'Comply All') {
        $truckId = mysqli_real_escape_string($connection, $_POST['truckId']);
        $waybillNumbers = $_POST['waybillNumbers'];
        $failedWaybillMails = [];
        $ctr = 0;

        array_shift($waybillNumbers);
        array_shift($waybillNumbers);

        if(count($waybillNumbers) > 0 && !in_array('None', $waybillNumbers)) {
            foreach($waybillNumbers as $waybillNumber) {
                $waybillNumber = mysqli_real_escape_string($connection, $waybillNumber);
                $queryUpdate = mysqli_query($connection, "UPDATE waybills SET Delivery_Status='Complied' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            
                if($queryUpdate) {
                    $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    $scan = mysqli_num_rows($query);

                    if($scan == 0) {
                        $queryUpdate = mysqli_query($connection, "UPDATE trucks SET Status='Inactive' WHERE Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    }

                    $query = mysqli_query($connection, "SELECT * FROM waybills LEFT JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE waybills.Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    $scan = mysqli_num_rows($query);

                    if($scan == 1) {
                        $row = mysqli_fetch_array($query);
                        $emails = array($row['Email_Address'], $row['Company_Email_Address'], $row['Primary_Contact_Email']);
                        $counter = 0;

                        foreach($emails as $email) {
                            if(@mail($email, 'Delivery Notification', "Waybill Number: " . $waybillNumber . "\n\nYour package has been delivered. Thank you!\n\nIf you received this message and your package has not yet reached its destination, please contact us immediately.", 'From: RMR Customs Brokerage Corporation <corp@rmrcustoms.com>')) {
                                $counter += 1;
                            }
                        }

                        if($counter == 0) {
                            array_push($failedWaybillMails, $waybillNumber);
                        }
                    }
                } else {
                    $ctr += 1;
                    array_push($failedWaybills, $waybillNumber);
                }
            }

            if($ctr == 0) {
                echo 'All pending transactions has been successfully complied.';
            } else {
                echo 'All pending transactions has been successfully complied except for the following: ';

                foreach($failedWaybills as $key => $failedWaybill) {
                    echo ($key + 1) . '.) ' . $failedWaybill;

                    if($key + 1 != count($failedWaybills)) {
                        echo '<br>';
                    }
                }
            }

            if(count($failedWaybillMails) > 0) {
                echo '<br><br>The following clients won\'t be able to receive a notification due to a system error:<br>';

                foreach($failedWaybillMails as $key => $failedWaybillMail) {
                    $queryClient = mysqli_query($connection, "SELECT * FROM waybills LEFT JOIN clients ON waybills.Client_ID=clients.Client_ID LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE waybills.Waybill_Number='$failedWaybillMail'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    $rowClient = mysqli_fetch_array($queryClient);

                    if($rowClient['First_Name'] == 'Not Available' && $rowClient['Middle_Name'] == 'Not Available' && $rowClient['Last_Name'] == 'Not Available') {
                        $name = $rowClient['Company_Name'];
                    } else {
                        if(strlen($rowClient['Middle_Name']) > 1) {
                            $name = $rowClient['First_Name'] . ' ' . substr($rowClient['Middle_Name'], 0, 1) . '. ' . $rowClient['Last_Name'];
                        } else {
                            $name = $rowClient['First_Name'] . ' ' . $rowClient['Last_Name'];
                        }
                    }

                    echo ($key + 1) . '.) ' . $name;

                    if($key + 1 != count($failedWaybillMails)) {
                        echo '<br>';
                    }
                }
            }
        } else {
            echo 'No pending transaction found.';
        }
    } else if($action == 'Remove') {
        $truckId = mysqli_real_escape_string($connection, $_POST['truckId']);
        $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

        $queryUpdate = mysqli_query($connection, "UPDATE waybills SET Delivery_Status='Inactive', Truck_ID='-1' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Delivery_Status='Active' AND Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 0) {
            $queryUpdate = mysqli_query($connection, "UPDATE trucks SET Status='Inactive' WHERE Truck_ID='$truckId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        }

        echo 'Transaction successfully removed.';
    }

    mysqli_close($connection);
?>