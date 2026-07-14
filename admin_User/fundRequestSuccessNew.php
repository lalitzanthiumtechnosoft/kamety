 <?php require_once 'include/head.php'; ?>
<body>
  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
    require_once 'include/menu.php';
    require_once 'include/header.php';
    ?>
    <?php
  $orderId=$_GET['orderId'];
  $queryTrn=mysqli_query($con,"SELECT priceAmount,priceCurrency,payAmount,payCurrency,amountReceived,paymentId,paymentStatus,payAddress,createdTime,updateTime,purchaseId FROM user_invest_purchase_details WHERE memberId='$memberId' AND orderId='$orderId'");
  $valTrn=mysqli_fetch_assoc($queryTrn);
  $priceAmount=$valTrn['priceAmount'];
  $priceCurrency=$valTrn['priceCurrency'];
  $payAmount=$valTrn['payAmount'];
  $payCurrency=$valTrn['payCurrency'];
  $amountReceived=$valTrn['amountReceived'];
  $paymentId=$valTrn['paymentId'];
  $paymentStatus=$valTrn['paymentStatus'];
  $payAddress=$valTrn['payAddress'];
  $createdTime=$valTrn['createdTime'];
  $updateTime=$valTrn['updateTime'];
  $purchaseId=$valTrn['purchaseId']; 
  
  ?>
    <div id="content">
      <?php
      require_once 'include/nav.php';
      ?>
      <div class="main-box">
        <div class="BankDetails">
          <h4>Add Funds </h4>
          <div class="box">
            
    <div class="row">
      <div class="col-xl-6 col-lg-12">
        <div class="box">
          <div class="box-header"><span class="badge badge-success"style="font-size:14px!important;">Request Id -: <?=$orderId?></span></div>
          <div class="box-body">
            <div class="col-xl-12 col-lglg-4 col-md-12 col-sm-4 col-12">
              <label class="control-label" style="font-size:14px;">To pay, send exact amount of USDT BEP20 to the given address</label>
              <label class="control-label" style="font-size:14px;">Amount : <strong><?= $priceAmount?></strong> USDT BEP20</label>
              <br>
              <div class="box-header">Status-: <span class="badge badge-success"style="font-size:14px!important;"><?=$paymentStatus?></span></div>
              
                <!--<label class="control-label" style="font-size:14px;"> : <strong><?= $paymentStatus?></strong></label>-->
              <p><label style="font-size:16px;" style="font-size:14px;">Payment Address -: <span class='badge badge-primary' style="font-weight: 600;" id="qrstatus" style="font-size:14px;"></span></label></p>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group">
                      <input type="text" class="form-control pull-right" id="payAddress" value="<?=$payAddress?>"  readonly style="display: inline-block;" >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <a onclick="copyPayAddress()" style="display: inline-block;" href="javascript:;" class="btn btn-success btn-sm" ><i class="zoom fa fa-copy " style="color:white;"></i> Copy</a>
                    </div>
                  </div>
                </div>
              <br>
              <label class="control-label">QR Code</label>
             
                 <!--<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$payAddress?>&choe=UTF-8" /><br/>-->
      <center><img src="https://quickchart.io/qr?text=<?=$payAddress?>&choe=UTF-8" /></center><br/>
            </div>
            <p><label class="control-label" style="font-size:14px;">1. Fund will be deposited after Network confirmations.</label></p>
            <p><label class="control-label" style="font-size:14px;">2. Wait for sometime to receive fund. If not received contact at <br><a href="support@FUTURE_VISION.com" target="_blank">support@FUTURE_VISION.com</a></label></p>
          </div>
      </div>
      </div>
    </div>
   
          </div>

           </div>
         </div>
    </div>
  </div>

  <?php
  require_once 'include/footer.php'; ?>
  <script>
jQuery(document).ready(function(){
  setInterval(function(){
    var orderId ="<?=$orderId; ?>";
    $.ajax({
      type: "POST",
      url: 'fundRequestPaymentAjaxProcess.php',
      data: { orderId : orderId },
      cache: false,
        success: function(data){
        // alert(data);
        var resData=jQuery.parseJSON(data);
        if(resData.status=="finished"){
            var url = "fundRequestSuccessNew?orderId=<?= $orderId?>";
            window.location.href=url;
        }
        if(resData.status=="confirming"){
          jQuery('#qrstatus').text("(Payment Partially Confirmed)")
        }
        if(resData.status=="canceled"){
          jQuery('#qrstatus').text("(Payment Expired)")
        }                         
        if(resData.status=="refunded"){
          jQuery('#qrstatus').text("(Payment Refunded)")
        }                         
        if(resData.status=="failed"){
          jQuery('#qrstatus').text("(Payment Failed)")
        }
        if(resData.status=="partially_paid"){
          jQuery('#qrstatus').text("(Payment Partially Paid)")
        }
        if(resData.status=="sending"){
          jQuery('#qrstatus').text("(Payment Sending)")
        }                       
        if(resData.status=="confirmed"){
          jQuery('#qrstatus').text("(Payment Confirmed)")
        }
        if(resData.status=="waiting"){
          jQuery('#qrstatus').text("(Payment Waiting)")
        }
        var current_addr="<?= $payAddress?>";
        if(current_addr !=resData.address){
          location.reload();
        }
      }
    });
  }, 10000);
});
function copyPayAddress(){
  var copyText = document.getElementById("payAddress");
  copyText.select();
  document.execCommand("Copy");
  alert("Pay Address Copied Successfully!!!");
}
var d = document.getElementById("Fund");
  d.className += " active";
var d = document.getElementById("fundRequest");
  d.className += " active";
</script>
</body>
</html>