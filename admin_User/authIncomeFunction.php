<?php

// Wallet Add & Statement Add Code Starts//
// function incomeEntry($con, $memberId, $trnId, $incomeAmount, $statementId, $d)
// {
//     mysqli_query($con, "INSERT INTO user_wallet_statement (member_id,wallet_statement_id,deb_cr,amount,date_time,trn_id) VALUES ('$memberId','$statementId',2,'$incomeAmount','$d','$trnId')");
//     mysqli_query($con, "UPDATE sub_admin_user_details SET wallet=wallet+'$incomeAmount' WHERE member_id='$memberId'");
// }
// //Wallet Add & Statement Add Code Ends//

// //Referral Income Code Starts
// function referralIncome($con, $sponserId, $memberId, $packagePrice, $packageId, $directIncome, $d)
// {
//     // $referralIncome = $packagePrice * $referralPercent / 100;
//     $queryNew = mysqli_query($con, "INSERT INTO user_sponsor_income (`memberId`,`childId`,`referralIncome`,`Amount`,`packageId`,`dateTime`,`releaseStatus`) VALUES ('$sponserId','$memberId','$directIncome','$packagePrice','$packageId','$d',1)");
//     $refIncomeId = $con->insert_id;
//     incomeEntry($con, $sponserId, $refIncomeId, $directIncome, 2, $d);
// }
// //Referral Income Code Ends
