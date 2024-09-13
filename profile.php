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
if (isset($_POST["update_profile"])) {
    
    // Create a connection to the database using mysqli
    include "includes/connection.php";

$fname = mysqli_real_escape_string($db, $_POST['fname']);
$surname = mysqli_real_escape_string($db,$_POST['surname']);
$role = mysqli_real_escape_string($db,$_POST['role']);
$staff_id= mysqli_real_escape_string($db,$_POST["staff_id"]);
$email= mysqli_real_escape_string($db, $_POST["email"]);
$phone= mysqli_real_escape_string($db,$_POST["phone"]);
$address= mysqli_real_escape_string($db,$_POST["address"]);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert the user data into the users table
$sql = "UPDATE `users` SET `fname`='$fname',`surname`='$surname',`username`='$username',`staff_id`='$staff_id',`email`='$email',`phone`='$phone',`address`='$address' WHERE email = '$email'";
if (mysqli_query($db, $sql)) {
    $message = "<center>Record updated successfully</center>";
} else {
    $message = "Error: " . $sql . "<br>" . mysqli_error($db);
}

// Close the database connection
mysqli_close($db);
}
$message = isset($message) ? $message : "" ;

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
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
        <section class="section profile">
            <div class="row">
            <div class="col-xl-4">

                <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="staff_pictures/<?=$picture?>" alt="Profile" class="rounded-circle">
                    <h2><?=$fname . " " . $surname?></h2>
                    
                    <?php if($role == 1):?>
                        <span>Admin</span>
                    <?php endif;?>
                    <?php if($role == 2):?>
                        <span>Security Officer</span>
                    <?php endif;?>

                </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                    </ul>
                    <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                      
                        <h5 class="card-title">Profile Details</h5>
                        <?php if (isset($message)) {echo $message;} ?>
                        <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Full Name:</div>
                        <div class="col-lg-9 col-md-8"><?=$fname . " " . $surname?></div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 label">Rank:</div>
                        <div class="col-lg-9 col-md-8">
                            <?php if($role == 1):?>
                                <span>Admin</span>
                            <?php endif;?>
                            <?php if($role == 2):?>
                             <span>Security Officer</span>
                            <?php endif;?>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 label">Staff ID:</div>
                        <div class="col-lg-9 col-md-8"><?=$staff_id;?></div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 label">Phone:</div>
                        <div class="col-lg-9 col-md-8"><?=$phone;?></div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email Address:</div>
                        <div class="col-lg-9 col-md-8"><?=$email;?></div>
                        </div>

                        <div class="row">
                        <div class="col-lg-3 col-md-4 label">Address:</Address></div>
                        <div class="col-lg-9 col-md-8"><?=$address;?></div>
                        </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form method="POST">
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                            <img src="staff_pictures/<?=$picture?>" alt="Profile">
                            <div class="pt-2">
                                <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                            </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="fname" type="text" class="form-control" id="fname" value="<?=$fname?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="surname" type="text" class="form-control" id="surname" value="<?=$surname?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Rank:</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="role" type="text" class="form-control" id="role" 
                            value="<?php if($role == 1):?>
                                    Admin
                                <?php endif;?>
                                <?php if($role == 2):?>
                                    Security Officer
                                <?php endif;?>
                            " readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Staff</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="staff_id" type="text" class="form-control" id="staff" value="<?=$staff_id?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="phone" type="text" class="form-control" id="Phone" value="<?=$phone?>">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="Email" value="<?=$email?>">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control" id="Address" value="<?=$address?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="update_profile">Save Changes</button>
                        </div>
                        </form><!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>

                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="currentPassword">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                        </form><!-- End Change Password Form -->

                    </div>

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