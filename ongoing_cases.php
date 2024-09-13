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

    $sql = "SELECT * FROM `cases` WHERE status = 0";
    $query = mysqli_query($db, $sql);
    $i = 1;
   

// Close the database connection
// mysqli_close($db);


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
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Ongoing Cases</li>
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
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ongoing Cases</button>
                    </li>

                    </ul>
                    <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <table class="table datatable">
                            <tr>
                                <th>#</th>
                                <th>case_date</th>
                                <th>staff_officer</th>
                                <th>case_type</th>
                                <th>complainer_reg</th>
                                <th>compalinant_reg</th>
                                <!-- <th>complainer_sex</th> -->
                                <!-- <th>complainer_name</th>
                                <th>complainer_level</th> -->
                                <!-- <th>complainer_picture</th> -->
                                <!-- <th>complainer_department</th>
                                <th>complainer_faculty</th>
                                <th>complainer_phone</th>
                                <th>complainer_address</th>
                                <th>complainant_sex</th>
                                <th>complainant_name</th>
                                <th>complainant_level</th>
                                <th>complainant_picture</th>
                                <th>complainant_department</th>
                                <th>complainant_faculty</th>
                                <th>complainant_phone</th>
                                <th>complainant_address</th>
                                <th>statement</th>
                                <th>status</th>
                                <th>case_time</th>
                                <th>complainer_picture </th>
                                <th>complainant_picture</th> -->

                            </tr>
                            <?php 
                                while ($row = mysqli_fetch_assoc($query)):?>
                                    <td><?=$id = $row['id'];?>
                                    <td><?=$case_date = $row['case_date'];?></td>
                                    <td><?=$staff_officer = $row['staff_officer'];?></td>
                                    <td><?=$case_type = $row['case_type'];?></td>
                                    <td><?=$complainer_reg = $row['complainer_reg'];?></td>
                                    <td><?=$compalinant_reg = $row['compalinant_reg'];?></td>
                                    <td><a href="view.php?case_id=<?=$row['id'];?>" class="btn btn-info"><i class="bx bxs-user-detail"></i></a></td>

                                    <!-- <td><?=$complainer_sex = $row['complainer_sex'];?></td>
                                    <td><?=$complainer_name = $row['complainer_name'];?></td>
                                    <td><?=$complainer_level = $row['complainer_level'];?></td>
                                    <?php $complainer_picture = $row['complainer_picture'];?>
                                    <?php $complainant_picture = $row['complainant_picture'];?>
                                    <td><?=$complainer_picture = "<img src='uploaded_imgs/$complainer_picture' class='img-fluid rounded-start' alt='complainer_picture' width='50'>";?>
                                    <?=$complainant_picture = "<img src='uploaded_imgs/$complainant_picture' class='img-fluid rounded-start' alt='complainer_picture' width='50'>";?></td> -->
                                    <!-- <td><?=$complainer_department = $row['complainer_department'];?></td>
                                    <td><?=$complainer_faculty = $row['complainer_faculty'];?></td>
                                    <td><?=$complainer_phone = $row['complainer_phone'];?></td>
                                    <td><?=$complainer_address = $row['complainer_address'];?></td>
                                    <td><?=$complainant_sex = $row['complainant_sex'];?></td>
                                    <td><?=$complainant_name = $row['complainant_name'];?></td>
                                    <td><?=$complainant_level = $row['complainant_level'];?></td>
                                    <td><?=$complainant_department = $row['complainant_department'];?>?></td>
                                    <td><?=$complainant_faculty = $row['complainant_faculty'];?></td>
                                    <td><?=$complainant_phone = $row['complainant_phone'];?></td>
                                    <td><?=$complainant_address = $row['complainant_address'];?></td>
                                    <td><?=$statement = $row['statement'];?></td>
                                    <td><?=$status = $row['status'];?></td>
                                    <td><?=$case_time = $row['case_time'];?></td>
                             -->
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