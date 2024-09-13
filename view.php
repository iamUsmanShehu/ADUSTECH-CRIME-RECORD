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
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">View Case</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            
          <div class='row'>
          
            <!-- Recent Sales -->
            <div class="col-12">
                  <h5 class="card-title">Case Datails<span></span></h5>
                    <?php 
                        $case_id = $_GET["case_id"]; 
                        $sql = "SELECT * FROM `cases` WHERE id = $case_id";
                        $query = mysqli_query($db, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($query)):
                            $id = $row['id'];
                            $case_date = $row['case_date'];
                            $staff_officer = $row['staff_officer'];
                            $complainer_sex = $row['complainer_sex'];
                            $complainer_name = $row['complainer_name'];
                            $complainer_reg = $row['complainer_reg'];
                            $complainer_level = $row['complainer_level'];
                            $complainer_picture = $row['complainer_picture'];
                            $complainer_department = $row['complainer_department'];
                            $complainer_faculty = $row['complainer_faculty'];
                            $complainer_phone = $row['complainer_phone'];
                            $complainer_address = $row['complainer_address'];
                            $complainant_sex = $row['complainant_sex'];
                            $complainant_name = $row['complainant_name'];
                            $compalinant_reg = $row['compalinant_reg'];
                            $complainant_level = $row['complainant_level'];
                            $complainant_picture = $row['complainant_picture'];
                            $complainant_department = $row['complainant_department'];
                            $complainant_faculty = $row['complainant_faculty'];
                            $complainant_phone = $row['complainant_phone'];
                            $complainant_address = $row['complainant_address'];
                            $case_type = $row['case_type'];
                            $statement = $row['statement'];
                            $status = $row['status'];
                            $case_time = $row['case_time'];
                            $complainer_picture = "<img src='uploaded_imgs/$complainer_picture' class='img-fluid rounded-start' alt='complainer_picture' width='200'>";
                            $complainant_picture = "<img src='uploaded_imgs/$complainant_picture' class='img-fluid rounded-start' alt='complainer_picture' width='200'>";
                    ?>
                        <?php endwhile; ?>
                            
                        <div class="container">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row ">
                            <div class="col-12">
                                <div class="card">
                                    <div class='row mt-2'>
                                        <div class='col-10'></div>
                                        <div class='col-2'>
                                            <form method='POST'>
                                                <?php if ($status == 0): ?>
                                                    <a href="close_case.php?close_id=1&case_id=<?=$id?>" class="btn btn-danger"><i class="bx bxs-file"></i> Close Case</a>
                                                <?php endif;?>
                                                <?php if ($status == 1): ?>
                                                    <a href="close_case.php?close_id=0&case_id=<?=$id?>" class="btn btn-secondary"><i class="bx bxs-file"></i>Case Closed</a>
                                                <?php endif;?>
                                            </form>
                                        </div>
                                    </div>
                                <div class="card-body">
                                    <div class='row pt-3'>
                                        <div class='col-6'>
                                            Date:
                                            <input type="text" class="form-control p-3" placeholder="<?=$case_date?>" readonly>

                                        </div>
                                        <div class='col-6'>
                                            Staff:
                                            <select name="staff_officer" class="form-control p-3">
                                                <option value=""><?=$staff_officer?></option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title">Complainer</div>
                                    <div class="row">
                                    <div class="col-4">
                                        <div class="form-control border-success color-black">
                                            <td><?=$complainer_picture?></td>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                    </div>
                                    <select name="complainer_sex" class="form-control p-3">
                                        <option value=""><?=$complainer_sex?></option>
                                        
                                    </select>
                                    <input type="text" name="complainer_name" class="form-control p-3" placeholder="<?=$complainer_name?>" readonly>
                                    <input type="text" name="complainer_reg" class="form-control p-3" placeholder="<?=$complainer_reg?>" readonly>
                                    <select name="complainer_level" class="form-control p-3">
                                        <option value=""><?=$complainer_level?></option>
                                    </select>
                                    <input type="text" name="complainer_department" class="form-control p-3" placeholder="<?=$complainer_department?>" readonly>
                                    <input type="text" name="complainer_faculty" class="form-control p-3" placeholder="<?=$complainer_faculty?>" readonly>
                                    <input type="number" name="complainer_phone" class="form-control p-3" placeholder="<?=$complainer_phone?>" readonly>
                                    <textarea type="text" name="complainer_address" class="form-control p-3" placeholder="<?=$complainer_address?>" readonly></textarea>
                                    
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Complainant</div>
                                    <div class="row">
                                    <div class="col-8"></div>
                                    <div class="col-4">
                                        <div class="form-control h-100 border-warning color-black">
                                        <?=$complainant_picture?>
                                        </div>
                                    </div>
                                    </div>
                                    <select name="complainant_sex" class="form-control p-3">
                                        <option value=""><?=$complainant_sex?></option>
                                    </select>
                                    <input type="text" name="complainant_name" class="form-control p-3" placeholder="<?=$complainant_name?>" readonly>
                                    <input type="text" name="compalinant_reg" class="form-control p-3" placeholder="<?=$compalinant_reg?>" readonly>
                                    <select name="complainant_level" class="form-control p-3">
                                        <option value=""><?=$complainant_level?></option>
                                    </select>
                                    <input type="text" name="complainant_department" class="form-control p-3" placeholder="<?=$complainant_department?>" readonly>
                                    <input type="text" name="complainant_faculty" class="form-control p-3" placeholder="<?=$complainant_faculty?>">
                                    <input type="number" name="complainant_phone" class="form-control p-3" placeholder="<?=$complainant_phone?>">
                                    <textarea type="text" name="complainant_address" class="form-control p-3" placeholder="<?=$complainant_address?>"></textarea>
                                    
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title">Case Statement</div>
                                    
                                    <select name="case_type" class="form-control p-2">
                                        <option value=""><?=$case_type?></option>
                                    </select>
                                    <textarea type="text" name="statement" class="form-control p-3" placeholder="<?=$statement?>"></textarea>
                                   
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
            
          
          </div>
        </div><!-- End Left side columns -->
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
   
 <?php include "add-case.php"; ?>
 <?php include "footer.php"; ?>
</body>

</html>