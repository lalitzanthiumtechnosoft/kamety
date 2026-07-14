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
                <div class="BankDetails">
                    <h4>Activate Account</h4>
                    <div class="box">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="boosting_box boosting_box_bg_light">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!--img src="assets/images/usdt.png" class="img_icon" /-->
                                            <i class="fa fa-dollar-sign img_icon"></i>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-right"></p>
                                        </div>
                                    </div>
                                    <p>&nbsp;</p>
                                    <h4 class="text-center"> $ <?php echo $fundWallet; ?></h4>
                                    <p>Available Balance </p>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-6">
                                <form class="theme-form" action="authActiveUserProcess" method="post"
                                    onsubmit="return confirm('Are you sure?')">
                                    <div class="mb-3">
                                        <label>UserId *</label>
                                        <input type="text" name="sponser_id" id="sponser_id" placeholder="Enter User Id"
                                            value="<?php echo $userId; ?>" class="form-control">
                                        <input type="hidden" name="loginMemberId" value="<?php echo $memberId; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Name </label>
                                        <input type="text" id="sponser_name" id="sponser_name" readonly disabled
                                            class="form-control" placeholder="e.g. Name"
                                            value="<?php echo $userName; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Fund Wallet </label>
                                        <input type="text" name="fundWallet" class="form-control" readonly
                                            value=" $ <?php echo isset($fundWallet) ? $fundWallet : '0.00'; ?>">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="inputName">Select Package *</label>
                                        <select class="form-control" required name="packageId">
                                            <option value=""> Select Package </option>
                                            <?php
                                            $queryPackage = mysqli_query($con, 'SELECT * FROM config_package_type WHERE packageStatus=1 ORDER BY packageId ASC');
                                            while ($valPackage = mysqli_fetch_assoc($queryPackage)) { ?>
                                                <option value="<?php echo $valPackage['packageId']; ?>">
                                                    ₹ <?php echo $valPackage['packageAmount']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="inputName">Amount *</label>
                                        <input type="number" name="amount" class="form-control" required
                                            placeholder="Enter Amount you want to Deposit Monthly">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputName">Month *</label>
                                        <input type="number" name="month" class="form-control" required
                                            placeholder="Enter Number of Months">
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary " name="upgradeNow"
                                            value="Purchase Now">Active Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

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
                                            <td>
                                                <?php echo $count; ?>
                                            </td>
                                            <td>
                                                <?php echo $valActive['user_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $valActive['name']; ?>
                                            </td>
                                            <td><span class='badge badge-success'> $
                                                    <?php echo $valActive['Amount']; ?>
                                                </span></td>
                                            <td><i class="fa fa-clock-o"></i>
                                                <?php echo date('d-m-Y H:i:s', strtotime($valActive['dateTime'])); ?>
                                            </td>
                                            <td>
                                                <?php echo $valActive['activerName'] . ' (User ID:' . $valActive['activerId'] . ')'; ?>
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

    <?php
    require_once 'include/footer.php'; ?>

</body>

</html>