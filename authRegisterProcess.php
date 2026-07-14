<br><br><br>
<center>
    <h2>Processing your request!!!</h2>
    <h3>Please do not press back or refresh!!!</h3>
</center>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__).'/php_errors.log');
require_once 'conection.php';

if (isset($_POST['submitRegister'])) {
    $newToken = $_SESSION['tokenSet'];
    $goodFile = mysqli_real_escape_string($con, $_POST['goodFile']);

    if ($goodFile == $newToken) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $sponser_id = mysqli_real_escape_string($con, $_POST['sponser_id']);
        $emailId = mysqli_real_escape_string($con, $_POST['emailId']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $loginPassword = mysqli_real_escape_string($con, $_POST['password']);
        $trnPassword = 123456;
        $countryId = 91;

        $d = date('Y-m-d H:i:s');
        $dt = date('Y-m-d');

        $queryCheck = mysqli_query($con, "SELECT * FROM sub_admin_user_details WHERE user_id='$sponser_id' AND account_status=1");
        if (!mysqli_num_rows($queryCheck)) { ?>
<script>
alert("Invalid / Suspended Sponser Id!!!");
history.go(-1);
</script>
<?php
            exit;
        }

        // // Check if email has already been used 3 times
        // $emailCheck = mysqli_query($con, "SELECT COUNT(*) as count FROM sub_admin_user_details WHERE email_id='$emailId'");
        // $emailData = mysqli_fetch_assoc($emailCheck);

        // if ($emailData['count'] >= 3) {
        //?>

<script>
//         alert("This email address has already been used 3 times.");
//         history.go(-1);
//     
</script>
<?php
        //     exit;
        // }

        // // Check if phone number has already been used 3 times
        // $phoneCheck = mysqli_query($con, "SELECT COUNT(*) as count FROM sub_admin_user_details WHERE phone='$phone'");
        // $phoneData = mysqli_fetch_assoc($phoneCheck);

        // if ($phoneData['count'] >= 3) {
        //?>

<script>
//         alert("This phone number has already been used 3 times.");
//         history.go(-1);
//     
</script>
<?php
        //     exit;
        // }

        $querySponser = mysqli_query($con, "SELECT member_id from sub_admin_user_details where user_id='$sponser_id'");
        $valSponser = mysqli_fetch_array($querySponser);
        $sponser_member_id = $valSponser[0];

        $queryInsert = mysqli_query($con, "INSERT INTO sub_admin_user_details (name,email_id,phone,password,sponser_id,date_time,countryId) VALUES ('$name','$emailId','$phone','$loginPassword','$sponser_member_id','$d','$countryId')");
        $used_member_id = $con->insert_id;
        $newMember = base64_encode($used_member_id);
        $newMd = md5($used_member_id);
        $newSha = sha1($used_member_id);

        $_SESSION['newDevineToken'] = $used_member_id;
        $_SESSION['newAdvineToken'] = $newSha;
        $_SESSION['ngDefine'] = $newMd;
        $_SESSION['newLogPass'] = $loginPassword;
        $_SESSION['ngTrnPass'] = $trnPassword;

        function userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $trnPassword)
        {
            require_once 'PHPMailer/PHPMailer.php';
            require_once 'PHPMailer/SMTP.php';
            require_once 'PHPMailer/Exception.php';
            require_once 'PHPMailer/OAuthCredential.php';
            $user_id = 'FV'.rand(11, 99).rand(1111, 9999);
            $queryExist = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details WHERE user_id='$user_id'");
            $valExist = mysqli_fetch_array($queryExist);
            if ($valExist[0] == 0) {
                mysqli_query($con, "UPDATE sub_admin_user_details SET user_id='$user_id' WHERE member_id='$used_member_id'");
                $mailSubject = 'Digital Kamety Account Details';
                $newMsg = '<html>
                            <head>
                                <title>Digital Kamety Account Details</title>
                            </head>
                            <body style="background-color:#ffffff; color:#222222; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
                                <p>Dear <strong style="color:#4b2996;">'.htmlspecialchars($name).'</strong>,</p>
                                <p>
                                    Thank you for registering your account with <strong>Digital Kamety</strong>. By completing your registration, you have accepted the terms of the Public Offer Agreement. This electronic agreement carries the same legal validity and obligations as a traditional signed contract.
                                </p>
                                <p>
                                    Your account has been successfully created. Please find your access details below:
                                </p>
                                <ul style="list-style:none; padding-left:0;">
                                    <li><strong>Affiliate ID:</strong> <span style="color:#4b2996;">'.htmlspecialchars($user_id).'</span></li>
                                    <li><strong>Login Password:</strong> <span style="color:#FF8C00;">'.htmlspecialchars($loginPassword).'</span></li>
                                    <li><strong>Transaction Password:</strong> <span style="color:#FF8C00;">'.htmlspecialchars($trnPassword).'</span></li>
                                </ul>
                                <p>
                                    Please keep this information secure and do not share it with anyone.
                                </p>
                                <p>
                                    If you have any questions or require assistance, feel free to contact our support team.
                                </p>
                                <br>
                                <p>Best regards,<br>
                                <strong>Digital Kamety Team</strong></p>
                            </body>
                            </html>';
                $mail = new PHPMailer();
                $mail->isSMTP();
                // $mail->SMTPDebug = 4;  //Keep It commented this is used for debugging
                $mail->Host = smtpServer; // smtp address of your email
                $mail->SMTPAuth = true;
                $mail->Username = EmailCode;
                $mail->Password = addCode;
                $mail->Port = smtpPort;
                $mail->SMTPSecure = 'tls';
                $mail->smtpConnect([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ]);

                // Email Settings
                $mail->isHTML(true);
                $mail->setFrom(EmailCode, mailerName);
                $mail->addAddress($emailId); // enter email address whom you want to send
                $mail->Subject = ("$mailSubject");
                $mail->Body = $newMsg;
                $mail->send();
            } else {
                userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $trnPassword);
            }
        }
        userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $trnPassword);

        // Joining Code Ends//

        // Child ID Code Starts//
        $queryChild = mysqli_query($con, "SELECT sponser_id,date_time FROM sub_admin_user_details WHERE member_id='$used_member_id'");
        $valChild = mysqli_fetch_array($queryChild);
        $parent_id = $valChild[0];
        $date_time = $valChild[1];
        $level = 1;
        while ($parent_id) {
            mysqli_query($con, "INSERT INTO sub_admin_user_child_ids(member_id,child_id,level,date_time) VALUES ('$parent_id','$used_member_id','$level','$date_time')");
            $queryUser = mysqli_query($con, "SELECT sponser_id FROM sub_admin_user_details WHERE member_id='$parent_id'");
            $valUser = mysqli_fetch_array($queryUser);
            $parent_id = $valUser[0];
            ++$level;
        }
        // Child ID Code Ends

        unset($_SESSION['tokenSet']); ?>
<script>
window.top.location.href =
    "authRegisterSuccess?BorCool=<?php echo $newMd; ?>&glowCoco=<?php echo $newMember; ?>&kriNote=<?php echo $newSha; ?>";
</script>
<?php } else { ?>
<script>
alert('Your Session Expired.Please re Submit your form Again');
history.go(-1);
</script>
<?php }
} ?>
<?php require 'close-connection.php'; ?>