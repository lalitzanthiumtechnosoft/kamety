<br><br><br>
<center>
	<h2>Processing your request!!!</h2>
	<h3>Please do not press back or refresh!!!</h3>
</center>
<?php
include 'login-check.php';
if (isset($_POST['tokenGenerate'])) {
    $loginMemberId = $_POST['loginMemberId'];
    $generateToken = $_POST['generateToken'];
    $coinRate = $_POST['coinRate'];
    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $d = date('Y-m-d H:i:s');
    $entry_date = date('Y-m-d');

    // $queryCheck = mysqli_query($con, "SELECT coinRate, dateFrom, dateTo, status FROM config_coin_generate_history WHERE status=1 ORDER BY dateTo DESC LIMIT 1");
    // $valCheck = mysqli_fetch_assoc($queryCheck);
    // $roundCheck = $valCheck['dateTo'];
    // if ($entry_date < $roundCheck) {
    ?>
	// <script>
		// 		alert("You cannot generate tokens until the next date is completed!!!");
		// 		window.top.location.href = "tokenGenerate";
		// 	
	</script>
	// <?php
            // 	exit;
            // }

            // 	$queryRest = mysqli_query($con, "SELECT restGenToken FROM sub_admin_user_details WHERE member_id=1");
            // 	$valRest = mysqli_fetch_assoc($queryRest);
            // 	$restGenToken = $valRest['restGenToken'];
            // 	if ($restGenToken > 0) {
    ?>
	// <script>
		// 		alert("You are not Generate Token this time!!!");
		// 		window.top.location.href = 'tokenGenerate';
		// 	
	</script>
	// <?php
    // 		exit;
    // 	}

    $queryCheck = mysqli_query($con, 'SELECT COUNT(1) AS total FROM config_coin_generate_history ORDER BY dateTime ASC');
    $valCheck = mysqli_fetch_assoc($queryCheck);
    $roundCheck = $valCheck['total'];
    if ($roundCheck >= 3) {
        ?>
		<script>
			alert("Complet All Rounde!!!");
			window.top.location.href = "tokenGenerate";
		</script>
	<?php
            exit;
    }

    if ($generateToken <= 0 || $generateToken == 0) { ?>
		<script>
			alert("Please Enter Valid Token Amount!!!");
			window.top.location.href = "tokenGenerate";
		</script>
	<?php
        exit;
    }
    if ($coinRate <= 0 || $coinRate == 0) { ?>
		<script>
			alert("Please Enter Valid Token Rate!!!");
			window.top.location.href = "tokenGenerate";
		</script>
	<?php
        exit;
    }

    // mysqli_query($con, "UPDATE config_coin_generate_history SET status=0 WHERE status=1");

    mysqli_query($con, "UPDATE sub_admin_user_details SET restGenToken='$generateToken' WHERE member_id='$loginMemberId'");

    mysqli_query($con, "UPDATE config_misc_setting SET tokenRate='$coinRate'");

    mysqli_query($con, "INSERT INTO config_coin_generate_history (`coinGenerate`,`coinRate`,`dateTime`,`dateFrom`,`dateTo`,`status`) VALUES ('$generateToken','$coinRate','$d','$dateFrom','$dateTo',1 )"); ?>
	<script>
		alert("Token Generated Successfully!!!");
		window.top.location.href = "tokenGenerate";
	</script>
<?php } ?>
<?php include '../close-connection.php'; ?>