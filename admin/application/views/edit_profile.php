<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['status']) && $_SESSION != '') {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                        </div>
                        
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <h4 class="card-title">Admin Profile</h4>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="form-sample" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <img class="img-xs rounded-circle" style="height:100px; width:100px;" src="<?php echo site_url; ?>images/admin/<?php echo $key->profile_pic; ?>" alt="">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <input type="hidden" name="profile_pic_old" value="<?php echo $key->profile_pic; ?>" class="form-control file-upload-info" placeholder="Upload admin pic">
                                                <input type="file" name="profile_pic" class="form-control file-upload-info" placeholder="Upload admin pic">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="id" value="<?php echo $key->id; ?>" class="form-control" />
                                                <input type="text" name="first_name" value="<?php echo $key->first_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="last_name" value="<?php echo $key->last_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="male" <?php if (isset($key->gender) && $key->gender == 'male') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>> Male</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="female" <?php if (isset($key->gender) && $key->gender == 'female') {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>> Female </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="dob" value="<?php echo $key->dob; ?>" placeholder="dd/mm/yyyy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="update" class="btn btn-info btn-icon-text">
                                    <i class="mdi mdi-lead-pencil"></i>update</button>
                            </form>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['change_status']) && $_SESSION != '') {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['change_status']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['change_status']);
                    }
                    ?>
                    <h4 class="card-title">Change Password</h4>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="form-sample" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Enter old password</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="pass" value="<?php echo $key->password; ?>" class="form-control" />
                                                <input type="text" name="old_password" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Enter new password</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="password" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Reenter password</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cnf_password" class="form-control" />
                                            </div>
                                        </div>
                                        <button type="submit" name="changepassword" class="btn btn-info btn-icon-text">
                                            <i class="mdi mdi-lead-pencil"></i>Change Password</button>
                                    </div>
                                </div>
                            </form>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->