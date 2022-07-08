<?php

// echo '<pre>';
// print_r($data['users']);

// echo '<br>';
// echo $data['users'][0]['first_name'];

?>



<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="index.php"><img src="<?php echo site_url; ?>images/codelink.svg" style="height:50px ;" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="<?php echo site_url; ?>images/logo-mini.svg" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url; ?>Users/home">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url; ?>Leave/leaves">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Leaves</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="<?php echo base_url; ?>Policy/viewPolicies">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Policies</span>
      </a>
    </li>

  </ul>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="<?php echo base_url; ?>Users/home"><img src="<?php echo site_url; ?>images/codelink.svg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav w-100">
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <div>
          <!-- <textarea  style="font-size: 18px; color:chartreuse; height:35px; background-color: black; padding-left:16px; padding-right: 12px;  width:115px; border: groove; border-width: 4px; border-color: goldenrod; border-radius: 3px; resize:none; overflow:hidden"></textarea> -->
        </div>
        <button type="button" class="btn btn-outline-danger btn-fw me-5 text-uppercase px-3 py-2" id="checked_in" value="<?php if (isset($data['users']['id'])) {
                                                                                                                            echo $data['users']['id'];
                                                                                                                          } ?>">Check In  <time id="displayarea" style="display: none;">00:00:00.000</time> </button>
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
            <div class="navbar-profile">
              <img class="img-xs rounded-circle" src="<?php if (isset($data['users']['profile_pic'])) {
                                                        if ($data['users']['profile_pic'] == '' || $data['users']['profile_pic'] == NULL) {
                                                          echo site_url . 'images/carousel/profile_default.png';
                                                        } else {
                                                          echo site_url . 'images/carousel/' . $data['users']['profile_pic'];
                                                        }
                                                      } else {
                                                        echo site_url . 'images/carousel/profile_default.png';
                                                      } ?>">
              <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php if (isset($data['users']['first_name'])) {
                                                                      echo $data['users']['first_name'];
                                                                    } else {
                                                                      echo '';
                                                                    } ?></p>
              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
            <h6 class="p-3 mb-0">Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="<?php echo base_url; ?>Users/profile">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-settings text-success"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">My Profile</p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="<?php echo base_url; ?>Users/logout">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-dark rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Log out</p>
              </div>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>
  <div class="main-panel">
    <div class="content-wrapper">
      <!-- partial -->