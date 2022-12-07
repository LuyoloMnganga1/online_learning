<?php
include('top_section.php');
?>
<?php
$mesg_id = $_GET['id'];
$query= mysqli_query($conn,"SELECT * FROM messages where id = '$mesg_id'")or die(mysqli_error());
$row = mysqli_fetch_array($query);
$sender = $row['from_user'];
$updated = mysqli_query($conn,"UPDATE messages SET readed = 1 where id = '$mesg_id'")or die(mysqli_error());

 if(isset($_POST['add'])) //if button add_staff is clicked  then adding user
 {

     $from_user=$session_id;
     $to_user=$sender;
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
                        <h3> Reply to  Messages</h3>
                    </div>
                    <form action="#" method="POST" name="add" enctype="multipart/form-data">
                    <label for="role">From User</label>
                        <?php
                         $sql= mysqli_query($conn,"SELECT * FROM users where id = '$sender'")or die(mysqli_error());
                        $record = mysqli_fetch_array($sql);
                        ?>
                        <input type="text" name="user" value="<?php echo $record['name']." ".$record['surname']?>" style="background-color:lightgray;" readonly>

                        <label for="lname">Message</label>
                        <textarea  cols="30" rows="10" style="background-color:lightgray;" readonly><?php echo $row['message'];?></textarea>

                        <label for="lname">Reply Message</label>
                        <textarea name="mesg" id="mesg" cols="30" rows="10" required></textarea>
                    
                        <input type="submit" value="Send Message" name="add">
                    </form>
            </div>
        </main>

<?php
include('bottom_section.php')
?>