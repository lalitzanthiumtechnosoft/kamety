<?php require_once 'include/head.php'; ?>

<body>
  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
    require_once 'include/header.php';
    require_once 'include/menu.php'; ?>
    <div id="content">
      <?php
      require_once 'include/nav.php'; ?>

      <section class="content">
        <div class="row">
          <div class="col-12">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Activation History </h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="example" width="100%">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Package Amount</th>
                        <th>Purchase Date</th>
                        <th>Purchase By</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 0;
                      $queryActive = mysqli_query($con, "SELECT a.Amount,a.dateTime,b.user_id,b.name,c.user_id AS activerId,c.name AS activerName from user_invest_history a, sub_admin_user_details b, sub_admin_user_details c WHERE (a.loginMemberId='$memberId' OR a.memberId='$memberId') AND a.memberId=b.member_id AND a.loginMemberId=c.member_id ORDER BY a.dateTime DESC");
                      while ($valActive = mysqli_fetch_assoc($queryActive)) {
                        ++$count; ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $valActive['user_id']; ?></td>
                          <td><?php echo $valActive['name']; ?></td>
                          <td><span class='badge badge-success'> $ <?php echo $valActive['Amount']; ?> </span></td>
                          <td><i class="fa fa-clock-o"></i>
                            <?php echo date('d-m-Y H:i:s', strtotime($valActive['dateTime'])); ?> </td>
                          <td><?php echo $valActive['activerName'] . ' (User ID:' . $valActive['activerId'] . ')'; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>

  <?php
  require_once 'include/footer.php'; ?>

</body>

</html>