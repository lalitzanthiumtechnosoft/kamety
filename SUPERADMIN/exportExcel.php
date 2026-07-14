<?php

include 'login-check.php';
ini_set('max_execution_time', 3000);
$user_id = $_GET['user_id'];
$payout_date = date('Y-m-d');
$cal_date = $_GET['from_date'];
$cal_date1 = $_GET['to_date'];
$queryUser = "SELECT member_id from sub_admin_user_details where user_id='$user_id'";
$resultUser = mysqli_query($con, $queryUser);
$valUser = mysqli_fetch_array($resultUser);
$member_id = $valUser[0];
$query = '';
if ($cal_date != '') {
    $query = "AND CAST(a.withdrawal_date AS date)>='$cal_date'";
}
if ($cal_date1 != '') {
    $query = $query." AND CAST(a.withdrawal_date AS date)<='$cal_date1'";
}
if ($user_id1 != '') {
    $query = $query." AND a.member_id='$member_id'";
}
$RazorpayXAct = '3434492541990971';
$PayoutCurrency = 'INR';
$PayoutMode = 'IMPS';
$PayoutPurpose = 'payout';
$PayoutNarration = 'ovelpolife';
$PayoutRef = '';
$fundAct = '';
$fundActType = 'bank_account';
$fundActVpa = '';
$conType = 'customer';
$conEmail = '';
$note = '';
$note1 = '';
$query1 = 'SELECT a.id,a.member_id,a.withdrawal_date,a.amount,a.netAmount,a.withdrawCharge,b.name,b.user_id,b.bank,b.ifsc,b.branch,b.account_number,b.account_name,b.phone FROM user_wallet_withdrawal a,sub_admin_user_details b WHERE a.member_id=b.member_id '.$query.' ORDER BY a.id ASC';
// print_r($query1);exit;
$result = mysqli_query($con, $query1);
$arr = [];
$totalrecords = mysqli_num_rows($result);
// $val1=mysqli_fetch_all($result,MYSQLI_ASSOC);
$filename = 'PayoutSheet-'.$payout_date.'.xls';
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"$filename\"");
echo 'RazorpayX Account Number '."\t".'Payout Amount '."\t".'Payout Currency '."\t".'Payout Mode '."\t".'Payout Purpose '."\t".'Payout Narration '."\t".'Payout Reference Id '."\t".'Fund Account Id '."\t".'Fund Account Type '."\t".'Fund Account Name '."\t".'Fund Account Ifsc '."\t".'Fund Account Number'."\t".'Fund Account Vpa '."\t".'Contact Type'."\t".'Contact Name'."\t".'Contact Email'."\t".'Contact Mobile'."\t".'Contact Reference Id'."\t".'notes[place]'."\t".'notes[code]'."\n";
// echo "<pre>";
$isPrintHeader = false;
if ($totalrecords > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $netAmount = $row['netAmount'] * 100;
        echo $RazorpayXAct."\t".$netAmount."\t".$PayoutCurrency."\t".$PayoutMode."\t".$PayoutPurpose."\t".$PayoutNarration."\t".$PayoutRef."\t".$fundAct."\t".$fundActType."\t".$row['account_name']."\t".$row['ifsc']."\t".$row['account_number']."\t".$fundActVpa."\t".$conType."\t".$row['name']."\t".$conEmail."\t".$row['phone']."\t".$row['user_id']."\t".$note."\t".$note1."\n";
    }
}
exit;
