<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h4 class="page-title">Edit holiday</h4>
        </div>
        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <?php
                    if (isset($_SESSION['h_msg']) && $_SESSION != '') {
                    ?>
                    <div class="alert alert-success" role="alert">
                         <?php echo $_SESSION['h_msg']; ?>
                    </div>
                    <?php
                        unset($_SESSION['h_msg']);
                    }
                    ?>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                            <form class="forms-sample" id="frm" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputName1">Date</label>
                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $key->id; ?>" placeholder="input date">
                                    <input type="date" class="form-control" name="date" id="date" value="<?php echo $key->date; ?>" placeholder="input date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $key->title; ?>" placeholder="holiday title">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Description</label>
                                    <input type="text" class="form-control" name="description" id="description" value="<?php echo $key->description; ?>" placeholder="give description">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <img class="img-xs rounded-circle" style="height:100px; width:200px; border-radius: 5% !important;" src="<?php echo site_url; ?>images/holiday_img/<?php echo $key->image; ?>" alt="<?php echo $key->image; ?>">
                                        <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload holiday pic">
                                        <input type="hidden" name="old_image" class="form-control file-upload-info" value="<?php echo $key->image; ?>">
                                    </div>
                                </div>
                                <button type="submit" name="edit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-dark">Reset</button>
                            </form>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery('#frm').validate({
            rules: {
                date: "required",
                title: "required",
                description: "required",
                image: {
                    required: true,
                    accept: "jpg,png,jpeg,gif"
                },
            },
            messages: {
                date: "Please enter date",
                title: "Please give title",
                description: "Please add description",
                image: {
                    required: "Select Image",
                    accept: "Only image type jpg/png/jpeg/gif is allowed"
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
    <!-- content-wrapper ends -->