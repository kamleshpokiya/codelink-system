<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Approve Leave</h4>
          <?php
          if (!empty($data['data'])) {
            $records = array_values($data['data']);
            foreach ($records as $key) {
          ?>
              <form class="forms-sample" method="POST">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Leave Status</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="status">
                        <option value="1" <?php if($key->status == 1){echo "selected='true'";}else{echo " ";}?>>Approve</option>
                        <option value="2" <?php if($key->status == 2){echo "selected='true'";}else{echo " ";}?>>Decline</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Comment</label>
                  <!-- <input type="text" class="form-control" name="description" id="description" placeholder="leave status description"> -->
                  <textarea name="comment" class="form-control" id="comment" cols="50" rows="6"><?php echo $key->comments;?></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Credit leave</label>
                  <!-- <input type="text" class="form-control" name="description" id="description" placeholder="leave status description"> -->
                  <input type="number" name="credits" value="<?php echo $key->from_credit;?>" class="form-control" id="credits">
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
  <!-- content-wrapper ends -->