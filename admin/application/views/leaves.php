<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">User Leaves</h4>
                  <div class="table-responsive">
                     <table class="mytable table">
                        <thead>
                           <tr>
                              <th> Employee name</th>
                              <th> Leave type</th>
                              <th> (After/Before) launch Leave </th>
                              <th> Leave Subject</th>
                              <th> Credit leave</th>
                              <th> Non-credit leave</th>
                              <th> Total leave</th>
                              <th> From Date</th>
                              <th> To date</th>
                              <th> Admin reason</th>
                              <th> Status</th>
                              <th> Date</th>
                              <th> Edit </th>
                              <th> Delete </th>
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
                                    <td><?php if($key->leave_type == 1){echo "fullday";}else{echo "halfday";} ?></td>
                                    <td><?php if($key->half_leave_type == 1){echo "pre-lunch";}elseif($key->half_leave_type == 2){echo "post-lunch";}else{echo "-";} ?></td>
                                    <td><?php echo $key->leave_subject; ?></td>
                                    <td><?php echo $key->from_credit; ?></td>
                                    <td><?php echo $key->from_non_credit; ?></td>
                                    <td><?php echo $key->total; ?></td>
                                    <td><?php echo $key->leave_from; ?></td>
                                    <td><?php echo $key->leave_to; ?></td>
                                    <td><?php echo $key->comments; ?></td>
                                    <td><?php if($key->status == 1){echo "Approved";}elseif($key->status == 2){echo "Declined";}else{echo "Pending";} ?></td>
                                    <td><?php echo $key->date; ?></td>
                                    <td>
                                       <a href="<?php echo base_url; ?>Leaves/approve_leave/<?php echo $key->id; ?>"><button type="button" class="btn btn-info btn-icon-text">
                                             <i class="mdi mdi-view-grid"></i> Approve </button></a>
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
         $.ajax({
            type: "post",
            url: "<?php echo base_url; ?>Leaves/delete_leaves",
            data: {
               "did": s
            },
            success: function(data) {
               location.reload();
            }
         });
      }
   </script>
   <!-- content-wrapper ends -->