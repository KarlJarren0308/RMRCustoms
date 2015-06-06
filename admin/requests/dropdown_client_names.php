<?php
    require('connection.php');

    $query = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_erro($connection));

    if($query) {
        echo '<option value="" selected disabled>Choose client or company name here...</option>';
        while($row = mysqli_fetch_array($query)) {
            $query2 = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$row[Client_ID]' AND Status = 'Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $totalCredit = 0;
            $totalDebit = 0;

            while($row2 = mysqli_fetch_array($query2)) {
                $totalCredit += (double) $row2['Credit'];
                $totalDebit += (double) $row2['Debit'];
            }

            if($row['First_Name'] == 'Not Available' && $row['Middle_Name'] == 'Not Available' && $row['Last_Name'] == 'Not Available') {
                $name = $row['Company_Name'];
            } else {
                if(strlen($row['Middle_Name']) > 1) {
                    $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
                } else {
                    $name = $row['First_Name'] . ' ' . $row['Last_Name'];
                }
            }

            if($totalDebit < 800000) {
                echo '<option value="' . $row['Client_ID'] . '">' . $name . '</option>';
            } else {
                echo '<option value="" data-notif-value="C5U3qtr5ST46OM6S' . base64_encode($name) . '">' . $name . '</option>';
            }
        }
    }

    mysqli_close($connection);
?>