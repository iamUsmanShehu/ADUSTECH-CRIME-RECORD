<?php 
	include("includes/connection.php");
	if(isset($_POST["password"])){ 

		session_start();
		if ($_POST){

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password']= $_POST['password'];

		$message=[];

		if ($_SESSION['username'] && $_SESSION['password']){
			$query = mysqli_query($db, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
			$numrows = mysqli_num_rows($query);
			
			if ($numrows != 0){
				
				while($row = mysqli_fetch_assoc($query)){
					$dbusername = $row['username'];
					$dbpassword = $row['password'];
					$_SESSION['id']= $row['id'];
					$_SESSION['fname']= $row['fname'];
					$_SESSION['surname']= $row['surname'];
					$_SESSION['username']= $row['username'];
					$_SESSION['role']= $row['role'];
					$_SESSION['staff_id']= $row['staff_id'];
					$_SESSION['email']= $row['email'];
					$_SESSION['phone']= $row['phone'];
					$_SESSION['address']= $row['address'];
					$_SESSION["account_id"]= $row['id'];
					// $_SESSION['address']= $row['address'];
					$_SESSION['picture']= $row['picture'];

				}
				if($_SESSION['username']==$dbusername){
					if($_SESSION['password']==$dbpassword){
						
						$message = "You have login successfully";
						header("refresh:2; url='dashboard.php'");
						
					}else{ 
						$message = "your password is incorrect!";
					}
				}else{
					$message = "your name is incorrect!";
				}
			}else{
					$message = "Invalid username!";
				}
		}else{
					$message = "You have to type a username and Password!";
				}
		}else{
			echo "Access Denied!";
			exit;
		}
	}

 ?>
<style>
    .card-body{
        border-radius: 10px;
        background: #ffff;
        box-shadow: 6px -6px 12px #bebebe, inset -6px 6px 0px #078b09;
        padding: 20px;
        /* margin-top:-200px; */
    }
</style>
<div class="container">
<!-- <div class="card" style="width:50%; margin-top:100px;"> -->
    <div class="card-body">
      <h5 class="card-title">Account Login</h5>
      <h6><?php if (isset($message)) echo "$message"; ?></h6>
<br>
      <!-- Registration Form -->
      <form class="row g-3" method="POST">
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingEmail" placeholder="Your Email" name="username">
            <label for="floatingEmail">Your Username</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
          </div>
        </div>

       
        <div class="text-cente">
          <button type="submit" class="btn btn-success">Login</button>
          <a href="index.php" class="btn btn-secondary"><i class="bx bxl-lock"></i>Back</a>
        </div>
      </form>

    </div>
  </div>
</div>