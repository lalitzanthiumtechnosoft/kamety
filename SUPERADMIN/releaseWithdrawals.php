<?php

include 'login-check.php';
header('Content-Type: application/json');

$paymentDate = date('Y-m-d H:i:s');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON input
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate required fields
    if (isset($data['ids'], $data['releaseType']) && is_array($data['ids']) && count($data['ids']) > 0) {
        $ids = array_map('intval', $data['ids']);
        $releaseType = intval($data['releaseType']);
        $idList = implode(',', $ids);

        if ($releaseType === 1) {
            // Offline release logic
            $remarks = 'Offline Release';
            $query = "UPDATE user_wallet_withdrawal_crypto SET released = 1, remarks = '$remarks', payment_date = '$paymentDate' WHERE id IN ($idList)";
            if (mysqli_query($con, $query)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
            }
        } elseif ($releaseType === 4) {
            // Online release logic
            $remarks = 'Online Release';

            foreach ($ids as $id) {
                $queryAmount = mysqli_query($con, "SELECT netAmount, paymentId FROM user_wallet_withdrawal_crypto WHERE id='$id'");
                $valAmount = mysqli_fetch_assoc($queryAmount);

                $paymentId = $valAmount['paymentId'];
                $amount = floatval($valAmount['netAmount']);

                if ($amount <= 0) {
                    continue;
                }

                $queryAddress = mysqli_query($con, "SELECT walletAddress FROM user_wallet_address_details WHERE payment_id='$paymentId' AND status=1");
                $valAddress = mysqli_fetch_assoc($queryAddress);
                $WalletAddress = $valAddress['walletAddress'];

                if (empty($WalletAddress) || strlen($WalletAddress) !== 42 || strpos($WalletAddress, '0x') !== 0) {
                    continue;
                }

                mysqli_query($con, "UPDATE user_wallet_withdrawal_crypto SET trnxId='asdff', status='Done' WHERE id='$id'");
                //         $curl = curl_init();
                //         curl_setopt_array($curl, array(
                //             CURLOPT_URL => 'https://faradpay.com/api/payout',
                //             CURLOPT_RETURNTRANSFER => true,
                //             CURLOPT_ENCODING => '',
                //             CURLOPT_MAXREDIRS => 10,
                //             CURLOPT_TIMEOUT => 0,
                //             CURLOPT_FOLLOWLOCATION => true,
                //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //             CURLOPT_CUSTOMREQUEST => 'POST',
                //             CURLOPT_POSTFIELDS => '{
                //     "withdrawals": [
                //         {
                //             "address": "' . $WalletAddress . '",
                //             "currency": "USDTBSC",
                //             "amount": ' . $amount . ',
                //             "ipnCallbackUrl": "https://futurevison.world/withdrowalReturnFaradpayApi"
                //         }
                //     ]
                // }',
                //             CURLOPT_HTTPHEADER => array(
                //                 'x-api-key: EBB5F5DF-6E29-4126-B12F-400E90C21843',
                //                 'Content-Type: application/json'
                //             ),
                //         ));

                //         $response = curl_exec($curl);
                //         curl_close($curl);

                //         $data = json_decode($response, true);
                //         $withdrawal = $data['data']['withdrawals'][0] ?? null;

                // if ($withdrawal) {
                //     $Trnxid = $withdrawal['id'];
                //     $status = $withdrawal['status'];
                //     mysqli_query($con, "UPDATE user_wallet_withdrawal_crypto SET trnxId='$Trnxid', status='$status' WHERE id='$id'");
                // }
            }

            echo json_encode(['success' => true, 'message' => 'Online release completed.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Unknown release type.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid or missing input data.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
