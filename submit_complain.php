<?php
    // Create a connection to the database using mysqli
    include "includes/connection.php";


$message = '';

if (isset($_POST["fullname"])) {
    $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $casetype = mysqli_real_escape_string($db, $_POST['casetype']);
    $case_address = mysqli_real_escape_string($db, $_POST['case_address']);
    $case_description = mysqli_real_escape_string($db, $_POST['case_description']);

    $picture = '';
    if ($_FILES['picture']['error'] == 0) {
        $picture = $_FILES['picture']['name'];
        $picture_target = "complain_pictures/" . basename($picture);
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $picture_target)) {
            $message = "Failed to upload the picture.";
        }
    }


    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO `complains` (fullname, email, gender, phone, address, casetype, case_address,case_description, picture)
            VALUES ('$fullname', '$email', '$gender', '$phone', '$address', '$casetype', '$case_address', '$case_description', '$picture')";
    
    if (mysqli_query($db, $sql)) {
        $message = "<center>Staff created successfully</center>";
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);

    // Redirect to add-staff.php after 2 seconds
    header("refresh:2; url='submit_complain.php'");
    // exit();
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
        box-shadow: 6px -6px 12px #bebebe, inset -6px 6px 0px #ffc107;
        padding: 20px;
        /* margin-top:-200px; */
    }
    .btn-warning{color:white;}
    #hero::before {
  content: "";
  position: absolute;
  right: -100%;
  top: 20%;
  width: 250%;
  height: 200%;
  z-index: -1;    
  background-color: #ffc107;
  transform: skewY(100deg);
}
</style>
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-4 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-1 hero-img" data-aos="fade-up">
        <!-- <img src="assets/img/hero-img.png" class="img-fluid" alt=""> -->
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>
         <br><p><br><p>   
        </div>
        <div class="col-lg-8 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-2" data-aos="fade-up">
        <div class="container">
<!-- <div class="card" style="width:50%; margin-top:100px;"> -->
    <div class="card-body">
      <h5 class="card-title">File Complaint</h5>
      <h6 style='color:green;'><?php if (isset($message)) echo $message; ?></h6>
<br>
      <!-- Registration Form -->
      <form class="g-3" method="POST" enctype="multipart/form-data">
        <hr>
        <h5 class="card-title"><b>Your Basic Info</b></h5>
        <hr>
        <div class='row mb-3'>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingEmail" placeholder="Your Email" name="fullname">
                <label for="floatingEmail">Your Fullname</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" class="form-control" id="floatingPassword" placeholder="Email" name="email">
                <label for="floatingPassword">Registration Number</label>
              </div>
            </div>

        </div>
        
        <div class='row mb-3'>
        <div class="col-md-6">
              <div class="form-floating">
                <select type="text" class="form-control" id="floatingEmail" name="gender">
                    <option value='Male'>Male</option>
                    <option value='FeMale'>FeMale</option>
                    <option value='Other'>Other</option>
                </select>
                <label for="floatingEmail">Gender</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="tel" class="form-control" id="floatingPassword" placeholder="Phone Number" name="phone">
                <label for="floatingPassword">Phone Number</label>
              </div>
            </div>
        </div>
        <div class='row mb-3'>
        <div class="col-md-12">
              <div class="form-floating">
                <textarea type="text" class="form-control" id="floatingPassword" placeholder="Address" name="address"></textarea>
                <label for="floatingPassword">Address</label>
              </div>
            </div>
        </div>
        <hr>
        <h5 class="card-title"><b>Case Info</b></h5>
        <hr>
        <div class='row mb-3'>
        <div class="col-md-6">
              <div class="form-floating">
                <select type="text" class="form-control" id="floatingEmail" name="casetype">
                    <option value='Fighting'>Fighting</option>
                    <option value='Stealing'>Stealing</option>
                    <option value='Other'>Other</option>
                </select>
                <label for="floatingEmail">Case Type</label>
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-floating">
                <textarea type="text" class="form-control" id="floatingPassword" placeholder="Address" name="case_address"></textarea>
                <label for="floatingPassword">Crime Location</label>
              </div>
            </div>
        </div>
        <div class='row mb-3'>
            <div class="col-md-8">
              <div class="form-floating">
                <textarea type="text" class="form-control" id="floatingPassword" placeholder="Address" name="case_description"></textarea>
                <label for="floatingPassword">Case Description</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="file" class="form-control" id="floatingPassword"name="picture">
                <label for="floatingPassword">Upload</label>
              </div>
            </div>
        </div>
        <div class="text-cente">
          <button type="submit" class="btn btn-warning">Submit Case</button>
          <a href="index.php" class="btn btn-secondary"><i class="bx bxl-lock"></i>Cancel</a>
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