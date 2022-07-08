<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Add New Policy </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Policy</a></li>
                    <li class="breadcrumb-item active" aria-current="page">add policy</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h4 class="card-title">New Policy</h4>
                            <div class="form-group">
                                <label>Policy Title</label>
                                <input type="text" class="form-control" id="policy_title">
                                <span id="title_msg"></span>
                            </div>
                            <div class="form-group">
                                <label>Policy Description</label>
                                <input type="text" class="form-control" id="policy_desc">
                                <span id="desc_msg"></span>
                            </div>
                            <div class="form-group">
                                <label>Policy Image</label>
                                <input type="file" class="form-control" id="policy_img" style="padding-top: 12px;">
                                <span id="img_msg"></span>
                            </div>
                            <div class="form-group">
                                <label>Policy Link</label>
                                <input type="url" class="form-control" id="policy_link">
                                <span id="link_msg"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary me-2" id="add_policy_btn">Add Policy</button>
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
            $(document).on('click', '#add_policy_btn', function() {

                $policy_title = $('#policy_title').val();
                $policy_desc = $('#policy_desc').val();
                $policy_link = $('#policy_link').val();
                if ($('#policy_img').val() != '') {
                    var file = $('#policy_img')[0].files[0]
                    // console.log(file.type);
                    var img_types = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (jQuery.inArray(file.type, img_types)) {
                        $is_valid = false;
                        $("#img_msg").text('Only (jpeg, jpg, png) image files are allowed').css({
                            'color': 'red'
                        });
                        // console.log('Only (jpeg, jpg, png) image files are allowed');
                    } else {
                        $("#img_msg").text('');
                    }
                    // $("#img_msg").text('');
                } else {
                    $is_valid = false;
                    $("#img_msg").text('Please select your policy image file').css({
                        'color': 'red'
                    });
                    // console.log('Please select your policy image file');
                }

                // return false;
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
                    if ($('#policy_img').val() != '') {
                        fd.append('file', file);
                    }


                    $.ajax({
                        url: "<?php echo base_url; ?>Policy/addNewPolicy",
                        type: 'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            jsonResponse = JSON.parse(response);

                            if (jsonResponse.ins_policy_success) {
                                $('#policy_created').css({
                                    'display': 'block'
                                });

                                $('#add_policy_btn').prop('disabled', true)
                            }
                        }

                    });
                }else{
                    console.log('form is not valid');
                }


            });

        });
    </script>