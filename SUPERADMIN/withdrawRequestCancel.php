
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php

date_default_timezone_set('Asia/Kolkata');
include 'login-check.php';
if (isset($_POST['cancelWithdraw'])) {
    $payout_id = $_POST['id'];
    $remarks = $_POST['remarks'];
    $d = date('Y-m-d H:i:s');
    $actionType = $_POST['actionType'];

    $queryPayout = mysqli_query($con, "SELECT * FROM user_wallet_withdrawal WHERE id='$payout_id'");
    $valPayout = mysqli_fetch_assoc($queryPayout);
    $member_id = $valPayout['member_id'];
    $amount = $valPayout['amount'];
    $released = $valPayout['released'];

    if ($actionType == 1) {
        $returnUrl = 'withdrawRequest';
    } else {
        $returnUrl = 'walletWithdrawCheck';
    }
    if ($released == 2) { ?>
		<script>
			alert("This Request already Rejected");
			window.top.location.href="<?php echo $returnUrl; ?>";
		</script>
		<?php
        exit;
    }
    mysqli_query($con, "UPDATE user_wallet_withdrawal SET released=3,approvedDate='$d',remarks='$remarks' WHERE id='$payout_id'");

    mysqli_query($con, "UPDATE sub_admin_user_details SET wallet=wallet+'$amount' WHERE member_id='$member_id'");

    mysqli_query($con, "INSERT INTO  user_wallet_statement (`member_id`,`wallet_statement_id`,`deb_cr`,`amount`,`date_time`,`trn_id`) VALUES ('$member_id',11,2,'$amount','$d','$payout_id')");
    ?>
	<script>
		alert("Withdrawal Request Rejected Successful..");
		window.top.location.href="<?php echo $returnUrl; ?>";
	</script>
	<?php } ?>


<?php include '../close-connection.php'; ?>