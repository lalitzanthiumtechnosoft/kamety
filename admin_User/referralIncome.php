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
      require_once 'include/nav.php'; ?>

      <div class="main-box">
        <div class="BankDetails">
          <h4>Direct Income</h4>


          <div class="box">


            <div class="card-body">

              <div class="dt-ext table-responsive">
                <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User Id</th>
                      <th>Name</th>
                      <th>Direct Income</th>
                      <th>Package Price</th>
                      <th>Date</th>
                      <th>Income From</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 0;
                    $queryLevel = mysqli_query($con, "SELECT a.dateTime,a.referralIncome,a.Amount,b.name,b.user_id,c.user_id AS childID,c.name AS childName FROM user_sponsor_income a, sub_admin_user_details b, sub_admin_user_details c WHERE a.memberId=b.member_id AND a.childId=c.member_id  AND a.memberId='$memberId'  ORDER BY a.dateTime DESC");
                    while ($valLevel = mysqli_fetch_assoc($queryLevel)) {
                      ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valLevel['user_id']; ?></td>
                        <td><?php echo $valLevel['name']; ?></td>
                        <td><span class="badge badge-success">$ <?php echo $valLevel['referralIncome']; ?> </span></td>
                        <td><span class="badge badge-success">$ <?php echo $valLevel['Amount']; ?> </span></td>
                        <td><i class="fa fa-clock-o"></i>
                          <?php echo date('d-m-Y H:i:s', strtotime($valLevel['dateTime'])); ?></td>
                        <td><?php echo $valLevel['childID']; ?></td>
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