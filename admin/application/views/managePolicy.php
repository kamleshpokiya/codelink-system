<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"> Manage Policies </h3>
                        <?php $permission = $data['recode'];if(in_array('3', $permission)){  ?>
                        <a href="<?php echo base_url; ?>policy/addPolicy"><button type="button" class="btn btn-primary btn-icon-text  mb-3 ms-2" style="position:absolute; top:5%; right:40px;"> Add New Policy </button></a>
                        <?php }?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Id </th>
                                        <th> Policy Title </th>
                                        <th> Policy Description </th>
                                        <th> Policy Link </th>
                                        <th> Policy Image </th>
                                        <?php if(in_array('2', $permission)){  ?>
                                            <th> Edit </th>
                                        <?php }?>
                                        <?php if(in_array('4', $permission)){  ?>
                                            <th> Delete </th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (isset($data['policy_data'])) {
                                        foreach ($data['policy_data'] as $key => $value) {
                                    ?>
                                            <tr>
                                                <td class="serial"><?php echo $key + 1; ?></td>
                                                <td><?php echo $value->policy_title; ?> </td>
                                                <td><?php echo $value->policy_desc; ?> </td>
                                                <td> <?php echo $value->policy_link; ?> </td>
                                                <td><img class="img-xs rounded-circle" style="height:40px; width:40px;" src="<?php echo site_url; ?>images/policyImages/<?php echo $value->policy_image; ?>" alt=" <?php echo $value->policy_image; ?>"></td>
                                                <?php if(in_array('3', $permission)){  ?>
                                                    <td><a href="<?php echo base_url; ?>Policy/editPolicy/<?php echo $value->id; ?>"><button type="button" class="btn btn-outline-primary btn-icon-text" id="edit_policy_btn" name="edit_policy_btn" value="<?php echo $value->id; ?>"><i class="mdi mdi-file-check btn-icon-prepend"></i> Edit </button></a></td>
                                                <?php }?>
                                                <?php if(in_array('4', $permission)){  ?>
                                                <td><button type="button" class="btn btn-outline-danger btn-icon-text" id="<?php echo $value->id; ?>" onclick="del(this.id)"><i class="mdi mdi-file-check btn-icon-prepend"></i> Delete </button></td>
                                                <?php }?>
                                            </tr>
                                    <?php
                                        }
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
                            url: "<?php echo base_url; ?>policy/delPolicy",
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
    </script>