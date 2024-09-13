<?php 

include "includes/connection.php";
session_start();

$fname=$_SESSION["fname"];
$surname=$_SESSION["surname"];
$username=$_SESSION["username"];
$role=$_SESSION["role"];
$staff_id=$_SESSION["staff_id"];
$email=$_SESSION["email"];
$phone=$_SESSION["phone"];
$address=$_SESSION["address"];
$picture = $_SESSION["picture"];

if (!isset($_SESSION["fname"])) {
  header("location: index.php");
}

    $sql = "SELECT * FROM `complains`";
    $query = mysqli_query($db, $sql);
    $i = 1;
   

// Close the database connection
// mysqli_close($db);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "header.php"; ?>
<style>
td{font-size:12px;}
</style>
</head>

<body>

<?php include "side&head.php"; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Comlains</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
        <section class="section profile">
            <div class="row">

            <div class="col-xl-12">

                <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Submited Complains</button>
                    </li>

                    </ul>
                    <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <table class="table datatable">
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Case Type</th>
                                <th>Case Description</th>
                                <th>Case Address</th>
                                <th>Date</th>
                                <th>Picture</th>

                            </tr>
                            <?php 
                                while ($row = mysqli_fetch_assoc($query)):?>
                                
                                    <td><?=$id = $row['id'];?>
                                    <td><?=$fullname = $row['fullname'];?></td>
                                    <td><?=$email = $row['email'];?></td>
                                    <td><?=$gender = $row['gender'];?></td>
                                    <td><?=$phone = $row['phone'];?></td>
                                    <td><?=$address = $row['address'];?></td>
                                    <td><?=$casetype = $row['casetype'];?></td>
                                    <td><?=$case_description = $row['case_description'];?></td>
                                    <td><?=$case_address = $row['case_address'];?></td>
                                    <td><?=$case_date = $row['date'];?></td>
                                    <?php $picture = $row['picture'];?>
                                    <td><?=$picture = "<img src='complain_pictures/$picture' class='img-fluid rounded-start' alt='picture' width='50'>";?></td>
                                    
                                <?php endwhile; ?>
                        </table>
                        </div>

                    </div>

                                    </div></div>
                    </div><!-- End Bordered Tabs -->

                </div>
                </div>

            </div>
            </div>
        </section>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php include "add-case.php"; ?>
 <?php include "footer.php"; ?>
</body>

</html>