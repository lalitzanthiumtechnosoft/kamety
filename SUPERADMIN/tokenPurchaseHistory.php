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
                                <input class="form-control" type="text" placeholder="Enter User ID" name="user_id" value="<?php echo $user_id1; ?>">
                            </div>
                            <div class="col-3">
                                <input type="text" name="from_date" id="from_date" class="form-control " placeholder="e.g. From Date" required value="<?php echo $show_date; ?>" readonly>
                            </div>
                            <div class="col-3">
                                <input type="text" name="to_date" id="to_date" class="form-control " placeholder="e.g. To Date" required="" value="<?php echo $show_date1; ?>" readonly>
                            </div>
                            <div class="col-2">
                                <input class="btn btn-primary" type="submit" value="Search">
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
                        <h4 class="card-title">Token Purchase History</h4>
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
                                    <th>Coin Rate</th>
                                    <th>Total Coin Buy</th>
                                    <th>Buy Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
$queryIco = mysqli_query($con, "SELECT a.totalToken,a.tokenRate,a.dateTime,b.user_id,b.name FROM user_coin_ico_purchase a, sub_admin_user_details b WHERE CAST(a.dateTime AS date) BETWEEN '$cal_date' AND '$cal_date1' AND a.memberId=b.member_id ORDER BY a.dateTime DESC");
while ($valIco = mysqli_fetch_assoc($queryIco)) {
    ++$count; ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $valIco['user_id']; ?></td>
                                        <td><?php echo $valIco['name']; ?></td>
                                        <td><span class="badge badge-success"><i class="fa fa-usd"></i> <?php echo $valIco['tokenRate']; ?></span></td>
                                        <td><span class="badge badge-success"> <?php echo $valIco['totalToken']; ?></span></td>
                                        <td><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s', strtotime($valIco['dateTime'])); ?></td>
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
    var d = document.getElementById("Token");
    d.className += " active";
    var d = document.getElementById("tokenPurchaseHistory");
    d.className += " active";
</script>
</body>

</html>