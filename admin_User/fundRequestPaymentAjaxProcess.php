<?php
require_once 'loginCheck.php';
if(!empty($_POST["orderId"])){    
    $orderId=$_POST["orderId"];
   	$queryStatus =mysqli_query($con,"SELECT paymentStatus,payAddress FROM user_invest_purchase_details WHERE orderId='$orderId'");
	if($valStatus=mysqli_fetch_array($queryStatus)){
	 	$jsonArray['status']= $valStatus['paymentStatus'];
        $jsonArray['address']= $valStatus['payAddress'];
        echo json_encode($jsonArray);
	}
} ?>