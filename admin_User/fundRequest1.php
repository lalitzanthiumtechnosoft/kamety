   <?php require_once 'include/head.php'; ?>
<body>
  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
require_once 'include/menu.php';
require_once 'include/header.php';
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
              <div class="col-sm-4">
                <div class="boosting_box boosting_box_bg_light">
                  <div class="row">
                    <div class="col-sm-6">
                      <!--img src="assets/images/usdt.png" class="img_icon" /-->
                      <i class="fa fa-dollar-sign img_icon"></i>
                    </div>
                    <div class="col-sm-6">
                      <p class="text-right"></p>
                    </div>
                  </div>
                  <p>&nbsp;</p>
                  <h4 class="text-center">$<?php echo isset($fundWallet) ? $fundWallet : '0.00'; ?></h4>
                  <p>Available Balance</p>
                </div>
              </div>
              <div class="col-sm-1"></div>
              <div class="col-sm-6">
                <form class="theme-form" action="fundRequestProcess" enctype="multipart/form-data" method="post">
                  <div class="mb-3">
                    <label>UserId </label>
                    <input type="text" name="user_id" class="form-control" placeholder="e.g. john12345" readonly
                      value="<?php echo $userId; ?>">
                    <input type="hidden" name="member_id" value="<?php echo $memberId; ?>">
                    <input type="hidden" name="name" value="<?php echo $userName; ?>">
                  </div>
                  <div class="mb-3">
                    <label>Fund Need ( In <i class="fa fa-usd"></i> ) *</label>
                     <input type="number" name="requestFund" class="form-control" placeholder="e.g. Fund Need" required onkeypress="return onlynum(event)">
                  </div>
                  <div class="mb-3">
                    <label>Payment Mode *</label>
                      <select class="form-control" name="currencyId" id="currencyId" required>
                        <option value=""> Select One </option>
                        <?php $queryMode = mysqli_query($con, 'SELECT * FROM config_currency_list WHERE status=1 ORDER BY currency_id ASC');
while ($valMode = mysqli_fetch_assoc($queryMode)) { ?>
                          <option value="<?php echo $valMode['currency_id']; ?>"> <?php echo $valMode['currencyName']; ?> </option>
                        <?php } ?>
                      </select>
                   </div>

                  <!--<div class="mb-3">-->
                  <!--  <label for="transactionImage" class="form-label">Payment Slip *</label>-->
                  <!--  <input class="form-control" type="file" id="transactionImage" name="transactionImage" required-->
                  <!--    accept=".jpg,.jpeg,.png,.gif">-->
                  <!--</div>-->

                  <!--<div class="mb-3">-->
                  <!--  <label>Transaction Id *</label>-->
                  <!--  <textarea type="text" class="form-control" required placeholder="Transaction Hash"-->
                  <!--    name="paymentHash"></textarea>-->
                  <!--</div>-->

                  <div class="">
                    <button class="btn btn-primary" data-bs-original-title="" title=""name="fundRequest">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6" id="paymentDetails" style="display: none;"></div>
        </div>
        <br>
        <div class="row m-0 " style="width: 100%;">
          <div class="card crd0 w-100">
            <div class="card-header">
              <h6>Fund Request History</h6>
            </div>
            <div class="table-panel">
              <div class="row m-0">
                <div class="col-lg-12 ">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-custom table-hover">
                      <thead>
                        <tr>
                        <th>#</th>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>Add Amount</th>
                        <th>OrderId</th>
                        <th>Address</th>
                        <th>Pay Currency</th>
                        <th>Pay Amount</th>
                        <th>Pay Status</th>
                        <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
              $count = 0;
$queryFund = mysqli_query($con, "SELECT a.tempId,a.packagePrice,a.addDate,a.orderId,a.priceAmount,a.payAmount,a.payCurrency,a.payAddress,a.paymentStatus,b.user_id,b.name FROM user_invest_purchase_details a, sub_admin_user_details b WHERE (a.memberId='$memberId' OR a.loginMemberId='$memberId') AND a.memberId=b.member_id AND a.actionType=2 ORDER BY a.addDate DESC");
while ($valFund = mysqli_fetch_assoc($queryFund)) {
    $paymentStatus = $valFund['paymentStatus'];
    ++$count; ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $valFund['user_id']; ?></td>
                  <td><?php echo $valFund['name']; ?></td>
                  <td><span class="badge badge-success">$ <?php echo $valFund['packagePrice']; ?></span></td>
                  <td><?php echo $valFund['orderId']; ?></td>
                  <td><?php echo $valFund['payAddress']; ?></td>
                  <td><?php echo $valFund['payCurrency']; ?></td>
                  <td><?php echo $valFund['payAmount']; ?> <?php echo $valFund['payCurrency']; ?></td>
                  <td><?php if ($paymentStatus == 'finished') {
                      echo "<span class='badge badge-success'>FINISHED</span>";
                  } elseif ($paymentStatus == 'confirming') {
                      echo "<span class='badge badge-primary'>CONFIRMING</span>";
                  } elseif ($paymentStatus == 'refunded') {
                      echo "<span class='badge badge-danger'>REFUNDED</span>";
                  } elseif ($paymentStatus == 'failed') {
                      echo "<span class='badge badge-danger'>FAILED</span>";
                  } elseif ($paymentStatus == 'partially_paid') {
                      echo "<span class='badge badge-warning'>PARTIAL PAID</span>";
                  } elseif ($paymentStatus == 'sending') {
                      echo "<span class='badge badge-warning'>SENDING</span>";
                  } elseif ($paymentStatus == 'confirmed') {
                      echo "<span class='badge badge-success'>CONFIRMED</span>";
                  } elseif ($paymentStatus == 'waiting') {
                      echo "<span class='badge badge-primary'>WAITING</span>";
                  } elseif ($paymentStatus == 'expired') {
                      echo "<span class='badge badge-danger'>EXPIRED</span>";
                  } elseif ($paymentStatus == 'canceled') {
                      echo "<span class='badge badge-danger'>CANCELED</span>";
                  } ?></td>
                  <td><a href="fundRequestSuccessNew?orderId=<?php echo $valFund['orderId']; ?>"><span class='badge badge-primary'>More</span></a>&nbsp;<?php if ($paymentStatus == 'waiting') { ?><a href="javascript:void(0);" onclick="cancelFundRequest('<?php echo $valFund['orderId']; ?>','<?php echo $valFund['tempId']; ?>')" class='badge badge-danger'>Cancel</a><?php } ?></td>
                </tr>
              <?php } ?>
                      </tbody>
                    </table>
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
    function showAddressQR(paymentId) {
      var showDiv = document.getElementById("paymentDetails");
      if (paymentId != "") {
        $.ajax({
          type: "POST",
          url: 'ajaxCalls/fetchPaymentDetailsAjax',
          data: {
            paymentId: paymentId
          },
          cache: false,
          success: function (data) {
            showDiv.style.display = "block";
            if (data) {
              $('#paymentDetails').html(data);
            }
          }
        });
      } else {
        showDiv.style.display = "none";
      }
    }

    function cancelFundRequest(orderId, tempId) {
      if (tempId != "") {
        if (confirm('Are you sure to Cancel this Add Fund Request?')) {
          $.ajax({
            type: "POST",
            url: 'ajaxCalls/cancelFundRequestAjax',
            data: {
              tempId: tempId,
              orderId: orderId
            },
            cache: false,
            success: function (data) {
              // alert(data);
              if (data) {
                alert('Add Fund Request Cancel Successfully');
                location.reload();
              }
            }
          });
        }
      }
    }
  </script>
</body>
</html>