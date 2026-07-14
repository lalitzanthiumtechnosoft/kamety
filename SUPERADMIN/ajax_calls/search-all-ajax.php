<?php include '../../conection.php'; ?>
<style type="text/css">
.highlight { background-color: yellow; }
</style>
<div class="col-sm-12">
   <div class="iq-card">
      <div class="iq-card-header d-flex justify-content-between">
         <div class="iq-header-title">
            <h4 class="card-title">Search Member Result</h4>
         </div>
      </div>
      <div class="iq-card-body">
         <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="overflow-x: scroll!important;font-size: 12px!important;">
               <thead>
                  <tr>
                    <th>#</th>          
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Sponser ID</th>
                    <th>Sponser Name</th>
                    <th>Joinig Date</th>
                    <th>Password</th>
                    <th>More Details</th>
                  </tr>
               </thead>
               <tbody>
                <?php
                function name($con, $member_id)
                {
                    $query = "SELECT name from sub_admin_user_details where member_id='$member_id'";
                    $result = mysqli_query($con, $query);
                    $val1 = mysqli_fetch_array($result);

                    return $val1[0];
                }
function user_id($con, $member_id)
{
    $query = "SELECT user_id from sub_admin_user_details where member_id='$member_id'";
    $result = mysqli_query($con, $query);
    $val1 = mysqli_fetch_array($result);

    return $val1[0];
}
$i = 1;
if (!empty($_GET['search_value'])) {
    $s_value = $_GET['search_value'];
    $search_value = strtolower($s_value);
    $search_value = strtoupper($s_value);
    $query = mysqli_query($con, "SELECT * from sub_admin_user_details where CONCAT (`user_id`, `name`, `phone`) LIKE '%".$s_value."%' AND user_type=2");
    $row = mysqli_num_rows($query);
    if ($row == 0) { ?>
                    <tr>
                        <td colspan="9"><b><center> No Record Found </center>  </b> </td>
                    </tr>
            <?php } else {
                while ($val1 = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['user_id']).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['name']).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['phone']).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", user_id($con, $val1['sponser_id'])).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", name($con, $val1['sponser_id'])).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", date('d-m-Y H:i:d', strtotime($val1['date_time']))).'</td>';
                    echo '<td>'.str_ireplace($search_value, "<span class=\"highlight\">$search_value</span>", $val1['password']).'</td>';
                    echo "<td><a class='btn btn-success' href='viewMemberDetails?user_id=".$val1['user_id']."'>More</a>"; ?> &nbsp; <a href="javascript:void(0);" onclick="memberDashboard('<?php echo base64_encode($val1['user_id']); ?>','<?php echo base64_encode($val1['password']); ?>','<?php echo base64_encode($val1['member_id']); ?>')" class="btn btn-primary btn-sm">Dashboard</a> <?php echo '</td>';
                    echo '</tr>'; ?>
            <?php ++$i;
                }
            } ?>
                </tbody>
            <?php } ?>
            </table>
         </div>
      </div>
   </div>
</div>