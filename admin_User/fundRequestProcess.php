<?php
include 'loginCheck.php';
if (isset($_POST['fundRequest'])) {
  $loginMemberId = mysqli_real_escape_string($con, $_POST['member_id']);
  $investmentAmount = mysqli_real_escape_string($con, $_POST['requestFund']);
  $currencyId = mysqli_real_escape_string($con, $_POST['currencyId']);
  $d = date('Y-m-d H:i:s');
  $todayDate = date('Y-m-d');

  $queryOld = mysqli_query($con, "SELECT COUNT(1) FROM user_invest_purchase_details WHERE memberId='$loginMemberId' AND actionType=2 AND nextPayOpen=0");
  $valOld = mysqli_fetch_array($queryOld);
  if ($valOld[0] > 0) { ?>
    <script>
      alert("Your Previous Request is on Pending!!!");
      window.top.location.href = "fundRequest.php";
    </script>
    <?php
    exit;
  }

  $queryDetails = mysqli_query($con, "SELECT member_id,name,phone,email_id,user_id,sponser_id FROM sub_admin_user_details WHERE member_id='$loginMemberId'");
  $valDetails = mysqli_fetch_assoc($queryDetails);
  $memberId = $valDetails['member_id'];
  $name = $valDetails['name'];
  $phone = $valDetails['phone'];
  $emailId = $valDetails['email_id'];
  $userId = $valDetails['user_id'];
  $sponserId = $valDetails['sponser_id'];

  $queryCoin = mysqli_query($con, "SELECT currencyCode FROM config_currency_list WHERE currency_id='$currencyId'");
  $valCoin = mysqli_fetch_assoc($queryCoin);
  $currencyCode = $valCoin['currencyCode'];

  //   $addCharge = $investmentAmount * 1 / 100;
  //   $newAmount = $investmentAmount + $addCharge;

  // Payment Gateway Code Starts (FarraPay)
  $orderId = 'FV' . time() . $memberId . 'AZ' . rand(1000, 9999);
  $packageName = 'New Add Order Rivage';
  $queryTemp = mysqli_query($con, "INSERT INTO user_invest_purchase_details (`memberId`,`loginMemberId`,`name`,`phone`,`emailId`,`addDate`,`orderId`,`packagePrice`,`actionType`) VALUES ('$memberId','$loginMemberId','$name','$phone','$emailId','$d','$orderId','$investmentAmount',2)");
  $tempId = $con->insert_id;

  $queryAPI = mysqli_query($con, 'SELECT apiKey FROM config_misc_setting');
  $val = mysqli_fetch_assoc($queryAPI);
  $apiKey = $val['apiKey'];

  $postData = [
    'priceAmount' => (float) $investmentAmount,
    'priceCurrency' => 'USDTBSC',
    'payCurrency' => 'USDTBSC',
    'network' => 'bsc',
    'orderId' => $orderId,
    'orderDescription' => 'Deposit (Online)',
  ];

  $curl = curl_init('https://faradpay.com/api/payment');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'x-api-key: ' . $apiKey,
  ]);

  $response = curl_exec($curl);
  $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

  if (curl_errno($curl)) {
    echo 'FarraPay Error: ' . curl_error($curl);
    exit;
  }

  curl_close($curl);
  $data = json_decode($response, true);
  // Check if 'data' key exists
  if (!isset($data['data'])) {
    echo "<script>alert('Invalid response from FarraPay'); window.top.location.href='fundRequest.php';</script>";
    exit;
  }

  // Extract from nested 'data' array
  $paymentData = $data['data'];
  $paymentId = $paymentData['paymentId'] ?? '';
  $paymentStatus = $paymentData['paymentStatus'] ?? '';
  $payAddress = $paymentData['payAddress'] ?? '';
  $priceAmount = $paymentData['priceAmount'] ?? '';
  $priceCurrency = $paymentData['priceCurrency'] ?? '';
  $payAmount = $paymentData['payAmount'] ?? '';
  $payCurrency = $paymentData['payCurrency'] ?? '';
  $amountReceived = $paymentData['amountReceived'] ?? '';
  $createdAt = $paymentData['createdAt'] ?? '';
  $updatedAt = $paymentData['updatedAt'] ?? '';
  $purchaseId = $paymentData['purchaseId'] ?? '';
  $returnOrderId = $paymentData['orderId'] ?? $orderId;

  mysqli_query($con, "UPDATE user_invest_purchase_details SET paymentId='$paymentId', paymentStatus='$paymentStatus', payAddress='$payAddress', priceAmount='$priceAmount', priceCurrency='$priceCurrency', payAmount='$payAmount', payCurrency='$payCurrency', amountReceived='$amountReceived', createdTime='$createdAt', updateTime='$updatedAt', purchaseId='$purchaseId' WHERE orderId='$returnOrderId'");

  ?>
  <script>
    window.top.location.href = "fundRequestSuccessNew?orderId=<?php echo $returnOrderId; ?>";
  </script>
<?php } ?>
<?php include '../close-connection.php'; ?>