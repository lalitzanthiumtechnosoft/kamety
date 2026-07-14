<?php
include '../conection.php';
require '../PHPMailer/EncrptyModel.php';
date_default_timezone_set('Asia/Kolkata');
$d = date('Y-m-d');
if ($_POST) {
    $msg = '';
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $passObj = new passEncrypt();
    $encPass = $passObj->twoPassEncrypt($password);
    $query = "SELECT * FROM sub_admin_user_details WHERE user_id='$username' AND password='$encPass' AND user_type=1";
    $sql = mysqli_query($con, $query); // execute a sql query
    $val = mysqli_fetch_array($sql);
    if (!$sql) {
        exit('Query failed: '.mysqli_error($con));
    }
    $count = mysqli_num_rows($sql); // count the no of rows returned
    if ($count == 0) { ?>
        <script>
        alert("Incorrect Userid or Password Login!!!\nPlease Try Again!!!");
        window.top.location.href="index";
        </script>
        <?php
    } elseif ($count == 1) {
        $_SESSION['admin_id'] = $val['member_id'];
        $_SESSION['admin_user_id'] = $_POST['username'];
        $_SESSION['admin_password'] = $encPass;
        ?> <script>window.top.location.href='dashboard';</script> <?php
    }
} ?>
<?php include '../close-connection.php'; ?>