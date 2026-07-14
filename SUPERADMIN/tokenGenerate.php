<!DOCTYPE html>
<html lang="en">
<?php include("login-check.php"); ?>
<?php include('include/head.php');
include('include/menu.php');
include('include/header.php'); ?>

<?php
$queryCheck = mysqli_query($con, "SELECT COUNT(1) AS total FROM config_coin_generate_history ORDER BY dateTime ASC");
$valCheck = mysqli_fetch_assoc($queryCheck);
$roundCheck = $valCheck['total'];
$roundCheck; // This will output the count
?>

<style>
    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blink {
        animation: blink 1s infinite;
        color: red;
    }
</style>

<div id="main-content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Token Generate <span class="blink">Round(<?= $roundCheck ?>)</span></h2>
                    </div>

                    <div class="body">
                        <form method="POST" action="tokenGenerateProcess">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Generate Token *</label>
                                            <input type="text" name="generateToken" id="generateToken" class="form-control" required placeholder="Enter Distribute ICO Token">
                                            <input type="hidden" name="loginMemberId" value="<?= $member_id ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex">
                                        <div class="form-group col-lg-6">
                                            <label>Select Date From*</label>
                                            <input type="date" id="dateFrom" name="dateFrom" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Select Date To*</label>
                                            <input type="date" id="dateTo" name="dateTo" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Token Rate *</label>
                                            <input type="text" name="coinRate" class="form-control" placeholder="Token Rate" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="tokenGenerate" class="btn btn-primary action-button float-left" value="Generate Token">Generate Token</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>Token Generate History</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!-- <th>Rest Global Token</th> -->
                                        <th>Token Generate</th>
                                        <th>Token Sell</th>
                                        <th>Generate Rate</th>
                                        <th>Generate Date</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $queryToken = mysqli_query($con, "SELECT * FROM config_coin_generate_history ORDER BY dateTime ASC");
                                    while ($valToken = mysqli_fetch_assoc($queryToken)) {
                                        $count++; ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <!-- <td><i class="fa fa-coins"></i> <?= $valToken['restCoin'] ?></td> -->
                                            <td><i class="fa fa-coins"></i> <?= $valToken['coinGenerate'] ?></td>
                                            <td><i class="fa fa-coins"></i> <?= $valToken['coinSell'] ?></td>
                                            <td><i class="fa fa-usd"></i> <?= $valToken['coinRate'] ?></td>
                                            <td><i class="fa fa-clock-o"></i> <?= $valToken['dateTime'] ?></td>
                                            <td><i class="fa fa-clock-o"></i> <?= $valToken['dateFrom'] ?></td>
                                            <td><i class="fa fa-clock-o"></i> <?= $valToken['dateTo'] ?></td>
                                            <td>
                                                <?php if ($valToken['status'] == 1) echo "<span class='badge badge-primary'>RUNNING</span>";
                                                else if ($valToken['status'] == 0) echo "<span class='badge badge-success'>COMPLETED</span>";
                                                ?>
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
<?php include('include/footer.php'); ?>
<script>
    var d = document.getElementById("Token");
    d.className += " active";
    var d = document.getElementById("tokenGenerate");
    d.className += " active";
</script>

</body>

</html>