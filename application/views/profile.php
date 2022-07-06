<!-- profile page  -->
<div class="page-header" id="profile_head">
  <h3 class="page-title"> my profile </h3>
</div>
<div class="" id="update_msg" style="display: block;">

</div>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"></h4>
        <p class="card-description"> </p>
        <form class="forms-sample" id="update_form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputUsername1">First Name</label>
            <input type="hidden" class="form-control" id="user_id" name='user_id' value="<?php echo  $data['users']['id'] ?>">
            <input type="text" class="form-control" id="first_name" value="<?php if (isset($data['users']['first_name'])) {
                                                                              echo  $data['users']['first_name'];
                                                                            } ?>">
            <span id="first_name_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputUsername1">Last Name</label>
            <input type="text" class="form-control" id="last_name" value="<?php if (isset($data['users']['last_name'])) {
                                                                            echo   $data['users']['last_name'];
                                                                          }  ?>">
            <span id="last_name_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" value="<?php if (isset($data['users']['email'])) {
                                                                          echo  $data['users']['email'];
                                                                        }   ?>">
            <span id="email_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Date of Birth</label>
            <input type="date" class="form-control" id="dob" value="<?php if (isset($data['users']['dob'])) {
                                                                      echo  $data['users']['dob'];
                                                                    }  ?>">
            <span id="dob_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">My Contact</label>
            <input type="text" class="form-control" id="contact" value="<?php if (isset($data['users']['contact'])) {
                                                                          echo $data['users']['contact'];
                                                                        } ?>">
            <span id="contact_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alt. Contact</label>
            <input type="text" class="form-control" id="alt_contact" value="<?php if (isset($data['users']['alt_contact'])) {
                                                                              echo  $data['users']['alt_contact'];
                                                                            }   ?>">
            <span id="alt_contact_msg"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" id="address" value="<?php if (isset($data['users']['address'])) {
                                                                          echo  $data['users']['address'];
                                                                        }   ?>">
            <span id="address_msg"></span>
          </div>

          <div class="form-group" style="    margin: 40px auto;">
            <span> Role as : <span style="color: white;
    padding: 7px 25px;
    margin: 0px 7px;
    border-radius: 15px;
    background-color: black;"><?php if (isset($data['users']['role_as'])) {
                                if ($data['users']['role_as'] == 1) {
                                  echo 'HR';
                                } elseif ($data['users']['role_as'] == 2) {
                                  echo 'Team Leader';
                                } elseif ($data['users']['role_as'] == 3) {
                                  echo 'User';
                                }
                              } ?></span></span>
            <span> Credit Leaves : <span style="    color: white;
    padding: 8px 30px;
    margin: 0px 7px;
    border-radius: 15px;
    background-color: black;"><?php if (isset($data['users']['credits'])) {
                                echo   $data['users']['credits'];
                              }  ?></span></span>

          </div>


          <!-- </form> -->
      </div>
    </div>
  </div>
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <img style="height: 160px; display: block; width: 160px; border-radius: 10%; margin: auto" src="<?php if (isset($data['users']['profile_pic'])) {
                                                                                                            if ($data['users']['profile_pic'] == '' && $data['users']['profile_pic'] == NULL) {
                                                                                                              echo site_url . 'images/carousel/profile_default.png';
                                                                                                            } else {
                                                                                                              echo site_url . 'images/carousel/' . $data['users']['profile_pic'];
                                                                                                            }
                                                                                                          } else {
                                                                                                            echo site_url . 'images/carousel/profile_default.png';
                                                                                                          }
                                                                                                          ?>">
          <div class="form-group" style="    margin: 20px auto;">
            <i class="mdi mdi-grease-pencil" style="margin: 0px 50%; cursor:pointer;" id="open_file_input"></i>
          </div>

        </div>

        <div class="form-group file_toggle" style="display : none;">
          <label for="exampleInputPassword1" id="file_label">Choose Photo</label>
          <input type="file" class="form-control" style="height: calc(2.25rem + 0.7px);" id="profile_pic" value="">
          <span id="img_msg"></span>
        </div>

        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label" id="change_pasd_label">
              <input type="checkbox" class="form-check-input" id="change_pswd"> Change Password</label><span id="pswd_msg"></span>
          </div>
        </div>
        <div class="form-group toggle" style="display: none;">
          <label for="exampleInputUsername1">Old Password</label>
          <input type="password" class="form-control" id="old_pass">
          <span id="password_msg"></span>
        </div>
        <div class="form-group toggle" style="display: none;">
          <label for="exampleInputUsername1">New Password</label>
          <input type="password" class="form-control" id="update_new_pass">
          <span id="password_msg"></span>
        </div>
        <div class="form-group toggle" style="display: none;">
          <label for="exampleInputUsername1">Confirm Password</label>
          <input type="password" class="form-control" id="update_confirm_pass">
        </div>

        <button type="button" class="btn btn-outline-primary btn-fw" name="update" id="update">Save</button>
        <button type="reset" class="btn btn-outline-danger btn-fw">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>