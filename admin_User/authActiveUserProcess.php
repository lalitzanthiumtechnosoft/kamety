<?php
require_once 'loginCheck.php';
require_once 'authIncomeFunction.php';
if (isset($_POST['upgradeNow'])) {
    $user_id1 = $_POST['sponser_id'];
    $loginMemberId = $_POST['loginMemberId'];
    $amount = $_POST['amount'];
    $month = $_POST['month'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    $querySlab = mysqli_query($con, 'SELECT minInvest FROM config_misc_setting');
    $valSlab = mysqli_fetch_assoc($querySlab);
    $minInvest = $valSlab['minInvest'];
    if ($amount < $minInvest) { ?>
        <script>
            alert("Minimum Investment Amount is $ <?php echo $minInvest; ?> !!!");
            window.top.location.href = "authActiveUser";
        </script>
        <?php
        exit;
    }
    if ($amount < 0 || $amount == '') { ?>
        <script>
            alert("Invalid Investment Amount!!!");
            window.top.location.href = "authActiveUser";
        </script>
        <?php
        exit;
    }

    $resultUser = mysqli_query($con, "SELECT member_id FROM sub_admin_user_details WHERE user_id='$user_id1' AND user_type=2 AND account_status=1");
    if (!mysqli_num_rows($resultUser)) { ?>
        <script>
            alert("Invalid User Id!!!");
            window.top.location.href = "authActiveUser";
        </script>
        <?php
        exit;
    }

    $queryWallet = mysqli_query($con, "SELECT fundWallet FROM sub_admin_user_details WHERE member_id='$loginMemberId'");
    $valWallet = mysqli_fetch_array($queryWallet);
    $currentWallet = $valWallet[0];
    if ($currentWallet <= 0) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "authActiveUser";
        </script>
        <?php
        exit;
    }
    if ($currentWallet < $amount) { ?>
        <script>
            alert("Insufficient Balance in Wallet to Purchase");
            window.top.location.href = "authActiveUser";
        </script>
        <?php
        exit;
    }

    $queryDetails = mysqli_query($con, "SELECT a.name,a.member_id,a.sponser_id,a.topup_flag,b.topup_flag AS sponserTop FROM sub_admin_user_details a, sub_admin_user_details b WHERE a.user_id='$user_id1' AND a.sponser_id=b.member_id");
    $valDetails = mysqli_fetch_assoc($queryDetails);
    $memberId = $valDetails['member_id'];
    $name = $valDetails['name'];
    $sponserId = $valDetails['sponser_id'];
    $topup_flag = $valDetails['topup_flag'];
    $sponserTop = $valDetails['sponserTop'];

    // Activation Code Start//
    if ($topup_flag == 0) {
        mysqli_query($con, "UPDATE sub_admin_user_details SET topup_flag=1,activation_date='$d' WHERE member_id='$memberId'");
        mysqli_query($con, "UPDATE sub_admin_user_child_ids SET topup_status=1,topup_date='$d' WHERE child_id='$memberId'");
    }
    // Fund Debit Code Start
    mysqli_query($con, "UPDATE sub_admin_user_details SET fundWallet=fundWallet-'$amount' WHERE member_id='$loginMemberId'");

    // Invest Amount History Code Start
    $queryPartner = mysqli_query($con, "INSERT INTO user_invest_history (memberId,sponserId,loginMemberId,Amount,dateTime) VALUES ('$memberId','$sponserId','$loginMemberId','$amount','$d')");
    $investId = $con->insert_id;
    mysqli_query($con, "INSERT INTO user_wallet_statement (member_id,wallet_statement_id,deb_cr, amount,date_time,trn_id) VALUES ('$loginMemberId',8,1,'$amount','$d','$investId')");
    // Invest Amount History Code End

    mysqli_query($con, "INSERT INTO `user_month_set_details`(`member_id`, `sponserId`, `packagePrice`, `userNeed`, `date_time`, `dueDate`) VALUES ('$memberId','$sponserId','$amount','$month','$d','$todayDate')");

    // Referal income code start
    // if ($sponserTop == 1) {
    //     referralIncome($con, $sponserId, $memberId, $amount, $directIncome, $d);
    // }
    // Referal income code end

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        window.onload = function() {
            // Construct the dynamic message in JavaScript
            var message = 'DEAR ' + '" . addslashes($name) . "' + ', YOUR ID ' + '" . addslashes($user_id1) . "' + ' HAS BEEN ACTIVATED BY ' + " . $amount . " + ' ON ' + '" . addslashes($d) . "' + ' ENJOY YOUR DAY.';

            // Show the SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'CONGRATULATIONS!',
                text: message,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'authActiveUser';
            });
        };
    </script>";
} ?>
<?php include '../close-connection.php'; ?>