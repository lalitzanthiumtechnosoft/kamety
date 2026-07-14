<?php require_once 'include/head.php'; ?>

<body>
    <div class="wrapper">
        <?php
        require_once 'loginCheck.php';
require_once 'include/header.php';
require_once 'include/menu.php';
?>
        <div id="content">
            <?php
    require_once 'include/nav.php';
?>
            <div class="main-box">
                <div class="BankDetails">
                    <h4>Add New Member</h4>
                    <div class="box">
                        <form action="addMemberProccess" enctype="multipart/form-data" method="POST" role="form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel" style="color:#000;">Add New Member </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-12">Select Price</label>
                                            <div class="col-md-12">
                                                <select class="form-control" required id="summary_id" name="summary_id"
                                                    onchange="filterData(this.value)">
                                                    <option value=""> Select Price </option>
                                                    <?php
                                                $querySubject = mysqli_query($con, "SELECT summary_id, packagePrice,userNeed FROM user_month_set_details WHERE status=1 AND member_id='$memberId'");
$currentSummaryId = $_GET['summary_id'] ?? '';
while ($valSubject = mysqli_fetch_assoc($querySubject)) {
    $userNeed = $valSubject['userNeed'];
    $selected = ($valSubject['summary_id'] == $currentSummaryId) ? 'selected' : '';
    ?>
                                                    <option value="<?php echo $valSubject['summary_id']; ?>"
                                                        <?php echo $selected; ?>>
                                                        <?php echo $valSubject['packagePrice']; ?> (
                                                        <?php echo $userNeed; ?> Month)
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Full Name</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" required id="name" name="name"
                                                    placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Email Id</label>
                                            <div class="col-md-12">
                                                <input type="email" class="form-control" required id="email"
                                                    name="email" placeholder="Email Id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" required id="phoneNumber"
                                                    name="phoneNumber" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" required id="password"
                                                    name="password" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="addMember"><i
                                            class="fa fa-info"></i> Submit</button>
                                    <button type="button" class="btn btn-default float-right"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
$summary_id = $_GET['summary_id'] ?? '';
$queryDirect = mysqli_query($con, "SELECT member_id,user_id,name,email_id,phone,date_time,topup_flag,activation_date  FROM sub_admin_user_details WHERE sponser_id='$memberId' AND summary_id='$summary_id' ORDER BY date_time DESC");
while ($valDirect = mysqli_fetch_assoc($queryDirect)) {
    ++$count; ?>
                                        <tr>
                                            <td> <?php echo $count; ?> </td>
                                            <td> <?php echo $valDirect['user_id']; ?> </td>
                                            <td> <?php echo $valDirect['name']; ?> </td>
                                            <td> <?php echo $valDirect['email_id']; ?> </td>
                                            <td> <?php echo $valDirect['phone']; ?> </td>
                                            <td><i class="fa fa-clock-o"></i>
                                                <?php echo date('d-m-Y H:i:s', strtotime($valDirect['date_time'])); ?>
                                            </td>
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

<script>
function filterData(summaryId) {
    // Get the current URL without parameters
    const baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;

    if (summaryId) {
        // Reload page with the selected summary_id as a GET parameter
        window.location.href = baseUrl + '?summary_id=' + encodeURIComponent(summaryId);
    } else {
        // Reload without parameters if "Select Price" is chosen
        window.location.href = baseUrl;
    }
}
</script>



</html>