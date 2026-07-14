<?php
include("../../conection.php");
date_default_timezone_set('Asia/Kolkata');
$d=date("Y-m-d H:i:s");
$game_id=$_POST['gameId'];
$bet_number=$_POST['betNumber'];

$query="INSERT INTO game_user_number_manual_result (`gameId`,`betNumber`,`date_time`) VALUES ('$game_id','$bet_number','$d')";
print_r($query);
$result=mysqli_query($con,$query);
if($result){
	echo "true";
}
?>