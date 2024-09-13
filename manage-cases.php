<?php
  session_start();

  $fname=$_SESSION["fname"];
  $surname=$_SESSION["surname"];
  $username=$_SESSION["username"];
  $role=$_SESSION["role"];
  $staff_id=$_SESSION["staff_id"];
  $email=$_SESSION["email"];
  $phone=$_SESSION["phone"];
  $address=$_SESSION["address"];

  if (!isset($_SESSION["fname"])) {
    header("location: index.php");
  }


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
          <li class="breadcrumb-item active">Manage Staffs</li>
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
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Manage Staffs</button>
                    </li>

                    </ul>
                    <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <table class="table datatable">
                            <tr>
                                <th>#</th>
                              <th>case_date</th>
                              <th>staff_officer</th>
                              <th>complainer_sex</th>
                              <th>complainer_name</th>
                              <th>complainer_reg</th>
                              <th>complainer_level</th>
                              <th>complainer_picture</th>
                              <th>complainant_sex</th>
                              <th>complainant_name</th>
                              <th>compalinant_reg</th>
                              <th>complainant_level</th>
                              <th>complainant_picture</th>
                              <th>case_type</th>
                              <th>statement</th>
                            </tr>
                            <?php 
                                include "includes/connection.php";
                                $sql = "SELECT * FROM `cases`";
                                $query = mysqli_query($db, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)):
                            ?>
                                <td><?=$i++;?></td>
                                <td><?=$row['case_date'];?>
                                <td><?=$row['staff_officer'];?>
                                <td><?=$row["complainer_sex"];?>
                                <td><?=$row["complainer_name"];?>
                                <td><?=$row["complainer_reg"];?>
                                <td><?=$row["complainer_level"];?>
                                <td><img src="uploaded_imgs/<?=$row["complainer_picture"];?>" width="50">
                                <td><?=$row["complainant_sex"];?>
                                <td><?=$row["complainant_name"];?>
                                <td><?=$row["compalinant_reg"];?>
                                <td><?=$row["complainant_level"];?>
                                <td><img src="uploaded_imgs/<?=$row["complainant_picture"];?>" width="50"> 
                                <td><?=$row["case_type"];?>
                                <td><?=$row["statement"];?>
                                <td><a href="" class="btn btn-danger"><i class="bx bx-trash"></i></a> &nbsp<a href="" class="btn btn-info"><i class="bx bxs-user-detail"></i></a></td>
                            </tr>
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