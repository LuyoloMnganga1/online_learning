<?php
include('top_section.php');
?>
<?php
    if(isset($_POST['add'])) //if button add_staff is clicked  then adding user
    {
        $name=$_POST['name'];
        $filename = basename($_FILES['attach']['name']);
        $path="uploads/notes/".$filename;
        if (move_uploaded_file($_FILES['attach']['tmp_name'],  $path)) {
            mysqli_query($conn,"INSERT INTO documents (name,path,created_by) VALUES('$name','$path','$session_id')         
        ") or die(mysqli_error()); 
         mysqli_query($conn,"INSERT INTO notifications (name, created_by, to_user) VALUES('New note named $name has been uploaded','$session_id','2')         
         ") or die(mysqli_error()); 
          mysqli_query($conn,"INSERT INTO notifications (name, created_by, to_user) VALUES('New note named $name has been uploaded','$session_id','1')         
          ") or die(mysqli_error());
          mysqli_query($conn,"INSERT INTO notifications (name, created_by, to_user) VALUES('New note named $name has been uploaded','$session_id','0')         
          ") or die(mysqli_error());
     ?>
        <script>alert('File uploaded');</script>;
        <script>
        window.location = "notes.php"; 
        </script>
      <?php   
        } else {
            ?>
        <script>alert('An error occurred');</script>;
        <!-- <script>
        window.location = "notes.php"; 
        </script> -->
      <?php   
        }
}
?>
		<!-- MAIN -->
		<main>
			<div class="head-title">
            <div class="head-title">
				<div class="left">
					<h1>NOTES</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">NOTES</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">AVAILABLE NOTES</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Add New Note</h3>
					</div> 
					<form action="#" method="POST" name="add" enctype="multipart/form-data">
                        <label for="fname">Name</label>
                        <input type="text" id="fname" name="name" placeholder="Your name.." required>

                        <label for="lname">Attachment</label>
                        <input type="file" id="lname" name="attach" placeholder="Your last name.." required accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                        
                        <input type="submit" value="Add Note" name="add">
                    </form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
<?php
include('bottom_section.php')
?>