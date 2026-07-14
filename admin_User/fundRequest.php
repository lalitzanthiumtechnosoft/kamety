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
                <form class="theme-form" action="fundRequestBack" enctype="multipart/form-data" method="post">
                  <div class="mb-3">
                    <label>UserId </label>
                    <input type="text" name="user_id" class="form-control" placeholder="e.g. john12345" readonly
                      value="<?php echo $userId; ?>">
                    <input type="hidden" name="member_id" value="<?php echo $memberId; ?>">
                    <input type="hidden" name="name" value="<?php echo $userName; ?>">
                  </div>
                  <div class="mb-3">
                    <label>Fund Need ( In <i class="fa fa-usd"></i> ) *</label>
                    <input type="number" name="requestFund" class="form-control" placeholder="e.g. Fund Need" required
                      onkeypress="return onlynum(event)">
                  </div>
                  <div class="mb-3">
                    <label>Payment Mode *</label>
                    <select class="form-control" name="payment_id" required onchange="showAddressQR(this.value)">
                      <option value=""> Select One </option>
                      <?php $queryMode = mysqli_query($con, 'SELECT * FROM config_payment_details WHERE status=1 ORDER BY payment_id ASC');
while ($valMode = mysqli_fetch_assoc($queryMode)) { ?>
                        <option value="<?php echo $valMode['payment_id']; ?>"> <?php echo $valMode['paymentName']; ?> </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="transactionImage" class="form-label">Payment Slip *</label>
                    <input class="form-control" type="file" id="transactionImage" name="transactionImage" required
                      accept=".jpg,.jpeg,.png,.gif">
                  </div>

                  <div class="mb-3">
                    <label>Transaction Id *</label>
                    <textarea type="text" class="form-control" required placeholder="Transaction Hash"
                      name="paymentHash"></textarea>
                  </div>

                  <div class="">
                    <button class="btn btn-primary" data-bs-original-title="" title=""
                      name="fundRequest">Submit</button>
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
                          <th>User ID</th>
                          <th>Name</th>
                          <th>Requested Amount</th>
                          <th>Request Date</th>
                          <th>Payment Mode</th>
                          <th>Transaction ID</th>
                          <th>Transaction Slip</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
  $count = 0;
$queryRequest = mysqli_query($con, "SELECT a.* ,b.paymentName, name from user_fund_request a, config_payment_details b where a.member_id='$memberId' AND a.payment_id=b.payment_id order by date_time desc");
while ($valRequest = mysqli_fetch_array($queryRequest)) {
    ++$count;
    ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $valRequest['user_id']; ?></td>
                            <td><?php echo $valRequest['name']; ?></td>
                            <td><i class="fa fa-usd"></i> <?php echo $valRequest['requestFund']; ?></td>
                            <td><i class="fa fa-clock-o"></i> <?php echo $valRequest['date_time']; ?></td>
                            <td><?php echo $valRequest['paymentName']; ?></td>
                            <td><?php echo $valRequest['paymentHash']; ?></td>
                            <td><img src="<?php echo $valRequest['transactionImage']; ?>" height="150px" width="150px"></td>
                            <td>
                              <?php
        if ($valRequest['status'] == 1) {
            echo 'Approved';
        } elseif ($valRequest['status'] == 2) {
            echo 'Rejected';
        } elseif ($valRequest['status'] == 0) {
            echo 'Pending';
        }
    ?>
                            </td>
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