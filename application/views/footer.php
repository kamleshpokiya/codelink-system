</div>
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Codelinkinfotech.com 2021</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="<?php echo base_url; ?>Users/home" target="_blank">Usermanagement admin site</a> from Codelinkinfotech.com</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?php echo site_url; ?>vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?php echo site_url; ?>vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo site_url; ?>vendors/progressbar.js/progressbar.min.js"></script>
<script src="<?php echo site_url; ?>vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="<?php echo site_url; ?>vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo site_url; ?>vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="<?php echo site_url; ?>js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo site_url; ?>js/off-canvas.js"></script>
<script src="<?php echo site_url; ?>js/hoverable-collapse.js"></script>
<script src="<?php echo site_url; ?>js/misc.js"></script>
<script src="<?php echo site_url; ?>js/settings.js"></script>
<script src="<?php echo site_url; ?>js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?php echo site_url; ?>js/dashboard.js"></script>
<!-- End custom js for this page -->
<!-- bootstrap js-->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--end bootstrap js-->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<?php
// $dt = new DateTime("now", new DateTimeZone('GMT'));

// echo $dt->format('H:i:s');

// if ( time() > strtotime( '04:57:00AM' ) && time() < strtotime( '04:57:20AM' ) ) {
//     echo "<script> alert('this is good time to go'); </script>";
// }
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body myModal_content">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  var timer;
  var startTime;

  function start($id) { 
        startTime = parseInt(localStorage.getItem('startTime_'+$id) || Date.now());
        localStorage.setItem('startTime_'+$id, startTime);
        timer = setInterval(clockTick, 100);
  }

  function stop() {
    clearInterval(timer);
  }

  function reset($id =! null) {
    clearInterval(timer);
    localStorage.removeItem('startTime_'+$id);
    $('#displayarea').html('00:00:00.000');
  }

  function clockTick() {
    var currentTime = Date.now(),
      timeElapsed = new Date(currentTime - startTime),
      hours = timeElapsed.getUTCHours(),
      mins = timeElapsed.getUTCMinutes(),
      secs = timeElapsed.getUTCSeconds(),
      ms = timeElapsed.getUTCMilliseconds(),
      display = $('#displayarea').html();

      $('#displayarea').html(
      (hours > 9 ? hours : "0" + hours) + ":" +
      (mins > 9 ? mins : "0" + mins) + ":" +
      (secs > 9 ? secs : "0" + secs));
  };

  $(document).ready(function() {
    $id = $('#checked_out').val();
    $id = $('#checked_in').val();
    if (localStorage.getItem('checked_in_'+$id) != null) {
      //user are checked_in
      $('#checked_in').attr('id', 'checked_out');
      $('#checked_out').html('<time id="displayarea"  style = "font-size: 20px;">00:00:00</time>');
      // $('#displayarea').css('display', 'block');
      // $id = $('#checked_out').val();
      start($id);
    }
    if (localStorage.getItem('checked_out_'+$id != null)) {
      //user are checked_out
      $('#checked_out').attr('id', 'checked_in');
      $('#checked_in').text('Check In');
      start($id);
    }

    // For check in
    $(document).on('click', '#checked_in', function() {
      $id = $('#checked_in').val();
      $.ajax({
        url: '<?php echo base_url; ?>WorkHours/CheckIn/' + $id,
        success: function(response) {
          jsonResponse = JSON.parse(response);
          if (jsonResponse.check_in_success) {
            localStorage.setItem('checked_in_'+$id, 'yes');
            localStorage.setItem('user_id_'+$id, $id);
            if (localStorage.getItem('checked_out_'+$id) != null) {
              localStorage.removeItem('checked_out_'+$id);
            }
            $('#checked_in').attr('id', 'checked_out');
            $('#checked_out').html('<time id="displayarea" style = "font-size: 20px;">00:00:00</time>');
            reset($id);
            start($id);
          }
        }
      });
    });


    // For check out
    $(document).on('click', '#checked_out', function() {
      $id = $('#checked_out').val();
      $.ajax({
        url: '<?php echo base_url; ?>WorkHours/CheckOut/' + $id,
        success: function(response) {
          jsonResponse = JSON.parse(response);
          if (jsonResponse.check_out_success) {
            localStorage.setItem('checked_out_'+$id, 'yes');
            if (localStorage.getItem('checked_in_'+$id) != null) {
              localStorage.removeItem('checked_in_'+$id);
              // localStorage.removeItem('startTime_'+$id);
              localStorage.removeItem('user_id_'+$id);
            }
            $('#checked_out').attr('id', 'checked_in');
            $('#checked_in').text('Check In');
            $('#displayarea').css('display', 'none');
            reset($id);
            // start($id);
          }
        }
      });
    });
  });
</script>
</body>

</html>