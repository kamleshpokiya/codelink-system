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
                    <th>Total Time</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($data['users'])) {
                    $records = array_values($data['users']);
                    // echo '<pre>';
                    // print_r($records);
                    // die;
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
                        <td> <?php
                              $hours = 0;
                              $minutes = 0;
                              $seconds = 0;
                              $in = $key->time_in;
                              $out = $key->time_out;
                              $time1 = new DateTime($in);
                              $time2 = new DateTime($out);
                              $time_diff = $time1->diff($time2);
                              $hours = $time_diff->h;
                              $minutes = $time_diff->i;
                              $seconds = $time_diff->s;
                              if ($hours < 9) {
                                $hours =  '0' . $hours;
                              }
                              if ($minutes < 9) {
                                $minutes =  '0' . $minutes;
                              }
                              if ($seconds < 9) {
                                $seconds =  '0' . $seconds;
                              }
                              if ($hours && $minutes && $seconds != '00') {
                                echo $hours . ' : ' . $minutes . ' : ' . $seconds;
                              } else {
                                echo '--';
                              }
                              ?></td>
                        <td><button type='button' class="btn btn-outline-secondary btn-icon-text show_user_inout_onThisDate data-bs-toggle='modal' data-bs-target='#exampleModal'" id="user_inout_onThisDate" value='<?php echo json_encode($key->id); ?>'> View <i class='mdi mdi-file-check btn-icon-append'></i>
                          </button></td>
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
    $(document).on('click', '.show_user_inout_onThisDate', function() {
      $content = '';
      $heading = 'j';
      $data = $(this).val();
		  // console.log($data);
      $.ajax({
        url: "<?php echo base_url; ?>user_check_inout/user_time_details/",
        type: 'post',
        data: ({id : $data}),
        // processData: false,
        // contentType: false,
        success: function(response) {
          
        }

      });

      // $recode = JSON.parse($date);
      // $content += "<table class='table'>"
      // $content += "<thead >";
      // $content += "<tr>";
      // $content += "<th>s</th>";
      // $content += "<th>Date</th>";
      // $content += "</thead>";
      // $content += "<tbody>";
      // // $content += '<td>' + $recode['comments'] + '</td>';
      // // $content += '<td>' + $recode['date'] + '</td>';
      // $content += "</tbody>";
      // $content += "</table>";
      // $('#exampleModalLabel').text($heading);
      // $(".myModal_content").html($content);
      // $("#myModal").modal('show');
    })
  </script>