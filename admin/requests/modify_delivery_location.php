<?php
    require('connection.php');

    $waybill = mysqli_real_escape_string($connection, $_POST['waybill']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);

    if($location != '') {
        $query = mysqli_query($connection, "UPDATE waybills SET Delivery_Location='$location' WHERE Waybill_Number='$waybill'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            echo 'Delivery location has been changed.';
        } else {
            echo 'Failed to change delivery location.';
        }
    } else {
        echo 'Delivery Location should not be empty.';
    }
?>