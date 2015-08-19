<?php
    require('connection.php');

    $query = mysqli_query($connection, "SELECT * FROM ladings INNER JOIN clients ON ladings.Bill_of_Lading_ID=clients.Client_ID WHERE ladings.Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_erro($connection));

    if($query) {
        echo '<option value="" selected disabled>Choose an existing bill of lading here...</option>';

        while($row = mysqli_fetch_array($query)) {
            $queryWaybill = mysqli_query($connection, "SELECT * FROM waybills WHERE Bill_of_Lading_ID='$row[Bill_of_Lading_Number]'") or die('Cannot connect to Database. Error: ');
            $scanWaybill = mysqli_num_rows($queryWaybill);
            $rowWaybill = mysqli_fetch_array($queryWaybill);

            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            if($scanWaybill == 0) {
                echo '<option value="' . $row['Bill_of_Lading_Number'] . '">' . $name . '</option>';
            } else {
                if($rowWaybill['Status'] == 'Inactive') {
                    if($rowWaybill['Delivery_Status'] != 'Complied') {
                        echo '<option value="' . $row['Bill_of_Lading_Number'] . '">' . $name . '</option>';
                    }
                }
            }
        }
    }

    mysqli_close($connection);
?>