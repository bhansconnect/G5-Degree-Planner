<?php
if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])){
	$host="localhost";
	$username="root"; 
	$password="onesockman43";
	$db_name="TSP";
	$tbl_name="profiles";

	$connection=mysqli_connect("$host", "$username", "$password", "$db_name")or exit("cannot connect"); 

	$name=$_POST['username'];
	$username=$_POST['username']; 
	$password=$_POST['password']; 

	$name = mysqli_real_escape_string($connection, $name);
	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);
	$sql="SELECT * FROM $tbl_name WHERE username='$username'";
	$result=mysqli_query($connection, $sql);
	$count=mysqli_num_rows($result);

	// If result matched $username and $password, table row must be 1 row
	if($count > 0){
		echo "Username already taken.";
	}else{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO profiles (name, username, password) VALUES ('$name', '$username', '$hash');";
		$result=mysqli_query($connection, $sql);
		echo "Account Created!";
		echo "<br>Redirecting to <a href='login.php'>login</a>.";
		header( "refresh:5; url=login.php" ); 
		exit();
	}
}
require "header.php";
?>
<html>
	<head>
		<title>Register</title>
	</head>
	<body id="body-color">
		<div id="Sign-Up">
			<h1>Register</h1>
			<table border="0">
				<form method="POST" action="register.php">
					<tr>
						<td>Name:</td><td> <input type="text" name="name"></td>
					</tr>
					<tr>
						<td>Username:</td><td> <input type="text" name="username"></td>
					</tr>
					<tr>
						<td>Password:</td><td> <input type="password" name="password"></td>
					</tr>
					<tr>
						<td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
					</tr>
				</form>
			</table>
		</div>
	Have an account? <a href="login.php">Login</a>
	</body>
</html>