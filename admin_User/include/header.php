<?php

$queryAccess = mysqli_query($con, "SELECT a.name,a.user_id,a.member_id,a.topup_flag,a.wallet,a.fundWallet,a.email_id,a.phone,a.currentPackage,b.user_id  AS sponser_id,b.name AS sponserName FROM sub_admin_user_details a , sub_admin_user_details b WHERE a.user_id='$_SESSION[member_user_id]' AND a.sponser_id=b.member_id");
if ($valAccess = mysqli_fetch_array($queryAccess)) {
    $userName = $valAccess['name'];
    $userId = $valAccess['user_id'];
    $memberId = $valAccess['member_id'];
    $topupFlag = $valAccess['topup_flag'];
    $incomeWallet = $valAccess['wallet'];
    $fundWallet = $valAccess['fundWallet'];
    $emailId = $valAccess['email_id'];
    $phone = $valAccess['phone'];
    $sponser_id = $valAccess['sponser_id'];
    $sponserName = $valAccess['sponserName'];
    $currentPackage = $valAccess['currentPackage'];
}
