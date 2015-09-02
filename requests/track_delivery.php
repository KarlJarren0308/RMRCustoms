<?php
    require('connection.php');
    require('charges.php');
    require('rates.php');

    function getBrokerageFee($dutiableValuePaid) {
        switch(true) {
            case $dutiableValuePaid <= 10000:
                $fee = 10000;
                break;
            case $dutiableValuePaid > 10000 && $dutiableValuePaid <= 20000:
                $fee = 20000;
                break;
            case $dutiableValuePaid > 20000 && $dutiableValuePaid <= 30000:
                $fee = 30000;
                break;
            case $dutiableValuePaid > 30000 && $dutiableValuePaid <= 40000:
                $fee = 40000;
                break;
            case $dutiableValuePaid > 40000 && $dutiableValuePaid <= 50000:
                $fee = 50000;
                break;
            case $dutiableValuePaid > 50000 && $dutiableValuePaid <= 60000:
                $fee = 60000;
                break;
            case $dutiableValuePaid > 60000 && $dutiableValuePaid <= 100000:
                $fee = 100000;
                break;
            case $dutiableValuePaid > 100000:
                $fee = 200000;
                break;
            default:
                $fee = 0;
        }

        return $fee;
    }

    function getBrokerageRate($dutiableValuePaid) {
        switch(true) {
            case $dutiableValuePaid <= 10000:
                $rate = 1300;
                break;
            case $dutiableValuePaid > 10000 && $dutiableValuePaid <= 20000:
                $rate = 2000;
                break;
            case $dutiableValuePaid > 20000 && $dutiableValuePaid <= 30000:
                $rate = 2700;
                break;
            case $dutiableValuePaid > 30000 && $dutiableValuePaid <= 40000:
                $rate = 3300;
                break;
            case $dutiableValuePaid > 40000 && $dutiableValuePaid <= 50000:
                $rate = 3600;
                break;
            case $dutiableValuePaid > 50000 && $dutiableValuePaid <= 60000:
                $rate = 4000;
                break;
            case $dutiableValuePaid > 60000 && $dutiableValuePaid <= 100000:
                $rate = 4700;
                break;
            case $dutiableValuePaid > 100000:
                $rate = 5300;
                break;
            default:
                $rate = 0;
        }

        return $rate;
    }

    $track = mysqli_real_escape_string($connection, $_GET['track']);

    if($track != "") {
        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Waybill_Number='$track' AND Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 1) {
            $row = mysqli_fetch_array($query);

            if($row['Display'] == 'Hide' || ($row['Datetime_Complied'] != '0000-00-00 00:00:00' && date('Y-m-d H:i', strtotime('+2 weeks', strtotime($row['Datetime_Complied']))) < date('Y-m-d H:i'))) {
                echo 'Transaction not viewable to client.';
            } else {
                if($row['Delivery_Status'] == 'Complied') {
                    $bg = 'bg-success';
                } else if($row['Delivery_Status'] == 'Active') {
                    $bg = 'bg-primary';
                } else {
                    $bg = 'bg-danger';
                }

                if($row['Datetime_Complied'] != '0000-00-00 00:00:00') {
                    echo '<div class="text-right" style="font-size: 11px; font-weight: bold; margin-bottom: 5px;">Viewable until: ' . date('F d, Y (h:iA)', strtotime('+2 weeks', strtotime($row['Datetime_Complied']))) . '</div>';
                }

                echo '<table class="table table-hover table-striped">';
                echo '<tbody>';
                echo '<tr>';
                echo '<td width="30%" align="right" class="' . $bg . '"><strong>Delivery Status:</strong></td>';
                echo '<td class="' . $bg . '">' . $row['Delivery_Status'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right"><strong>Waybill Number:</strong></td>';
                echo '<td><a class="copy-to-clipboard" data-clipboard-text="' . $row['Waybill_Number'] . '" title="Click to copy">' . $row['Waybill_Number'] . '</a></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right"><strong>Destination Address:</strong></td>';
                echo '<td>' . $row['Delivery_Location'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right"><strong>Date of Transaction:</strong></td>';
                echo '<td>' . date('F d, Y', strtotime($row['Transaction_Date'])) . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right"><strong>Credit:</strong></td>';
                echo '<td>&#8369; ' . number_format($row['Credit'], 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td width="30%" align="right"><strong>Debit:</strong></td>';
                echo '<td>&#8369; ' . number_format($row['Debit'], 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                
                if($row['Delivery_Status'] != 'Complied') {
                    echo '<form target="mapOfDora" method="POST" action="http://www.wetrack.ph/Tracking.aspx">';
                    echo '<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUIMzM0OTkwMjZkZNTTdRt/h9POvtYyzzHPTQUC/UvIAmPWhwc74EIr0ik1">';
                    echo '<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="414E4794">';
                    echo '<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAg/yyLfoQpALLwZb+pO7Rs0wsYQpfr+0vh5mICgP8EIOgJGqZ27oArvd2fDWxTsnY6UrLulE1MftRpgG8G9cXEoTRpOxYCxMCogS9q63SeE7BGDTy4obJKGYZKy7pkwBovMNbSr3ROOilgHKwgiJt+AVggpvtCfkURCcwcMBsRBFlGQlKjpmnmvcYa1HKRkiXkirqUAz7NAVfHEoabI0tBN">';
                    echo '<input name="hidLanguage" type="hidden" id="hidLanguage" value="en-us">';
                    echo '<input name="hidUserID" type="hidden" id="hidUserID" value="31660">';
                    echo '<input name="hidDeviceID" type="hidden" id="hidDeviceID" value="90749">';
                    echo '<input name="hidIcon" type="hidden" id="hidIcon" value="21">';
                    echo '<input name="hidTimeZone" type="hidden" id="hidTimeZone" value="8">';
                    echo '<input name="hidDeviceName" type="hidden" id="hidDeviceName" value="TR0">';
                    echo '<input name="hidStatus" type="hidden" id="hidStatus" value="-1">';
                    echo '<input class="btn btn-primary btn-block" type="submit" value="Load Map">';
                    echo '</form><br>';
                    echo '<iframe id="gps-frame" name="mapOfDora"></iframe>';
                    // echo '<div id="map-canvas"></div>';
                    // echo '<script>google.maps.event.addDomListener(window, "load", initializeMap(0, 0));</script>';
                }

                $rmrCharges = new RMRCharges();
                $rmrRates = new RMRRates();
                $currencyRate = (double) $rmrRates->getPesoToDollarRate();

                if($_GET['currency'] == 'peso') {
                    $currencyButton = '<button class="btn btn-primary btn-xs pull-right change-currency" data-waybill="' . $_GET['track'] . '" data-currency="dollar">Convert to Dollar</button>';
                } else {
                    $currencyButton = '<button class="btn btn-primary btn-xs pull-right change-currency" data-waybill="' . $_GET['track'] . '" data-currency="peso">Convert to Peso</button>';
                }

                echo '<br><br>';
                echo '<div>';
                echo '<ul class="nav nav-tabs">';
                echo '<li class="active"><a href="#ladings" data-toggle="tab">Bill of Lading</a></li>';
                echo '<li><a href="#history" data-toggle="tab">Transaction History</a></li>';
                echo '<li><a href="#advances" data-toggle="tab">Advances for our Clients</a></li>';
                echo '<li><a href="#charges" data-toggle="tab">Service Charges</a></li>';
                echo '<li><a href="#grande" data-toggle="tab">Grand Total Charges</a></li>';
                echo '</ul>';
                echo '<div class="tab-content">';
                echo '<div class="tab-pane active" id="ladings">';
                echo '<div class="container-fluid">';
                echo '<br>';
                echo '<h3 class="no-margin">Bill of Lading</h3><br>';

                $queryBills = mysqli_query($connection, "SELECT * FROM ladings INNER JOIN clients ON ladings.Bill_of_Lading_ID=clients.Client_ID WHERE Bill_of_Lading_Number='$row[Bill_of_Lading_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($queryBills) {
                    $rowBills = mysqli_fetch_array($queryBills);

                    if(strlen($rowBills['Middle_Name']) > 1) {
                        $name = $rowBills['First_Name'] . ' ' . substr($rowBills['Middle_Name'], 0, 1) . '. ' . $rowBills['Last_Name'];
                    } else {
                        $name = $rowBills['First_Name'] . ' ' . $rowBills['Last_Name'];
                    }

                    echo '<table class="table table-hover table-striped">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td width="30%" align="right">Bill of Lading ID:</td>';
                    echo '<td>' . $name . '</td>';
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
                    echo '<td>' . $rowBills['Date_of_Transaction'] . '</td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '<table class="table table-hover table-striped">';
                    echo '<thead class="bg-dark">';
                    echo '<tr>';
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

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<div class="alert alert-danger">No Bill of Lading found.</div>';
                }

                echo '</div>';
                echo '</div>';
                echo '<div class="tab-pane" id="history">';
                echo '<div class="container-fluid">';

                $totalCredit = 0;
                $totalDebit = 0;
                $query2 = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$row[Client_ID]' AND Waybill_Number<>'$track' AND Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                $scan2 = mysqli_num_rows($query2);

                echo '<br>';
                echo '<h3 class="no-margin">Transaction History ' . $currencyButton . '</h3><br>';
                echo '<table class="table table-hover table-striped">';
                echo '<thead class="bg-dark">';
                echo '<tr>';
                echo '<th>Waybill Number</th>';
                echo '<th>Date of Transaction</th>';
                echo '<th>Delivery Status</th>';
                echo '<th>Credit</th>';
                echo '<th>Debit</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';

                if($scan2 > 0) {
                    while($row2 = mysqli_fetch_array($query2)) {
                        if($_GET['currency'] == 'peso') {
                            $currencySymbol = '&#8369; ';

                            $totalCredit += $row2['Credit'];
                            $totalDebit += $row2['Debit'];
                            $transactionCredit = $row2['Credit'];
                            $transactionDebit = $row2['Debit'];
                        } else if($_GET['currency'] == 'dollar') {
                            $currencySymbol = 'USD ';

                            $totalCredit += $row2['Credit'] / $currencyRate;
                            $totalDebit += $row2['Debit'] / $currencyRate;
                            $transactionCredit = $row2['Credit'] / $currencyRate;
                            $transactionDebit = $row2['Debit'] / $currencyRate;
                        }

                        echo '<td width="20%"><a class="copy-to-clipboard" data-clipboard-text="' . $row2['Waybill_Number'] . '" title="Click to copy">' . $row2['Waybill_Number'] . '</a></td>';
                        echo '<td width="20%">' . $row2['Transaction_Date'] . '</td>';
                        echo '<td width="20%">' . $row2['Delivery_Status'] . '</td>';
                        echo '<td width="20%">' . $currencySymbol . number_format($transactionCredit) . '</td>';
                        echo '<td width="20%">' . $currencySymbol . number_format($transactionDebit) . '</td>';
                        echo '</tr>';
                    }

                    echo '<tr>';
                    echo '<td colspan="3" align="right"><strong>Total:</strong></td>';
                    echo '<td>' . $currencySymbol . number_format($totalCredit) . '</td>';
                    echo '<td>' . $currencySymbol . number_format($totalDebit) . '</td>';
                } else {
                    echo '<td align="center" colspan="5">No previous transactions.</td>';
                }

                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';

                if($_GET['currency'] == 'peso') {
                    $currencySymbol = '&#8369; ';

                    $stampsOnEntry = (double) $rmrCharges->getChargeValue('stampsOnEntry');
                    $customsStorage = (double) $rmrCharges->getChargeValue('customsStorage');
                    $xerox = (double) $rmrCharges->getChargeValue('xerox');
                    $notaryFee = (double) $rmrCharges->getChargeValue('notaryFee');
                    $stampsOnCarrierBonds = (double) $rmrCharges->getChargeValue('stampsOnCarrierBonds');
                    $stampsOnChargeableBond = (double) $rmrCharges->getChargeValue('stampsOnChargeableBond');
                    $stampsOnExportDeclaration = (double) $rmrCharges->getChargeValue('stampsOnExportDeclaration');
                } else if($_GET['currency'] == 'dollar') {
                    $currencySymbol = 'USD ';

                    $stampsOnEntry = (double) $rmrCharges->getChargeValue('stampsOnEntry') / $currencyRate;
                    $customsStorage = (double) $rmrCharges->getChargeValue('customsStorage') / $currencyRate;
                    $xerox = (double) $rmrCharges->getChargeValue('xerox') / $currencyRate;
                    $notaryFee = (double) $rmrCharges->getChargeValue('notaryFee') / $currencyRate;
                    $stampsOnCarrierBonds = (double) $rmrCharges->getChargeValue('stampsOnCarrierBonds') / $currencyRate;
                    $stampsOnChargeableBond = (double) $rmrCharges->getChargeValue('stampsOnChargeableBond') / $currencyRate;
                    $stampsOnExportDeclaration = (double) $rmrCharges->getChargeValue('stampsOnExportDeclaration') / $currencyRate;
                }

                echo '<div class="tab-pane" id="advances">';
                echo '<div class="container-fluid">';
                echo '<br>';
                echo '<h3 class="no-margin">Advances for our Clients ' . $currencyButton . '</h3><br>';
                echo '<table class="table table-hover table-striped">';
                echo '<tbody>';
                echo '<tr>';
                echo '<td width="30%" align="right">Stamps on Entry:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnEntry, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Customs Storage:</td>';
                echo '<td>' . $currencySymbol . number_format($customsStorage, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Xerox:</td>';
                echo '<td>' . $currencySymbol . number_format($xerox, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Notary Fee:</td>';
                echo '<td>' . $currencySymbol . number_format($notaryFee, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Carrier Bonds:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnCarrierBonds, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Chargeable Bond:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnChargeableBond, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Export Declaration:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnExportDeclaration, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';

                echo '<div class="tab-pane" id="charges">';
                echo '<div class="container-fluid">';
                echo '<br>';
                echo '<h3 class="no-margin">Service Charges ' . $currencyButton . '</h3><br>';
                echo '<table class="table table-hover table-striped">';
                echo '<tbody>';
                
                $customs = 0.02;
                $vat = 0.12;
                $rateOfDuty = 0.15;
                $shippingLines = 300;
                $customerDocumentaryStamp = 265;

                if($row['Container_Size'] == '20 feet') {
                    $arastreCharges = 4099.70;
                    $wharfageCharges = 571.29;
                } else if($row['Container_Size'] == '40 feet') {
                    $arastreCharges = 9406.10;
                    $wharfageCharges = 856.96;
                } else {
                    $arastreCharges = 0;
                    $wharfageCharges = 0;
                }

                $importProcessingFee = 750;

                if($row['Debit'] != 0) {
                    $warehouseEntry = (double) $row['Debit'];
                    $warehouseEntry = $warehouseEntry / $currencyRate;

                    $dutiableValuePaid = (($warehouseEntry + ($warehouseEntry * $customs)) + $shippingLines) * $currencyRate;
                    $customerDuty = $dutiableValuePaid * $rateOfDuty;
                    $BrokerageFee = (($dutiableValuePaid - getBrokerageFee($dutiableValuePaid)) * 0.00125) + getBrokerageRate($dutiableValuePaid);
                    $grossTotal = $dutiableValuePaid + $customerDuty + $BrokerageFee + $customerDocumentaryStamp + $arastreCharges + $wharfageCharges + $importProcessingFee;
                    $grossTotal = ($grossTotal * 0.15) + $grossTotal;

                    if($_GET['currency'] == 'dollar') {
                        $dutiableValuePaid = $dutiableValuePaid / $currencyRate;
                        $customerDuty = $customerDuty / $currencyRate;
                        $BrokerageFee = $BrokerageFee / $currencyRate;
                        $grossTotal = $grossTotal / $currencyRate;

                        $customerDocumentaryStamp = $customerDocumentaryStamp / $currencyRate;
                        $arastreCharges = $arastreCharges / $currencyRate;
                        $wharfageCharges = $wharfageCharges / $currencyRate;
                        $importProcessingFee = $importProcessingFee / $currencyRate;
                    }
                } else {
                    $dutiableValuePaid = 0;
                    $customerDuty = 0;
                    $BrokerageFee = 0;
                    $grossTotal = 0;
                    $customerDocumentaryStamp = 0;
                    $arastreCharges = 0;
                    $wharfageCharges = 0;
                    $importProcessingFee = 0;
                }

                echo '<tr>';
                echo '<td width="30%" align="right">Dutiable Value Paid:</td><td>' . $currencySymbol . number_format($dutiableValuePaid, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Customer Duty:</td><td>' . $currencySymbol . number_format($customerDuty, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Brokerage Fee:</td><td>' . $currencySymbol . number_format($BrokerageFee, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Customer Documentary Stamp:</td><td>' . $currencySymbol . number_format($customerDocumentaryStamp, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Arastre Charges:</td><td>' . $currencySymbol . number_format($arastreCharges, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Wharfage Charges:</td><td>' . $currencySymbol . number_format($wharfageCharges, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Import Processing Fee:</td><td>' . $currencySymbol . number_format($importProcessingFee, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Total:</td><td>' . $currencySymbol . number_format($grossTotal, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';

                $grandTotal = $stampsOnEntry + $customsStorage + $xerox + $notaryFee + $stampsOnCarrierBonds + $stampsOnChargeableBond + $stampsOnExportDeclaration + $dutiableValuePaid + $customerDuty + $BrokerageFee + $customerDocumentaryStamp + $arastreCharges + $wharfageCharges + $importProcessingFee;

                echo '<div class="tab-pane" id="grande">';
                echo '<div class="container-fluid">';
                echo '<br>';
                echo '<h3 class="no-margin">Grand Total Charges ' . $currencyButton . '</h3><br>';
                echo '<table class="table table-hover table-striped">';
                echo '<tbody>';
                echo '<tr>';
                echo '<td width="30%" align="right">Stamps on Entry:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnEntry, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Customs Storage:</td>';
                echo '<td>' . $currencySymbol . number_format($customsStorage, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Xerox:</td>';
                echo '<td>' . $currencySymbol . number_format($xerox, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Notary Fee:</td>';
                echo '<td>' . $currencySymbol . number_format($notaryFee, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Carrier Bonds:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnCarrierBonds, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Chargeable Bond:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnChargeableBond, 2, '.', ',') . '</td>';
                echo '</tr><tr>';
                echo '<td align="right">Stamps on Export Declaration:</td>';
                echo '<td>' . $currencySymbol . number_format($stampsOnExportDeclaration, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Dutiable Value Paid:</td>';
                echo '<td>' . $currencySymbol . number_format($dutiableValuePaid, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Customer Duty:</td>';
                echo '<td>' . $currencySymbol . number_format($customerDuty, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Brokerage Fee:</td>';
                echo '<td>' . $currencySymbol . number_format($BrokerageFee, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Customer Documentary Stamp:</td>';
                echo '<td>' . $currencySymbol . number_format($customerDocumentaryStamp, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Arastre Charges:</td>';
                echo '<td>' . $currencySymbol . number_format($arastreCharges, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Wharfage Charges:</td>';
                echo '<td>' . $currencySymbol . number_format($wharfageCharges, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Import Processing Fee:</td>';
                echo '<td>' . $currencySymbol . number_format($importProcessingFee, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Grand Total:</td>';
                echo '<td>' . $currencySymbol . number_format($grandTotal, 2, '.', ',') . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'Transaction not found. Please check your waybill number and try again.';
        }
    } else {
        echo 'Please enter your waybill number first.';
    }

    echo '<script>var client = new ZeroClipboard($(".copy-to-clipboard"));</script>';

    mysqli_close($connection);
?>