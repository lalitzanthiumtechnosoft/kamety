<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../conection.php';
require '../PHPMailer/EncrptyModel.php';
$d = date('Y-m-d H:i:s');
$userId = mysqli_real_escape_string($con, $_POST['userId']);
$d = date('Y-m-d H:i:s');
$queryDetails = mysqli_query($con, "SELECT member_id,name,phone,user_id,email_id FROM sub_admin_user_details WHERE user_id='$userId' AND user_type=2 AND account_status=1");
if ($valDetails = mysqli_fetch_array($queryDetails)) {
    $email_id = $valDetails['email_id'];
    $memberId = $valDetails['member_id'];
    $name = $valDetails['name'];
    $phone = $valDetails['phone'];
    $user_id = $valDetails['user_id'];

    function trnPassword($length = 6)
    {
        $chars = '0123456789';
        $password = substr(str_shuffle($chars), 0, $length);

        return $password;
    }

    $trnPassword = trnPassword(6);

    // $passObj= new passEncrypt();
    // $encTrnPass= $passObj -> twoPassEncrypt($trnPassword);

    $queryupdate = mysqli_query($con, "UPDATE sub_admin_user_details SET  trnPassword='$trnPassword' WHERE member_id='$memberId'");

    require_once '../PHPMailer/PHPMailer.php';
    require_once '../PHPMailer/SMTP.php';
    require_once '../PHPMailer/Exception.php';
    require_once '../PHPMailer/OAuthCredential.php';

    $mailSubject = 'Digital Kamety Password Recover';
    $newMsg = '
<html>
<head>
    <title>Digital Kamety Account Credentials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333333;
            background-color: #ffffff;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #e0e0e0;
            padding: 30px;
            background-color: #f9f9f9;
        }
        .highlight {
            color: #4b0082;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <p>Dear <span class="highlight">'.$name.'</span>,</p>

        <p>Welcome to <strong>Digital Kamety</strong>!</p>

              <p>We received a request to recover the login credentials for your Digital Kamety account. Below are your login details:</p>

        <p>
            <strong>Affiliate ID:</strong> <span class="highlight">'.$userId.'</span><br>
            <strong>Transaction Password:</strong> <span class="highlight">'.$trnPassword.'</span>
        </p>

         <p>We recommend changing your password after your next login to ensure account security.</p>

        <p>Best regards,<br>
        <strong>Digital Kamety Team</strong></p>

        <div class="footer">
            This is an automated email. Please do not reply to this message.
        </div>
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
    $mail->addAddress($email_id); // enter email address whom you want to send
    $mail->Subject = ("$mailSubject");
    $mail->Body = $newMsg;
    $mail->send();
    echo '../../';
} else {
    return false;
}
