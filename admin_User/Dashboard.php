<?php
require_once 'loginCheck.php';
require_once 'include/header.php';
require_once 'include/head.php';

$todayDate = date('Y-m-d');
$d = date('Y-m-d H:i:s');
$queryGe = mysqli_query($con, "SELECT member_id,wallet,topup_flag,date_time FROM sub_admin_user_details WHERE user_id='$userId'");
$valGe = mysqli_fetch_assoc($queryGe);
$memberId = $valGe['member_id'];
$incomeWallet = $valGe['wallet'];
$topupFlag = $valGe['topup_flag'];
$joinDate = $valGe['date_time'];

if ($topupFlag == 1) {
    $queryRank = mysqli_query($con, "SELECT Amount FROM user_invest_history WHERE memberId='$memberId'  AND investStatus=1 ORDER BY Amount DESC LIMIT 1");
    $valRank = mysqli_fetch_assoc($queryRank);
    $investPrice = $valRank['Amount'];
} else {
    $investPrice = 'NA';
}

$querySponser = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details WHERE sponser_id='$memberId'");
$valSponser = mysqli_fetch_array($querySponser);
$totalSponser = $valSponser[0];

$queryAll = mysqli_query($con, "SELECT
        (SELECT COALESCE(SUM(referralIncome), 0) FROM user_sponsor_income WHERE memberId='$memberId' AND releaseStatus=1) AS referralIncome");

$valAll = mysqli_fetch_assoc($queryAll);
$referralIncome = $valAll['referralIncome'];
$totalIncome = $referralIncome;

$queryWithdraw = mysqli_query($con, "SELECT SUM(amount) FROM user_wallet_withdrawal_crypto WHERE member_id='$memberId' AND (released=1 OR released=0)");
$valWithdraw = mysqli_fetch_array($queryWithdraw);
$totalWithdraw = $valWithdraw[0];

$queryTeam = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_child_ids WHERE member_id='$memberId'");
$valTeam = mysqli_fetch_array($queryTeam);
$totalTeam = $valTeam[0];

$queryDirect = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details where sponser_id='$memberId' AND topup_flag=1");
$valDirect = mysqli_fetch_array($queryDirect);
$activeSponser = $valDirect[0];

$queryInDirect = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_details where sponser_id='$memberId' AND topup_flag=0");
$valInDirect = mysqli_fetch_array($queryInDirect);
$inActiveSponser = $valInDirect[0];

$queryActveTeam = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_child_ids WHERE member_id='$memberId' AND topup_status=1");
$valActveTeam = mysqli_fetch_array($queryActveTeam);
$activeTeam = $valActveTeam[0];

$queryInActiveTeam = mysqli_query($con, "SELECT COUNT(1) FROM sub_admin_user_child_ids WHERE member_id='$memberId' AND topup_status=0");
$valInActiveTeam = mysqli_fetch_array($queryInActiveTeam);
$inActiveTeam = $valInActiveTeam[0];

// $queryNews = mysqli_query($con, 'SELECT news,newStatus FROM config_misc_setting WHERE newsId=1');
// $valNews = mysqli_fetch_assoc($queryNews);

$queryTotalBusiness = mysqli_query($con, "SELECT SUM(Amount) FROM user_invest_history WHERE memberId  IN (SELECT child_id FROM sub_admin_user_child_ids WHERE member_id='$memberId')");
$valTotalBusiness = mysqli_fetch_array($queryTotalBusiness);
$totalBusiness = $valTotalBusiness[0];

$queryBuss = mysqli_query($con, "SELECT SUM(Amount) AS selfBuss FROM user_invest_history WHERE memberId='$memberId'  AND investStatus=1 ");
$valBuss = mysqli_fetch_assoc($queryBuss);
$selfInvestPrice = $valBuss['selfBuss'];
?>

<body>
    <div class="wrapper">
        <?php
        require_once 'include/menu.php'; ?>
        <div id="content">
            <?php
            require_once 'include/nav.php'; ?>
            <style>
                table.table>thead>tr>th,
                table.table>tbody>tr>td {
                    text-align: left;
                }
            </style>
            <div class="main-box">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8 low_margin_r">
                                <div class="box_main box_bg">
                                    <h4 style="margin-bottom: 11px;"><small>Hello,</small><br />
                                        <?php echo isset($userName) ? $userName : 'N/A'; ?></h4>
                                    <!--h5>News & Updates</h5-->
                                    <marquee direction="left" scrollamount="3">Welcome to Digital Kamety
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</marquee>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box_main date_box">
                                    <h5>Joining Date</h5>
                                    <p> <?php echo isset($joinDate) ? $joinDate : 'N/A'; ?></p>
                                    <!-- <h5>Activation Date </h5>
                            <p><?php echo isset($activationDate) ? $activationDate : 'N/A'; ?> </p> -->
                                </div>
                            </div>
                        </div>
                        <?php if ($topupFlag == 1) { ?>

                            <div class="box_main referral_link">
                                <h4>My Referral Link</h4>
                                <div class="input-group mb-3">
                                    <input type="text"
                                        value="http://kamety2222/authUserRegister?affiliateCode=<?php echo $userId; ?>"
                                        id="myInput" class="form-control" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="button-addon2"
                                            onclick="myFunction()"><i class="fa fa-copy"></i> Copy</button>
                                        &nbsp;
                                        <button class="btn btn-primary" type="button"
                                            onclick="window.open('http://test.futurevison.world/authUserRegister?affiliateCode=<?php echo $userId; ?>','_blank');"><i
                                                class="fa fa-user-plus"></i> Refer</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } ?>
                        <div class="box_main">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4>Activation kamety </h4>
                                    <p>Click here to activate.</p>
                                    <a href="authActiveUser"><button class="btn btn-primary" type="button">Click
                                            Here</button></a>
                                </div>
                                <div class="col-sm-3">
                                    <img src="assets/images/robo-removebg-preview.png" class="img-fluid booster_tree" />
                                </div>
                            </div>
                        </div>


                        <div class="box_main">
                            <h4>Total Income Status</h4>
                            <table class="table table-hover">
                                <tr>
                                    <td><a>TOTAL INCOME</a></td>
                                    <td class="tbl_width"> $ <?php echo isset($totalIncome) ? $totalIncome : '0.00'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="referralIncome">DIRECT INCOME</a></td>
                                    <td class="tbl_width"><a href="referralIncome"> $
                                            <?php echo isset($referralIncome) ? $referralIncome : '0.00'; ?></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box_main">
                            <!-- <div class="text-center">
                                <img src="assets/images/<?php echo $rankImage; ?>" class="img-fluid img-zoom"
                                    title="Current Rank: <?php echo $currentRank; ?>" style="max-width: 190px;" />
                                <p class="profile_head"><?php echo isset($userId) ? $userId : '0'; ?></p>
                                <p class="profile_info">India</p>
                                <p>
                                    <hr />
                                </p>
                  </div> -->
                            <h4>Wallet Status</h4>
                            <div class="row min_height">
                                <div class="col-sm-6 low_margin_r">
                                    <div class="box_main box_bg">
                                        <h5 class="small_font">INCOME WALLET</h5>
                                        <p> $ <?php echo isset($incomeWallet) ? $incomeWallet : '0.00'; ?></p>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-6 low_margin_l">
                            <div class="box_main box_bg">
                                <h5 class="small_font">PURCHASE Wallet</h5>
                                <p> $ <?php echo isset($fundWallet) ? $fundWallet : '0.00'; ?></p>
                            </div>
                        </div> -->

                            </div>
                            <p>
                                <hr />
                            </p>
                            <h4>My Team Status</h4>
                            <div class="row min_height">
                                <div class="col-sm-6 low_margin_r">
                                    <div class="box_main box_bg">
                                        <h5 class="small_font">Total Referral</h5>
                                        <p> <?php echo isset($totalSponser) ? $totalSponser : '0'; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 low_margin_l">
                                    <div class="box_main box_bg">
                                        <h5 class="small_font">Active Referral</h5>
                                        <p> <?php echo isset($activeSponser) ? $activeSponser : '0'; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 low_margin_r">
                                    <div class="box_main box_bg">
                                        <h5 class="small_font">Total Team</h5>
                                        <p><?php echo isset($totalTeam) ? $totalTeam : '0'; ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 low_margin_l">
                                    <div class="box_main box_bg">
                                        <h5 class="small_font">Active Team</h5>
                                        <p> <?php echo isset($activeTeam) ? $activeTeam : '0'; ?></p>
                                    </div>
                                </div>
                            </div>

                            <p>
                                <hr />
                            </p>
                            <h4>Wallet Txn</h4>
                            <table class="table table-hover">
                                <tr>
                                    <td>TOTAL INCOME</td>
                                    <td> $ <?php echo isset($totalIncome) ? $totalIncome : '0.00'; ?> </td>
                                </tr>
                                <tr>
                                    <td>TOTAL WITHDRAW</td>
                                    <td>$ <?php echo isset($totalWithdraw) ? $totalWithdraw : '0.00'; ?></td>
                                </tr>
                                <tr>
                                    <td>TOTAL BUSINESS</td>
                                    <td>$ <?php echo isset($totalBusiness) ? $totalBusiness : '0.00'; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Make sure this runs after your DB connection and $con is available
            $queryConfig = mysqli_query($con, 'SELECT dashboardImage,imageStatus FROM config_misc_setting');
            $valConfig = mysqli_fetch_assoc($queryConfig);

            $dashboardImage = isset($valConfig['dashboardImage']) && $valConfig['dashboardImage'] !== ''
                ? $valConfig['dashboardImage']
                : 'assets/images/default-popup.png'; // fallback
            $imageStatus = isset($valConfig['imageStatus']) ? intval($valConfig['imageStatus']) : 0;
            ?>

            <!-- Modal (Bootstrap 5) -->
            <div class="modal fade" id="welcomeNotice" tabindex="-1" aria-labelledby="welcomeNoticeLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <!-- change modal-lg to modal-sm as needed -->
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="welcomeNoticeLabel">Notice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- show the image fullwidth — wrap in <a> if you want it clickable -->
                            <img src="../<?php echo htmlspecialchars($dashboardImage, ENT_QUOTES, 'UTF-8'); ?>"
                                alt="Dashboard Notice" style="width:100%; height:auto; display:block;" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: ""
                        },
                        axisX: {
                            crosshair: {
                                enabled: true,
                                snapToDataPoint: true
                            }
                        },
                        axisY: {
                            title: "Total Levels",
                            includeZero: true,
                            crosshair: {
                                enabled: true
                            }
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor: "pointer",
                            verticalAlign: "bottom",
                            horizontalAlign: "left",
                            dockInsidePlotArea: true,
                            itemclick: toogleDataSeries
                        },
                        data: [{
                            type: "line",
                            showInLegend: true,
                            name: "Level No.",
                            markerType: "square",
                            color: "#5f5cdd",
                            dataPoints: [{
                                x: 1,
                                y: 1
                            },
                            {
                                x: 2,
                                y: 2
                            },
                            {
                                x: 3,
                                y: 3
                            },
                            {
                                x: 4,
                                y: 4
                            },
                            {
                                x: 5,
                                y: 5
                            },
                            {
                                x: 6,
                                y: 6
                            }
                            ]
                        },
                        {
                            type: "line",
                            showInLegend: true,
                            name: "Achieved",
                            color: "#875cde",
                            lineDashType: "dash",
                            dataPoints: [{
                                x: 1,
                                y: "Achieved"
                            },
                            {
                                x: 2,
                                y: "Achieved"
                            },
                            {
                                x: 3,
                                y: "Achieved"
                            },
                            {
                                x: 4,
                                y: "Achieved"
                            },
                            {
                                x: 5,
                                y: "Achieved"
                            },
                            {
                                x: 6,
                                y: "Achieved"
                            }
                            ]
                        }
                        ]
                    });
                    chart.render();

                    function toogleDataSeries(e) {
                        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        } else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var imageStatus = <?php echo $imageStatus; ?>;

                    if (imageStatus === 1) {
                        var myModalEl = document.getElementById('welcomeNotice');
                        if (myModalEl) {
                            var bsModal = new bootstrap.Modal(myModalEl, {
                                backdrop: 'static', // stops closing on outside click
                                keyboard: false // stops closing on Esc key
                            });
                            bsModal.show();
                        }
                    }
                });
            </script>
            <script src="js/canvasjs.min.js"></script>
        </div>
    </div>

    <?php
    include 'include/footer.php'; ?>

</body>

</html>