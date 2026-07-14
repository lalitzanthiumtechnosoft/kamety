<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
$todayDate = date('Y-m-d');

$queryUser = mysqli_query($con, 'SELECT count(1) AS totalUser FROM sub_admin_user_details where user_type=2');
$valUser = mysqli_fetch_array($queryUser);
$totalUser = $valUser['totalUser'];

$queryActiveMember = mysqli_query($con, 'SELECT COUNT(1) AS activeMember FROM sub_admin_user_details WHERE topup_flag=1 AND user_type=2');
$valActiveMember = mysqli_fetch_array($queryActiveMember);

$queryInActiveMember = mysqli_query($con, 'SELECT COUNT(1) AS inActiveMember FROM sub_admin_user_details WHERE topup_flag=0 AND user_type=2');
$valInActiveMember = mysqli_fetch_array($queryInActiveMember);

$queryOutstanding = mysqli_query($con, 'SELECT SUM(wallet),SUM(fundWallet) FROM sub_admin_user_details');
$valOutstanding = mysqli_fetch_array($queryOutstanding);
$workingWallet = $valOutstanding[0];
$fundWallet = $valOutstanding[1];

$queryBusiness = mysqli_query($con, 'SELECT SUM(Amount) FROM user_invest_history');
$valBusiness = mysqli_fetch_array($queryBusiness);
$totalBusiness = $valBusiness[0];

$queryTodayBusiness = mysqli_query($con, "SELECT sum(Amount) FROM user_invest_history WHERE CAST(dateTime AS date)='$todayDate'");
$valTodayBusiness = mysqli_fetch_array($queryTodayBusiness);
$todayBusiness = $valTodayBusiness[0];

$queryActiveIncome = mysqli_query($con, 'SELECT  COUNT(1) AS activeMember FROM sub_admin_user_details  WHERE topup_flag=1 AND user_type=2   ');
$valActiveIncome = mysqli_fetch_array($queryActiveIncome);
$totalActiveIncome = $valActiveIncome[0];

$queryPendingWithdraw = mysqli_query($con, 'SELECT sum(amount) FROM user_wallet_withdrawal_crypto WHERE released=0');
$valPendingWithdraw = mysqli_fetch_array($queryPendingWithdraw);
$totalPendingWithdraw = $valPendingWithdraw[0];

?>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-xs-12">
         <div class="form-group" align="center" style="font-size: 18px;font-weight: 600;color: #fff;">
            <label>Referral Link</label>
            <input id="referralCone" type="hidden" readonly
               value="https://test.futurevison.world/authUserRegister?affiliateCode=<?php echo $user_id; ?>">
            <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;"
               href="javascript:void(0)" onclick="copyLink('referralCone')" class="btn btn-sm btn-success waves-effect">
               <i class="fa fa-copy"></i>
               <span>Copy </span>
            </a>
            <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;"
               target="_blank"
               href="https://api.whatsapp.com/send?phone=&amp;text=https://test.futurevison.world/authUserRegister?affiliateCode=<?php echo $user_id; ?>"
               class="btn btn-sm btn-success waves-effect">
               <i class="fa fa-whatsapp"></i>
               <span>Whatsapp</span>
            </a>
            <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;"
               target="_blank"
               href="http://www.facebook.com/sharer/sharer.php?u=https://test.futurevison.world/authUserRegister?affiliateCode=<?php echo $user_id; ?>&amp;quote=text"
               class="btn btn-sm btn-primary waves-effect">
               <i class="fa fa-facebook-f"></i>
               <span>Facebook</span>
            </a>
            <a style="display: inline-block;margin-top: 1px;font-weight: bold;padding: 3px 8px;border-radius: 5px;"
               target="_blank"
               href="https://telegram.me/share/url?url=https://test.futurevison.world/authUserRegister?affiliateCode=<?php echo $user_id; ?>&text=text"
               class="btn btn-sm btn-primary waves-effect">
               <i class="fa fa-telegram"></i>
               <span>Telegram</span>
            </a>
         </div>
      </div>
      <div class="col-lg-12">
         <div class="row">
            <div class="col-md-6 col-lg-3">
               <a href="viewMember">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-primary rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-fill"></i></div>
                           <div class="text-right">
                              <h3 class="mb-0"><i class="fa fa-user"></i>
                                 <?php echo isset($totalUser) ? $totalUser : '0'; ?></h3>
                              <h6 class="">Total User</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="viewActiveMember">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"><i class="ri-user-fill"></i></div>
                           <div class="text-right">
                              <h3 class="mb-0"><i class="fa fa-user"></i>
                                 <?php echo isset($valActiveMember[0]) ? $valActiveMember[0] : '0'; ?></h3>
                              <h6 class="">Active User</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="viewInActiveMember">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-danger rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-user-fill"></i></div>
                           <div class="text-right">
                              <h3 class="mb-0"><i class="fa fa-user"></i>
                                 <?php echo isset($valInActiveMember[0]) ? $valInActiveMember[0] : '0'; ?></h3>
                              <h6 class="">In Active User</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>



            <div class="col-md-6 col-lg-3">
               <a href="investmentHistory">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($todayBusiness) ? $todayBusiness : '0.00'; ?></h3>
                              <h6 class="">Today Business</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="investmentHistory">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($totalBusiness) ? $totalBusiness : '0.00'; ?></h3>
                              <h6 class="">Total Business</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="walletWithdrawStatus">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($totalWithdraw) ? $totalWithdraw : '0.00'; ?></h3>
                              <h6 class="">Total Withdraw</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="walletWithdrawStatus">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($totalPendingWithdraw) ? $totalPendingWithdraw : '0.00'; ?></h3>
                              <h6 class="">Pending Withdrawal</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-md-6 col-lg-3">
               <a href="walletOutstanding">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-success rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-success"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($workingWallet) ? $workingWallet : '0.00'; ?></h3>
                              <h6 class="">Income Wallet Outstanding</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>

            <div class="col-md-6 col-lg-3">
               <a href="walletOutstanding">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-body iq-bg-warning rounded">
                        <div class="d-flex align-items-center justify-content-between">
                           <div class="rounded-circle iq-card-icon bg-warning"></div>
                           <div class="text-right">
                              <h3 class="mb-0" style="font-size:14px;">
                                 <?php echo isset($fundWallet) ? $fundWallet : '0.00'; ?></h3>
                              <h6 class="">Purchase Wallet</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include 'include/footer.php'; ?>
<script>
   function copyLink(referralId) {
      var link = $("#" + referralId).val();
      var tempInput = document.createElement("input");
      tempInput.style = "position: absolute; left: -1000px; top: -1000px";
      tempInput.value = link;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      alert('Referral Link Copied Successfully');
   }
   var d = document.getElementById("dashboard");
   d.className += " active";
</script>
</body>

</html>