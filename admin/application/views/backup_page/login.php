<?php
if (isset($_SESSION['admin'])) {
  header("location:" . base_url . "Users/home");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $data['0']; ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo site_url; ?>/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo site_url; ?>/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?php echo site_url; ?>/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo site_url; ?>/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form method="post">
                <div class="form-group">
                  <label>Email *</label>
                  <input type="text" name="email" value="<?php if (isset($_COOCKIE['email'])) {
                                                            echo $_COOCKIE['email'];
                                                          } ?>" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" name="password" value="<?php if (isset($_COOCKIE['password'])) {
                                                                  echo $_COOCKIE['password'];
                                                                } ?>" class="form-control p_input">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" name="remember" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary btn-block enter-btn" name="login" value="Login">
                </div>
                <!-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> -->
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo site_url; ?>/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo site_url; ?>/js/off-canvas.js"></script>
  <script src="<?php echo site_url; ?>/js/hoverable-collapse.js"></script>
  <script src="<?php echo site_url; ?>/js/misc.js"></script>
  <script src="<?php echo site_url; ?>/js/settings.js"></script>
  <script src="<?php echo site_url; ?>/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>