<?php

include '../../conection.php';
$paymentId = $_POST['paymentId'];
$query = mysqli_query($con, "UPDATE config_payment_details SET status=0 WHERE payment_id='$paymentId'");
if ($query) {
    echo '1';

    return true;
} else {
    return false;
}
