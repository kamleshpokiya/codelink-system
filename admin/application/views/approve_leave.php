<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Approve Leave</h4>

          <form class="forms-sample" method="POST">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Leave Status</label>
                <div class="col-sm-9">
                  <select class="form-control" name="status">
                    <option value="1">Approve</option>
                    <option value="2">Decline</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Comment</label>
              <!-- <input type="text" class="form-control" name="description" id="description" placeholder="leave status description"> -->
              <textarea name="comment" class="form-control" id="comment" cols="50" rows="6"></textarea>
            </div>
            <button type="submit" name="edit" class="btn btn-primary me-2">Submit</button>
            <button type="reset" class="btn btn-dark">Reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->