<?php
require "header.php";
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true && isset($_POST['major_input'])){
	$username="root";
	$password="onesockman43";
	$host="localhost";
	$db_name="TSP";
	$tbl_name = "profiles";

	$connection=mysqli_connect("$host","$username", "$password", "$db_name") or exit("cannot connect");

	$username=$_SESSION['username'];

	$username=mysqli_real_escape_string($connection, $username);
	/*$sql="select * from $tbl_name where username='$username'";
	$result=mysqli_query($connection, $sql);
	$row = $result->fetch_assoc();

	$classes_taken = $row['taken'];

	$tbl_name = "majors";*/
	$major_input = mysqli_real_escape_string($connection,$_POST['major_input']);
	/*$sql = "select * from $tbl_name where major='$major_input'";
	$result = mysqli_query($connection, $sql);
	$row = $result->fetch_assoc();

	$classes_needed = $row['req_courses'];*/
	echo exec("python3 scheduler.py");
}
?>

<html>
	<head>
		<title>Schedule</title>
	</head>
	<body>
	<h1>Schecule</h1>
	<div class="schedule">
		<form method="post" action="schedule.php">
			<p><input type="text" name="major_input" value="" placeholder="Major"></p>

			<p class="submit"><input type="submit" name="commit" value="View Schedule"></p>
		</form>
	</div>
	<a href="viewmajor.php">View Major</a>
	<a href="addclass.php">Add Class</a>
	<a href="index.php">Home</a>
	<a href="logout.php">Logout</a>
	</body>
</html>
