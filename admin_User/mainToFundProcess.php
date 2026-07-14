<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php
include 'loginCheck.php';
if (isset($_POST['fundTransfer'])) {
    $user_id1 = $_POST['sponser_id'];
    $loginMemberId = $_POST['loginMemberId'];
    $amount = $_POST['amount'];
    $trnPassword = $_POST['trnPassword'];
    $incomeWallet = $_POST['incomeWallet'];
    $fundWallet = $_POST['fundWallet'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    if ($amount <= 0) { ?>
		<script>
			alert("Invalid Amount Enter!!!");
	    	window.top.location.href="mainToFund";
		</script>
		<?php
        exit;
    }

    // $queryCheck=mysqli_query($con,"SELECT COUNT(1) FROM sub_admin_user_details WHERE member_id='$loginMemberId' AND trnPassword='$trnPassword'");
    // $valCheck=mysqli_fetch_array($queryCheck);
    // if($valCheck[0]==0) {?>
	//     <script>
	//       alert("Incorrect Transaction Password!!!");
	//       window.top.location.href='mainToFund';
	//     </script>
	//     <?php
    //     exit;
    // }
    $resultFund = mysqli_query($con, "SELECT wallet FROM sub_admin_user_details WHERE member_id='$loginMemberId' AND wallet>='$amount'");
    if (!mysqli_num_rows($resultFund)) { ?>
		<script>
		alert("Insufficient Balance in Income Wallet to Transfer!!!");
	    window.top.location.href="mainToFund";
		</script>
		<?php
        exit;
    }

    // $queryConfig=mysqli_query($con,"SELECT withdrawCharge FROM config_misc_setting");
    // $valConfig=mysqli_fetch_assoc($queryConfig);
    // $withdrawCharge=$valConfig['withdrawCharge'];

    // $Charge=$amount*$withdrawCharge/100;
    // $netAmount=$amount-$Charge;

    mysqli_query($con, "UPDATE sub_admin_user_details SET wallet=wallet-'$amount',fundWallet=fundWallet+'$amount' WHERE member_id='$loginMemberId'");

    $queryIn = mysqli_query($con, "INSERT INTO user_income_wallet_transfer(`memberId`,`transferAmount`,`transferCharge`,`depositAmount`,`transferDate`,`incomeWallet`,`fundWallet`) VALUES ('$loginMemberId','$amount','$withdrawCharge','$amount','$d','$incomeWallet','$fundWallet')");
    $trfId = $con->insert_id;

    mysqli_query($con, "INSERT INTO user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$loginMemberId',9,1,'$amount','$d','$trfId')"); ?>
	<script>
	  alert("Fund Transfer Successfully!!!");
	  window.top.location.href="mainToFund";
	</script>
<?php } ?>
<?php include '../close-connection.php'; ?>