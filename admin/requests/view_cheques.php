<?php
    require('connection.php');

    $chequeNumber = [];
    $bankName = [];
    $chequeDate = [];
    $clientId = mysqli_real_escape_string($connection, $_POST['id']);

    $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$clientId' AND Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            $cn = json_decode($row['Cheque_Number']);
            $bn = json_decode($row['Bank_Name']);
            $cd = json_decode($row['Cheque_Date']);

            for($i = 0; $i < count($cn); $i++) {
                array_push($chequeNumber, $cn[$i]);
            }

            for($i = 0; $i < count($bn); $i++) {
                array_push($bankName, $bn[$i]);
            }

            for($i = 0; $i < count($cd); $i++) {
                array_push($chequeDate, $cd[$i]);
            }
        }
    }

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

    echo '<table class="table table-hover table-striped">';
    echo '<thead class="bg-dark">';
    echo '<tr>';
    echo '<th>Cheque Number</th>';
    echo '<th>Bank Name</th>';
    echo '<th>Cheque Date</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if($countCheques > 0) {
        for($i = 0; $i < $countCheques; $i++) {
            echo '<tr>';
            echo '<td>' . @$chequeNumber[$i] . '</td>';
            echo '<td>' . @$bankName[$i] . '</td>';
            echo '<td>' . @date('F d, Y', strtotime($chequeDate[$i])) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="3" align="center">No cheque found.</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    mysqli_close($connection);
?>