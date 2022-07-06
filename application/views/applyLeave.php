
    <div class="page-header">
      <h3 class="page-title">Apply For Leave </h3>
    </div>
    <div id="success_msg">
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-description">
            </p>
            <form class="forms-sample">
              <label class="col-sm-4 col-form-label">Leave Type</label>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="leave_type" id="leave_type_full_day" value="1" checked> Full Day</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="leave_type" id="leave_type_half_day" value="2"> Half Day </label>
                    </div>
                  </div>
                </div>
              </div>
              <label class="col-sm-3 col-form-label" id="options_half_day_label" style="display: none;">Half Day</label>
              <div class="col-md-6" id="options_half_day_input" style="display: none;">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input " name="half_leave_type" id="pre_lunch_option" value="1" checked> Pre Lunch</label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input " name="half_leave_type" id="post_lunch_option" value="2"> Post Lunch </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12" id="half_leave_type_option" style="display: none;">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <div class="form-check" style="padding-left: 0rem;">
                      <label for="from_date">Date</label>
                      <input type="date" class="form-control" id="half_day_from_date">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12" id="from_to_date">
                <div class="form-group row">
                  <div class="col-sm-6">
                    <div class="form-check" style="padding-left: 0rem;">
                      <label for="from_date">From</label>
                      <input type="date" class="form-control" id="from_date">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-check" style="padding-left: 0rem;">
                      <label for="to_date">To</label>
                      <input type="date" class="form-control" id="to_date">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>
                <textarea class="form-control" id="subject" rows="5"></textarea>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-sm-6">
                    <div class="form-check" style="padding-left: 0rem;">
                      <div class="form-group row" style="margin-bottom: 0.7rem;">
                        <label for="credit">Credit</label>
                      </div>
                      <div class="btn-group" role="group" aria-label="Basic example"><?php if (isset($data['users']['credits'])) {

                                                                                        if ($data['users']['credits'] > 0) {
                                                                                          $i = 1;
                                                                                          while ($i <= $data['users']['credits']) {
                                                                                            echo "<button type='button' class='btn btn-outline-secondary  credit_val' style='padding: 10px 30px;
                                                                                             '>" . $i . "</button>";
                                                                                            if ($i == 5) {
                                                                                              break;
                                                                                            }
                                                                                            $i++;
                                                                                          }
                                                                                        } else {
                                                                                          echo "<button type='button' class='btn btn-outline-secondary  credit_val' style='padding: 10px 30px;
                                                                                             ' disabled>" . 0 . "</button>";
                                                                                        }
                                                                                      }
                                                                                      ?>
                      </div>

                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-check" style="padding-left: 0rem;">
                      <label for="non_credit">Non Credit</label>
                      <input type="number" class="form-select" aria-label="Default select example" id="non_credit" style="color: #e3ffff;
    background-color: #2a3038; border: 1px solid #2a3038;" placeholder="0.5 or 1" value="0">
                      </input>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-outline-danger btn-icon-text" id="apply_leave">
                <i class="mdi mdi-file-check btn-icon-prepend"></i> Apply </button>
              <button type="reset" class="btn btn-outline-warning btn-icon-text">
                <i class="mdi mdi-reload btn-icon-prepend"></i> Reset </button>
            </form>
            <label class="col-sm-4 col-form-label" id="invalid_error_msg"></label>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-description">
            <div class="template-demo">
              <div class="col-sm-2">
                <div class="form-check" style="padding-left: 0rem;">
                  <label for="non_credit">My Credit Score</label>
                  <input type="number" class="form-select" aria-label="Default select example" id="credit_score" style="color: #e3ffff;margin:15px 0px;
    background-color: #2a3038; border: 1px solid #2a3038;" value="<?php if (isset($data['users']['credits'])) {
                                                                    if ($data['users']['credits'] > 0) {
                                                                      echo $data['users']['credits'];
                                                                    } else {
                                                                      echo '0';
                                                                    }
                                                                  }; ?>" disabled>
                  </input>
                </div>
              </div>
            </div>
            </p>
            <form class="forms-sample">
              <label class="col-sm-4 col-form-label">Leave Instructions</label>

            </form>
          </div>
        </div>
      </div>

    </div>
 