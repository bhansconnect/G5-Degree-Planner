<?php
require "header.php";
if (isset($_POST['major_select'])){
	$host = "localhost";
	$username = "root";
	$password = "onesockman43";
	$db_name = "TSP";
	$tbl_name = "majors";

	$connection = mysqli_connect("$host","$username","$password","$db_name") or exit("cannot connect");
	$major_selected = mysqli_real_escape_string($connection, $_POST['major_select']);
	$sql = "select req_courses from $tbl_name where major='$major_selected'";
	$result = mysqli_query($connection, $sql);
	$row = $result->fetch_assoc();
	$classes  = explode(", ", $row['req_courses']);

	$username = mysqli_real_escape_string($connection, $_SESSION['username']);
	$tbl_name = "profiles";
	$sql = "select taken from $tbl_name where username='$username'";
	$result = mysqli_query($connection, $sql);
	$row = $result->fetch_assoc();
	$myclasses = explode(", ", $row['taken']);

	echo "required\ttaken<br>";
	foreach( $classes as $value){
		$flag = false;
		echo "$value\t";
		foreach( $myclasses as $taken){
			if ($value == $taken){
				$flag=true;
			}
		}
		unset($taken);
		if ($flag == true){
			echo "yes<br>";
		} else {
			echo "no<br>";
		}
		$tbl_name = "courses";
		$sql = "select course_name from courses where course_num='$value'";
		$result = mysqli_query($connection, $sql);
		$row = $result->fetch_assoc();
		$classname = $row['course_name'];
		echo "Course Name: $classname<br><br>";
}
	unset($value);
}
?>

<html>
	<head>
		<title>View Major</title>
	</head>
	<body>
	<div class="Viewer">
		<h1>Select Major to View</h1>
		<form method="post" action="viewmajor.php">
			<p><input type="text" name="major_select" value = "" placeholder="Major"></p>
			<p class ="submit"><input type="submit" name="commit" value="View Major"></p>
		</form>
	</div>
	<a href="index.php">Home</a>
	<a href="logout.php">Logout</a>
	<a href="schedule.php">View Schedule</a>
	<a href="addclass.php">Add Class</a>
	</body>
</html>
