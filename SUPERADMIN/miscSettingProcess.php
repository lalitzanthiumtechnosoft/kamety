
<br><br><br>
<center>
<h2>Processing your request!!!</h2>
<h3>Please do not press back or refresh!!!</h3>
</center>
<?php

ob_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
include 'login-check.php';
if (isset($_POST['miscUpdate'])) {
    $withdrawCharge = $_POST['withdrawCharge'];
    $minimumWithdraw = $_POST['minimumWithdraw'];
    $miscId = $_POST['miscId'];
    $d = date('Y-m-d H:i:s');

    $queryIn = mysqli_query($con, "UPDATE config_misc_setting SET withdrawCharge='$withdrawCharge',minimumWithdraw='$minimumWithdraw' WHERE id='$miscId'");
    if ($queryIn) { ?>
        <script>
            alert('MISC Setting Updated Successfully');
            window.top.location.href="miscSetting";
        </script>
        <?php
        exit;
    } else { ?>
        <script>
            alert('MISC Setting Not Updated...Try Again');
            window.top.location.href="miscSetting";
        </script>
        <?php
        exit;
    }
} ?>
<?php include '../close-connection.php'; ?>