    <div class="card-body">
      <button type="button" class="btn btn-inverse-primary btn-fw" style="    margin-right: 30px;
    padding: 14px 0px;"><a href="<?php echo base_url; ?>Leave/applyLeave" style="color:white; text-decoration:none;">Apply For Leave</a></button>
      <div class="table-responsive" style="margin-top: 40px;">
        <h4 class="card-title">My Leaves</h4>
        <table class="table">
          <thead>
            <tr>
              <th>Sno.</th>
              <th>( Full | Half ) Day</th>
              <th>( Pre | Post ) Lunch</th>
              <th>From</th>
              <th>To</th>
              <th>Credit</th>
              <th>Non - Credit</th>
              <th>Total Leave</th>
              <th>Subject</th>
              <th>Status</th>
              <th>Comments</th>
              <th>Applied Date</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($data['leaves'])) {
              if (sizeof($data['leaves']) > 0) {
                foreach ($data['leaves'] as $key => $value) { ?>
                  <tr>
                    <td><?php if (isset($value)) {
                          echo $key + 1;
                        } ?></td>
                    <td><?php if (isset($value['leave_type'])) {
                          if ($value['leave_type'] == 1) {
                            echo 'Full Day';
                          } else if ($value['leave_type'] == 2) {
                            echo 'Half Day';
                          }
                        } ?></td>
                    <td><?php if (isset($value['half_leave_type'])) {
                          if ($value['half_leave_type'] == 1) {
                            echo 'Pre Lunch';
                          } else if ($value['half_leave_type'] == 2) {
                            echo 'Post Lunch';
                          }
                        } ?></td>
                    <td><?php if (isset($value['leave_from'])) {
                          echo $value['leave_from'];
                        } ?></td>
                    <td><?php if (isset($value['leave_to'])) {
                          echo $value['leave_to'];
                        } ?></td>
                    <td><?php if (isset($value['from_credit'])) {
                          echo $value['from_credit'];
                        } ?></td>
                    <td><?php if (isset($value['from_non_credit'])) {
                          echo $value['from_non_credit'];
                        } ?></td>
                    <td><?php if (isset($value['from_credit'])) {
                          echo $value['from_credit'] + $value['from_non_credit'];
                        } ?></td>
                    <!-- <td><?php echo $value['leave_subject'] ?></td> -->
                    <td>
                      <button type="button" class="btn btn-outline-secondary btn-icon-text view_user_comments  data-bs-toggle='modal' data-bs-target='#exampleModal'"><?php if (isset($value['from_credit'])) {
                                                                                                                                                                        echo 'View';
                                                                                                                                                                      } ?> <i class="mdi mdi-file-check btn-icon-append"></i>
                        <span hidden><?php if (isset($value['leave_subject'])) {
                                        echo $value['leave_subject'];
                                      } ?></span></button>
                    </td>
                    <td><label style="width: 120px;" class=" badge badge-<?php if (isset($value['status'])) {
                                                                            if ($value['status'] == 0) {
                                                                              echo 'primary';
                                                                            } elseif ($value['status'] == 1) {
                                                                              echo 'success';
                                                                            } else if ($value['status'] == 2) {
                                                                              echo 'danger';
                                                                            } ?>"><?php if ($value['status'] == 0) {
                                                                                  echo 'Pending';
                                                                                } elseif ($value['status'] == 1) {
                                                                                  echo 'Approved';
                                                                                } else if ($value['status'] == 2) {
                                                                                  echo 'Declined';
                                                                                }
                                                                              } ?></td>
                    <td><button type="button" class="btn btn-outline-secondary btn-icon-text view_admin_comments data-bs-toggle='modal' data-bs-target='#exampleModal'"><?php echo 'View'; ?> <i class="mdi mdi-file-check btn-icon-append"></i>
                        <span hidden><?php if (isset($value['comments'])) {
                                        echo $value['comments'];
                                      } ?></span></button></td>
                    <td><?php echo $value['date']; ?></td>
                  </tr>
            <?php  }
              }
            } ?>

          </tbody>
        </table>
      </div>
    </div>