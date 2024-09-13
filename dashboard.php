<?php
include "includes/connection.php";
  session_start();
  ob_start();
  $fname=$_SESSION["fname"];
  $surname=$_SESSION["surname"];
  $username=$_SESSION["username"];
  $role=$_SESSION["role"];
  $account_id = $_SESSION["account_id"];
  $picture = $_SESSION["picture"];

  if (!isset($_SESSION["fname"])) {
    header("location: dashboard.php");
  }

  $cases_data = "SELECT COUNT(id) AS 'Total' FROM `cases` WHERE account_id = $account_id";
    $cases_stmt = $db->prepare($cases_data);
    $cases_stmt->execute();
    $cases_result = $cases_stmt->get_result();
    
    if ($cases_result->num_rows > 0) {
        $total = $cases_result->fetch_assoc();
        $total_cases = $total['Total'];
    }
    $admin_cases_data = "SELECT COUNT(id) AS 'Total' FROM `cases`";
    $admin_cases_stmt = $db->prepare($admin_cases_data);
    $admin_cases_stmt->execute();
    $admin_cases_result = $admin_cases_stmt->get_result();
    
    if ($admin_cases_result->num_rows > 0) {
        $total = $admin_cases_result->fetch_assoc();
        $admin_total_cases = $total['Total'];
    }

  $cases_pending_data = "SELECT COUNT(id) AS 'Total' FROM `cases` WHERE status = 0 AND account_id = $account_id";
  $cases_pending_stmt = $db->prepare($cases_pending_data);
  $cases_pending_stmt->execute();
  $cases_pending_result = $cases_pending_stmt->get_result();
  
  if ($cases_pending_result->num_rows > 0) {
      $total = $cases_pending_result->fetch_assoc();
      $total_pending_cases = $total['Total'];
  }

  $admin_cases_pending_data = "SELECT COUNT(id) AS 'Total' FROM `cases` WHERE status = 0";
  $admin_cases_pending_stmt = $db->prepare($admin_cases_pending_data);
  $admin_cases_pending_stmt->execute();
  $admin_cases_pending_result = $admin_cases_pending_stmt->get_result();
  
  if ($admin_cases_pending_result->num_rows > 0) {
      $total = $admin_cases_pending_result->fetch_assoc();
      $admin_total_pending_cases = $total['Total'];
  }

  $cases_closed_data = "SELECT COUNT(id) AS 'Total' FROM `cases` WHERE status = 1 AND account_id = $account_id";
  $cases_closed_stmt = $db->prepare($cases_closed_data);
  $cases_closed_stmt->execute();
  $cases_closed_result = $cases_closed_stmt->get_result();
  
  if ($cases_closed_result->num_rows > 0) {
      $total = $cases_closed_result->fetch_assoc();
      $total_closed_cases = $total['Total'];
  }

  $admin_cases_closed_data = "SELECT COUNT(id) AS 'Total' FROM `cases` WHERE status = 1";
  $admin_cases_closed_stmt = $db->prepare($admin_cases_closed_data);
  $admin_cases_closed_stmt->execute();
  $admin_cases_closed_result = $admin_cases_closed_stmt->get_result();
  
  if ($admin_cases_closed_result->num_rows > 0) {
      $total = $admin_cases_closed_result->fetch_assoc();
      $admin_total_closed_cases = $total['Total'];
  }

  $staffs = "SELECT COUNT(id) AS 'Total' FROM `users`";
  $staffs_stmt = $db->prepare($staffs);
  $staffs_stmt->execute();
  $staffs_result = $staffs_stmt->get_result();
  
  if ($staffs_result->num_rows > 0) {
      $total = $staffs_result->fetch_assoc();
      $total_staffs = $total['Total'];
  }

  $staffs = "SELECT COUNT(id) AS 'Total' FROM `users` WHERE role != 0";
  $staffs_stmt = $db->prepare($staffs);
  $staffs_stmt->execute();
  $staffs_result = $staffs_stmt->get_result();
  
  if ($staffs_result->num_rows > 0) {
      $total = $staffs_result->fetch_assoc();
      $authorised_staffs = $total['Total'];
  }

  $staffs = "SELECT COUNT(id) AS 'Total' FROM `users` WHERE role = 0";
  $staffs_stmt = $db->prepare($staffs);
  $staffs_stmt->execute();
  $staffs_result = $staffs_stmt->get_result();
  
  if ($staffs_result->num_rows > 0) {
      $total = $staffs_result->fetch_assoc();
      $unauthorised_staffs = $total['Total'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "header.php"; ?>

</head>

<body>

<?php include "side&head.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <?php if($role == 1):?> 
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Staffs</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php if($role == 1):?> 
                          <h6><?=$total_staffs?></h6>
                        <?php endif;?>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Authorized <span>| Staffs</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php if($role == 1):?> 
                        <h6><?=$authorised_staffs?></h6>
                      <?php endif;?>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Unauthorised <span>| Staffs</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php if($role == 1):?> 
                        <h6><?=$unauthorised_staffs?></h6>
                      <?php endif;?>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <div class='row'>
                 <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total <span>| Cases</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php if($role == 1):?> 
                          <h6><?=$admin_total_cases?></h6>
                        <?php endif;?>
                      <?php if($role == 2):?> 
                          <h6><?=$total_cases?></h6>
                        <?php endif;?>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Pending <span>| Cases</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php if($role == 1):?> 
                        <h6><?=$admin_total_pending_cases?></h6>
                      <?php endif;?>
                    <?php if($role == 2):?> 
                      <h6><?=$total_pending_cases?></h6>
                      <?php endif;?>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Close <span>| Cases</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <?php if($role == 1):?> 
                        <h6><?=$admin_total_closed_cases?></h6>
                      <?php endif;?>
                    <?php if($role == 2):?> 
                      <h6><?=$total_closed_cases?></h6>
                      <?php endif;?>
                      
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Cases <span></span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Officer</th>
                        <th scope="col">Date</th>
                        <!-- <th scope="col">Case Description</th> -->
                        <th scope="col">Type</th>
                        <th scope="col">complainer_reg</th>
                        <th scope="col">complainant_reg</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                                
                        $sql = "SELECT * FROM `cases` WHERE account_id = $account_id ORDER BY id DESC";
                        $query = mysqli_query($db, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)):
                    ?>
                        <td><?=$i++;?></td>
                        <td><?=$row['staff_officer'];?>
                        <td><?=$row['case_date'];?>
                        <td><?=$row["case_type"];?>
                        <td><?=$row["complainer_reg"];?>
                        <td><?=$row["compalinant_reg"];?>

                        <?php if ($row["status"] == 2):?>
                          <td><span class="badge bg-danger">Guilty</span></td>
                        <?php endif;?>
                        <?php if ($row["status"] == 0):?>
                          <td><span class="badge bg-success">Closed</span></td>
                        <?php endif;?>
                        <?php if ($row["status"] == 1):?>
                          <td><span class="badge bg-warning">Pending</span></td>
                        <?php endif;?>
                        <td><a href="view.php?case_id=<?=$row['id'];?>" class="btn btn-info"><i class="bx bxs-user-detail"></i></a></td>
                    </tr>
                    <!-- <a href="" class="btn btn-danger"><i class="bx bx-trash"></i>&nbsp -->
                        <?php endwhile; ?>
                        
                        <?php 
                                
                        $sql = "SELECT * FROM `cases` ORDER BY id DESC";
                        $query = mysqli_query($db, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)):
                          if($account_id == 1 ):
                    ?>
                        <td><?=$i++;?></td>
                        <td><?=$row['staff_officer'];?>
                        <td><?=$row['case_date'];?>
                        <td><?=$row["case_type"];?>
                        <td><?=$row["complainer_reg"];?>
                        <td><?=$row["compalinant_reg"];?>
                        
                      
                        <?php if ($row["status"] == 2):?>
                          <td><span class="badge bg-danger">Guilty</span></td>
                        <?php endif;?>
                        <?php if ($row["status"] == 0):?>
                          <td><span class="badge bg-success">Closed</span></td>
                        <?php endif;?>
                        <?php if ($row["status"] == 1):?>
                          <td><span class="badge bg-warning">Pending</span></td>
                        <?php endif;?>
                        <td><a href="view.php?case_id=<?=$row['id'];?>" class="btn btn-info"><i class="bx bxs-user-detail"></i></a></td>
                    </tr>
                        <?php endif; endwhile; ?>


                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

       
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Ongoing Cases  <span>| Today</span></h5>

              <div class="activity">
              <?php 
                                
                  $sql = "SELECT * FROM `cases` WHERE status = 0 AND account_id = $account_id";
                  $query = mysqli_query($db, $sql);
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($query)):
              ?>
                               
                <div class="activity-item d-flex">
                  <div class="activite-label"><h6><?=$row['case_time'];?></h6></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="text-dark"><?=$row["case_type"];?></a>
                  </div>
                </div><!-- End activity item-->
              <?php endwhile; ?>

              <?php 
                                
                  $sql = "SELECT * FROM `cases` WHERE status = 0";
                  $query = mysqli_query($db, $sql);
                  $i = 1;
                  if($account_id == 1):
                  while ($row = mysqli_fetch_assoc($query)):
                  
              ?>
                                
                <div class="activity-item d-flex">
                  <div class="activite-label"><h6><?=$row['case_time'];?></h6></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="text-dark"><?=$row["case_type"];?></a>
                  </div>
                </div><!-- End activity item-->
              <?php endwhile; endif; ?>

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- News & Updates Traffic -->
          <!-- <div class="card"> -->
            <!-- <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div> -->

            <!-- <div class="card-body pb-0">
              <h5 class="card-title">Direct Complains</h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="assets/img/murja.jpg" alt="">
                  <h4><a href="#">TWO FIGHTING CASES</a></h4>
                  <p>Fighting with fellow coursemate...</p>
                  <p>Caught fighting outside school...</p>
                </div>

              </div>

            </div> -->
          <!-- </div> -->
          <!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
   
 <?php include "add-case.php"; ?>
 <?php include "footer.php"; ?>
</body>

</html>