<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                    </div>
                    <h4 class="card-title">User detail</h4>
                    <?php
                    if (isset($data['user_info'])) {
                        echo $data['user_info']['user_info'];
                    }
                    ?>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="form-sample" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <img class="img-xs rounded-circle" style="height:100px; width:100px;" src="<?php echo site_url; ?>images/users/<?php echo $key->profile_pic; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Profile Photo</label>
                                            <div class="col-sm-2">
                                                <input type="file" id="profile_pic">
                                                <span id="photo_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="first_name" value="<?php echo $key->first_name; ?>" class="form-control" />
                                                <span id="first_name_msg"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="last_name" class="form-control" value="<?php echo $key->last_name; ?>" placeholder="dd/mm/yyyy" />
                                                <span id="last_name_msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" id="email" value="<?php echo $key->email; ?>" class="form-control" />
                                                <span id="email_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" value="<?php echo $key->password; ?>" class="form-control" />
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="male" <?php if (isset($key->gender) && $key->gender == 'male') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>> Male</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="gender" id="gender" value="female" <?php if (isset($key->gender) && $key->gender == 'female') {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>> Female </label>
                                                </div>
                                            </div>
                                            <span id="gender_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="date" id="dob" class="form-control" value="<?php echo $key->dob; ?>" placeholder="dd/mm/yyyy" />
                                                <span id="dob_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Role As</label>
                                            <div class="col-sm-9">
                                                <select name="role_as" id="role_as">
                                                    <option value="1" <?php if ($key->role_as == 1) {
                                                                            echo "selected";
                                                                        } ?>>HR</option>
                                                    <option value="2" <?php if ($key->role_as == 2) {
                                                                            echo "selected";
                                                                        } ?>>Team Leader</option>
                                                    <option value="3" <?php if ($key->role_as == 3) {
                                                                            echo "selected";
                                                                        } ?>>Employee</option>
                                                </select>
                                                <span id="role_as_msg"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="contact" value="<?php echo  $key->contact; ?>" class="form-control" />
                                                <span id="contact_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Alt Contact</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="alt_contact" value="<?php echo $key->alt_contact; ?>" class="form-control" />
                                                <span id="alt_contact_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea id="address" class="form-control" cols="50" rows="4"><?php echo $key->address; ?></textarea>
                                                <span id="address_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group row">
                                        <button type="button" id="<?php echo $key->id; ?>" onclick="update_user(this.id)" name="edit_single_user" class="btn btn-info btn-icon-text">
                                            <i class="mdi mdi-view-grid"></i> Update </button>
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
<!-- Jquery start -->
<script>
    // For updating user profile
    function update_user($id) {
        // console.log($id);
        $is_valid = true;
        $first_name = $('#first_name').val();
        $last_name = $('#last_name').val();
        $email = $('#email').val();
        $gender = $("input[name='gender']:checked").val();
        $dob = $('#dob').val();
        $role_as = $('#role_as option:selected').val();
        $contact = $('#contact').val();
        $alt_contact = $('#alt_contact').val();
        $address = $('#address').val();

        // user profile validation

        // 1. First Name 
        if ($first_name == '') {
            $is_valid = false;
            $("input[id='first_name']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='first_name']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 2. Last Name 
        if ($last_name == '') {
            $is_valid = false;
            $("input[id='last_name']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='last_name']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 3. Last Name 
        if ($email == '') {
            $is_valid = false;
            $("input[id='email']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='email']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 4. Date of Birth 
        if ($dob == '') {
            $is_valid = false;
            $("input[id='dob']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='dob']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 5. Role As
        if ($role_as == '') {
            $is_valid = false;
            $("input[id='role_as']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='role_as']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 6. Contact
        if ($contact == '') {
            $is_valid = false;
            $("input[id='contact']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='contact']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 7. Alt Contact
        if ($alt_contact == '') {
            $is_valid = false;
            $("input[id='alt_contact']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='alt_contact']").css({
                'border': '1px solid #2a3038'
            });
        }

        // 7. Address
        if ($address == '') {
            $is_valid = false;
            $("input[id='address']").css({
                'border': '1px solid red'
            });
        } else {
            $("input[id='address']").css({
                'border': '1px solid #2a3038'
            });
        }

        if ($is_valid) {
            var fd = new FormData;
            fd.append('first_name', $first_name);
            fd.append('last_name', $last_name);
            fd.append('email', $email);
            fd.append('gender', $gender);
            fd.append('dob', $dob);
            fd.append('role_as', $role_as);
            fd.append('contact', $contact);
            fd.append('alt_contact', $alt_contact);
            fd.append('address', $address);
            fd.append('id', $id);

            if ($('#profile_pic').val() != '') {
                var file = $('#profile_pic')[0].files[0]
                if (file) {
                    fd.append('file', file);
                }
            }

            $.ajax({
                url: "<?php echo base_url; ?>Users/edit_user_profile",
                type: 'post',
                data: fd,
                processData: false,
                contentType: false,
                success: function(response) {

                    jsonResponse = JSON.parse(response);

                    // Profile Updated
                    if (jsonResponse.update_success) {
                        location.reload();
                    }

                    // First Name 
                    if (jsonResponse.req_first_name) {
                        $('#first_name_msg').text(jsonResponse.req_first_name).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.invalid_first_name) {
                        $('#first_name_msg').text(jsonResponse.invalid_first_name).css({
                            'color': 'red'
                        });
                    } else {
                        $('#first_name_msg').text('');
                    }

                    // Last Name
                    if (jsonResponse.req_last_name) {
                        $('#last_name_msg').text(jsonResponse.req_last_name).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.invalid_last_name) {
                        $('#last_name_msg').text(jsonResponse.invalid_last_name).css({
                            'color': 'red'
                        });
                    } else {
                        $('#last_name_msg').text('');
                    }


                    // Email 
                    if (jsonResponse.req_email) {
                        $('#email_msg').text(jsonResponse.req_email).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.invalid_email) {
                        $('#email_msg').text(jsonResponse.invalid_email).css({
                            'color': 'red'
                        });
                    } else {
                        $('#email_msg').text('');
                    }


                    // Gender
                    if (jsonResponse.req_gender) {
                        $('#gender_msg').text(jsonResponse.req_gender).css({
                            'color': 'red'
                        });
                    } else {
                        $('#gender_msg').text('');
                    }

                    // DOB
                    if (jsonResponse.req_dob) {
                        $('#dob_msg').text(jsonResponse.req_dob).css({
                            'color': 'red'
                        });
                    } else {
                        $('#dob_msg').text('');
                    }

                    // Role As
                    if (jsonResponse.req_role_as) {
                        $('#role_as_msg').text(jsonResponse.req_role_as).css({
                            'color': 'red'
                        });
                    } else {
                        $('#role_as_msg').text('');
                    }

                    // Contact
                    if (jsonResponse.req_contact) {
                        $('#contact_msg').text(jsonResponse.req_contact).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.invalid_contact) {
                        $('#contact_msg').text(jsonResponse.invalid_contact).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.limit_contact) {
                        $('#contact_msg').text(jsonResponse.limit_contact).css({
                            'color': 'red'
                        });
                    } else {
                        $('#contact_msg').text('');
                    }


                    // Alt Contact
                    if (jsonResponse.req_alt_contact) {
                        $('#alt_contact_msg').text(jsonResponse.req_alt_contact).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.invalid_alt_contact) {
                        $('#alt_contact_msg').text(jsonResponse.invalid_alt_contact).css({
                            'color': 'red'
                        });
                    } else if (jsonResponse.limit_alt_contact) {
                        $('#alt_contact_msg').text(jsonResponse.limit_alt_contact).css({
                            'color': 'red'
                        });
                    } else {
                        $('#alt_contact_msg').text('');
                    }

                    // Address 
                    if (jsonResponse.req_address) {
                        $('#address_msg').text(jsonResponse.req_address).css({
                            'color': 'red'
                        });
                    } else {
                        $('#address_msg').text('');
                    }

                    // Profile Picture 
                    if (jsonResponse.img_type_error) {
                        $('#photo_msg').text(jsonResponse.img_type_error).css({
                            'color': 'red'
                        });
                    }
                    if (jsonResponse.img_size_error) {
                        $('#photo_msg').text(jsonResponse.img_size_error).css({
                            'color': 'red'
                        });
                    } else {
                        $('#photo_msg').text('');
                    }

                }

            });
        }
    }
</script>