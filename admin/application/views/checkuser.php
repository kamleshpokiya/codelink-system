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
                    <th>User Holiday</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Send Massege</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($data['users'])) {
                    $records = array_values($data['users']);

                    foreach ($records as $k =>$key) {
                      $time1 = new DateTime($key->time_in);
                            $time2 = new DateTime($key->time_out);
                            $time_diff = $time1->diff($time2);
                            $hours = $time_diff->h;
                            $minutes = $time_diff->i;
                            $seconds = $time_diff->s;

                        if(!$key->leave_type == null){
                          if($key->leave_type == 1){
                            $leave_type ="<div class='badge badge-outline-warning'>Half Day</div>";
                          }else {
                          $leave_type ="<div class='badge badge-outline-danger'>Full Day</div>";
                          }
                        }else{
                          $leave_type ="<div class='badge badge-outline-success'>No leave</div>";
                        }
                  ?>
                      <tr>
                        <td>
                          <div class="form-check form-check-muted m-0">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input">
                            </label>
                          </div>
                        </td>
                        <td><?php echo $k+1; ?></td>
                        <td><?php echo $key->first_name . '  ' . $key->last_name; ?></td>
                        <td><?php if($key->time_in == null){echo "<div class='badge badge-outline-danger'>Not Check In</div>";}else{echo "$key->time_in";}?></td>
                        <td><?php if($key->time_out == null){echo "<div class='badge badge-outline-danger'>Not Check out</div>";}else{echo "$key->time_out";}?></td>
                        <td><?php if($key->time_in == null){echo '-';}else{echo "$hours:$minutes:$seconds Hours";}?></td>
                        <td><?php echo $leave_type; ?></td>
                        <td><?php if($key->leave_from == null){echo "<div class='badge badge-outline-danger'>not apllied</div>";}else{echo "$key->leave_from";}?></td>
                        <td><?php if($key->leave_to == null){echo "<div class='badge badge-outline-danger'>not apllied</div>";}else{echo "$key->leave_to";}?></td>
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