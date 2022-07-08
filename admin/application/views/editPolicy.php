<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Update Your Policy </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Policy</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update policy</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="policy_created" style="display: none;">
                                Policy created successfully..
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <h4 class="card-title">New Policy</h4>
                            <div class="form-group">
                                <label>Policy Title</label>
                                <input type="text" class="form-control" id="policy_title" value="<?php if (isset($data['policy_data'])) {
                                                                                                        echo $data['policy_data'][0]->policy_title;
                                                                                                    } ?>">
                                <span id="title_msg"></span>
                            </div>
                            <div class="form-group">
                                <label>Policy Description</label>
                                <input type="text" class="form-control" id="policy_desc" value="<?php if (isset($data['policy_data'])) {
                                                                                                    echo $data['policy_data'][0]->policy_desc;
                                                                                                } ?>">
                                <span id="desc_msg"></span>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Policy Image</label>
                                <img style="height:150px; width:40%; border-radius:10px; margin: 10px 0px;" class="col-md-12" src="<?php echo site_url . "images/policyImages/" . $data['policy_data'][0]->policy_image; ?>">
                            </div>
                            <div class="form-group">
                                <label>Upload New Image</label>
                                <input type="hidden" class="form-control" id="policy_old_img" style="padding-top: 12px;" value="<?php if (isset($data['policy_data'])) {
                                                                                                                                    echo $data['policy_data'][0]->policy_image;
                                                                                                                                } ?>">
                                <input type="file" class="form-control" id="policy_img" style="padding-top: 12px;" value="">
                                <span id="img_msg"></span>
                            </div>
                            <div class="form-group">
                                <label>Policy Link</label>
                                <input type="url" class="form-control" id="policy_link" value="<?php if (isset($data['policy_data'])) {
                                                                                                    echo $data['policy_data'][0]->policy_link;
                                                                                                } ?>">
                                <span id="link_msg"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2" id="update_policy_btn" value="<?php if (isset($data['policy_data'])) {
                                                                                                                        echo $data['policy_data'][0]->id;
                                                                                                                    } ?>">Update Policy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $is_valid = true;
            $(document).on('click', '#update_policy_btn', function() {

                $policy_title = $('#policy_title').val();
                $policy_desc = $('#policy_desc').val();
                $policy_link = $('#policy_link').val();
                $policy_old_image = $('#policy_old_img').val();


                console.log($policy_title);
                console.log($policy_desc);
                console.log($policy_link);
                console.log($policy_old_image);


                if ($('#policy_img').val() != '') {
                    var file = $('#policy_img')[0].files[0]
                    console.log(file.name);
                    var img_types = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (jQuery.inArray(file.type, img_types)) {
                        $is_valid = false;
                        $("#img_msg").text('Only (jpeg, jpg, png) image files are allowed').css({
                            'color': 'red'
                        });
                        console.log('Only (jpeg, jpg, png) image files are allowed');
                    } else {
                        $("#img_msg").text('');
                    }
                    $("#img_msg").text('');
                }


                // Add policy form validation

                // policy Title
                if ($policy_title == '') {
                    $is_valid = false;
                    $("#title_msg").text('Please enter your policy title').css({
                        'color': 'red'
                    });
                } else {
                    $("#title_msg").text('');
                }


                // policy Description
                if ($policy_desc == '') {
                    $is_valid = false;
                    $("#desc_msg").text('Please enter your policy description').css({
                        'color': 'red'
                    });
                } else {
                    $("#desc_msg").text('');
                }


                // policy Link
                if ($policy_link == '') {
                    $is_valid = false;
                    $("#link_msg").text('Please enter your policy link/url').css({
                        'color': 'red'
                    });
                } else {
                    $("#link_msg").text('');
                }

                // Submit if form is valid
                if ($is_valid) {

                    // Append data to the FormData object
                    var fd = new FormData;
                    fd.append('policy_title', $policy_title);
                    fd.append('policy_desc', $policy_desc);
                    fd.append('policy_link', $policy_link);
                    fd.append('policy_old_image', $policy_old_image);
                    fd.append('id', $(this).val());
                    if ($('#policy_img').val() != '') {
                        fd.append('file', file);
                    }


                    $.ajax({
                        url: "<?php echo base_url; ?>Policy/editOldPolicy",
                        type: 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            jsonResponse = JSON.parse(response);

                            if (jsonResponse.update_success) {
                                $('#policy_created').css({
                                    'display': 'block'
                                });
                                location.reload();

                                $('#update_policy_btn').prop('disabled', true)
                            }
                        }

                    });
                };


            });

        });
    </script>