<?php
    require('connection.php');

    $chequeNumber = array('');
    $bankName = array('');
    $chequeDate = array('');
    $loopCount = 0;

    $waybillNumber = mysqli_real_escape_string($connection, $_POST['waybillNumber']);

    foreach($_POST as $key => $post) {
        if($post != '') {
            if($loopCount % 3 == 0) {
                array_push($chequeNumber, mysqli_real_escape_string($connection, $post));
            } else if($loopCount % 3 == 1) {
                array_push($bankName, mysqli_real_escape_string($connection, $post));
            } else {
                array_push($chequeDate, mysqli_real_escape_string($connection, $post));
            }

            $loopCount += 1;
        }
    }

    array_shift($chequeNumber);
    array_shift($bankName);
    array_shift($chequeDate);
    array_pop($chequeNumber);

    $chequeNumber = json_encode($chequeNumber);
    $bankName = json_encode($bankName);
    $chequeDate = json_encode($chequeDate);

    $query = mysqli_query($connection, "UPDATE waybills SET Cheque_Number='$chequeNumber', Bank_Name='$bankName', Cheque_Date='$chequeDate' WHERE Waybill_Number='$waybillNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

    if($query) {
        echo 'Saved Changes.';
    } else {
        echo 'Failed to save changes.';
    }

    mysqli_close($connection);
?>