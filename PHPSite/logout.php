<?php
require "header.php";
$_SESSION['loggedin'] = false;
header('Location: login.php');
exit();
?>