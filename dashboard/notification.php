<?php
include('top_section.php')
?>
		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>NOTIFICATION</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">NOTIFICATION</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent notification</h3>
					</div>
					<table>
						<thead>
							<tr>
                                <th>#</th>
								<th>Name</th>
								<th>CreatedBy</th>
								<th>CreatedAt</th>
							</tr>
						</thead>
						<tbody>
                        <?php

                        $query= mysqli_query($conn,"SELECT * FROM notifications where to_user ='$role' ORDER BY id desc LIMIT 5")or die(mysqli_error());
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
                                <?php 
                                $creater = $row['created_by'];
                                $seach= mysqli_query($conn,"SELECT * FROM users where id ='$creater'")or die(mysqli_error());
                                $record = mysqli_fetch_array($seach);
                                ?>
								<td><?php echo $record['name']." ".$record['surname']; ?></td>
								<td> <?php echo $row['created_at']; ?></td>
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