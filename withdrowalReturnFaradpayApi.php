<?php

require_once 'conection.php';
$d = date('Y-m-d H:i:s');
$request_json = file_get_contents('php://input');

$data = json_decode($request_json, true);
if ($data === null) {
    file_put_contents('log_error.txt', 'JSON decode failed: '.json_last_error_msg()."\n", FILE_APPEND);
    exit('Invalid JSON');
}

$id = $data['id'];
$address = $data['address'];
$txHash = $data['txHash'];
$status = $data['status'];

$query = "UPDATE user_wallet_withdrawal_crypto  SET address = '$address', status = '$status' ,txHash='$txHash',payment_date='$d' WHERE trnxId = '$id'";

mysqli_query($con, $query);

// Optional: Check for success
if (mysqli_affected_rows($con) > 0) {
    echo 'Updated successfully.';
} else {
    echo 'No update made or error.';
}
