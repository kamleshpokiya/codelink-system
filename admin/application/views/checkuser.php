<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Users Checked in/out Table </h3>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>SR No.</th>
                    <th>Users Status</th>
                    <th>Full name</th>
                    <th>Time - In</th>
                    <th>Time - Out </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($data['users'])) {
                    $records = array_values($data['users']);
                    foreach ($records as $k => $key) {
                      if ($key->time_in == null) {
                        $avatar_sigin = 'checked_out.png';
                      } else {
                        $avatar_sigin = 'checked_in.png';
                      }
                  ?>
                      <tr>
                        <td><?php echo $k + 1; ?></td>
                        <td>
                          <div class='avatar-wrap'>
                            <img class="img-xs rounded-circle" style="height:100%; width:100%; border-radius: 50%;" src="<?php echo site_url; ?>images/users/<?php echo $key->profile_pic; ?>" alt="<?php echo $key->first_name; ?>" onerror="this.onerror=null;this.src='<?php echo site_url; ?>images/users/default_img.png'">
                            <img class="avatar_cross_img" style="height:15px; width:15px;" src="<?php echo site_url; ?>images/<?php echo $avatar_sigin; ?>" alt="">
                          </div>
                        </td>
                        <td><?php echo $key->first_name . '  ' . $key->last_name; ?></td>
                        <td><?php if ($key->time_in == null) {
                              echo "--";
                            } else {
                              echo "$key->time_in";
                            } ?></td>
                        <td><?php if ($key->time_out == null) {
                              echo "--";
                            } else {
                              echo "$key->time_out";
                            } ?></td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?> <tr>
                      <td style="color:white; font-size:large;">No record found</td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>