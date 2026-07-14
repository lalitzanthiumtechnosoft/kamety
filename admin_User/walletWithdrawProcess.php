<br><br><br>
<center>
	<h2>Processing your request!!!</h2>
	<h3>Please do not press back or refresh!!!</h3>
</center>
<?php
include 'loginCheck.php';

if (isset($_POST['walletWithdraw'])) {
    $memberId = $_POST['memberId'];
    $withdraw_amount = $_POST['withdrawAmount'];
    $trnPassword = $_POST['trnPassword'];
    $paymentId = $_POST['paymentId'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    $emailOtp = md5($_POST['emailOtp']);
    $actualOtp = $_SESSION['withdrawOTP'];
    if ($actualOtp != $emailOtp) {
        unset($_SESSION['withdrawOTP']); ?>
          <script>
              alert("Invalid OTP Enter");
              window.top.location.href = 'walletWithdraw';
          </script>
          <?php
         exit;
    }

    $query = mysqli_query($con, "SELECT topup_flag FROM sub_admin_user_details WHERE member_id='$memberId'");
    $val = mysqli_fetch_array($query);

    if ($val[0] == 0) { ?>
		<script>
			alert("Your account is not Active.");
			history.go(-1);
		</script>
	<?php
        exit;
    }

    $queryWithdraw = mysqli_query($con, 'SELECT minimumWithdraw FROM config_misc_setting');
    $valWithdraw = mysqli_fetch_assoc($queryWithdraw);
    $minimumWithdraw = $valWithdraw['minimumWithdraw'];
    if ($withdraw_amount < $minimumWithdraw) { ?>
		<script>
			alert("The Minimum withdraw amount is $ <?php echo $minimumWithdraw; ?>");
			history.go(-1);
		</script>
	<?php
        exit;
    }

    // $result = mysqli_query($con, "SELECT COUNT(1) FROM user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND CAST(withdrawal_date AS date)='$todayDate' AND (released=1 OR released=0)");
    // $val = mysqli_fetch_array($result);
    // if ($val[0] >= 1) {?>
	// 	<script>
	// 		alert("The Maximun Withdraw Limit Reached today");
	// 		history.go(-1);
	// 	</script>
	// <?php
    // 	exit;
    // }

    $queryLast = mysqli_query($con, "SELECT COUNT(1) from user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND released=0");
    $valLast = mysqli_fetch_array($queryLast);
    if ($valLast[0] >= 1) { ?>
		<script>
			alert("Your Previous Request is On Pending!!!");
			window.top.location.href = "walletWithdraw";
		</script>
	<?php
        exit;
    }

    $queryWallet = mysqli_query($con, "SELECT wallet FROM sub_admin_user_details WHERE member_id='$memberId'");
    $valWallet = mysqli_fetch_array($queryWallet);
    $currentWallet = $valWallet[0];
    if ($currentWallet < $withdraw_amount) { ?>
		<script>
			alert("Insufficient Balance in Your Wallet To Withdraw");
			history.go(-1);
		</script>
	<?php
        exit;
    }

    $queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details where trnPassword='$trnPassword'");
    $valCheck = mysqli_fetch_array($queryCheck);
    if ($valCheck[0] == 0) { ?>
		<script>
			alert("Incorrect Transaction Password!!!");
			history.go(-1);
		</script>
	<?php
        exit;
    }
    $orderId = rand(11101, 99999).date('s').date('h');

    $queryConfig = mysqli_query($con, 'SELECT withdrawCharge FROM config_misc_setting');
    $valConfig = mysqli_fetch_assoc($queryConfig);
    $withdrawCharge = $valConfig['withdrawCharge'];

    $Charge = $withdraw_amount * $withdrawCharge / 100;
    $netAmount = $withdraw_amount - $Charge;

    $queryIn = mysqli_query($con, "INSERT INTO user_wallet_withdrawal_crypto (`member_id`,`payout_date`,`date_time`,`amount`,`netAmount`,`withdrawCharge`,`orderid`,`paymentId`) VALUES ('$memberId','$todayDate','$d','$withdraw_amount','$netAmount','$Charge','$orderId','$paymentId')");
    $lastWithdraw = $con->insert_id;

    mysqli_query($con, "UPDATE sub_admin_user_details SET wallet=wallet-'$withdraw_amount' WHERE member_id='$memberId'");

    mysqli_query($con, "INSERT INTO user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$memberId',10,1,'$withdraw_amount','$d','$lastWithdraw')"); ?>
	<script>
		alert("Wallet Withdraw Successfully");
		window.top.location.href = "walletWithdraw";
	</script>
<?php } ?>
<?php include '../close-connection.php'; ?>