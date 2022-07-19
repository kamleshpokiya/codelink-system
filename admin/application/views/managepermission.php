<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"> Manage permission </h3>
                        <div class="table-responsive">
                            <form action="<?php echo base_url; ?>permission/updatepermission" method="POST">
                                <table class="table table">
                                    <thead>
                                        <tr>
                                            <th>MODULS LIST</th>
                                            <th>PERMISSION LIST</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $role_id = $data['id'];
                                    $p_recode = array_values($data['records']);
                                    // echo '<pre>';
                                    // print_r($p_recode);
                                    // $p_option = explode(',', $p_recode[1]->options);
                                    // echo '<pre>';
                                    // print_r($p_option);
                                    $count = 0;
                                    if (!empty($data['data'])) {
                                        $Permission = $data['data'];
                                        foreach ($Permission as $key => $value) {
                                    ?>          
                                            <tbody>
                                                <tr>
                                                    <?php if ($p_recode[$count]->moduls == "$key") { ?>
                                                        <th><label class="form-check-label">
                                                                <input type="checkbox" checked name="permission['<?php echo $key; ?>']" class="form-check-input default_chaked" value="<?php echo $key; ?>" /> <?php echo $key; ?></label></th>
                                                    <?php } else { ?>
                                                        <label for="" class="form-check-label">
                                                            <th> <input type="checkbox" name="permission['<?php echo $key; ?>']" class="form-check-input default_chaked" value="<?php echo $key; ?>" /> <?php echo $key; ?></th>
                                                        </label>
                                                    <?php }
                                                    ?>
                                                </tr>

                                                <?php
                                                $p_option = explode(',', $p_recode[$count]->options);
                                                // echo '<pre>';
                                                // print_r($p_option);
                                                // die;
                                                $count++;
                                                foreach ($value as $k => $v) {
                                                    if (in_array($v, $p_option)) {
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <label for="" class="form-check-label">
                                                                <td> <input type="checkbox" checked class="form-check-input <?php echo $key ?> " name="permission['<?php echo $key; ?>'][] " value="<?php echo $v ?>" /><?php echo $k; ?></th>
                                                            </label>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td></td>
                                                            <label for="" class="form-check-label">
                                                                <td> <input type="checkbox" class="form-check-input <?php echo $key ?>" name="permission['<?php echo $key; ?>'][] " value="<?php echo $v ?>" /><?php echo $k; ?></th>
                                                            </label>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                    </tr>
                                                <?php }   ?>

                                        <?php
                                        }
                                    }
                                        ?>
                                            </tbody>
                                            <input type="hidden" name="id" value="<?php echo $role_id; ?>">
                                </table>
                                <a href="<?php echo base_url; ?>permission/updatepermission/<?php echo $id = "4"; ?>"><button type="submit" class="btn btn-primary me-2" name="update">UPDATE </button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.default_chaked').change(function() {
                if ($(":checkbox[value=User]").prop('checked')) {
                    $('.User').prop('checked', true);
                } else {
                    $('.User').prop('checked', false);
                }
                if ($(":checkbox[value=Leaves]").prop('checked')) {
                    $('.Leaves').prop('checked', true);
                } else {
                    $('.Leaves').prop('checked', false);
                }
                if ($(":checkbox[value=Policy]").prop('checked')) {
                    $('.Policy').prop('checked', true);
                } else {
                    $('.Policy').prop('checked', false);
                }
            })
        });
    </script>