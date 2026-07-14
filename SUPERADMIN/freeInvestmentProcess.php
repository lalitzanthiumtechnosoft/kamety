<br><br><br>
<center>
  <h2>Processing your request!!!</h2>
  <h3>Please do not press back or refresh!!!</h3>
</center>
<?php
include 'login-check.php';
if (isset($_POST['investNow'])) {
  $user_id1 = $_POST['sponser_id'];
  $loginMemberId = $_POST['loginMemberId'];
  $investmentAmount = $_POST['amount'];
  $d = date('Y-m-d H:i:s');
  $todayDate = date('Y-m-d');

  $result = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE user_id='$user_id1' AND user_type=2 AND account_status=1");
  if (!mysqli_num_rows($result)) { ?>
    <script>
      alert("Invalid User Id!!!");
      window.top.location.href = "freeInvestment";
    </script>
    <?php
    exit;
  }
  $queryDetails = mysqli_query($con, "SELECT a.member_id,a.sponser_id,a.topup_flag,b.topup_flag AS sponserTop FROM sub_admin_user_details a, sub_admin_user_details b WHERE a.user_id='$user_id1' AND a.sponser_id=b.member_id");
  $valDetails = mysqli_fetch_assoc($queryDetails);
  $memberId = $valDetails['member_id'];
  $sponser_id = $valDetails['sponser_id'];
  $topupFlag = $valDetails['topup_flag'];
  $sponserTopup = $valDetails['sponserTop'];

  $queryConfig = mysqli_query($con, 'SELECT referralPercent,roiReturn,investReturn FROM config_misc_setting');
  $valConfig = mysqli_fetch_assoc($queryConfig);
  $referralPercent = $valConfig['referralPercent'];
  $roiReturn = $valConfig['roiReturn'];
  $investReturn = $valConfig['investReturn'];

  // Activation & Update Code Starts//
  if ($topup_flag == 0) {
    mysqli_query($con, "UPDATE sub_admin_user_details SET topup_flag=1,activation_date='$d' WHERE member_id='$memberId'");

    mysqli_query($con, "UPDATE sub_admin_user_child_ids SET topup_status=1,topup_date='$d' WHERE child_id='$memberId'");
  }
  // Activation & Update Code Ends//

  // Investment Code Starts
  $dueDate = date('Y-m-d H:i:s', strtotime($d . ' +72 hours'));
  $roiMaturity = $investmentAmount * $roiReturn;
  $investMaturity = $investmentAmount * $investReturn;

  mysqli_query($con, "UPDATE user_invest_income_summary SET investStatus=0 WHERE memberId='$memberId' AND countStatus=1");

  $queryIn = mysqli_query($con, "INSERT INTO user_invest_income_summary (`memberId`,`Amount`,`investMaturity`,`investReturn`,`roiMaturity`,`roiReturn`,`dateTime`,`dueDate`,`roiBusCount`) VALUES ('$memberId','$investmentAmount','$investMaturity','$investReturn','$roiMaturity','$roiReturn','$d','$dueDate',2)");
  $summaryId = $con->insert_id;

  // Investment Code Starts ?>
  <script>
    alert("Package Purchased Successfully!!!");
    window.top.location.href = "freeInvestment";
  </script>
<?php } ?>
<?php include '../close-connection.php'; ?>