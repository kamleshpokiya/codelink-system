<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <?php
            if (isset($_SESSION['user_msg']) && $_SESSION != '') {
            ?>
              <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['user_msg']; ?>
              </div>
            <?php
              unset($_SESSION['user_msg']);
            }
            ?>
            <h4 class="card-title">Users Table</h4>
            <a href="<?php echo base_url; ?>users/add_users"><button class="btn btn-warning btn-fw" style="position:absolute; top:5%; right:40px;" id="adduser">Add User</button></a>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </th>
                    <th>SR No.</th>
                    <th>Full name</th>
                    <th>Time - In</th>
                    <th>Time - Out </th>
                    <th>Total ( Hours )</th>
                    <th>Date</th>
                    <th>chaked in/out</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($data['data'])) {
                    $records = array_values($data['data']);
                    foreach ($records as $key) {
                  ?>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td><?php echo $key->id; ?></td>
                        <td><?php echo $key->first_name . '  ' . $key->last_name; ?></td>
                        <td><?php echo $key->email; ?></td>
                        <td><img class="img-xs rounded-circle" style="height:35px; width:35px;" src="<?php echo site_url; ?>images/users/<?php echo $key->profile_pic; ?>" alt="<?php echo $key->first_name; ?>"></td>
                        <td><?php if ($key->role_as == 1) {
                              echo "HR";
                            } elseif ($key->role_as == 2) {
                              echo "Team Leader";
                            } else {
                              echo "Employee";
                            } ?></td>
                        <td>
                          <a href="<?php echo base_url; ?>users/single_user/<?php echo $key->id; ?>"><button type="button" class="btn btn-info btn-icon-text">
                              <i class="mdi mdi-view-grid"></i> View </button></a>
                        </td>
                        <td>
                          <a href="<?php echo base_url; ?>users/edit_single_user/<?php echo $key->id; ?>"><button type="button" class="btn btn-primary btn-icon-text">
                              <i class="mdi mdi-lead-pencil"></i> Edit </button></a>
                        </td>
                        <td>
                          <button type="button" class="btn btn-danger btn-icon-text" id="<?php echo $key->id; ?>" onclick="del(this.id)">
                            <i class="mdi mdi-delete"></i> Delete </button>
                        </td>
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
  <script>
    function del(s) {
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Record",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: "post",
              url: "<?php echo base_url; ?>users/delete_user",
              data: {
                "did": s
              },
              success: function(data) {
                swal("Data deleted successfully.!", {
                  icon: "success",
                }).then((result) => {
                  location.reload();
                });
              }
            });

          }
        });

    }
  </script>
  <!-- content-wrapper ends -->