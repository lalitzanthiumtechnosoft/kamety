<?php 
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
include("login-check.php"); 

if(isset($_POST['add_remark'])){
$d=date('Y-m-d H:i:s'); 
$id=$_POST['id'];

$member_id=$_POST['member_id'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$remarks=$_POST['remarks'];

if($status==1){
    $result1=mysqli_query($con,"UPDATE user_wallet_withdrawal set remarks='$remarks',release_date='$d',status='$status' where id='$id'");
}
else{
    $result1=mysqli_query($con,"UPDATE user_wallet_withdrawal set remarks='$remarks' where id='$id'");
}

if($result1) { ?>
 <script>
    alert("Remarks Add successfully!!!");
    window.top.location.href='wallet-withdraw-status?user_id=<?= $user_id;?>&from_date=<?= $from_date;?>&to_date=<?= $to_date; ?>';
 </script>
 <?php }

} 



if(isset($_POST['edit_remark'])){
$d=date('Y-m-d H:i:s'); 
$id=$_POST['id'];
$member_id=$_POST['member_id'];
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$remarks=$_POST['remarks'];

if($status==1){
    $result1=mysqli_query($con,"UPDATE user_wallet_withdrawal set remarks='$remarks',release_date='$d',status='$status' where id='$id'");
}
else{

     $result1=mysqli_query($con,"UPDATE user_wallet_withdrawal set remarks='$remarks',status='$status' where id='$id'");
}
if($result1) { ?>
 <script>
    alert("Remarks Edit successfully!!!");
    window.top.location.href='wallet-withdraw-status?user_id=<?= $user_id;?>&from_date=<?= $from_date;?>&to_date=<?= $to_date; ?>';
 </script>
 <?php }   
    } 
?>
<?php include("../close-connection.php"); ?>