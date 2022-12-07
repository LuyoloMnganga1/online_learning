<?php include('../includes/config.php'); ?>
<?php include('../includes/session.php');?>
<?php
$query= mysqli_query($conn,"select * from users where id = '$session_id'")or die(mysqli_error());
$row = mysqli_fetch_array($query);
$role = $row['role'];
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="styles/style.css">

	<title>E-Learning</title>
</head>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=file] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
textarea{
  width: 100%;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #45a049;
}
</style>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-book'></i>
			<span class="text">E-Learning</span>
		</a>
		<ul class="side-menu top">
			<li class="<?= ($activePage == 'index') ? 'active':''; ?>">
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="<?= ($activePage == 'notes') ? 'active':''; ?>">
				<a href="notes.php">
					<i class='bx bxs-note' ></i>
					<span class="text">Notes</span>
				</a>
			</li>
			<li class="<?= ($activePage == 'videos') ? 'active':''; ?>">
				<a href="videos.php">
					<i class='bx bxs-video' ></i>
					<span class="text">Videos</span>
				</a>
			</li>
			<li class="<?= ($activePage == 'messages') ? 'active':''; ?>">
			<?php			
				$sql ="SELECT * FROM messages where to_user ='$session_id' and readed = 0";
				$query= mysqli_query($conn, $sql)or die(mysqli_error());
				$count = mysqli_num_rows($query);
			?>
				<a href="messages.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message 
					<span class="num" style="margin-left: 10px;color:white;background-color:lightblue;padding:2px;border-raduis:50px;"><?php echo $count ?></span>
					</span>
				</a>
			</li>
			<li class="<?= ($activePage == 'users') ? 'active':''; ?>">
				<a href="users.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Users</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link"></a>
			<form action="#">
				<div class="form-input">
					<!-- <input type="search" placeholder="Search..." style="background-color:trans">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button> -->
				</div>
			</form>
			<!-- <input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label> -->
			
			<?php			
				$sql ="SELECT * FROM notifications where to_user ='$role'";
				$query= mysqli_query($conn, $sql)or die(mysqli_error());
				$count = mysqli_num_rows($query);
			?>
			<a class="notification" href="notification.php">
				<i class='bx bxs-bell' ></i>
				<span class="num"><?php echo $count ?></span>
			</a>
			<a href="#" class="profile">
				<h1 class="h1"><?php echo $row['name']. " " .$row['surname']; ?></h1>
			</a>
		</nav>
		<!-- NAVBAR -->
