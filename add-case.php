
<!-- case_date
type 
officer 

complainer_sex 
complainer_name 
complainer_reg 
complainer_level 
complainer_picture
complainer_department
complainer_faculty
complainer_phone
complainer_address 

complainant_sex 
complainant_name 
compalinant_reg 
complainant_level 
complainant_picture
complainant_department
complainant_faculty
complainant_phone
complainant_address  

statement 
verdit 
status 
penalty 
finger 
complainant_picture -->
<?php 
include "includes/connection.php";
// session_start();

if (isset($_POST["add-case"])) {
  
  // Handling complainer picture upload
  $complainer_picture = '';
  if ($_FILES['complainer_picture']['error'] == 0) {
    $complainer_picture = $_FILES['complainer_picture']['name'];
    $complainer_target = "uploaded_imgs/" . basename($complainer_picture);
    if (!move_uploaded_file($_FILES['complainer_picture']['tmp_name'], $complainer_target)) {
      $complainer_picture = ''; // Reset if upload fails
    }
  }

  // Handling complainant picture upload
  $complainant_picture = '';
  if ($_FILES['complainant_picture']['error'] == 0) {
    $complainant_picture = $_FILES['complainant_picture']['name'];
    $complainant_target = "uploaded_imgs/" . basename($complainant_picture);
    if (!move_uploaded_file($_FILES['complainant_picture']['tmp_name'], $complainant_target)) {
      $complainant_picture = ''; // Reset if upload fails
    }
  }

  $case_date = $_POST['case_date'];
  $staff_officer = $_POST['staff_officer'];

  $complainer_sex = $_POST["complainer_sex"];
  $complainer_name = mysqli_real_escape_string($db, $_POST["complainer_name"]);
  $complainer_reg = $_POST["complainer_reg"];
  $complainer_level = $_POST["complainer_level"];
  $complainer_department = $_POST["complainer_department"];
  $complainer_faculty = $_POST["complainer_faculty"];
  $complainer_phone = $_POST["complainer_phone"];
  $complainer_address = $_POST["complainer_address"];

  $complainant_sex = $_POST["complainant_sex"];
  $complainant_name = mysqli_real_escape_string($db, $_POST["complainant_name"]);
  $compalinant_reg = $_POST["compalinant_reg"];
  $complainant_level = $_POST["complainant_level"];
  $complainant_department = $_POST["complainant_department"];
  $complainant_faculty = $_POST["complainant_faculty"];
  $complainant_phone = $_POST["complainant_phone"];
  $complainant_address = $_POST["complainant_address"];
 
  $case_type = $_POST["case_type"];
  $statement = mysqli_real_escape_string($db, $_POST["statement"]);
  $time = date("h:i A");
  $account_id = $_SESSION['id'];

  if ($case_date && $staff_officer && $complainer_sex && $complainer_name && $complainer_reg && $complainer_level && $complainant_sex && $complainant_name && $compalinant_reg && $complainant_level && $case_type && $statement) {

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the user data into the cases table
    $sql = "INSERT INTO cases (case_date, staff_officer, complainer_sex, complainer_name, complainer_reg, complainer_level, complainer_picture, complainer_department, complainer_faculty, complainer_phone, complainer_address, complainant_sex, complainant_name, compalinant_reg, complainant_level, complainant_picture, complainant_department, complainant_faculty, complainant_phone, complainant_address, case_type, statement, case_time, account_id) VALUES ('$case_date', '$staff_officer', '$complainer_sex', '$complainer_name', '$complainer_reg', '$complainer_level', '$complainer_picture', '$complainer_department', '$complainer_faculty', '$complainer_phone', '$complainer_address', '$complainant_sex', '$complainant_name', '$compalinant_reg', '$complainant_level', '$complainant_picture','$complainant_department', '$complainant_faculty', '$complainant_phone', '$complainant_address', '$case_type', '$statement', '$time', '$account_id')";

    if (mysqli_query($db, $sql)) {
        // $message = "<center>Case Recorded successfully!</center>";
        header("location: dashboard.php");
        exit();
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    // Close the database connection
    // mysqli_close($db);

  } else {
    $message = "All fields are required*";
  }
}
ob_end_flush();
?>

<style>
  select, textarea, input{margin: 5px;}
  .card {box-shadow: 0px 0 8px 4px rgba(1, 41, 112, 0.1);}
</style>
  <div class="modal fade" id="fullscreenModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Case</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
        <div class="container">
          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                  <!-- if (isset($message)) {echo $message;} -->
                      <div class="card-title">Basic Info</div>
                      <input type="date" name="case_date" class="form-control p-3" placeholder="case_date">
                      <select name="staff_officer" class="form-control p-3">
                          <option value="">Staff Officer...</option>
                          
                          <?php 
                                include "includes/connection.php";
                                $sql = "SELECT * FROM users WHERE role = 0";
                                $query = mysqli_query($db, $sql);
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($query)):
                            ?>
                                <option value="<?=$row["staff_id"];?>"><?=$row["fname"] . " " . $row["surname"]?></option>
                                
                            </tr>
                                <?php endwhile; ?>
                      </select>
                      
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
                      <div class="col-8"></div>
                      <div class="col-4">
                          <div class='row'>
                          <div class="form-control border-success color-black" style='height:150px;'>
                            <i class="bi bi-person"></i>
                          </div>
                          <input type="file" name="complainer_picture" class="form-control p-3" placeholder="complainer_picture">
                        </div>
                      </div>
                    </div>
                    
                      <select name="complainer_sex" class="form-control p-3">
                        <option value="">Select Gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <input type="text" name="complainer_name" class="form-control p-3" placeholder="Complainer_name">
                      <input type="text" name="complainer_reg" class="form-control p-3" placeholder="Complainer_reg">
                      <select name="complainer_level" class="form-control p-3">
                          <option value="">Student Level...</option>
                          <option value="100">100</option>
                          <option value="200">200</option>
                          <option value="300">300</option>
                          <option value="400">400</option>
                          <option value="500">500</option>
                          <option value="spill 1">spill 1</option>
                          <option value="spill 2">spill 2</option>
                      </select>
                      <input type="text" name="complainer_department" class="form-control p-3" placeholder="Department">
                      <input type="text" name="complainer_faculty" class="form-control p-3" placeholder="Faculty">
                      <input type="number" name="complainer_phone" class="form-control p-3" placeholder="Phone">
                      <textarea type="text" name="complainer_address" class="form-control p-3" placeholder="Block/Room No"></textarea>
                      <input type="number" name="complainer_age" class="form-control p-3" placeholder="Age">
                      <select name="complainant_religion" class="form-control p-3">
                          <option value="">Religion...</option>
                          <option value="Islam">Islam</option>
                          <option value="Christian">Christian</option>
                      </select>
                     
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title"> Suspect </div>
                    <div class="row">
                      <div class="col-8"></div>
                      <div class="col-4">
                        <div class="form-control border-warning color-black" style='height:150px;'>
                          <i class="bi bi-person"></i>
                        </div>
                         <input type="file" name="complainant_picture" class="form-control p-3" placeholder="Suspect_picture">
                      </div>
                    </div>
                      <select name="complainant_sex" class="form-control p-3">
                          <option value="">Select Gender...</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                      </select>
                      <input type="text" name="complainant_name" class="form-control p-3" placeholder="Suspect_name">
                      <input type="text" name="compalinant_reg" class="form-control p-3" placeholder="Suspect_reg">
                      <select name="complainant_level" class="form-control p-3">
                          <option value="">Student Level...</option>
                          <option value="100">100</option>
                          <option value="200">200</option>
                          <option value="300">300</option>
                          <option value="400">400</option>
                          <option value="500">500</option>
                          <option value="spill 1">spill 1</option>
                          <option value="spill 2">spill 2</option>
                      </select>
                      <input type="text" name="complainant_department" class="form-control p-3" placeholder="Department">
                      <input type="text" name="complainant_faculty" class="form-control p-3" placeholder="Faculty">
                      <input type="number" name="complainant_phone" class="form-control p-3" placeholder="Phone">
                      <textarea type="text" name="complainant_address" class="form-control p-3" placeholder="Block/Room No"></textarea>
                      <input type="number" name="complainant_age" class="form-control p-3" placeholder="Age">
                      <select name="complainant_religion" class="form-control p-3">
                          <option value="">Religion...</option>
                          <option value="Islam">Islam</option>
                          <option value="Christian">Christian</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-title">Case Category</div>
                      
                      <select name="case_type" class="form-control p-2">
                        <option value="">Case Category ...</option>
                        <option value="Fighting">Civil Case</option>
                        <option value="Stealing">Criminal Case</option>
                      </select>
                      <input type="text" name="case type" class="form-control p-3" placeholder="Case Type">
                           
                      <textarea type="text" name="statement" class="form-control p-3" placeholder="statement..."></textarea>
                      <div class="">
                        <button type="button" class="btn btn-danger">Enrollment</button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="add-case">Add Case</button>
        </div>
      </form>
      </div>
    </div>
  </div><!-- End Full Screen Modal-->
