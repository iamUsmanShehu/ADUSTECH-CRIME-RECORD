<?php
if (isset($_POST)) {

$fname = $_POST['fname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Create a connection to the database using mysqli
$db=mysqli_connect("localhost", "root", "", "crime_record_system");

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert the user data into the security table
$sql = "INSERT INTO security (fname, surname, rank, security_id, address, phone, department, picture) VALUES (`fname`, `surname`, `rank`, `security_id`, `address`, `phone`, `department`, `picture`)";
if (mysqli_query($db, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

// Close the database connection
mysqli_close($db);

// Redirect to index.php after 2 seconds
header("refresh:2; url='../index.php'");
}
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
  <link href="../img/favicon.png" rel="icon">
  <link href="../img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../vendor/aos/aos.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">
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
      <h5 class="card-title">Register Security</h5>

      <!-- Registration Form -->
      <form class="row g-3">
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" placeholder="Your Name">
            <label for="floatingName">Your Name</label>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email">
            <label for="floatingEmail">Your Email</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password">
            <label for="floatingPassword">Confirm Password</label>
          </div>
        </div>

       
        <div class="text-cente">
          <button type="submit" class="btn btn-success">Register</button>
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
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>