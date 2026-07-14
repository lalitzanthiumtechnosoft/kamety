
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php 

date_default_timezone_set("Asia/Kolkata");
include("login-check.php");
 
$payout_id=$_GET['WalletID']; 
$d=date('Y-m-d H:i:s');
$remarks="Withdrawal Request Accepted";

$queryPayout=mysqli_query($con,"SELECT * FROM user_wallet_withdrawal WHERE id='$payout_id'");
$valPayout=mysqli_fetch_assoc($queryPayout);
$member_id=$valPayout['member_id'];
$amount=$valPayout['amount'];
$released=$valPayout['released'];

if($released==1){ ?>
	<script>
		alert("This Request already Rejected");
		window.top.location.href="withdrawRequest";
	</script>
	<?php 
	exit;
}

mysqli_query($con,"UPDATE user_wallet_withdrawal SET released=1,approvedDate='$d',remarks='$remarks' WHERE id='$payout_id'"); ?>
<script>
	alert("Withdrawal Request Approved Successful..");
	window.top.location.href="withdrawRequest";
</script>
<?php include("../close-connection.php"); ?>