<?php
include('top_section.php');
?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql1 = "SELECT * FROM users where id = ".$delete;
	$searcher= mysqli_query($conn,$sql1)or die(mysqli_error());
	$searcheder = mysqli_fetch_array($searcher);
	$name =$searcheder['name']." ".$searcheder['surname'];
	$sql = "DELETE FROM users where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('User named $name has been deleted','$session_id','0')         
          ") or die(mysqli_error()); 
		  		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('User named $name has been deleted','$session_id','1')         
				  ") or die(mysqli_error());
		echo "<script>alert('User deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'users.php'; </script>";
		
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
						<h3>List of Users</h3>
                        <?php
                        if($role==0){
                        ?>
                       <a style="color: white; background-color:green;padding: 10px;border-radius:20px;" href="add_user.php">
					        <i class='bx bx-plus' ></i>
					        <span class="text"> Add User</span>
				        </a>
                        <?php
                        }
                        ?>
					</div>
					<table>
						<thead>
							<tr>
                                <th>#</th>
								<th>Name</th>
                                <th>surname</th>
                                <th>E-mail</th>
								<th>Role</th>
								<th>CreatedAt</th>
                                <?php
                                if($role==0){
                                ?>
                                <th>Action</th>
                                <?php
                                }
                                ?>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $query= mysqli_query($conn,"SELECT * FROM users ORDER BY id desc")or die(mysqli_error());
                        $cnt=1;
						while ($row = mysqli_fetch_array($query)) {
									
                        ?>
							<tr>
                                <td>
                                <div class="name-avatar d-flex align-items-center">
										<div class="txt mr-2 flex-shrink-0">
											<b><?php echo htmlentities($cnt);?></b>
										</div>
									</div>
                                </td>
								<td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['surname']; ?></td>
								<td><?php echo $row['email'] ; ?></td>
                                <td><?php $user_role=$row['role'];
	                             if($user_role==0){
	                              ?>
	                                  <span style="color: green">Admin</span>
	                                  <?php } if($user_role==1)  { ?>
	                                 <span style="color: blue">Teacher</span>
	                                  <?php } if($user_role==2)  { ?>
	                             <span style="color: orange">Student</span>
	                             <?php } ?>
	                            </td>
								<td> <?php echo $row['created_at']; ?></td>
                                <?php
                                if($role==0){
                                ?>
                                <td>
                                <a style="color: white; background-color:skyblue;padding: 10px;border-radius:20px;" href="edit_user.php?edit=<?php echo $row['id'];?>">
                                    <i class='bx bx-pen' ></i>
				                </a>
                                <span style="margin-left: 10px;"></span>
                                <a style="color: white; background-color:red;padding: 10px;border-radius:20px;" onclick="return Confirm('Are you sure you want to delete this user?')" href="users.php?delete=<?php echo $row['id'] ?>">
                                    <i class='bx bx-trash'></i>
				                </a>
                                </td>
                                <?php
                                }
                                ?>
							</tr>
							<?php $cnt++; }?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
<?php
include('bottom_section.php')
?>