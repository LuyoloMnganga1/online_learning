<?php
session_start();
include('includes/config.php');
if(isset($_POST['new_update']))
{
	$username=$_POST['username'];
	$new_password=md5($_POST['new_password']);   
	$confirm_new_password=md5($_POST['confirm_new_password']);  
    
    $sql ="SELECT * FROM users where email ='$username'";
	$query= mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if($count <= 0)
	{
        echo "<script>alert('Your credentials are invalid');</script>";
    }else if($new_password !== $confirm_new_password){
        echo "<script>alert('New password and confirm password do not match');</script>";
    }else{

    $result = mysqli_query($conn,"update users set password='$new_password' where email='$username'         
		")or die(mysqli_error());
        if ($result) {
            echo "<script>alert('Your password has been Successfully Updated');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else{
        die(mysqli_error());
    }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>E-learning System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assest/css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">E-learning System</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Forgot Password?</h3>
						<form action="#" class="login-form" method="POST" name="new_update">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="E-mail" name="username" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="New Password" name="new_password" required>
	            </div>
                <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Confirm New Password" name="confirm_new_password" required>
	            </div>
	           
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5" name="new_update">Reset Password </button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="assest/js/jquery.min.js"></script>
  <script src="assest/js/popper.js"></script>
  <script src="assest/js/bootstrap.min.js"></script>
  <script src="assest/js/main.js"></script>

	</body>
</html>