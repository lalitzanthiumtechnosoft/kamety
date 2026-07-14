<?php include '../../conection.php';

$payment_id = $_POST['paymentId'];

$queryDetails = mysqli_query($con, "SELECT * FROM config_payment_details WHERE payment_id='$payment_id'");
$valDetails = mysqli_fetch_assoc($queryDetails); ?>
  <div class="card card-default">
    <div class="card-header"> <?php echo $valDetails['paymentName']; ?> </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <?php echo $valDetails['paymentAddress']; ?>
        </div>
        <div class="col-md-6">
          <?php if ($valDetails['paymentImage'] != '') { ?><img src="../<?php echo $valDetails['paymentImage']; ?>" class="img-responsive" width="200%" height="100%"><?php } ?>
        </div>
      </div>
    </div>
  </div>