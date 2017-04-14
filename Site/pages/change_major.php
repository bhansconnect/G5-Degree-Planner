<?php
require "header.php";
if(isset($_POST['major'])){
    require "mysql_connect.php";
	$username=$_SESSION['username'];
	$major=mysqli_real_escape_string($connection, $_POST['major']);
	$sql="Update profiles set major='$major' WHERE username='$username'";
    $result=mysqli_query($connection, $sql);
}
header("Location: DegreePlanner.php");
exit();
?>