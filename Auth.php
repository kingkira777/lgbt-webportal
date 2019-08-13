<?php
	error_reporting(0);
	session_start();//dito rin kailangan to
	include'connection.php';
	$username = $_SESSION['studusername'];
	$userpass = $_SESSION['studpassword'];
	$studno = $_SESSION['studentno'];
	
	$sqlCheck = "select * from tbluser where stud_uusername='$username' and stud_upassword='$userpass'";
	$resultCheck = mysqli_query($con,$sqlCheck); // EXecute Query	
	$row = mysqli_fetch_assoc($resultCheck);
	$loguser = $row['stud_uusername'];
	$logpass = $row['stud_upassword'];
	if(!empty($loguser) && !empty($logpass)){
	}else{
		header("Location: index.php");
	}
	
?>