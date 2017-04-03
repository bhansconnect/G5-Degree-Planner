<?php
if(isset($_POST['username']) && isset($_POST['password'])){
	$host="localhost";
	$username="root"; 
	$password="onesockman43";
	$db_name="TSP";
	$tbl_name="profiles";

	$connection=mysqli_connect("$host", "$username", "$password", "$db_name")or exit("cannot connect"); 

	$username=$_POST['username']; 
	$password=$_POST['password']; 

	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);
	$sql="SELECT * FROM $tbl_name WHERE username='$username'";
	$result=mysqli_query($connection, $sql);
	$row = $result->fetch_assoc();

	// If result matched $username and $password, table row must be 1 row
	if(password_verify($password , $row['password'])){
		session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
	}else{
		echo "Login Failed: Username or Password wrong.";
	}
}
require "header.php";
?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
	<div class="login">
      <h1>Login</h1>
      <form method="post" action="login.php">
        <p><input type="text" name="username" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>

        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
	Need an account? <a href="register.php">Register</a>
	</body>
</html>
