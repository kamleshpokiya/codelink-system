<?php
if (isset($_SESSION['admin'])) {
    header("location:" . base_url . "admin/home");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $data['title']; ?></title>
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
                            <?php
                            if (isset($_SESSION['error_msg']) && $_SESSION != '') {
                            ?>
                                <div class="alert alert-success " role="alert">
                                     <?php echo $_SESSION['error_msg']; ?>
                                </div>
                            <?php
                                unset($_SESSION['error_msg']);
                            }
                            ?>
                            <h3 class="card-title text-left mb-3">Reset Password</h3>
                            <form method="post">
                                <div class="form-group">
                                    <label>Enter New password </label>
                                    <input type="password" name="password" class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label>Enter Confirm password </label>
                                    <input type="password" name="cnf_password" class="form-control p_input">
                                </div>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-block enter-btn" name="setpassword" value="Update Password">
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