<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $hostname = "mysql.comp.polyu.edu.hk";
    // $hostname = "localhost";
    $username = "17040377d";
    // $username = "root";
    $password = "uftrfseo";
    // $password = "";
    $db = "17040377d";
    // $db = "project_db";
	$conn = mysqli_connect($hostname, $username, $password, $db)
			or die(mysqli_connect_error());
?>
