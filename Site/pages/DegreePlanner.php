<?php
require "header.php";
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Degree Planner</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/degree_planner.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php
		require "navigation.php";
		?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Degree Planner</h1>
						<div class="panel-body">
							Your Current Major is: <?php
								require "mysql_connect.php";

								$username=$_SESSION['username'];

								$sql="SELECT major FROM profiles WHERE username='$username'";
								$result=mysqli_query($connection, $sql);
								$row = $result->fetch_assoc();
								echo $row['major'];
								$current_major = $row['major'];
							?>
							<form role="form" method="post" action="change_major.php">
								<fieldset>
									<div class="form-group">
										<select name="major"  class="selectpicker" data-live-search="true">
											<?php
												$sql="SELECT major FROM majors";
												$result=mysqli_query($connection, $sql);
												$rows = $result->fetch_all();
												foreach($rows as $row){
													echo '<option value="'.$row[0].'" ';
													if($row[0] == $current_major){
														echo "selected";
													}
													echo '>'.$row[0].'</option>';
												}
											?>
										</select>
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<!--a href="index.php" class="btn btn-lg btn-success btn-block">Login</a-->
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Change Major">
								</fieldset>
							</form>
						</div>
						<div class="panel-body">
							Selected Courses: <?php
								$sql="SELECT taken FROM profiles where username='$username'";
								$result=mysqli_query($connection, $sql);
								$row = $result->fetch_assoc();
								$taken = explode(", ", $row['taken']);
								echo($row['taken']);
							?>
							<form role="form" method="post" action="select_courses.php">
								<fieldset>
									<div class="form-group">
										<select name="courses[]"  class="selectpicker" data-live-search="true" multiple>
											<?php
												$sql="SELECT course_num, course_name FROM courses";
												$result=mysqli_query($connection, $sql);
												$rows = $result->fetch_all();
												foreach($rows as $row){
													if(in_array($row[0], $taken)){
														echo '<option value="'.$row[0].'" selected>'.$row[0].': '.$row[1].'</option>';
													}else{
														echo '<option value="'.$row[0].'">'.$row[0].': '.$row[1].'</option>';
													}
												}
											?>
										</select>
									</div>
									<!-- Change this to a button or input when using this as a form -->
									<!--a href="index.php" class="btn btn-lg btn-success btn-block">Login</a-->
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Select Courses">
								</fieldset>
							</form>
							<?php
								echo exec("python3 ../scheduler.py $username");
							?>
						</div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
