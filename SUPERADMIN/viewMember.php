<!DOCTYPE html>
<html lang="en">
<?php include 'login-check.php'; ?>
<?php include 'include/head.php';
include 'include/menu.php';
include 'include/header.php'; ?>
<?php
date_default_timezone_set('Asia/Kolkata');
$user_id1 = '';
if ($_GET) {
    if ($_GET['user_id']) {
        $user_id1 = $_GET['user_id'];
        $query = "select count(*) from sub_admin_user_details where user_id='$user_id1'";
        $result = mysqli_query($con, $query);
        $val = mysqli_fetch_array($result);
        if ($val[0] == 0) { ?>
          <script>
            alert("Invalid User Id");
            </script>
          <?php
          $user_id1 = $_SESSION['admin_user_id'];
        }
    }
    if ($_GET['from_date']) {
        $show_date = $_GET['from_date'];
        $cal_date = date('Y-m-d', strtotime($show_date));
    }
    if ($_GET['to_date']) {
        $show_date1 = $_GET['to_date'];
        $cal_date1 = date('Y-m-d', strtotime($show_date1));
    }
    if ($_GET['userType']) {
        $userType = $_GET['userType'];
    }
} else {
    $show_date = date('d-m-Y');
    $show_date1 = date('d-m-Y');
    $cal_date = date('Y-m-d');
    $cal_date1 = date('Y-m-d');
}
?>
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
                  <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>" >
                </div>
                <div class="col-3">
                  <input type="text" name="from_date" id="from_date" class="form-control " placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly >
                </div>
                <div class="col-3">
                  <input type="text" name="to_date" id="to_date" class="form-control " placeholder="e.g. To Date" required="" value="<?php echo $show_date1; ?>" readonly >
                </div>
                <div class="col-2">
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
                <h4 class="card-title">View Member</h4>
             </div>
          </div>
          <div class="iq-card-body">
             <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                   <thead>
                      <tr>
                        <th>#</th>          
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Sponser</th>
                        <th>Joinig Date</th>
                        <th>Status</th>
                        <th>More Details</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php
                        function name($con, $member_id)
                        {
                            $query = "SELECT name from sub_admin_user_details where member_id='$member_id' ";
                            $result = mysqli_query($con, $query);
                            $val1 = mysqli_fetch_array($result);

                            return $val1[0];
                        }
function user_id($con, $member_id)
{
    $query = "SELECT user_id from sub_admin_user_details where member_id='$member_id' ";
    $result = mysqli_query($con, $query);
    $val1 = mysqli_fetch_array($result);

    return $val1[0];
}
$query = '';
if ($user_id1 != '') {
    $query = $query." AND user_id='$user_id1'";
}
$count = 0;
$queryUser = mysqli_query($con, "SELECT * from sub_admin_user_details WHERE member_id!=1 AND user_type=2 AND CAST(date_time AS DATE) BETWEEN '$cal_date' AND '$cal_date1' ".$query.' order by date_time desc');
while ($valUser = mysqli_fetch_assoc($queryUser)) {
    ++$count; ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $valUser['user_id']; ?></td>
                        <td><?php echo $valUser['name']; ?></td>
                        <td><?php echo $valUser['phone']; ?></td>
                        <td><?php echo name($con, $valUser['sponser_id']).' (User ID:'.user_id($con, $valUser['sponser_id']).')'; ?></td>
                        <td><?php echo $valUser['date_time']; ?></td>
                    
                        <td><strong><?php if ($valUser['topup_flag'] == 1) {
                            echo 'Active';
                        } else {
                            echo 'In-Active';
                        } ?></strong></td>
                        <td><a href="viewMemberDetails?user_id=<?php echo $valUser['user_id']; ?>"><span class="badge badge-success">More</span></a>&nbsp;<a href="javascript:void(0);" onclick="memberDashboard('<?php echo base64_encode($valUser['user_id']); ?>','<?php echo base64_encode($valUser['password']); ?>','<?php echo base64_encode($valUser['member_id']); ?>')"><span class="badge badge-primary">Dashboard</span></a>&nbsp;<?php if ($valUser['account_status'] == 1) { ?><a href="javascript:void(0);" onclick="blockUser(<?php echo $valUser['member_id']; ?>,0)"><span class="badge badge-danger">Block</span></a><?php } else { ?> <a href="javascript:void(0);" onclick="unBlockUser(<?php echo $valUser['member_id']; ?>,1)" ><span class="badge badge-warning">Un-Block</span></a> <?php } ?></td>
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
function blockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajax_calls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
             if(data){
              alert('User Block Successfully');
              location.reload();
             }
          }
      });
    }
  }
}
function unBlockUser(memberId,blockStatus) {
  if(memberId!=""){
      if(confirm('Are you sure to Un-Block this Member?')){
        $.ajax({
          type: "POST",
          url: 'ajax_calls/blockUnBlockUserAjax',
          data: { memberId:memberId, blockStatus:blockStatus },
          cache: false,
          success: function(data){
            // alert(data);
            if(data){
              alert('User Un-Block Successfully');
              location.reload();
            }
          }
      });
    }
  }
}
function memberDashboard(userId,password,memberId){
   var url='../User/setSessionAdvice?userId='+userId+'&mID='+password+'&codeGenerate='+memberId;
   window.open(url,'_blank');
}; 
var d = document.getElementById("member");
    d.className += " active";
var d = document.getElementById("viewMember");
    d.className += " active";
</script>
</body>
</html>