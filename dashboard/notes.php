<?php
include('top_section.php');
?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql1 = "SELECT * FROM documents where id = ".$delete;
	$searcher= mysqli_query($conn,$sql1)or die(mysqli_error());
	$searcheder = mysqli_fetch_array($searcher);
	$name =$searcheder['name'];
	$sql = "DELETE FROM documents where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('Note named $name has been deleted','$session_id','2')         
		") or die(mysqli_error()); 
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('Note named $name has been deleted','$session_id','1')         
		") or die(mysqli_error()); 
		mysqli_query($conn,"INSERT INTO notifications (name,created_by,to_user) VALUES('Note named $name has been deleted','$session_id','0')         
		") or die(mysqli_error()); 
		echo "<script>alert('File deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'notes.php'; </script>";
		
	}
}

if (isset($_GET['file'])) {
    $file_path=$_GET['file'];
    $ctype="application/octet-stream";

      if(!empty($file_path) && file_exists($file_path)){ //check keberadaan file
        header("Pragma:public");
        header("Expired:0");
        header("Cache-Control:must-revalidate");
        header("Content-Control:public");
        header("Content-Description: File Transfer");
        header("Content-Type: $ctype");
        header("Content-Disposition:attachment; filename=\"".basename($file_path)."\"");
         header("Content-Transfer-Encoding:binary");
        header("Content-Length:".filesize($file_path));
        flush();
      readfile($file_path);
       exit();
     }else{
      echo "The File does not exist.";
     }
}

?>
		<!-- MAIN -->
		<main>
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
						<h3>List of Notes</h3>
                        <?php
                        if($role!==2){
                        ?>
                       <a style="color: white; background-color:green;padding: 10px;border-radius:20px;" href="add_note.php">
					        <i class='bx bx-plus' ></i>
					        <span class="text"> Add Note</span>
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
                                <th>File</th>
								<th>uploaded By</th>
                                <th>CreatedAt</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $query= mysqli_query($conn,"SELECT * FROM documents ORDER BY id desc")or die(mysqli_error());
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
                                <a style="color: white; background-color:orange;padding: 10px;border-radius:20px;" href="notes.php?file=<?php echo $row['path'] ?>">
                                    <i class='bx bx-file'></i>
				                </a>
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
                                <a style="color: white; background-color:red;padding: 10px;border-radius:20px;" onclick="return confirm('Are you sure you want to delete this file?')" href="notes.php?delete=<?php echo $row['id'] ?>">
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