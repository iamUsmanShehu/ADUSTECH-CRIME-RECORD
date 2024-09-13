<?php
    // Create a connection to the database using mysqli
    include "includes/connection.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("location: index.php");
    exit();
}

$fname = $_SESSION["fname"];
$surname = $_SESSION["surname"];
$username = $_SESSION["username"];
$role = $_SESSION["role"];
$picture = $_SESSION["picture"];

$message = '';

if (isset($_POST["add-staff"])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $staff_id = mysqli_real_escape_string($db, $_POST["staff_id"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $phone = mysqli_real_escape_string($db, $_POST["phone"]);
    $address = mysqli_real_escape_string($db, $_POST["address"]);
    $department = mysqli_real_escape_string($db, $_POST["department"]);

    $picture = '';
    if ($_FILES['picture']['error'] == 0) {
        $picture = $_FILES['picture']['name'];
        $picture_target = "staff_pictures/" . basename($picture);
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $picture_target)) {
            $message = "Failed to upload the picture.";
        }
    }


    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `users` (fname, surname, staff_id, email, phone, department, address, picture)
            VALUES ('$fname', '$surname', '$staff_id', '$email', '$phone', '$department', '$address', '$picture')";
    
    if (mysqli_query($db, $sql)) {
        $message = "<center>Staff created successfully</center>";
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);

    // Redirect to add-staff.php after 2 seconds
    header("refresh:2; url='add-staff.php'");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "header.php"; ?>
  <style>
      select, textarea, input, .form-control{margin: 0px;}
      .card{box-shadow: 0px 0 8px 4px rgba(1, 41, 112, 0.1);}
      .form{box-shadow: inset 0px 0 8px 4px rgba(1, 41, 112, 0.1); padding:30px;margin-top:5px;}
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
          <li class="breadcrumb-item active">Create-New-Staff</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">Add New Staff</h5>
                        <?php echo $message;?>
                        <form class="row g-3 form" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <label for="fname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="fname" type="text" class="form-control" id="fname">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="surname" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="surname" type="text" class="form-control" id="surname">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="department" class="col-md-4 col-lg-3 col-form-label">Department:</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="department" type="text" class="form-control" id="department">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="picture" class="col-md-4 col-lg-3 col-form-label">Picture:</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="picture" type="file" class="form-control" id="picture">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="staff_id" class="col-md-4 col-lg-3 col-form-label">Staff ID:</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="staff_id" type="text" class="form-control" id="staff_id">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Address">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" name="add-staff">Add Staff</button>&nbsp<a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "add-case.php"; ?>
<?php include "footer.php"; ?>

</body>
</html>
