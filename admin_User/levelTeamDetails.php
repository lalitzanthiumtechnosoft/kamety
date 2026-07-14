<?php require_once 'include/head.php'; ?>

<body class="body-scroll" data-page="index">



  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
    require_once 'include/menu.php';
    require_once 'include/header.php';
    ?>
    <div id="content">
      <?php
      require_once 'include/nav.php'; ?>

      <!-- Header -->

      <!--#INCLUDE file="header.asp"-->
      <main class="h-100 ">
        <div class="content-wrapper">
          <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
              <div class="card-header">

                <h4 class="card-title text-dark" style="margin-left: 20px;">Level <?php echo $_GET['LevelID']; ?> View
                </h4>

                <div class="row" style="margin-left: 20px; ">
                  <div class="card crd0" style="background:transparent !important; border:1px solid black !important;">
                    <div class="card-body">
                      <div class="dt-ext table-responsive">
                        <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>UserId</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Join Date</th>
                              <th>Account Status</th>
                              <th>Active Date</th>
                              <th>Total Invest</th>
                              <th>Total Withdrawal</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            function totalWithdrawl($con, $memberId)
                            {
                              $queryWithdrawl = mysqli_query($con, "SELECT SUM(amount) FROM user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND released=1");
                              $valWithdrawl = mysqli_fetch_array($queryWithdrawl);
                              if ($valWithdrawl[0] != '') {
                                return $valWithdrawl[0];
                              } else {
                                echo '0.00';
                              }
                            }
                            function totalInvest($con, $memberId)
                            {
                              $queryInvest = mysqli_query($con, "SELECT SUM(Amount) FROM user_invest_history WHERE memberId='$memberId'");
                              $valInvest = mysqli_fetch_array($queryInvest);
                              if ($valInvest[0] != '') {
                                return $valInvest[0];
                              } else {
                                echo '0.00';
                              }
                            }
                            $count = 0;
                            $queryTeam = mysqli_query($con, "SELECT a.member_id,a.user_id,a.name,a.date_time,a.activation_date,a.topup_flag,a.phone FROM sub_admin_user_details a, 	user_matrix_team b WHERE a.member_id=b.childId AND b.memberId='$memberId' AND b.level='$_GET[LevelID]' ORDER BY b.dateTime DESC");
                            while ($valTeam = mysqli_fetch_assoc($queryTeam)) {
                              ++$count; ?>
                              <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $valTeam['user_id']; ?></td>
                                <td><?php echo $valTeam['name']; ?></td>
                                <td><?php echo $valTeam['phone']; ?></td>
                                <td><i class="fa fa-clock-o"></i>
                                  <?php echo date('d-m-Y H:i:s', strtotime($valTeam['dateTime'])); ?></td>
                                <td><?php if ($valTeam['topup_flag'] == 1) {
                                  echo "<span class='badge badge-success'>Active</span>";
                                } else {
                                  echo "<span class='badge badge-danger'>In-Active</span>";
                                } ?></td>
                                <td><?php echo $valTeam['activation_date']; ?></td>
                                <td><span class="badge badge-success">$
                                    <?php echo totalInvest($con, $valTeam['member_id']); ?></span></td>
                                <td>$ <?php echo totalWithdrawl($con, $valTeam['member_id']); ?></td>

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
        <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
  </div>

  <?php require_once 'include/footer.php'; ?>

</body>


</html>