<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url; ?>Holiday/add_holidays"><button class="btn btn-warning btn-fw" style="position:absolute; top:30%; right:40px;" id="adduser" class="card-title">Add Holiday</button></a>
                        <h4 class="card-title">Holidays</h4>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Srno.</th>
                                        <th> Date</th>
                                        <th> Title </th>
                                        <th> Description</th>
                                        <th> Image</th>
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
                                                <td><?php echo $key->date; ?></td>
                                                <td><?php echo $key->title; ?></td>
                                                <td><?php echo $key->description; ?></td>
                                                <td><img class="img-xs rounded-circle" style="height:100px; width:200px; border-radius: 5% !important;" src="<?php echo site_url; ?>images/holiday_img/<?php echo $key->image; ?>" alt="<?php echo $key->image; ?>"></td>
                                                <td>
                                                    <a href="<?php echo base_url; ?>Holiday/edit_holidays/<?php echo $key->id; ?>"><button type="button" class="btn btn-info btn-icon-text">
                                                            <i class="mdi mdi-view-grid"></i> Edit </button></a>
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
                url: "<?php echo base_url; ?>Holiday/delete_holidays",
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