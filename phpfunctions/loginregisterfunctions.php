<?php
//Connection to our Database
//pag wala to d siya makkpag save  sa madling say d sya makka connect sa Dabase
include'../connection.php';
//kuni natin ung Variable sa AJax using POST MEthod
//then check if the variable is Empty or not

//pag Emty ung Variable d siya ppsok sa ating If statement
if(isset($_POST['sr_studid']) && !empty($_POST['sr_studid']))
{
	//Pag hindi siya Empty
	$sr_studno = $_POST['sr_studid'];
	$sr_username = $_POST['sr_username'];
	$sr_password = $_POST['sr_password'];
	$sr_email = $_POST['sr_email'];
	$sr_gender = $_POST['sr_gender'];
	$sr_bday = $_POST['sr_bday'];
	
	
	$sqlCheckUsername = "select stud_uusername from tbluser where stud_uusername='$sr_username'";
	$resultCheckUsername = mysqli_query($con,$sqlCheckUsername);
	
	if(mysqli_num_rows($resultCheckUsername)> 0)
	{
		echo"Taken";	
	}
	else
	{
		$sqlSaveNewUser = "INSERT INTO tbluser(stud_uno, stud_uusername, stud_upassword, stud_uemail, stud_ugender, stud_birthday) Values('$sr_studno', '$sr_username', '$sr_password', '$sr_email', '$sr_gender', '$sr_bday')";
		$resultSaveNewUser = mysqli_query($con,$sqlSaveNewUser);
		if(!$resultSaveNewUser)
		{
			echo"Save Failed!";	
		}else{
			echo"Succesfuly Registered! Please Login";	
		}
	}
}


?>