<?php
include 'loginCheck.php';

if (isset($_POST['bankUpdate'])) {
    $memberId = $_POST['memberId'];
    $acName = $_POST['acName'];
    $ifsc = $_POST['ifsc'];
    $bank = $_POST['bank'];
    $branch = $_POST['branch'];
    $accountNo = $_POST['accountNo'];

    mysqli_query($con, "UPDATE sub_admin_user_details SET acName=ucase('$acName'),ifsc=ucase('$ifsc'),bank=ucase('$bank'),branch=ucase('$branch'),accountNo='$accountNo' WHERE member_id='$memberId'"); ?>
    <script>
        alert('Bank Details Updated Successfully!!!');
        window.top.location.href = "bankDetails";
    </script>
<?php }

if (isset($_POST['profileUpdate'])) {
    $memberId = $_POST['memberId'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $emailId = $_POST['emailId'];
    $countryId = $_POST['countryId'];
    $d = date('Y-m-d H:i:s');
    mysqli_query($con, "UPDATE sub_admin_user_details SET name='$name',email_id='$emailId',phone='$phone',countryId='$countryId' WHERE member_id='$memberId'"); ?>
    <script>
        alert("Profile Updated Successfully!!!");
        window.top.location.href = "userProfileAuth";
    </script>
<?php }

if (isset($_POST['addWalletAddress'])) {
    $currencyId = $_POST['currencyId'];
    $memberId = $_POST['memberId'];
    $walletAddress = $_POST['walletAddress'];
    $trnPassword = $_POST['trnPassword'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    // $queryCheck=mysqli_query($con,"SELECT COUNT(1) FROM sub_admin_user_details WHERE member_id='$memberId' AND trnPassword='$trnPassword'");
    // $valCheck=mysqli_fetch_array($queryCheck);
    // if($valCheck[0]==0) {
    ?>
    // <script>
        //       alert("Incorrect Transaction Password!!!");
        //       window.top.location.href='walletAddressAdd';
        //     
    </script>
    // <?php
            //     exit;
            // }
            $queryIn = mysqli_query($con, "INSERT INTO user_wallet_address_details (`currency_id`,`member_id`,`walletAddress`,`addDate`) VALUES ('$currencyId','$memberId','$walletAddress','$d')");
    if ($queryIn) {  ?>
        <script>
            alert('Wallet Address Added Successfully');
            window.top.location.href = "walletAddressAdd";
        </script>
    <?php
        exit;
    } else { ?>
        <script>
            alert('Wallet Address Not Added...Try Again');
            window.top.location.href = "walletAddressAdd";
        </script>
    <?php
        exit;
    }
}

if (isset($_POST['addUPIAddress'])) {
    $memberId = $_POST['memberId'];
    $upiAddress = $_POST['upiAddress'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    $queryIn = mysqli_query($con, "INSERT INTO user_upi_address_details (`member_id`,`upiAddress`,`addDate`) VALUES ('$memberId','$upiAddress','$d')");
    if ($queryIn) {  ?>
        <script>
            alert('UPI Address Added Successfully');
            window.top.location.href = "upiAdd";
        </script>
    <?php
        exit;
    } else { ?>
        <script>
            alert('UPI Address Not Added...Try Again');
            window.top.location.href = "upiAdd";
        </script>
    <?php
        exit;
    }
}

if (isset($_POST['changeLogin'])) {
    $memberId = $_POST['memberId'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $d = date('Y-m-d H:i:s');

    if ($password2 != $password1) { ?>
        <script>
            alert("New Login passwords do not match!!!");
            window.top.location.href = 'changePassword';
        </script>
    <?php
        exit;
    }
    $result = mysqli_query($con, "SELECT count(*) FROM sub_admin_user_details WHERE member_id='$memberId' AND password='$password'");
    $val = mysqli_fetch_array($result);
    if ($val[0] == 0) { ?>
        <script>
            alert("Incorrect Current Login password!!!");
            window.top.location.href = 'changePassword';
        </script>
    <?php
        exit;
    }

    $result1 = mysqli_query($con, "UPDATE sub_admin_user_details SET password='$password1' WHERE member_id='$memberId'");
    if ($result1) {
        unset($_SESSION['user_member_id']);
        unset($_SESSION['member_user_id']);
        unset($_SESSION['member_password']); ?>
        <script>
            alert("Login Password Updated Successfully!!!\nNow please login again with new password. ");
            window.top.location.href = 'changePassword';
        </script>
    <?php
    }
}
if (isset($_POST['changeTrn'])) {
    $memberId = $_POST['memberId'];
    $password = $_POST['trnPassword'];
    $password1 = $_POST['trnPassword1'];
    $password2 = $_POST['trnPassword2'];
    $d = date('Y-m-d H:i:s');
    if ($password2 != $password1) { ?>
        <script>
            alert("New Transaction passwords and Confirm Transaction Password do not match!!!");
            window.top.location.href = 'trnPassword';
        </script>
    <?php
        exit;
    }

    $result = mysqli_query($con, "SELECT COUNT(*) FROM sub_admin_user_details WHERE member_id='$memberId' AND trnPassword='$password'");
    $val = mysqli_fetch_array($result);
    if ($val[0] == 0) { ?>
        <script>
            alert("Incorrect Current Transaction password!!!");
            window.top.location.href = 'trnPassword';
        </script>
    <?php
        exit;
    }

    $result1 = mysqli_query($con, "UPDATE sub_admin_user_details SET trnPassword='$password1' WHERE member_id='$memberId'");
    if ($result1) { ?>
        <script>
            alert("Transaction Password Updated Successfully!!!");
            window.top.location.href = 'trnPassword';
        </script>
<?php
    }
} ?>
<?php include '../close-connection.php'; ?>