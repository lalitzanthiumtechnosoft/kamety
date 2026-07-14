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
        <div class="content-wrapper">
          <div class="container-full">
            <!-- Content Header (Page header) -->


            <!-- Main content -->
            <section class="content">
              <div class="card-header">
                <h5 style='color:#000'>My Refferal</h5>
              </div>
              <div class="row" style="display:unset">
                <div class="card crd0">
                  <div class="card-body mb-4 w-p100">
                    <div class="table-responsive" style="width: 100%; ">
                      <table class="table table-bordered table-hover" style="width: 100%;" id="example">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>UserId</th>
                            <th>Name</th>
                            <th>EmailId</th>
                            <th>Phone</th>
                            <th>Register Date</th>
                            <th>Active Status</th>
                            <th>Active Date</th>
                            <th>Total Invest</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
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
                          $queryDirect = mysqli_query($con, "SELECT member_id,user_id,name,email_id,phone,date_time,topup_flag,activation_date FROM sub_admin_user_details WHERE sponser_id='$memberId' ORDER BY date_time DESC");
                          while ($valDirect = mysqli_fetch_assoc($queryDirect)) {
                            ++$count; ?>
                            <tr>
                              <td>
                                <?php echo $count; ?>
                              </td>
                              <td>
                                <?php echo $valDirect['user_id']; ?>
                              </td>
                              <td>
                                <?php echo $valDirect['name']; ?>
                              </td>
                              <td>
                                <?php echo $valDirect['email_id']; ?>
                              </td>
                              <td>
                                <?php echo $valDirect['phone']; ?>
                              </td>
                              <td><i class="fa fa-clock-o"></i>
                                <?php echo date('d-m-Y H:i:s', strtotime($valDirect['date_time'])); ?>
                              </td>
                              <td>
                                <?php if ($valDirect['topup_flag'] == 1) {
                                  echo "<span class='badge badge-success'>Active</span>";
                                } else {
                                  echo "<span class='badge badge-danger'>In-Active</span>";
                                } ?>
                              </td>
                              <td>
                                <?php echo $valDirect['activation_date']; ?>
                              </td>
                              <td><span class="badge badge-success">
                                  <?php echo totalInvest($con, $valDirect['member_id']); ?> $
                                </span></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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

    </div>
  </div>

  <?php
  require_once 'include/footer.php'; ?>

  </script>
</body>

</html>