   <?php require_once 'include/head.php'; ?>
<body>
    <div class="wrapper">
        <?php
        require_once 'loginCheck.php';
require_once 'include/menu.php';
require_once 'include/header.php';

?>

        <div id="content">
            <?php require_once 'include/nav.php'; ?>

            <?php
    $queryProfile = mysqli_query($con, "SELECT date_time,sponser_id,countryId,name,user_id,email_id,phone FROM sub_admin_user_details WHERE user_id='$userId'");
$valProfile = mysqli_fetch_assoc($queryProfile);
$dateTime = $valProfile['date_time'];
$sponserId = $valProfile['sponser_id'];
$countryId = $valProfile['countryId'];
$name = $valProfile['name'];
$email_id = $valProfile['email_id'];
$phone = $valProfile['phone'];

if ($countryId != '') {
    $queryCountry = mysqli_query($con, "SELECT countryName FROM config_country_list WHERE country_id='$countryId'");
    $valCountry = mysqli_fetch_assoc($queryCountry);
    $countryName = $valCountry['countryName'];
} ?>

            <div class="main-box">
                <div class="BankDetails">
                    <h4>My Profile</h4>
                    <div class="box">
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <img src="assets/images/no_image.jpg" class="img-fluid profile_pic" />
                                <p>&nbsp;</p>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="card mb-4">
                                <div class="card-body pt-2 mt-1">
                                    <form action="userProfileAuthProcess" method="POST">
                                        <div class="row mt-2 gy-4">
                                            <div class="col-md-6">
                                                <label for="firstName">Name</label>
                                                <input class="form-control" type="text" id="firstName" name="name"
                                                    value="<?php echo $userName; ?>" required autofocus />
                                                <input type="hidden" name="memberId" value="<?php echo $memberId; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email">E-mail</label>
                                                <input class="form-control" type="email" id="email" name="emailId"
                                                    value="<?php echo $email_id; ?>" <?php if ($email_id != '') {
                                                        echo '';
                                                    } ?> required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phoneNumber">Phone Number</label>
                                                    <input class="form-control" type="text" id="phoneNumber" name="phone"
                                                        value="<?php echo $phone; ?>" <?php if ($phone != '') {
                                                            echo '';
                                                        } ?> onkeypress="return
                                                                onlynum(event)" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Country*</label>
                                                    <select class="form-control" required id="M_COUNTRY" name="countryId">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        $queryCountry = 'SELECT * FROM config_country_list WHERE status=1 ORDER BY countryName ASC';
$resultCountry = mysqli_query($con, $queryCountry);
while ($valCountry = mysqli_fetch_assoc($resultCountry)) { ?>
                                                        <option value="<?php echo $valCountry['country_id']; ?>"
                                                            <?php echo ($valCountry['country_id'] == $countryId) ? 'selected' : ''; ?>>
                                                            <?php echo $valCountry['countryName']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"  name="profileUpdate" id="submit" class="btn btn-primary me-2">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <?php require_once 'include/footer.php'; ?>
        </div>
    </div>
</body>

</html>