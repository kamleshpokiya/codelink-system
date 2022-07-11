<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Manage Permission </h3>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User permission</h4>
                        <div class="table-responsive">
                            <div class="col-md-6">
                                <form action="<?php echo base_url; ?>permission/updatepermission" method="POST">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>MODULS LIST</th>
                                                <th>PERMISSION LIST</th>
                                            </tr>
                                        </thead>
                                        <?php
                                    $role_id = $data['id'];
                                    if ($role_id == "2"){
                                        echo "HR PERMISSIONS";
                                    }
                        if (!empty($data['data'])) {
                              $Permission = $data['data'];
                              echo "<pre>";
                              print_r($Permission);
                            //   exit;
                            foreach ($Permission as $key => $value){
                                ?>
                                        <tbody>
                                            <tr>
                                                <label for="" class="form-check-label">
                                                    <th> <input type="checkbox" class="" name="permission['<?php echo $key; ?>']"
                                                            class="form-check-input" value="<?php echo $key;?>" />
                                                        <?php echo $key; ?></th>
                                                </label>
                                            </tr>

                                            <?php 
                                    // echo "<pre>";
                                    // print_r($value);
                                    foreach ($value as $k => $v){
                                        ?>
                                            <tr>
                                                <td></td>
                                                <label for="" class="form-check-label">
                                                    <td> <input type="checkbox" class="form-check-input"
                                                            name="permission['<?php echo $key; ?>'][] "
                                                            value="<?php echo $v?>" /><?php echo $k;?></th>
                                                </label>
                                            </tr>
                                            <?php } ?>
                                            <?php
                                }
                            }
                                ?>
                                        </tbody>
                                        <input type="hidden" name="id" value="<?php echo $role_id; ?>">
                                    </table>
                                    <a href="<?php echo base_url; ?>permission/updatepermission/<?php echo $id = "4"; ?>"><button
                                            type="submit" class="btn btn-info" name="update">UPDATED </button></a>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>