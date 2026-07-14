<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
include 'loginCheck.php';
require '../PHPMailer/EncrptyModel.php';
clearstatcache();
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 1300); // 300 seconds = 5 minutes
if (isset($_POST['fundRequest'])) {
    $member_id = $_POST['member_id'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $requestFund = $_POST['requestFund'];
    // $paymentDate=date('Y-m-d',strtotime($_POST['paymentDate']));
    $paymentHash = $_POST['paymentHash'];
    $paymentRemark = $_POST['paymentRemark'];
    $payment_id = $_POST['payment_id'];
    $trnPassword = $_POST['trnPassword'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    if ($requestFund == 0 || $requestFund < 0) { ?>
    <script>
      alert("Invalid Request Fund!!!");
      window.top.location.href="fundRequest";
    </script>
    <?php
      exit;
    }
    // $newCalObj4 = new passEncrypt;
    // $encTrnPass = $newCalObj4->twoPassEncrypt($trnPassword);
    // $queryCheck = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details WHERE member_id='$member_id' AND trnPassword='$encTrnPass'");
    // $valCheck = mysqli_fetch_array($queryCheck);
    // if ($valCheck[0] == 0) {?>
  //   <script>
  //     alert("Incorrect Transaction Password!!!");
  //     history.go(-1);
  //   </script>
  // <?php
    //   exit;
    // }
    $queryLast = mysqli_query($con, "SELECT COUNT(1) from user_fund_request WHERE member_id='$member_id' AND status=0");
    $valLast = mysqli_fetch_array($queryLast);
    if ($valLast[0] >= 1) { ?>
    <script>
      alert("Your Previous Request is On Pending!!!");
      window.top.location.href="fundRequest";
    </script>
    <?php
      exit;
    }

    $queryHash = mysqli_query($con, "SELECT COUNT(1) from user_fund_request WHERE member_id='$member_id' AND paymentHash='$paymentHash'");
    $valHash = mysqli_fetch_array($queryHash);
    if ($valHash[0] >= 1) { ?>
    <script>
      alert("Your Previous Request using this Transaction Hash!!!");
      window.top.location.href="fundRequest";
    </script>
    <?php
      exit;
    }

    $result1 = mysqli_query($con, "INSERT INTO user_fund_request (`member_id`,`name`,`user_id`,`requestFund`,`paymentDate`,`paymentHash`,`paymentRemark`,`date_time`, `payment_id`) VALUES ('$member_id','$name','$user_id','$requestFund','$paymentDate','$paymentHash','$paymentRemark','$d', '$payment_id')");

    $request_id = $con->insert_id;

    // Transaction Upload Code
    $allowedExts = ['gif', 'jpeg', 'jpg', 'png', 'JPG', 'JPEG', 'GIF', 'PNG', 'pdf', 'PDF'];
    $temp = explode('.', $_FILES['transactionImage']['name']);
    $extension = end($temp);
    if ((($_FILES['transactionImage']['type'] == 'image/gif')
    || ($_FILES['transactionImage']['type'] == 'image/jpeg')
    || ($_FILES['transactionImage']['type'] == 'image/jpg')
    || ($_FILES['transactionImage']['type'] == 'image/png')
    || ($_FILES['transactionImage']['type'] == 'image/GIF')
    || ($_FILES['transactionImage']['type'] == 'image/JPEG')
    || ($_FILES['transactionImage']['type'] == 'image/JPG')
    || ($_FILES['transactionImage']['type'] == 'image/PNG')
    || ($_FILES['transactionImage']['type'] == 'image/pdf')
    || ($_FILES['transactionImage']['type'] == 'image/PDF')
    || ($_FILES['transactionImage']['type'] == 'application/png'))
    && ($_FILES['transactionImage']['size'] < 5000000)
    && in_array($extension, $allowedExts)) {
        if ($_FILES['transactionImage']['error'] > 0) {
        } else {
            $location = '../assets/SupportFile/';
            $newFileNameId = uniqid('Trans-', true)
      .'.'.strtolower(pathinfo($_FILES['transactionImage']['name'], PATHINFO_EXTENSION));
            move_uploaded_file($_FILES['transactionImage']['tmp_name'], $location.$newFileNameId);
            $transaction_path = $location.$newFileNameId;

            mysqli_query($con, "UPDATE user_fund_request SET transactionImage='$transaction_path' WHERE id='$request_id'");
        }
    }
    if ($result1) { ?>
    <script>
      alert("Fund Request Raised Successfully");
      window.top.location.href='fundRequest';
    </script>
  <?php }
    } ?>
<?php include '../close-connection.php'; ?>