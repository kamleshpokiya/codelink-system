<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">User Leaves</h4>
                  <div class="table-responsive">
                     <?php $permission = $data['recode'];?>
                     <table class="table">
                        <thead>
                           <tr>
                              <th> Employee name</th>
                              <th> Leave type</th>
                              <th> Pre/Post Leave </th>
                              <th> Leave Subject</th>
                              <th> Credit</th>
                              <th> Non-credit</th>
                              <th> Total</th>
                              <th> From Date</th>
                              <th> To date</th>
                              <!-- <th> Admin reason</th> -->
                              <th> Status</th>
                              <th> View More</th>
                              <!-- <th> Date</th> -->
                              <?php if(in_array('2', $permission)){  ?>
                              <th> Edit </th>
                              <?php }?>
                              <?php if(in_array('3', $permission)){  ?>
                              <th> Delete </th>
                              <?php }?>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           if (!empty($data['data'])) {
                              $records = array_values($data['data']);
                              foreach ($records as $key) {
                           ?>
                                 <tr>
                                    <td><?php echo $key->first_name; ?></td>
                                    <td><?php if ($key->leave_type == 1) {
                                             echo "fullday";
                                          } else {
                                             echo "halfday";
                                          } ?></td>
                                    <td><?php if ($key->half_leave_type == 1) {
                                             echo "pre-lunch";
                                          } elseif ($key->half_leave_type == 2) {
                                             echo "post-lunch";
                                          } else {
                                             echo "-";
                                          } ?></td>
                                    <td><?php echo $key->leave_subject; ?></td>
                                    <td><?php echo $key->from_credit; ?></td>
                                    <td><?php echo $key->from_non_credit; ?></td>
                                    <td><?php echo $key->total = $key->from_credit+$key->from_non_credit; ?></td>
                                    <td><?php echo $key->leave_from; ?></td>
                                    <td><?php echo $key->leave_to; ?></td>
                                    <td><?php if ($key->status == 1) {
                                             echo "Approved";
                                          } elseif ($key->status == 2) {
                                             echo "Declined";
                                          } else {
                                             echo "Pending";
                                          } ?></td>
                                    <td><button type='button' class="btn btn-outline-secondary btn-icon-text show_user_inout_onThisDate data-bs-toggle='modal' data-bs-target='#exampleModal'" id="user_inout_onThisDate" value='<?php echo json_encode($key); ?>'> View <i class='mdi mdi-file-check btn-icon-append'></i>
                            </button></td>
                                    <?php if(in_array('2', $permission)){  ?>
                                       <td>
                                       <a href="<?php echo base_url; ?>leaves/approve_leave/<?php echo $key->id; ?>"><button type="button" class="btn btn-info btn-icon-text">
                                             <i class="mdi mdi-view-grid"></i> Approve </button></a>
                                    </td>
                                    <?php }?>
                                    <?php if(in_array('3', $permission)){  ?>
                                       <td>
                                       <button type="button" class="btn btn-danger btn-icon-text" id="<?php echo $key->id; ?>" onclick="del(this.id)">
                                          <i class="mdi mdi-delete"></i> Delete </button>
                                    </td>
                                    <?php }?>
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
              url: "<?php echo base_url; ?>leaves/delete_leaves",
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
    $(document).on('click', '.show_user_inout_onThisDate', function() {
            $content = '';
            $heading = 'Leaves information';
            $date = $(this).val();
            $recode = JSON.parse($date);
            $content += "<table class='table'>"
            $content += "<thead >";
            $content += "<tr>";
            $content += "<th>Admin reason</th>";
            $content += "<th>Date</th>";
            $content += "</thead>";
            $content += "<tbody>";
                $content += '<td>' + $recode['comments'] + '</td>';
                $content += '<td>' + $recode['date'] + '</td>';
            $content += "</tbody>";
            $content += "</table>";
            $('#exampleModalLabel').text($heading);
            $(".myModal_content").html($content);
            $("#myModal").modal('show');
        })
  </script>
   <!-- content-wrapper ends -->