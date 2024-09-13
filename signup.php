<?php
if (isset($_POST["role"])) {

    $fname = $_POST['fname'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Create a connection to the database using mysqli
    include "includes/connection.php";

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $picture = '';
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $picture = $_FILES['picture']['name'];
        $picture_target = "staff_pictures/" . basename($picture);

        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $picture_target)) {
            // Insert the user data into the users table
            $sql = "INSERT INTO `users`(fname, surname, username, password, role, picture) 
                    VALUES ('$fname', '$surname', '$username', '$password', '$role', '$picture')";

            if (mysqli_query($db, $sql)) {
                $message = "<center>New record created successfully</center>";
                header("refresh:2; url='login.php'");
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        } else {
            // Handle the error if the upload fails
            $message = "Failed to upload the picture.";
        }
    } else {
        $message = "No picture was uploaded or an error occurred.";
    }

    // Close the database connection
    mysqli_close($db);
}
$message = isset($message) ? $message : "" ;

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Crime Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
<style>
img{
    width: 100%;
    height: 300px;
  }
  .about-img{
    height: 500px!important;
    width: 100%;
  }
  .d-flex{margin-top:-150px;}
  .card-body{
      border-radius: 10px;
      background: #ffff;
      box-shadow: 6px -6px 12px #bebebe, inset -6px 6px 0px #078b09;
      padding: 20px;
      /* margin-top:-200px; */
  }
</style>
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-1 hero-img" data-aos="fade-up">
        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-2" data-aos="fade-up">
        <?php include "header.php"; ?>

<div class="container">
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Create Account</h5>
      <h6><marquee style="color:red;">This will give access to the system according to the choosen role</marquee> </h6><br>
      <?php echo $message;?>
      <!-- Registration Form -->
      <form class="row g-3" method="POST" enctype="multipart/form-data">
      <div class="col-md-6">
          <div class="form-floating">
            <input type="file" class="form-control" id="floatingName" name="picture">
            <label for="floatingName">Picture</label>
          </div>
        </div>  
      <div class="col-md-6">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="fname" placeholder="Your First Name">
            <label for="floatingName">Your First Name</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="surname" placeholder="Your Surname">
            <label for="floatingName">Your Surname</label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingEmail" name="username" placeholder="User name">
            <label for="floatingEmail">User name</label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-floating">
            <select class="form-control" id="floatingRole" name="role">
              <option value="">Select ...</option>
              <option value="1">Admin</option>
              <option value="2">Staff</option>
            </select>
           
            <label for="floatingRole">Role</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="cpassword" placeholder="Confirm Password">
            <label for="floatingPassword">Confirm Password</label>
          </div>
        </div>

       
        <div class="text-cente">
          <button type="submit" class="btn btn-success" name="register">Register</button>&nbsp<a href="dashboard.php" class="btn btn-secondary" name="register">Cancel</a>
        </div>
      </form>

    </div>
  </div>
</div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>