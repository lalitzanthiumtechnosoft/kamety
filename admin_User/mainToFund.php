
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
   ?>

 <div class="main-box">
		<div class="BankDetails">
			<h4>Main Wallet To Fund Wallet</h4>
			<div class="box">
									<form class="theme-form" action="mainToFundProcess" method="post">
              <div class="mb-3">
                            <label>User ID -:</label>
                            <input type="text" name="sponser_id" id="sponser_id" class="form-control"
                              placeholder="e.g. xxxxxxxxxx" required value="<?php echo $userId; ?>" readonly>
                            <input type="hidden" name="loginMemberId" value="<?php echo $memberId; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Name -: </label>
                            <input type="text" id="sponser_name" class="form-control" placeholder="e.g. John Doe"
                              disabled="" value="<?php echo $userName; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Income Wallet -:</label>
                            <input type="text" class="form-control" value="<?php echo $incomeWallet; ?>" readonly>
                          </div>
                          <div class="mb-3">
                            <label>Purchase Wallet -:</label>
                            <input type="text" id="current_wallet" name="fundWallet" class="form-control" readonly
                              value="<?php echo $fundWallet; ?>">
                          </div>
                          <div class="mb-3">
                            <label>Amount To Transfer -:</label>
                            <input type="number" id="amount" name="amount" class="form-control"
                              placeholder="e.g. Transfer Amount" onkeypress="return onlynum(event)" required>
                          </div>
                          <!-- <div class="mb-3">
                            <label>Transaction Password *</label>
                            <input type="password" name="trnPassword" class="form-control"
                              placeholder="e.g. Transaction Password" required="">
                          </div> -->
                          <div class="">
                            <button class="btn btn-primary" data-bs-original-title="" title="Transfer"
                              name="fundTransfer" value="Transfer">Transfer</button>
                          </div>
            </form>
								</div>
                  

		</div>
      <div class="row m-0 mt-4 ">
  <div class="card crd0 w-100 shadow ">
    <div class="card-header">
      <h5>History</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover w-100" id="example">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>User ID</th>
              <th>Name</th>
              <th>Transfer Amount</th>
              <th>Transfer Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
               $count = 0;
   $queryTransfer = mysqli_query($con, "SELECT a.user_id, a.name, b.transferAmount, b.transferCharge, b.depositAmount, b.transferDate FROM sub_admin_user_details a, user_income_wallet_transfer b WHERE b.memberId = '$memberId' AND a.member_id = b.memberId ORDER BY b.transferDate DESC");
   while ($valTransfer = mysqli_fetch_assoc($queryTransfer)) {
       ++$count;
       ?>
              <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $valTransfer['user_id']; ?></td>
                <td><?php echo $valTransfer['name']; ?></td>
                <td><span class="badge bg-danger"><i class="fa fa-usd"></i> <?php echo $valTransfer['transferAmount']; ?></span></td>
                <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valTransfer['transferDate'])); ?></td>
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
