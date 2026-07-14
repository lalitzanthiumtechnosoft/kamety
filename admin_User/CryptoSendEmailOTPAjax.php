<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'loginCheck.php';
$userId = $_POST['userId'];
$investmentAmount = $_POST['investmentAmount'];
$otpCode = rand(11111, 99999);
unset($_SESSION['withdrawOTP']);
$_SESSION['withdrawOTP'] = md5($otpCode);
$queryMail = mysqli_query($con, "SELECT email_id,name FROM sub_admin_user_details WHERE user_id='$userId' AND user_type=2");
$valMail = mysqli_fetch_assoc($queryMail);
$emailId = $valMail['email_id'];
$name = $valMail['name'];

require_once '../PHPMailer/PHPMailer.php';
require_once '../PHPMailer/SMTP.php';
require_once '../PHPMailer/Exception.php';
require_once '../PHPMailer/OAuthCredential.php';

$mailSubject = 'Digital Kamety OTP Verification';
$newMsg = '
<html>
<head>
    <title>Digital Kamety OTP Verification</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333333;
            background-color: #ffffff;
        }
        .container {
            padding: 20px;
            line-height: 1.6;
        }
        .highlight {
            color: #0056b3;
            font-weight: bold;
        }
        .otp {
            font-size: 16px;
            font-weight: bold;
            color: #d9534f;
        }
        .footer {
            margin-top: 30px;
            font-family: Georgia, serif;
            font-weight: bold;
            color: #222;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Dear <span class="highlight">'.$name.'</span>,</p>

        <p>You recently attempted to withdraw <strong>$'.$investmentAmount.'</strong>.</p>

        <p>For security reasons, please use the following OTP code to verify your transaction:</p>

        <p class="otp">OTP CODE: '.$otpCode.'</p>

        <p>If you did not initiate this request, please contact our support team immediately.</p>

        <div class="footer">Digital Kamety TEAM</div>
    </div>
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
echo 'true';

return true;
