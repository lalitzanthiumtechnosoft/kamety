   <?php require_once 'include/head.php'; ?>

<body>
  <div class="wrapper">
    <?php
    require_once 'loginCheck.php';
    require_once 'include/menu.php';
    require_once 'include/header.php';

    ?>
    <div id="content">
      <?php require_once 'include/nav.php'; ?>

      <div class="main-box">
        <div class="BankDetails">
          <h4>My Team</h4>
          <div class="dt-ext table-responsive">
            <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Level Number.</th>
                  <th>Total Member</th>
                  <th>Total Business</th>

                </tr>
              </thead>
              <tbody>
                <?php
                for ($level = 1; $level <= 20; $level++) {
                  $queryMember = mysqli_query($con, "SELECT COUNT(1) AS totalMember FROM user_matrix_team WHERE memberId='$memberId' AND level='$level'");
                  $valMember = mysqli_fetch_array($queryMember);
                  $count++; ?>
                  <tr>
                    <td><?= $level ?></td>
                    <td>Level <?= $level; ?></td>
                    <td><i class="fa fa-user"></i>
                      <?= isset($valMember[0]) ? $valMember[0] : '0'; ?></td>
                    <td><a href="levelTeamDetails?MemberID=<?= $memberId ?>&LevelID=<?= $level ?>"
                        class="btn btn-primary">More</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once 'include/footer.php'; ?>

</body>
</html>