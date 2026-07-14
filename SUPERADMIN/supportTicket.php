<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
if ($_GET) {
    if ($_GET['subjectId']) {
        $subjectId = $_GET['subjectId'];
    }
    if ($_GET['priorityId']) {
        $priorityId = $_GET['priorityId'];
    }
    if ($_GET['ticketStatus']) {
        $ticketStatus = $_GET['ticketStatus'];
    }
} ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12 ">
      <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
        </div>
        <div class="iq-card-body">
           <form>
              <div class="form-row">
                <div class="col-3">
                  <select class="form-control" name="subjectId">
                    <option value=""> Select One </option>
                    <?php $querySubject = mysqli_query($con, 'SELECT subjectId,subjectName FROM config_support_subject WHERE subjectStatus=1');
while ($valSubject = mysqli_fetch_assoc($querySubject)) { ?>
                      <option value="<?php echo $valSubject['subjectId']; ?>" <?php if ($valSubject['subjectId'] == $subjectId) {
                          echo 'selected';
                      } ?> > <?php echo $valSubject['subjectName']; ?> </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-3">
                  <select class="form-control" name="priorityId">
                    <option value=""> Select One </option>
                    <?php $queryPriority = mysqli_query($con, 'SELECT priorityId,priorityName FROM config_support_priority WHERE priorityStatus=1');
while ($valPriority = mysqli_fetch_assoc($queryPriority)) { ?>
                    <option value="<?php echo $valPriority['priorityId']; ?>" <?php if ($valPriority['priorityId'] == $priorityId) {
                        echo 'selected';
                    } ?> > <?php echo $valPriority['priorityName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-3">
                  <select class="form-control" name="ticketStatus">
                    <option value=""> Select One </option>
                    <option value="1" <?php if ($ticketStatus == 1) {
                        echo 'selected';
                    }?> > Open </option>
                    <option value="2" <?php if ($ticketStatus == 2) {
                        echo 'selected';
                    }?> > Processing </option>
                    <option value="3" <?php if ($ticketStatus == 3) {
                        echo 'selected';
                    }?> > Completed </option>
                  </select>
                </div>
                <div class="col-3">
                  <input class="btn btn-primary" type="submit" value="Search" >
                </div>
              </div>
           </form>
        </div>
      </div>
    </div>
    <div class="col-sm-12">
       <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
             <div class="iq-header-title">
                <h4 class="card-title">New Support Tickets</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>TicketNo</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Message</th>
                        <th>Raise Date</th>
                        <th>Remark</th>
                        <th>Resolve Date</th>
                        <th>Status</th>
                      </tr>
                   </thead>
                   <tbody>
                    <?php
                      $query = '';
if ($subjectId != '') {
    $query = $query." AND a.subjectId='$subjectId'";
}
if ($priorityId != '') {
    $query = $query." AND a.priorityId='$priorityId'";
}
if ($ticketStatus != '') {
    $query = $query." AND a.ticketStatus='$ticketStatus'";
}
$count = 0;
$queryRequest = mysqli_query($con, 'SELECT a.ticketId,a.ticketCode,a.ticketMessage,a.adminMessage,a.raiseDate,a.actionDate,a.ticketStatus,b.user_id,b.name,c.subjectName,d.priorityName FROM user_support_ticket a, sub_admin_user_details b, config_support_subject c, config_support_priority d WHERE a.memberId=b.member_id AND a.subjectId=c.subjectId AND a.priorityId=d.priorityId '.$query.' ORDER BY a.raiseDate DESC');
while ($valRequest = mysqli_fetch_assoc($queryRequest)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valRequest['user_id']; ?></td>
                        <td><?php echo $valRequest['name']; ?></td>
                        <td><?php echo $valRequest['ticketCode']; ?></td>
                        <td><?php echo $valRequest['subjectName']; ?></td>
                        <td><?php echo $valRequest['priorityName']; ?></td>
                        <td><?php echo $valRequest['ticketMessage']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valRequest['raiseDate'])); ?></td>
                        <td><?php echo $valRequest['adminMessage']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo $valRequest['actionDate']; ?></td>
                        <td><?php if ($valRequest['ticketStatus'] == 1) {
                            echo "<span class='badge badge-primary'>OPEN</span>";
                        } elseif ($valRequest['ticketStatus'] == 2) {
                            echo "<span class='badge badge-warning'>PROCESSING</span>";
                        } elseif ($valRequest['ticketStatus'] == 3) {
                            echo "<span class='badge badge-success'>COMPLETED</span>";
                        }?></td>
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

<?php include 'include/footer.php'; ?>
<script>
var d = document.getElementById("Support");
    d.className += " active";
var d = document.getElementById("supportTicket");
    d.className += " active";
</script>
</body>
</html>