<?php
require "header.php";
if (isset($_POST['department']) && isset($_POST['class_num']) ){//&& isset($_SESSION['username']) && $_SESSION['loggedin']==true){
	//session_start();
	if (!isset($_SESSION['username'])||!$_SESSION['loggedin']==true){
		exit("must log in");
	}

	$host="localhost";
	$username="root";
	$password="onesockman43";
	$db_name="TSP";
	$tbl_name="profiles";

	$connection=mysqli_connect("$host", "$username", "$password", "$db_name")or exit("cannot connect");

	$dept = $_POST['department'];
	$cID = $_POST['class_num'];

	$username = mysqli_real_escape_string($connection, $_SESSION['username']);
	$dept = mysqli_real_escape_string($connection, $dept);
	$cID = mysqli_real_escape_string($connection, $cID);
	$sql="select * from courses where course_num='$dept $cID'";
	$result = mysqli_query($connection, $sql);
	$column = 'taken';
	if (mysqli_num_rows($result)== 1){
		$sql = "select * from profiles where username='$username'";
		$result = mysqli_query($connection, $sql);
		$row=$result->fetch_assoc();
		if ($row[$column] == ""){
			$sql="update $tbl_name set taken='$dept $cID' where username='$username'";
		} else {
			$sql="update $tbl_name set taken=concat(taken, ', $dept $cID') WHERE username='$username'";
		}
		$result=mysqli_query($connection, $sql);

		echo "$dept $cID Added to Classes Taken";
	} else {
		echo "Invalid Department or Course Number";
	}

}
?>

<html>
	<head>
		<title>Add Class</title>
	</head>
	<body>
	<div class="ClassAdd">
		<h1>Add Class</h1>
		<form method="post" action="addclass.php">
			<p><input type="text" name="department" value="" placeholder="Department"></p>
			<p><input type="text" name="class_num" value="" placeholder="CourseNumber"></p>

			<p class="submit"><input type="submit" name="commit" value="Add Class"></p>
		</form>
	</div>
	<a href="index.php">Home</a>
	<a href="logout.php">Logout</a>
	<a href="viewmajor.php">See Major</a>
	<a href="schedule.php">View Schedule</a>
	</body>
</html>
