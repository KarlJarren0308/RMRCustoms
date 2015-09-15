<?php
    require('connection.php');

    $mark = array('');
    $quantity = array('');
    $description = array('');
    $loopCount = 0;

    $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);
    $billID = mysqli_real_escape_string($connection, $_POST['billID']);
    $consignee = mysqli_real_escape_string($connection, $_POST['consignee']);
    $exportReferences = mysqli_real_escape_string($connection, $_POST['exportReferences']);
    $dateMonth = mysqli_real_escape_string($connection, $_POST['dateMonth']);
    $dateDay = mysqli_real_escape_string($connection, $_POST['dateDay']);
    $dateYear = mysqli_real_escape_string($connection, $_POST['dateYear']);
    $newBill = mysqli_real_escape_string($connection, $_POST['newBill']);

    $billDate = $dateYear . '-' . $dateMonth . '-' . $dateDay;
    $datetime = date('Y-m-d');

    foreach($_POST as $key => $post) {
        if($post != '') {
            $loopCount += 1;

            if($loopCount % 3 == 0) {
                array_push($mark, mysqli_real_escape_string($connection, $post));
            } else if($loopCount % 3 == 1) {
                array_push($quantity, mysqli_real_escape_string($connection, $post));
            } else {
                array_push($description, mysqli_real_escape_string($connection, $post));
            }
        }
    }

    array_shift($mark);
    array_shift($mark);
    array_shift($mark);
    array_shift($quantity);
    array_shift($quantity);
    array_shift($quantity);
    array_shift($quantity);
    array_shift($description);
    array_shift($description);
    array_shift($description);
    array_shift($description);

    /*
    unset($mark[0]);
    unset($mark[1]);
    unset($quantity[0]);
    unset($quantity[1]);
    unset($description[0]);
    unset($description[1]);
    unset($description[2]);
    */

    if($billID == '-1') {
        $mark = json_encode($mark);
        $quantity = json_encode($quantity);
        $description = json_encode($description);

        $query = mysqli_query($connection, "INSERT INTO ladings (Bill_of_Lading_ID, Consignee, Export_References, Item_Mark, Item_Quantity, Item_Description, Date_of_Transaction, Date_Added) VALUES ('$newBill', '$consignee', '$exportReferences', '$mark', '$quantity', '$description', '$billDate', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $query2 = mysqli_query($connection, "SELECT * FROM ladings WHERE Bill_of_Lading_ID='$newBill' AND Consignee='$consignee' AND Export_References='$exportReferences' AND Item_Mark='$mark' AND  Item_Quantity='$quantity' AND Item_Description='$description' AND Date_of_Transaction='$billDate' AND Date_Added='$datetime'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query2);
            $row = mysqli_fetch_array($query2);

            if($scan == 1) {
                $query = mysqli_query($connection, "UPDATE waybills SET Bill_of_Lading_ID='$newBill' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                echo 'Bill successfully added.';
            }
        } else {
            echo 'Failed to save changes.';
        }
    } else {
        $query = mysqli_query($connection, "SELECT * FROM ladings WHERE Bill_of_Lading_ID='$billID'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 1) {
            $row = mysqli_fetch_array($query);

            $temp0 = json_decode($row['Item_Mark']);
            $temp1 = json_decode($row['Item_Quantity']);
            $temp2 = json_decode($row['Item_Description']);

            foreach ($mark as $value) {
                if($value != '') {
                    array_push($temp0, $value);
                }
            }

            foreach ($quantity as $value) {
                if($value != '') {
                    array_push($temp1, $value);
                }
            }

            foreach ($description as $value) {
                if($value != '') {
                    array_push($temp2, $value);
                }
            }

            $mark = json_encode($temp0);
            $quantity = json_encode($temp1);
            $description = json_encode($temp2);

            $query = mysqli_query($connection, "UPDATE ladings SET Bill_of_Lading_ID='$newBill', Consignee='$consignee', Export_References='$exportReferences', Item_Mark='$mark', Item_Quantity='$quantity', Item_Description='$description', Date_of_Transaction='$billDate' WHERE Bill_of_Lading_ID='$billID'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            echo 'Bill successfully modified.';
        } else {
            $mark = json_encode($mark);
            $quantity = json_encode($quantity);
            $description = json_encode($description);

            $query = mysqli_query($connection, "INSERT INTO ladings (Bill_of_Lading_ID, Consignee, Export_References, Item_Mark, Item_Quantity, Item_Description, Date_of_Transaction, Date_Added) VALUES ('$newBill', '$consignee', '$exportReferences', '$mark', '$quantity', '$description', '$billDate', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                $query2 = mysqli_query($connection, "SELECT * FROM ladings WHERE Bill_of_Lading_ID='$newBill' AND Consignee='$consignee' AND Export_References='$exportReferences' AND Item_Mark='$mark' AND  Item_Quantity='$quantity' AND Item_Description='$description' AND Date_of_Transaction='$billDate' AND Date_Added='$datetime'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                $scan = mysqli_num_rows($query2);
                $row = mysqli_fetch_array($query2);

                if($scan == 1) {
                    $query = mysqli_query($connection, "UPDATE waybills SET Bill_of_Lading_ID='$newBill' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                    echo 'Bill successfully added.';
                }
            } else {
                echo 'Failed to save changes.';
            }
        }
    }

    mysqli_close($connection);
?>