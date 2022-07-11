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
                                        <th> Admin name</th>
                                        <th> email</th>
                                        <th> profile_pic</th>
                                        <th>Date of Birth</th>
                                        <th> Edit </th>
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
                                                <td><?php echo $key->first_name . '  ' . $key->last_name; ?></td>
                                                <td><?php echo $key->email; ?></td>
                                                <td><img class="img-xs rounded-circle" style="height:35px; width:35px;" src="<?php echo site_url; ?>images/admin/<?php echo $key->profile_pic; ?>" alt=""></td>
                                                <td><?php echo $key->dob; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url; ?>admin/update_profile/<?php echo $key->id; ?>"><button type="button" class="btn btn-info btn-icon-text">
                                                            <i class="mdi mdi-view-grid"></i> Edit </button></a>
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
    <!-- content-wrapper ends -->