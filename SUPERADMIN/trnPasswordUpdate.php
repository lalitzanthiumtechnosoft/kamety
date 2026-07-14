<?php
include 'login-check.php';
require '../PHPMailer/EncrptyModel.php';
use PHPMailer\PHPMailer\PHPMailer;

$userId = $_GET['user_id'];
$queryMail = mysqli_query($con, "SELECT member_id,name,email_id FROM sub_admin_user_details WHERE user_id='$userId' AND user_type=2 AND account_status=1");
if ($valMail = mysqli_fetch_array($queryMail)) {
    $member_id = $valMail['member_id'];
    $emailId = $valMail['email_id'];
    $name = $valMail['name'];
    function trnPassword($length = 6)
    {
        $chars = '0123456789';
        $password = substr(str_shuffle($chars), 0, $length);

        return $password;
    }
    $trnPassword = trnPassword(6);
    $passObj = new passEncrypt();
    $encTrnPass = $passObj->twoPassEncrypt($trnPassword);
    $queryupdate = mysqli_query($con, "UPDATE sub_admin_user_details SET trnPassword='$encTrnPass' WHERE member_id='$member_id'");

    require_once '../PHPMailer/PHPMailer.php';
    require_once '../PHPMailer/SMTP.php';
    require_once '../PHPMailer/Exception.php';
    require_once '../PHPMailer/OAuthCredential.php';
    $mailSubject = 'Digital Kamety Account Details';
    $mailSubject = 'Digital Kamety Password Recover';
    $newMsg = '<html>
                    <head>
                        <title>Digital Kamety  Password Recover</title>
                        <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
                    </head>
                    <body><span style="background-color:#ffffff; color:#222222; font-family:arial,helvetica,sans-serif; font-size:small">Dear ,&nbsp;</span><span style="color:#ff0000"><span style="font-family:comic sans ms,cursive"><span style="font-size:small"><strong>'.$name.'</strong></span></span></span><span style="background-color:#ffffff; color:#222222; font-family:arial,helvetica,sans-serif; font-size:small">,&nbsp;<br />
                    <br />
                    <span style="background-color:#ffffff; color:#222222; font-family:arial,helvetica,sans-serif; font-size:small"><em><strong><span style="font-size:14px">Digital Kamety </span></strong></em> has registered a account on your name. Below are its access details<br /><br />
                    <strong>AffiliateId -: </strong>  <strong>'.$userId.'</strong></span><br />
                    <span style="color:#FF8C00"><span style="background-color:rgb(255, 255, 255); font-family:arial,helvetica,sans-serif; font-size:small"><strong> Trn Password -: </strong></span></span><span style="background-color:rgb(255, 255, 255); color:rgb(34, 34, 34); font-family:arial,helvetica,sans-serif; font-size:small">  <em>'.$trnPassword.'</em></span><br />
                    <span style="font-family:georgia,serif"><span style="background-color:rgb(255, 255, 255); font-size:small"><strong>Digital Kamety TEAM</strong></span></span><span style="background-color:rgb(255, 255, 255); color:rgb(34, 34, 34); font-family:arial,helvetica,sans-serif; font-size:small">.</span></body></html>';
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
    $mail->send(); ?>
        <script>
            alert('EMAIL SEND Successfully');
            window.top.location.href="viewMemberDetails?user_id=<?php echo $userId; ?>";
        </script>
        <?php
    exit;
} else { ?>
        <script>
            alert('Email not Send ..Try Again');
            window.top.location.href="viewMemberDetails?user_id=<?php echo $userId; ?>";
        </script>
        <?php
    exit;
}  ?>