<?php
require_once 'loginCheck.php';
require_once 'include/header.php';
 require_once 'include/head.php'; 
?>


<body>
  <div class="wrapper">
    <?php
    require_once 'include/menu.php';
    ?>
    <div id="content">
      <?php
      require_once 'include/nav.php'; ?>
      <div class="main-box">
        <div class="BankDetails">
          <h4>Login Password Update</h4>
          <div class="box">
            <form class="form theme-form" action="userProfileAuthProcess" method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Current Login Password *</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" id="currentPass"
                          placeholder="Current Login Password">
                        <input type="hidden" name="memberId" value="<?= $memberId ?>">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">New Login Password *</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="loginPassword" name="password1"
                          placeholder="Enter Password"
                          onkeyup="matchPassword('loginPassword','confirmLoginPassword','loginPasswordErrorMsg','loginJoin')"
                          name="password1">
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Retype Login Password *</label>
                      <div class="col-sm-6">
                        <input type="password" class="form-control" id="confirmLoginPassword" name="password2"
                          placeholder="Confirm Password"
                          onkeyup="matchPassword('loginPassword','confirmLoginPassword','loginPasswordErrorMsg','loginJoin')"
                          name="password2">
                        <span id="loginPasswordErrorMsg" class="text-danger"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <button type="submit" name="changeLogin" id="submit" class="btn btn-primary me-2">Save
                  changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php
  require_once 'include/footer.php'; ?>


</body>
</html>