<?php

require_once 'conection.php';
// if (isset($_SERVER['HTTP_X_NOWPAYMENTS_SIG']) && !empty($_SERVER['HTTP_X_NOWPAYMENTS_SIG'])) {
// $recived_hmac = $_SERVER['HTTP_X_NOWPAYMENTS_SIG'];
$request_json = file_get_contents('php://input');
$request_data = json_decode($request_json, true);
ksort($request_data);
$sorted_request_json = json_encode($request_data);
echo 'dd';
$paymentId = $request_data['payment_id'];
$paymentStatus = $request_data['payment_status'];
$payAddress = $request_data['pay_address'];
$priceAmount = $request_data['price_amount'];
$priceCurrency = $request_data['price_currency'];
$payAmount = $request_data['pay_amount'];
$payCurrency = $request_data['pay_currency'];
$amountReceived = $request_data['amount_received'];
$returnOrderId = $request_data['order_id'];
$createdAt = $request_data['created_at'];
$updatedAt = $request_data['updated_at'];
$purchaseId = $request_data['purchase_id'];
$actually_paid = $request_data['actually_paid'];

mysqli_query($con, "UPDATE user_invest_purchase_details SET paymentStatus='$paymentStatus',updateTime='$updatedAt' WHERE orderId='$returnOrderId' AND payAddress='$payAddress'");
if ($paymentStatus == 'expired') {
    mysqli_query($con, "UPDATE user_invest_purchase_details SET nextPayOpen=1 WHERE orderId='$returnOrderId' AND payAddress='$payAddress'");
} elseif ($paymentStatus == 'finished') {
    $queryTemp = mysqli_query($con, "SELECT tempId,memberId,loginMemberId,packagePrice,paymentStatus,actionTaken,orderId FROM user_invest_purchase_details WHERE orderId='$returnOrderId' AND payAddress='$payAddress'");
    if ($valTemp = mysqli_fetch_assoc($queryTemp)) {
        $tempId = $valTemp['tempId'];
        $memberId = $valTemp['memberId'];
        $loginMemberId = $valTemp['loginMemberId'];
        $investmentAmount = $valTemp['packagePrice'];
        $paymentStatus = $valTemp['paymentStatus'];
        $actionTaken = $valTemp['actionTaken'];
        $orderId = $valTemp['orderId'];
        $d = date('Y-m-d H:i:s');
        $todayDate = date('Y-m-d');
        if ($actionTaken == 0 && $paymentStatus == 'finished') {
            mysqli_query($con, "UPDATE user_invest_purchase_details SET actionTaken=1,nextPayOpen=1 WHERE orderId='$orderId'");

            // Fund Add Code Starts//
            mysqli_query($con, "UPDATE sub_admin_user_details SET fundWallet=fundWallet+'$investmentAmount' WHERE member_id='$memberId'");

            mysqli_query($con, "INSERT INTO user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$memberId',14,2,'$investmentAmount','$d','$tempId')");
            // Fund Add Code Ends//
        }
    }
}
// } else {
//     $error_msg = 'No HMAC signature sent.';
// }
