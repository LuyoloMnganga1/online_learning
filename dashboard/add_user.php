<?php
include('top_section.php');
?>
<?php
if(isset($_POST['add'])) //if button add_staff is clicked  then adding user
{
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $user_role=$_POST['user_role'];

    $query = mysqli_query($conn,"select * from users where email = '$email'")or die(mysqli_error());
    $count = mysqli_num_rows($query);
    
    if ($count > 0){ ?>
    <script>
    alert('Data Already Exist');
   </script>
   <?php
   
     }else{
       mysqli_query($conn,"INSERT INTO users(name,surname,email,password,role) VALUES('$name','$surname','$email','$password','$user_role')         
       ") or die(mysqli_error()); 
          mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('New user named $name $surname has been created','$session_id','0')         
          ") or die(mysqli_error()); 
                    mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('New user named $name $surname has been created','$session_id','1')         
                    ") or die(mysqli_error()); 
    ?>
    
       <script>alert('User Records Added Successfully');</script>;
       <script>
       window.location = "users.php"; 
       </script>
     <?php   
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
						<h3>Add New User</h3>
					</div> 
					<form action="#" method="POST" name="add">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="name" placeholder="Your name.." required>

                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="surname" placeholder="Your last name.." required>
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Your email address.." required>

                        <label for="email">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your password address.." required>

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
  
                        <input type="submit" value="Add User" name="add">
                    </form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
<?php
include('bottom_section.php')
?>