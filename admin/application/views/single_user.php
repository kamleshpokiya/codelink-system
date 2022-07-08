<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User detail</h4>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="form-sample">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <img class="img-xs rounded-circle" style="height:100px; width:100px;" src="<?php echo site_url; ?>images/users/<?php echo $key->profile_pic; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo $key->first_name . ' ' . $key->last_name; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Role As</label>
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" value="<?php echo $key->email; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
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
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" value="<?php echo $key->dob; ?>" placeholder="dd/mm/yyyy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo  $key->contact; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alt Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo $key->alt_contact; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="text" class="form-control" cols="50" rows="4"><?php echo $key->address; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">user Credits</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="user_status" value="<?php if ($key->total_credits == "") {
                                                                                                    echo "12";
                                                                                                } else {
                                                                                                    echo $key->total_credits;
                                                                                                } ?>" class="form-control" />
                                            </div>
                                        </div>
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