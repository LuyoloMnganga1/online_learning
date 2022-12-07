<?php
include('top_section.php');
?>
<?php
 if(isset($_POST['add'])) //if button add_staff is clicked  then adding user
 {
     $from_user=$session_id;
     $to_user=$_POST['user'];
     $message=$_POST['mesg'];
     mysqli_query($conn,"INSERT INTO messages (from_user, to_user, message) VALUES ('$from_user', '$to_user', '$message')         
     ") or die(mysqli_error()); 
     
    ?>
      <script>alert('Message captured  Successfully');</script>;
       <script>
       window.location = "messages.php"; 
       </script>
    <?php
 }
?>
		<main>
			<div class="head-title">
				<div class="left">
					<h1>MESSAGES</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">MESSAGES</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">AVAILABLE MESSAGES</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="table-data">
            <div class="order">
					<div class="head">
                        <h3> Add New Messages</h3>
                    </div>
                    <form action="#" method="POST" name="add" enctype="multipart/form-data">
                    <label for="role">User</label>
                        <select id="user" name="user" required>
                            <option value="" selected disabled>Select user role</option>
                        <?php
                         $query= mysqli_query($conn,"SELECT * FROM users")or die(mysqli_error());
                         while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['name']." ".$row['surname']?></option>
                        <?php
                         }
                         ?>
                        </select>

                        <label for="lname">Message</label>
                        <textarea name="mesg" id="mesg" cols="30" rows="10" required></textarea>
                    
                        <input type="submit" value="Add Message" name="add">
                    </form>
            </div>
        </main>

<?php
include('bottom_section.php')
?>