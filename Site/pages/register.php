<?php
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name'])){
    $host="localhost";
    $username="root";
    $password="onesockman43";
    $db_name="TSP";
    $tbl_name="profiles";

    $connection=mysqli_connect("$host", "$username", "$password", "$db_name")or exit("cannot connect");

    $name = $_POST['name'];
	$username=$_POST['username'];
    $password=$_POST['password'];

	$name = mysqli_real_escape_string($connection, $name);
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $sql="SELECT * FROM $tbl_name WHERE username='$username'";
    $result=mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    // If result matched $username and $password, table row must be 1 row
    if ($count > 0) {
        echo "Username already taken";
    } else {
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "insert into profiles (name, username, password, major, minor, taken) values ('$name', '$username', '$hash','','','');";
		$result=mysqli_query($connection, $sql);
		header("Location: index.php");
		exit();
	}
}
require "header.php";
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/degree_planner.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Pick a Username and Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="register.php">
                            <fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Your Name" name="name" type="text" autofocus>
								</div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!--a href="index.php" class="btn btn-lg btn-success btn-block">Login</a-->
								<input class="btn btn-lg btn-success btn-block" type="submit" value="Sign-Up">
                            </fieldset>
                        </form>
						<h4>Have an Account?</h4>
						<a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/degree_planner.js"></script>

</body>

</html>
