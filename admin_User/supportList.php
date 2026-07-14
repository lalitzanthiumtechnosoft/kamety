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
          <h4>All Outbox Tickets </h4>


          <div class="box">


            <div class="card-body">

              <div class="dt-ext table-responsive">
                <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ticket No</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Priority</th>
                      <th>Raise Date</th>
                      <th>Last Update</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                $count = 0;
$queryRequest = mysqli_query($con, "SELECT a.ticketCode,a.ticketMessage,a.raiseDate,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName,d.priorityName FROM user_support_ticket a, sub_admin_user_details b, config_support_subject c, config_support_priority d WHERE a.memberId='$memberId' AND a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.priorityId=d.priorityId ORDER BY a.raiseDate DESC");
while ($valRequest = mysqli_fetch_assoc($queryRequest)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valRequest['ticketCode']; ?></td>
                        <td><?php echo $valRequest['subjectName']; ?></td>
                        <td><?php echo $valRequest['ticketMessage']; ?></td>
                        <td><?php echo $valRequest['priorityName']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valRequest['raiseDate'])); ?>
                        </td>
                        <td><?php if ($valRequest['actionDate'] != '') { ?> <i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valRequest['actionDate']));
                        } ?>
                        </td>
                        <td>
                          <?php if ($valRequest['ticketStatus'] == 1) {
                              echo "<span class='badge badge-primary'>OPEN</span>";
                          } elseif ($valRequest['ticketStatus'] == 2) {
                              echo "<span class='badge badge-warning'>PROCESSING</span>";
                          } elseif ($valRequest['ticketStatus'] == 3) {
                              echo "<span class='badge badge-success'>RESOLVED</span>";
                          } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="BankDetails">
          <h4>All Inbox Tickets </h4>


          <div class="box">


            <div class="card-body">

              <div class="dt-ext table-responsive">
                <table class="table table-bordered table-hover display margin-top-10 w-p100" id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject</th>
                      <th>Message</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 0;
$queryResponse = mysqli_query($con, "SELECT a.adminMessage,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName FROM user_support_ticket a, sub_admin_user_details b, config_support_subject c WHERE a.memberId='$memberId' AND a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.adminMessage<>'' ORDER BY a.actionDate DESC");
while ($valResponse = mysqli_fetch_assoc($queryResponse)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valResponse['subjectName']; ?></td>
                        <td><?php echo $valResponse['adminMessage']; ?></td>
                        <td><i class="fa fa-clock-o"></i>
                          <?php echo date('d-m-Y H:i:s', strtotime($valResponse['actionDate'])); ?></td>
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