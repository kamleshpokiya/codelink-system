<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-12 grid-margin">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">User Leaves</h4>
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th> SR No.</th>
                              <th> Employee name</th>
                              <th> Leave type</th>
                              <th> (After/Before) Leave </th>
                              <th> Description</th>
                              <th> Credit leave</th>
                              <th> Extra leave</th>
                              <th> From Date</th>
                              <th> To date</th>
                              <th> Admin reason</th>
                              <th> Status</th>
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
                                    <td><?php echo $key->id; ?></td>
                                    <td><?php echo $key->first_name; ?></td>
                                    <td><?php echo $key->leave_type; ?></td>
                                    <td><?php echo $key->after_before_leave; ?></td>
                                    <td><?php echo $key->leave_desc; ?></td>
                                    <td><?php echo $key->credit_leave; ?></td>
                                    <td><?php echo $key->extra_leave; ?></td>
                                    <td><?php echo $key->from_date; ?></td>
                                    <td><?php echo $key->to_date; ?></td>
                                    <td><?php echo $key->admin_reason; ?></td>
                                    <td><?php echo $key->status; ?></td>
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