<?php error_reporting(0); ?>
<?php include '../../conection.php'; ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/style.min.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/css/custom/bineryTooltip.css" rel="stylesheet" />
    <style>
        .red-border {
            box-shadow: 0 0 0 2px #f44242;
        }

        .orange-border {
            box-shadow: 0 0 0 2px #f49b41;
        }

        .yellow_border {
            box-shadow: 0 0 0 2px #f4df41;
        }

        .blue_border {
            box-shadow: 0 0 0 2px #4167f4;
        }

        .sky_border {
            box-shadow: 0 0 0 2px #41f4e5;
        }

        .green_border {
            box-shadow: 0 0 0 2px #67f441;
        }

        .gray_border {
            box-shadow: 0 0 0 2px #ccc5c1;
        }
    </style>
    <style>

    </style>
</head>

<body>
    <?php
    function sponserID($con, $sponserId)
    {
        $querySponser = mysqli_query($con, "SELECT user_id FROM sub_admin_user_details WHERE member_id='$sponserId'");
        $valSponser = mysqli_fetch_array($querySponser);
        echo $valSponser['user_id'];
    }
    function carryTeam($user_id, $con)
    {
        $queryUser = mysqli_query($con, "SELECT member_id,name,user_id FROM sub_admin_user_details WHERE user_id='$user_id'");
        $valUser = mysqli_fetch_array($queryUser);
        $member_id = $valUser['member_id'];

        // Totel Business count
    
        $querySelf = mysqli_query($con, "SELECT SUM(Amount) FROM user_invest_history WHERE memberId=$member_id");
        $valSelf = mysqli_fetch_array($querySelf);
        $SelfCount = $valSelf[0];
        if ($SelfCount !== null) {
            echo 'Self Business: ' . $SelfCount . '<br>';
        }

        $queryLeft = mysqli_query($con, "SELECT SUM(Amount) FROM user_invest_history WHERE memberId IN (SELECT childId FROM user_matrix_team WHERE memberId='$member_id'AND legPosition=2 )");
        $valleft = mysqli_fetch_array($queryLeft);
        $LeftCount = $valleft[0];
        if ($LeftCount !== null) {
            echo 'Left Business: ' . $LeftCount . '<br>';
        }

        $queryRight = mysqli_query($con, "SELECT SUM(Amount) FROM user_invest_history WHERE memberId IN (SELECT childId FROM user_matrix_team WHERE memberId='$member_id'AND legPosition=3)");
        $valRight = mysqli_fetch_array($queryRight);
        $RightCount = $valRight[0];
        if ($RightCount !== null) {
            echo 'Right Business: ' . $RightCount . '<br>';
        }

        // Totel Business End
    
        // Left  Team
        $queryLAct = mysqli_query($con, "SELECT COUNT(1) FROM user_matrix_team WHERE memberId='$member_id' AND legPosition=2 ");
        $valLAct = mysqli_fetch_array($queryLAct);
        $leftActTeam = $valLAct[0];

        // Right  Team
        $queryRAct = mysqli_query($con, "SELECT COUNT(1) FROM user_matrix_team WHERE memberId='$member_id' AND legPosition=3 ");
        $valRAct = mysqli_fetch_array($queryRAct);
        $rightActTeam = $valRAct[0];

        echo ' Team: ' . $leftActTeam . ' ( L ) - ' . $rightActTeam . ' ( R ) <br>';
    } ?>
    <div style="width: 1100px">
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div id="transformIt" style="padding: 20px;">
                    <!-- Binery Tree will Be Here -->
                    <?php
                    $member_id = $_GET['member_id'];
                    $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id FROM sub_admin_user_details WHERE member_id='$member_id'");
                    $parent_id1 = 0;
                    $parent_id2 = 0;
                    $parent_id3 = 0;
                    $parent_id4 = 0;
                    $parent_id5 = 0;
                    $parent_id6 = 0;
                    $parent_id7 = 0;
                    if ($val = mysqli_fetch_array($result)) {
                        $parent_id1 = $val['member_id']; ?>
                        <div class="binery-background">
                            <?php if ($val['topup_flag'] == 1) { ?>
                                <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                    target="_blank">
                                <?php } ?>
                                <div style="width: 80px; height: 120px; position : relative;background-color: transparent;margin-top: 10px;"
                                    class="center-block binary-item">
                                    <!-- Binary TOOLTIP -->
                                    <div class="binery-tooltip">
                                        <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class" role="alert">
                                            <div class="gritter-top"></div>
                                            <div class="gritter-item">
                                                <div class="gritter-with-image">
                                                    <span class="gritter-title">
                                                        <?php echo $val['name']; ?></span>
                                                    <p>User Id:
                                                        <?php echo $val['user_id']; ?><br />
                                                        Account Status :
                                                        <?php if ($val['topup_flag'] == 1) {
                                                            echo 'Active';
                                                        } else {
                                                            echo 'In-Active';
                                                        } ?><br />
                                                        <?php carryTeam($val['user_id'], $con); ?>
                                                    </p>
                                                </div>
                                                <div style="clear:both"></div>
                                            </div>
                                            <div class="gritter-bottom">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- //BINARY TOOLTIP -->

                                    <img <?php if ($val['topup_flag'] == 1) {
                                        echo "src='assets/img/silver.png'";
                                    } else {
                                        echo "src='assets/img/0.JPG'";
                                    } ?> class="img-circle img-responsive">

                                    <h4 class="text-center"><a target="_parent"
                                            href="../treeStructure?userId=<?php echo $val['user_id']; ?>"><?php echo $val['user_id']; ?></a>
                                    </h4>

                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <!-- Child Level 1 -->
                    <div>
                        <?php

                        $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id1' and legPosition=2");
                        if ($val = mysqli_fetch_array($result)) {
                            $parent_id2 = $val['member_id'];

                            ?>
                            <div class="col-xs-6 binery-background ">
                                <?php if ($val['topup_flag'] == 1) { ?>
                                    <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                        target="_blank">
                                    <?php } ?>
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <!-- Binary TOOLTIP -->
                                        <div class="binery-tooltip">
                                            <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                role="alert">
                                                <div class="gritter-top"></div>
                                                <div class="gritter-item">
                                                    <div class="gritter-with-image">
                                                        <span class="gritter-title">
                                                            <?php echo $val['name']; ?></span>
                                                        <p>User Id:
                                                            <?php echo $val['user_id']; ?><br />

                                                            Account Status :
                                                            <?php if ($val['topup_flag'] == 1) {
                                                                echo 'Active';
                                                            } else {
                                                                echo 'In-Active';
                                                            } ?><br />
                                                            <?php carryTeam($val['user_id'], $con); ?>
                                                        </p>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                                <div class="gritter-bottom">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- //BINARY TOOLTIP -->
                                        <img <?php if ($val['topup_flag'] == 1) {
                                            echo "src='assets/img/silver.png'";
                                        } else {
                                            echo "src='assets/img/0.JPG'";
                                        } ?> class="img-circle img-responsive">
                                        <h4 class="text-center"><a target="_parent"
                                                href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                <?php echo $val['user_id']; ?></a></h4>
                                    </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-xs-6 binery-background ">
                                <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                    class="center-block binary-item">
                                    <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id1' and legPosition=3");
                        if ($val = mysqli_fetch_array($result)) {
                            $parent_id3 = $val['member_id'];

                            ?>
                            <div class="col-xs-6 binery-background ">
                                <?php if ($val['topup_flag'] == 1) { ?>
                                    <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                        target="_blank">
                                    <?php } ?>
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <!-- Binary TOOLTIP -->
                                        <div class="binery-tooltip">
                                            <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                role="alert">
                                                <div class="gritter-top"></div>
                                                <div class="gritter-item">
                                                    <div class="gritter-with-image">
                                                        <span class="gritter-title">
                                                            <?php echo $val['name']; ?></span>
                                                        <p>User Id:
                                                            <?php echo $val['user_id']; ?><br />
                                                            Account Status :
                                                            <?php if ($val['topup_flag'] == 1) {
                                                                echo 'Active';
                                                            } else {
                                                                echo 'In-Active';
                                                            } ?><br />
                                                            <?php carryTeam($val['user_id'], $con); ?>
                                                        </p>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                                <div class="gritter-bottom">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- //BINARY TOOLTIP -->
                                        <img <?php if ($val['topup_flag'] == 1) {
                                            echo "src='assets/img/silver.png'";
                                        } else {
                                            echo "src='assets/img/0.JPG'";
                                        } ?> class="img-circle img-responsive">
                                        <h4 class="text-center"><a target="_parent"
                                                href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                <?php echo $val['user_id']; ?></a></h4>
                                    </div>
                            </div>
                        <?php } else {
                            ?>
                            <div class="col-xs-6 binery-background ">
                                <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                    class="center-block binary-item">
                                    <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                    <!--//Child Level 1 -->
                    <!-- Child Level 2 -->
                    <div>
                        <div class="col-xs-6">
                            <?php
                            $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id2' and legPosition=2");
                            if ($val = mysqli_fetch_array($result)) {
                                $parent_id4 = $val['member_id'];

                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <?php if ($val['topup_flag'] == 1) { ?>
                                        <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                            target="_blank">
                                        <?php } ?>
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <!-- Binary TOOLTIP -->
                                            <div class="binery-tooltip">
                                                <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                    role="alert">
                                                    <div class="gritter-top"></div>
                                                    <div class="gritter-item">
                                                        <div class="gritter-with-image">
                                                            <span class="gritter-title">
                                                                <?php echo $val['name']; ?></span>
                                                            <p>User Id:
                                                                <?php echo $val['user_id']; ?><br />

                                                                Account Status :
                                                                <?php if ($val['topup_flag'] == 1) {
                                                                    echo 'Active';
                                                                } else {
                                                                    echo 'In-Active';
                                                                } ?><br />
                                                                <?php carryTeam($val['user_id'], $con); ?>
                                                            </p>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                    <div class="gritter-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- //BINARY TOOLTIP -->
                                            <img <?php if ($val['topup_flag'] == 1) {
                                                echo "src='assets/img/silver.png'";
                                            } else {
                                                echo "src='assets/img/0.JPG'";
                                            } ?>
                                                class="img-circle img-responsive">
                                            <h4 class="text-center"><a target="_parent"
                                                    href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                    <?php echo $val['user_id']; ?></a></h4>
                                        </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <!-- Binary TOOLTIP -->
                                        <div class="binery-tooltip">
                                            <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                role="alert">
                                                <div class="gritter-top"></div>
                                                <div class="gritter-item">
                                                    <div class="gritter-with-image">
                                                        <span class="gritter-title"></span>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                                <div class="gritter-bottom">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- //BINARY TOOLTIP -->
                                        <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id2' and legPosition=3");
                            if ($val = mysqli_fetch_array($result)) {
                                $parent_id5 = $val['member_id'];

                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <?php if ($val['topup_flag'] == 1) { ?>
                                        <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                            target="_blank">
                                        <?php } ?>
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <!-- Binary TOOLTIP -->
                                            <div class="binery-tooltip">
                                                <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                    role="alert">
                                                    <div class="gritter-top"></div>
                                                    <div class="gritter-item">
                                                        <div class="gritter-with-image">
                                                            <span class="gritter-title">
                                                                <?php echo $val['name']; ?></span>
                                                            <p>User Id:
                                                                <?php echo $val['user_id']; ?><br />

                                                                Account Status :
                                                                <?php if ($val['topup_flag'] == 1) {
                                                                    echo 'Active';
                                                                } else {
                                                                    echo 'In-Active';
                                                                } ?><br />
                                                                <?php carryTeam($val['user_id'], $con); ?>
                                                            </p>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                    <div class="gritter-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- //BINARY TOOLTIP -->
                                            <img <?php if ($val['topup_flag'] == 1) {
                                                echo "src='assets/img/silver.png'";
                                            } else {
                                                echo "src='assets/img/0.JPG'";
                                            } ?>
                                                class="img-circle img-responsive">
                                            <h4 class="text-center"><a target="_parent"
                                                    href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                    <?php echo $val['user_id']; ?></a></h4>
                                        </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id3' and legPosition=2");
                            if ($val = mysqli_fetch_array($result)) {
                                $parent_id6 = $val['member_id'];

                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <?php if ($val['topup_flag'] == 1) { ?>
                                        <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                            target="_blank">
                                        <?php } ?>
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <!-- Binary TOOLTIP -->
                                            <div class="binery-tooltip">
                                                <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                    role="alert">
                                                    <div class="gritter-top"></div>
                                                    <div class="gritter-item">
                                                        <div class="gritter-with-image">
                                                            <span class="gritter-title">
                                                                <?php echo $val['name']; ?></span>
                                                            <p>User Id:
                                                                <?php echo $val['user_id']; ?><br />

                                                                Account Status :
                                                                <?php if ($val['topup_flag'] == 1) {
                                                                    echo 'Active';
                                                                } else {
                                                                    echo 'In-Active';
                                                                } ?><br />
                                                                <?php carryTeam($val['user_id'], $con); ?>
                                                            </p>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                    <div class="gritter-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- //BINARY TOOLTIP -->
                                            <img <?php if ($val['topup_flag'] == 1) {
                                                echo "src='assets/img/silver.png'";
                                            } else {
                                                echo "src='assets/img/0.JPG'";
                                            } ?>
                                                class="img-circle img-responsive">
                                            <h4 class="text-center"><a target="_parent"
                                                    href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                    <?php echo $val['user_id']; ?></a></h4>
                                        </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id3' and legPosition=3");
                            if ($val = mysqli_fetch_array($result)) {
                                $parent_id7 = $val['member_id'];

                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <?php if ($val['topup_flag'] == 1) { ?>
                                        <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                            target="_blank">
                                        <?php } ?>
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <!-- Binary TOOLTIP -->
                                            <div class="binery-tooltip">
                                                <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                    role="alert">
                                                    <div class="gritter-top"></div>
                                                    <div class="gritter-item">
                                                        <div class="gritter-with-image">
                                                            <span class="gritter-title">
                                                                <?php echo $val['name']; ?></span>
                                                            <p>User Id:
                                                                <?php echo $val['user_id']; ?><br />

                                                                Account Status :
                                                                <?php if ($val['topup_flag'] == 1) {
                                                                    echo 'Active';
                                                                } else {
                                                                    echo 'In-Active';
                                                                } ?><br />
                                                                <?php carryTeam($val['user_id'], $con); ?>
                                                            </p>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                    </div>
                                                    <div class="gritter-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- //BINARY TOOLTIP -->
                                            <img <?php if ($val['topup_flag'] == 1) {
                                                echo "src='assets/img/silver.png'";
                                            } else {
                                                echo "src='assets/img/0.JPG'";
                                            } ?>
                                                class="img-circle img-responsive">
                                            <h4 class="text-center"><a target="_parent"
                                                    href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                    <?php echo $val['user_id']; ?></a></h4>
                                        </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-xs-6 binery-background ">
                                    <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                        class="center-block binary-item">
                                        <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!--//Child Level 2 -->
                    <!-- Child Level 3 -->
                    <div>
                        <div class="col-xs-6">
                            <div class="col-xs-6">
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id4' and legPosition=2");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id4' and legPosition=3");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-6">
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id5' and legPosition=2");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id5' and legPosition=3");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6">
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id6' and legPosition=2");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id6' and legPosition=3");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-xs-6">
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id7' and legPosition=2");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                $result = mysqli_query($con, "SELECT member_id,name,user_id,date_time,topup_flag,activation_date,sponser_id from sub_admin_user_details where placeholderId='$parent_id7' and legPosition=3");
                                if ($val = mysqli_fetch_array($result)) {
                                    ?>
                                    <div class="col-xs-6  ">
                                        <?php if ($val['topup_flag'] == 1) { ?>
                                            <a href="https://futurevison.world/authUserRegister?affiliateCode=<?php echo $val['user_id']; ?>"
                                                target="_blank">
                                            <?php } ?>
                                            <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                                class="center-block binary-item">
                                                <!-- Binary TOOLTIP -->
                                                <div class="binery-tooltip">
                                                    <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class"
                                                        role="alert">
                                                        <div class="gritter-top"></div>
                                                        <div class="gritter-item">
                                                            <div class="gritter-with-image">
                                                                <span class="gritter-title">
                                                                    <?php echo $val['name']; ?></span>
                                                                <p>User Id:
                                                                    <?php echo $val['user_id']; ?><br />

                                                                    Account Status :
                                                                    <?php if ($val['topup_flag'] == 1) {
                                                                        echo 'Active';
                                                                    } else {
                                                                        echo 'In-Active';
                                                                    } ?><br />
                                                                    <?php carryTeam($val['user_id'], $con); ?>
                                                                </p>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                        </div>
                                                        <div class="gritter-bottom">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- //BINARY TOOLTIP -->
                                                <img <?php if ($val['topup_flag'] == 1) {
                                                    echo "src='assets/img/silver.png'";
                                                } else {
                                                    echo "src='assets/img/0.JPG'";
                                                } ?>
                                                    class="img-circle img-responsive">
                                                <h4 class="text-center"><a target="_parent"
                                                        href="../treeStructure?userId=<?php echo $val['user_id']; ?>">
                                                        <?php echo $val['user_id']; ?></a></h4>
                                            </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-xs-6 ">
                                        <div style="width: 80px; height: auto; position : relative;background-color: transparent;margin-top: 10px;"
                                            class="center-block binary-item">
                                            <img src="assets/img/inactive-user.jpg" class="img-circle img-responsive ">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- //Child level 3 -->
                </div>
                <!-- //Binery Tree -->
            </div>
        </div>
    </div>
    </div>
    <!-- //Panel -->
    <!-- end row -->
</body>

</html>
<?php include '../../close-connection.php'; ?>