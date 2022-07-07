<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Holiday add</h4>
                    <?php
                    if (!empty($data['data'])) {
                        $records = array_values($data['data']);
                        foreach ($records as $key) {
                    ?>
                    <form class="forms-sample" id="frm" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label for="exampleInputName1">Date</label>
                            <input type="date" class="form-control" name="date" id="date" placeholder="input date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="holiday title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="give description">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload holiday pic">
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