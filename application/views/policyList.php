        <div class="page-header">
            <h3 class="page-title"> Company Policies </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">company policy</a></li>
                    <li class="breadcrumb-item active" aria-current="page">policies</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="width:100%;table-layout:fixed;">
                                <thead>
                                    <tr style="height:1em;">
                                        <th> Sno. </th>
                                        <th> Policy Title </th>
                                        <th> Policy Description </th>
                                        <!-- <th> <img src='<?php echo base_url?>/admin/public/assets/images/policyImages/<?php echo $row['policy_image']?>'></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($data['policy_data'])){
                                        echo $data['policy_data'];
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // To call delPolicy method when click on (delete_policy_btn)
                $(document).on('click', '#delete_policy_btn', function() {
                    $.ajax({
                        url: "<?php echo base_url; ?>Policy/delPolicy/" + $(this).val(),
                        type: 'post',
                        success: function(response) {
                            jsonResponse = JSON.parse(response);
                            if (jsonResponse.success) {
                                location.reload();
                            }
                        }
                    })
                })
            })
        </script>