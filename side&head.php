<?php
 include "includes/connection.php";
$query_count = mysqli_prepare($db, "SELECT DISTINCT COUNT(id) AS 'total_complains' FROM `complains` WHERE status = 0");
mysqli_stmt_execute($query_count);
$data = mysqli_stmt_get_result($query_count);
$row = mysqli_fetch_assoc($data);
$total_counts = $row['total_complains'];
?>  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/adustech.png" alt="">
        <span class="d-none d-lg-block">ADUSTECH</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <!-- <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form> -->
      <marquee><h1 class='text-success'>Aliko Dangote University of Science & Technology, Wudil.</h1></marquee>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="staff_pictures/<?=$picture?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$username?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$fname . " " . $surname?></h6>
              <?php if($role == 1):?>
                <span>Admin</span>
              <?php endif;?>
              <?php if($role == 2):?>
                <span>Security Officer</span>
              <?php endif;?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="signout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed"href="profile.php">
          <i class="bi bi-person"></i><span>My Profile</span>
        </a>
        <?php if($role == 2):?>
            
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Case</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
              <a href="" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                <i class="bi bi-circle"></i><span>Add Case</span>
              </a>
            </li>
            <li>
              <a href="manage-cases.php">
                <i class="bi bi-circle"></i><span>Manage Case</span>
            </a>
        </li>
          </ul>
          <?php endif;?>
          <?php if($role == 1):?>  
            <a class="nav-link collapsed"href="signup.php">
              <i class="bx bx-user-plus"></i><span>Create Account</span>
            </a>
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Staff Officer</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="add-staff.php">
                  <i class="bi bi-circle"></i><span>Add Staff</span>
                </a>
              </li>
              <li>
                <a href="manage-staff.php">
                  <i class="bi bi-circle"></i><span>Manage Staff</span>
                </a>
              </li>
            </ul>
            <a class="nav-link collapsed" data-bs-target="#components-cases-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Cases</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-cases-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <!-- <li>
                <a href="">
                  <i class="bi bi-circle"></i><span>Processed Cases</span>
                </a>
              </li> -->
              <li>
                <a href="ongoing_cases.php">
                  <i class="bi bi-circle"></i><span>Pending Cases</span>
                </a>
              </li>
              <li>
                <a href="completed_cases.php">
                  <i class="bi bi-circle"></i><span>Completed Cases</span>
                </a>
              </li>
            </ul>
            <?php endif;?>
            
            <li class="dropdown-header">
              <?php if($role == 2):?>
                <!-- <li class="nav-item"> -->
                  <a class="nav-link collapsed" href="view_complains.php">
                    <i class="bi bi-grid"></i>
                    <span>File Complaint List</span>
                    <i class="badge badge-danger"><?=$total_counts?></i>
                  </a>
                <!-- </li> -->
                <span><a href="" class="btn btn-danger">Verify Suspect</a></span>
              <?php endif;?>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
      </li><!-- End Nav -->

    </ul>

  </aside><!-- End Sidebar-->