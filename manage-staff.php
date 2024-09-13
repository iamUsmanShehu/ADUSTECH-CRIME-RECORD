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
  $picture = $_SESSION["picture"];

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
                                <th>Full Name:</th>
                                <th>Staff ID:</th>
                                <th>Phone:</th>
                                <th>Email Address:</th>
                                <th>Address:</Address></th>
                            </tr>
                            <?php 
                                include "includes/connection.php";
                                $sql = "SELECT * FROM users WHERE role = 0";
                                $query = mysqli_query($db, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)):
                            ?>
                                <td><?=$i++;?></td>
                                <td><?=$row["fname"] . " " . $row["surname"]?></td>
                                <td><?=$row["staff_id"];?></td>
                                <td><?=$row["phone"];?></td>
                                <td><?=$row["email"];?></td>
                                <td><?=$row["address"];?></td>
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