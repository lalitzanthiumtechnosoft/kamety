   <?php require_once 'include/head.php'; ?>

<body>
  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
require_once 'include/header.php';
require_once 'include/menu.php';
?>
    <div id="content">
      <?php
  require_once 'include/nav.php';

unset($_SESSION['withdrawTokenSet']);
$randToken = rand(1111, 9999).time().date('s');
$newToken = md5($randToken);
$_SESSION['withdrawTokenSet'] = $newToken;

?>

      <div class="main-box">
        <div class="BankDetails">
          <h4>Withdraw </h4>
          <div class="card-body">
            <form class="theme-form" action="walletWithdrawProcess" method="post">
              <div class="mb-3">
                <label>UserId </label>
                <input type="text" name="user_id" class="form-control" placeholder="e.g. john12345" readonly
                  value="<?php echo $userId; ?>">
                <input type="hidden" name="memberId" value="<?php echo $memberId; ?>">
                <input type="hidden" name="goodFile" value="<?php echo $newToken; ?>">

              </div>
              <div class="mb-3">
                <label>Name </label>
                <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" readonly
                  value="<?php echo $userName; ?>">
              </div>
              <div class="mb-3">
                <label> Income Wallet </label>
                <input type="text" class="form-control" value="<?php echo $incomeWallet; ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="inputAddress">Select Wallet In *</label>
                <select class="form-control" name="paymentId" required id="paymentId">
                  <option value="">Select Withdrawl In</option>
                  <?php $queryWallet = mysqli_query($con, "SELECT a.payment_id,a.walletAddress,b.currencyName FROM user_wallet_address_details a, config_currency_list b WHERE a.member_id='$memberId' AND a.currency_id=b.currency_id AND a.status=1 ORDER BY a.addDate DESC");
while ($valWallet = mysqli_fetch_assoc($queryWallet)) { ?>
                    <option value="<?php echo $valWallet['payment_id']; ?>"> <?php echo $valWallet['currencyName']; ?> [
                      <?php echo $valWallet['walletAddress']; ?> ]
                    </option> <?php } ?>
                </select>
              </div>

              <div class="mb-3">
                <label>Withdraw Amount *</label>
                <input type="text" id="withdrawAmount" name="withdrawAmount" class="form-control" placeholder="Enter Withdraw Amount"
                  required="">
              </div>

              <div class="mb-3">
                <label>Transaction Password *</label>
                <input type="password" name="trnPassword" class="form-control" placeholder="e.g. Transaction Password"
                  required="">
              </div>
              <div class="form-group col-md-12 col-sm-12" style="padding-right:0px; padding-left:0px;">
              <label>Email Verification*</label>
              <div class="input-group">
                <input type="text" id="emailOtp" name="emailOtp" required class="form-control"
                  placeholder="Enter OTP" />

                <!-- Send OTP Button -->
                <button type="button" class="btn btn-success" id="emailBtn" style="padding:1px 6px;"
                  onclick="CryptoSendEmailOTP('<?php echo $userId; ?>')">Send OTP</button>

                <!-- Timer Span (Initially hidden) -->
                <span id="count"
                  style="visibility: hidden; padding: 6px 6px; background: #28a745; color: #fff; border-radius: 4px; margin-left: 5px;"></span>
              </div>
            </div>
              <div class="">
                <button class="btn btn-primary" data-bs-original-title="" title="Withdraw" name="walletWithdraw"
                  value="withdraw">Withdraw</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="card crd0 w-100">
            <div class="card-header">
              <h5>Withdraw Report</h5>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive w-100">
                <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>UserId</th>
                      <th>Withdraw</th>
                      <th>Charge</th>
                      <th>Net Amount</th>
                      <th>OrderId</th>
                      <th>Currency</th>
                      <th>Wallet Address</th>
                      <th>Date</th>
                      <th>Withdraw Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
  $count = 0;
$queryWithdraw = mysqli_query($con, "SELECT a.*,b.name,b.user_id,c.walletAddress,d.currencyName FROM user_wallet_withdrawal_crypto a, sub_admin_user_details b, user_wallet_address_details c,config_currency_list d WHERE a.member_id='$memberId' AND a.member_id=b.member_id AND a.paymentId=c.payment_id AND c.currency_id=d.currency_id ORDER BY a.date_time DESC");
while ($valWithdraw = mysqli_fetch_assoc($queryWithdraw)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valWithdraw['user_id']; ?></td>
                        <td><span class="badge badge-success"><i class="fa fa-usd"></i>
                            <?php echo $valWithdraw['amount']; ?></span></td>
                        <td><span class="badge badge-success"><i class="fa fa-usd"></i>
                            <?php echo $valWithdraw['withdrawCharge']; ?></span></td>
                        <td><span class="badge badge-danger"><i class="fa fa-usd"></i>
                            <?php echo $valWithdraw['netAmount']; ?></span></td>
                        <td><?php echo $valWithdraw['orderid']; ?></td>
                        <td><?php echo $valWithdraw['currencyName']; ?></td>
                        <td><?php echo $valWithdraw['walletAddress']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valWithdraw['date_time'])); ?>
                        </td>
                        <td>
                          <?php if ($valWithdraw['released'] == 0) {
                              echo "<span class='badge badge-primary'>PROCESSING</span>";
                          } elseif ($valWithdraw['released'] == 1) {
                              echo "<span class='badge badge-success'> OFF-LINE RELEASED</span>";
                          } elseif ($valWithdraw['released'] == 3) {
                              echo "<span class='badge badge-danger'>REJECTED</span>";
                          } elseif ($valWithdraw['released'] == 2) {
                              echo "<span class='badge badge-danger'>PENDING</span>";
                          } elseif ($valWithdraw['released'] == 4) {
                              if ($valWithdraw['status'] == 'WAITING') {
                                  echo "<span class='badge badge-warning'>WAITING</span>";
                              } else {
                                  echo "<span class='badge badge-success'> ONLINE-RELEASED</span>";
                              }
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

  <?php
  require_once 'include/footer.php'; ?>

</body>
</html>