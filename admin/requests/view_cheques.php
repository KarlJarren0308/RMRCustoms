<?php
    require('connection.php');

    $clientId = mysqli_real_escape_string($connection, $_POST['id']);

    $query = mysqli_query($connection, "SELECT * FROM transactions INNER JOIN waybills ON transactions.Waybill_Number=waybills.Waybill_Number INNER JOIN payment ON transactions.Payment_ID=payment.Payment_ID WHERE waybills.Client_ID='$clientId' AND waybills.Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    /*
    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            $cn = json_decode($row['Cheque_Number']);
            $bn = json_decode($row['Bank_Name']);
            $cd = json_decode($row['Cheque_Date']);
            $ca = json_decode($row['Cheque_Amount']);

            for($i = 0; $i < count($cn); $i++) {
                array_push($chequeNumber, $cn[$i]);
            }

            for($i = 0; $i < count($bn); $i++) {
                array_push($bankName, $bn[$i]);
            }

            for($i = 0; $i < count($cd); $i++) {
                array_push($chequeDate, $cd[$i]);
            }

            for($i = 0; $i < count($ca); $i++) {
                array_push($chequeAmount, $ca[$i]);
            }
        }
    }
    */

    /*
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
    */

    //$countCheques = max(count($chequeNumber), count($bankName), count($chequeDate), count($chequeAmount));

    echo '<table class="table table-hover table-striped">';
    echo '<thead class="bg-dark">';
    echo '<tr>';
    echo '<th>Mode of Payment</th>';
    echo '<th>Cheque Number</th>';
    echo '<th>Bank Name</th>';
    echo '<th>Date</th>';
    echo '<th>Amount</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if($scan > 0) {
        /*
        for($i = 0; $i < $countCheques; $i++) {
            echo '<tr>';
            echo '<td>' . @$chequeNumber[$i] . '</td>';
            echo '<td>' . @$bankName[$i] . '</td>';
            echo '<td>' . @date('F d, Y', strtotime($chequeDate[$i])) . '</td>';
            echo '<td>&#8369; ' . @number_format((double) $chequeAmount[$i], 2, '.', ',') . '</td>';
            echo '</tr>';
        }
        */

        while($row = mysqli_fetch_array($query)) {
            echo '<tr>';
            echo '<td>' . $row['Mode_of_Payment'] . '</td>';
            echo '<td>' . $row['Cheque_Number'] . '</td>';
            echo '<td>' . $row['Bank_Name'] . '</td>';
            echo '<td>' . date('F d, Y', strtotime($row['Cheque_Date'])) . '</td>';
            echo '<td>&#8369; ' . @number_format((double) $row['Amount'], 2, '.', ',') . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="5" align="center">No payment has been made.</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    mysqli_close($connection);
?>