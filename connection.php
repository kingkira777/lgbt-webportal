<?php

	//Makiita to sa PhpmyAdmin

	$server = "localhost"; 
	$username = "root";
	$password = "admin"; //wlang pass depends sa pag install nyo ng Wamp or Xampp
	$database = "dblgbt"; //ung databse natin 
	
	$con = new MySQLi($server,$username,$password,$database); //Connection String
	
	//Check if we can connect or not
	if(!$con)
	{
		echo"Can't Connect" . mysqli_error($con);	
	}else
	//else if can.
	mysqli_select_db($con,$database);

?>