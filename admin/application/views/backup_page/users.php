<div class="main-panel">
  <div class="content-wrapper">
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Users Table</h4>
            <button class="btn btn-primary btn-fw" style="position:absolute ; top:10%; right: 30px;" data-toggle="modal" data-target="#add_user">Add User</button>

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
                    <th> SR No.</th>
                    <th> Full name</th>
                    <th> email</th>
                    <th> password </th>
                    <th> dob </th>
                    <th> contact </th>
                    <th> alt_contact </th>
                    <th> address </th>
                    <th> profile_pic </th>
                    <th> role_as </th>
                    <th> credit_leaves </th>
                    <th> extra_leaves </th>
                    <th> status </th>
                    <th> create_date </th>
                    <th> update_date </th>
                    <th> Edit </th>
                    <th> Delete </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $records = array_values($data['data']);
                  $c = count($records);
                  if ($c < 1) {
                  ?>
                    <tr>
                      <td>No Record is found</td>
                    </tr>
                    <?php
                  } else {
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
                        <td><?php echo $key->first_name . $key->last_name; ?></td>
                        <td><?php echo $key->email; ?></td>
                        <td><?php echo $key->password; ?></td>
                        <td><?php echo $key->dob; ?></td>
                        <td><?php echo $key->contact; ?></td>
                        <td><?php echo $key->alt_contact; ?></td>
                        <td><?php echo $key->address; ?></td>
                        <td><?php echo $key->profile_pic; ?></td>
                        <td><?php echo $key->role_as; ?></td>
                        <td><?php echo $key->credit_leave; ?></td>
                        <td><?php echo $key->extra_leave; ?></td>
                        <td><?php echo $key->is_deleted; ?></td>
                        <td><?php echo $key->created_on; ?></td>
                        <td><?php echo $key->updated_on; ?></td>
                        <td>
                          <button type="button" class="btn btn-danger btn-icon-text">
                            <i class="mdi mdi-lead-pencil"></i> Edit </button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-warning btn-icon-text">
                            <i class="mdi mdi-delete"></i> Delete </button>
                        </td>
            </div>

        <?php
                    }
                  }
        ?>
        </tr>
        </tbody>
        </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->