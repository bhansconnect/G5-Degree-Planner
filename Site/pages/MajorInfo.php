<?php
require "header.php";

require "mysql_connect.php";
$username = mysqli_real_escape_string($connection,$_SESSION['username']);
$sql = "select major from profiles where username='$username'";
$result = mysqli_query($connection, $sql);
$row = $result->fetch_assoc();

if ($row['major'] == "Computer Science"){
	header('Location: ComputerScience.php');
}else if ($row['major'] == "Mechanical Engineering"){
	header('Location: MechanicalEng.php');
}
else if ($row['major'] == "Electrical Engineering"){
	header('Location: ElectricalEng.php');
}else {
	header('Location: DegreePlanner.php');
}
exit();
?>
