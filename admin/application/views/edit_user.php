<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="form-sample" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <img class="img-xs rounded-circle" style="height:100px; width:100px;" src="<?php echo site_url; ?>images/users/<?php echo $key->profile_pic; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
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
                                            <label class="col-sm-3 col-form-label">User Type</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php if ($key->role_as == 1) {
                                                                                echo "HR";
                                                                            } elseif ($key->role_as == 2) {
                                                                                echo "Team Leader";
                                                                            } else {
                                                                                echo "Employees";
                                                                            } ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" value="<?php echo $key->email; ?>" class="form-control" />
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
                                                <input type="text" class="form-control" value="<?php echo $key->dob; ?>" placeholder="dd/mm/yyyy" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo  $key->contact; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alt_contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo $key->alt_contact; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="address" class="form-control" cols="50" rows="4"><?php echo  $key->address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Joining date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="modify_date" value="<?php $date = $key->created_on;
                                                                                                echo date("d-D-m-Y", strtotime($date)); ?>" class="form-control" />
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
    </div>
    <!-- content-wrapper ends -->