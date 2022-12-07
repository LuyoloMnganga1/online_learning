<?php
include('top_section.php');
?>
<?php
if (isset($_GET['delete'])) {
	$delete = $_GET['delete'];
	$sql = "DELETE FROM messages where id = ".$delete;
	$result = mysqli_query($conn, $sql);
	if ($result) {
		echo "<script>alert('Message deleted Successfully');</script>";
     	echo "<script type='text/javascript'> document.location = 'messages.php'; </script>";
		
	}
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
                        <h3>Messages</h3>
                        <a style="color: white; background-color:green;padding: 10px;border-radius:20px;" href="add_mess.php">
					        <i class='bx bx-plus' ></i>
					        <span class="text"> Add message</span>
				        </a>
                    </div>
                    <table>
						<thead>
							<tr>
                                <th>#</th>
								<th>FROM</th>
                                <th>CreatedAt</th>
                                <th>Action</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                        $query= mysqli_query($conn,"SELECT * FROM messages ORDER BY id desc")or die(mysqli_error());
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
								<td>
                                <?php
									$user_id  = $row['from_user'];
									$search= mysqli_query($conn,"SELECT * FROM users where id = '$user_id'")or die(mysqli_error());
									$searched = mysqli_fetch_array($search);
									echo $searched['name']." ".$searched['surname'];
									?>
                                </td>
								<td> <?php echo $row['created_at']; ?></td>
                                <td>
                                <a style="color: white; background-color:skyblue;padding: 10px;border-radius:20px;" href="mess_reply.php?id=<?php echo $row['id'] ?>">
                                    <i class='bx bx-pen'></i>
				                </a>
                                <span style="margin-left: 10px;"></span>
                                <a style="color: white; background-color:red;padding: 10px;border-radius:20px;" href="messages.php?delete=<?php echo $row['id'] ?>">
                                    <i class='bx bx-trash'></i>
				                </a>
                                </td>
                               
                               
							</tr>
							<?php $cnt++; }?>
						</tbody>
					</table>
            </div>
        </main>

<?php
include('bottom_section.php')
?>