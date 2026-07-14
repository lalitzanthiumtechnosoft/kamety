<?php
include '../../conection.php';

if (isset($_POST['addEditBulkRemark'])) {
    $ids = $_POST['ids'];
    $remarks = $_POST['remarks'];
    $withdrawStatus = $_POST['withdrawStatus'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $userId = $_POST['userId'];
    $d = date('Y-m-d H:i:s');

    foreach ($ids as $id) {
        $queryDetails = mysqli_query($con, "SELECT member_id, amount FROM user_wallet_withdrawal_crypto WHERE id='$id'");
        if (!$queryDetails) {
            continue;
        }
        $data = mysqli_fetch_assoc($queryDetails);
        if (!$data) {
            continue;
        }

        $memberId = $data['member_id'];
        $amount = $data['amount'];

        $update = mysqli_query($con, "UPDATE user_wallet_withdrawal_crypto 
                                      SET remarks='$remarks', payment_date='$d', released='$withdrawStatus' 
                                      WHERE id='$id'");

        if ($withdrawStatus == 3) {
            mysqli_query($con, "UPDATE sub_admin_user_details 
                                SET wallet = wallet + '$amount' 
                                WHERE member_id='$memberId'");

            mysqli_query($con, "INSERT INTO user_wallet_statement (member_id, wallet_statement_id, deb_cr, amount, date_time, trn_id) VALUES ('$memberId', 11, 1, '$amount', '$d', '$id')");

            echo "<script>
                 alert('Action Completed Successfully!');
               </script>";
        } elseif ($withdrawStatus == 4) {
            $queryAmount = mysqli_query($con, "SELECT netAmount,paymentId FROM user_wallet_withdrawal_crypto WHERE id='$id'");
            $valAmount = mysqli_fetch_assoc($queryAmount);
            $paymentId = $valAmount['paymentId'];
            $amount = floatval($valAmount['netAmount']);
            if ($amount <= 0) {
                exit("Invalid amount: $amount");
            }

            $queryAddress = mysqli_query($con, "SELECT walletAddress FROM user_wallet_address_details WHERE payment_id='$paymentId'  AND status=1");
            $valAddress = mysqli_fetch_assoc($queryAddress);
            $WalletAddress = $valAddress['walletAddress'];

            if (empty($WalletAddress) || strlen($WalletAddress) !== 42 || strpos($WalletAddress, '0x') !== 0) {
                exit("Invalid wallet address: $WalletAddress");
            }

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://faradpay.com/api/payout',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "withdrawals": [
                    {
                        "address": "'.$WalletAddress.'",
                        "currency": "USDTBSC",
                        "amount": '.$amount.',
                        "ipnCallbackUrl": "https:/futurevison.world/withdrowalReturnFaradpayApi"
                    }
                ]
            }',
                CURLOPT_HTTPHEADER => [
                    'x-api-key: EBB5F5DF-6E29-4126-B12F-400E90C21843',
                    'Content-Type: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response, true);
            $withdrawal = $data['data']['withdrawals'][0];
            $Trnxid = $withdrawal['id'];
            $status = $withdrawal['status'];
            mysqli_query($con, "UPDATE  user_wallet_withdrawal_crypto SET trnxId='$Trnxid',status='$status' WHERE id='$id'");
        }
        echo "<script>
                 alert('Action Completed Successfully!');
               </script>";
    }

    header('Location: ../walletWithdrawStatus');
    exit;
} else {
    header('Location: ../walletWithdrawStatus');
}

include '../../close-connection.php';
?>
<?php ?>
