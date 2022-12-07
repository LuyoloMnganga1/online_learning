<?php
include('top_section.php');
?>
<?php $get_id = $_GET['edit']; ?>
<?php
if(isset($_POST['add'])) //if button add_staff is clicked  then adding user
{
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
    $user_role=$_POST['user_role'];

    $result = mysqli_query($conn,"update users set name='$name', surname='$surname', email='$email', role='$user_role' where id='$get_id'        
		"); 		
	if ($result) {
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('User named $name $surname has been updated','$session_id','0')         
          ") or die(mysqli_error()); 
		  		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('User named $name $surname has been updated','$session_id','1')         
				  ") or die(mysqli_error()); 
				  
     	echo "<script>alert('Record Successfully Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'users.php'; </script>";
	} else{
	  die(mysqli_error());
   }
}
?>
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>USERS</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">USERS</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">USERS MANAGEMENT</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Update User</h3>
					</div> 
                    <?php
						$query = mysqli_query($conn,"select * from users where id = '$get_id' ")or die(mysqli_error());
						$row = mysqli_fetch_array($query);									
                    ?>
					<form action="#" method="POST" name="add">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="name" placeholder="Your name.." required value="<?php echo $row['name']; ?>">

                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="surname" placeholder="Your last name.." required value="<?php echo $row['surname']; ?>">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Your email address.." required value="<?php echo $row['email']; ?>">

                        <label for="role">Role</label>
                        <select id="role" name="user_role" required>
                            <option value="" selected disabled>Select user role</option>
                        <?php
                         $query= mysqli_query($conn,"SELECT * FROM roles")or die(mysqli_error());
                         $cnt=1;
                         while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $row['role_id']?>"><?php echo $row['name']?></option>
                        <?php
                         }
                         ?>
                        </select>
  
                        <input type="submit" value="Update User" name="add">
                    </form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
<?php
include('bottom_section.php')
?>