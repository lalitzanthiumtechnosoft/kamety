<?php
include 'loginCheck.php';

use PHPMailer\PHPMailer\PHPMailer;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if (isset($_POST['addMember'])) {
    $summary_id = $_POST['summary_id'];
    $name = $_POST['name'];
    $emailId = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $loginPassword = $_POST['password'];
    $d = date('Y-m-d H:i:s');
    $todayDate = date('Y-m-d');

    $queryAccess = mysqli_query($con, "SELECT member_id FROM sub_admin_user_details WHERE user_id='$_SESSION[member_user_id]'");
    if ($valAccess = mysqli_fetch_array($queryAccess)) {
        $sponser_member_id = $valAccess['member_id'];
    }

    $querySubject = mysqli_query($con, "SELECT userNeed FROM user_month_set_details WHERE status=1 AND member_id='$sponser_member_id' AND summary_id ='$summary_id' ");
    $valsubject = mysqli_fetch_assoc($querySubject);
    $userNeed = $valsubject['userNeed'];

    // // Check if email has already been used 3 times
    $emailCheck = mysqli_query($con, "SELECT COUNT(*) as count FROM sub_admin_user_details WHERE sponser_id='$sponser_member_id' AND summary_id='$summary_id'");
    $emailData = mysqli_fetch_assoc($emailCheck);
    if ($emailData['count'] >= $userNeed) {
        ?>

<script>
alert("You only add <?php echo $userNeed; ?>  members");
history.go(-1);
</script>
<?php
           exit;
    }

    $queryInsert = mysqli_query($con, "INSERT INTO sub_admin_user_details (name,email_id,phone,password,sponser_id,date_time,countryId,summary_id) VALUES
   ('$name','$emailId','$phone','$loginPassword','$sponser_member_id','$d','$countryId','$summary_id')");
    $used_member_id = $con->insert_id;
    $newMember = base64_encode($used_member_id);
    $newMd = md5($used_member_id);
    $newSha = sha1($used_member_id);

    $_SESSION['newDevineToken'] = $used_member_id;
    $_SESSION['newAdvineToken'] = $newSha;
    $_SESSION['ngDefine'] = $newMd;
    $_SESSION['newLogPass'] = $loginPassword;

    function userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $summary_id)
    {
        require_once '../PHPMailer/PHPMailer.php';
        require_once '../PHPMailer/SMTP.php';
        require_once '../PHPMailer/Exception.php';
        require_once '../PHPMailer/OAuthCredential.php';
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
                                    <li><strong>Transaction Password:</strong> <span style="color:#FF8C00;">'.htmlspecialchars($summary_id).'</span></li>
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
            userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $summary_id);
        }
    }
    userIdSet($con, $used_member_id, $name, $loginPassword, $d, $emailId, $summary_id);
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
    ?>
<script>
alert('Member Add Successfully');
history.go(-1);
</script>
<?php } ?>
<?php include '../close-connection.php'; ?>