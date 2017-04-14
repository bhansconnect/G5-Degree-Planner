<?php
require "header.php";
$selected = "";
if(!empty($_POST['courses'])){
	foreach($_POST['courses'] as $course){
		$selected = $selected.$course.", ";
	}
	$selected = substr($selected, 0, -2);
}
require "mysql_connect.php";
$username=$_SESSION['username'];
$major=mysqli_real_escape_string($connection, $_POST['major']);
$sql="Update profiles set taken='$selected' WHERE username='$username'";
$result=mysqli_query($connection, $sql);
header("Location: DegreePlanner.php");
exit();
?>