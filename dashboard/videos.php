<?php
include('top_section.php');
?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql1 = "SELECT * FROM videos where id = ".$delete;
	$searcher= mysqli_query($conn,$sql1)or die(mysqli_error());
	$searcheder = mysqli_fetch_array($searcher);
	$name =$searcheder['name'];
	$sql = "DELETE FROM videos where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('video named $name has been deleted','$session_id','2')         
		") or die(mysqli_error()); 
				mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('video named $name has been deleted','$session_id','1')         
				") or die(mysqli_error()); 
			mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('video named $name has been deleted','$session_id','0')         
			") or die(mysqli_error()); 
		echo "<script>alert('Video deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'videos.php'; </script>";
		
	}
}

?>
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>VIDEOS</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">videos</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">AVAILABLE videos</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>List of Videos</h3>
                        <?php
                        if($role!==2){
                        ?>
                       <a style="color: white; background-color:green;padding: 10px;border-radius:20px;" href="add_video.php">
					        <i class='bx bx-plus' ></i>
					        <span class="text"> Add Video</span>
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
                                <th>Video</th>
								<th>uploaded By</th>
                                <th>CreatedAt</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $query= mysqli_query($conn,"SELECT * FROM videos ORDER BY id desc")or die(mysqli_error());
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
								<td>
								<video width="320" height="240" controls>
									<source src="<?php echo $row['path']?>" type="video/mp4">
									<source src="<?php echo $row['path']?>" type="video/ogg">
								</video>
                                </td>
								<td>
									<?php
									$user_id  = $row['created_by'];
									$search= mysqli_query($conn,"SELECT * FROM users where id = '$user_id'")or die(mysqli_error());
									$searched = mysqli_fetch_array($search);
									echo $searched['name']." ".$searched['surname'];
									?>
								</td>
								<td> <?php echo $row['created_at']; ?></td>
                                <?php
                                if($role!==2){
                                ?>
                                <td>
                                <span style="margin-left: 10px;"></span>
                                <a style="color: white; background-color:red;padding: 10px;border-radius:20px;" onclick="return confirm('Are you sure you want to delete this video?')" href="videos.php?delete=<?php echo $row['id'] ?>">
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