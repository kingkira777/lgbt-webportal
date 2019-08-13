<?php
 error_reporting(0);
 include'../connection.php';



	//SENT CHAT
	if(isset($_POST['sch_uid']) && !empty($_POST['sch_uid']))
	{
		
		//SET THE TIMEZONE TO ASIA UCT +8
		date_default_timezone_set("Asia/Manila");
		
		$sch_uid = $_POST['sch_uid'];
		$sch_stdudno = $_POST['sch_stdudno'];
		$sch_username = $_POST['sch_username'];
		$sch_message = $_POST['sch_message'];
		$datenow = date("Y-m-d");
			
		//Get the User Firstname 
		$sqlFname = "select stud_firstname from tbluser where stud_uno='$sch_stdudno'";
		$reFname = mysqli_query($con,$sqlFname);
		$rowFname = mysqli_fetch_array($reFname);
		$cfname = $rowFname['stud_firstname'];	
			
		//Kunin natin ung IMAGE ng USER
		$sqlGetImage = "select stud_profilepath from tbluser where id='$sch_uid'";
		$resultGetImage = mysqli_query($con,$sqlGetImage);
		$rowGetImage = mysqli_fetch_array($resultGetImage);
		$imagePath = $rowGetImage['stud_profilepath'];
		
		
		$strTime = date("h:i:s a", time());
		
		$sqlSaveChatM = "insert into tblchatlogs(chat_userid, chat_userstudno, chat_username, chat_message, chat_date, chat_imagepath, chat_time, chat_fname)
							values('$sch_uid', '$sch_stdudno', '$sch_username' , '$sch_message', '$datenow', '$imagePath', '$strTime', '$cfname')";
		$resultSaveChatM = mysqli_query($con,$sqlSaveChatM);	
		
		if(!$resultSaveChatM)
		{
			echo"error";	
		}		
	}
	
	//GET CHAT
	if(isset($_POST['getchat']) && !empty($_POST['getchat']))
	{
		
		$gch_uid = $_POST['gch_uid'];
		
		$sqlGetChat = "select * from tblchatlogs ORDER BY id DESC LIMIT 50";
		$resultGetChat = mysqli_query($con,$sqlGetChat);
		while($rowGetChat = mysqli_fetch_array($resultGetChat))
		{
			$chat_userid = $rowGetChat['chat_userid'];
			$chat_fname = $rowGetChat['chat_fname'];
			$chat_userstudno = $rowGetChat['chat_userstudno'];
			$chat_username = $rowGetChat['chat_username'];
			$chat_message = $rowGetChat['chat_message'];
			$chat_date = $rowGetChat['chat_date'];
			$chat_imagepath = $rowGetChat['chat_imagepath'];
			$chat_time = $rowGetChat['chat_time'];
			
			$strImage = $chat_imagepath;
			
			if(!empty($strImage))
			{
				$strImage = $chat_imagepath;		
			}
			else
			{
				$strImage = "images/profileimages/user-logo.jpg";	
			}	
		
			
			echo"
				<li class=\"left clearfix\">
                	<span class=\"chat-img pull-left\">
                    <img src=".$strImage." class=\"img-circle\" style=\"width:50; height:50px;\">
                    </span>
                    
					<div class=\"chat-body clearfix\">
                    <div class=\"header\">
                    <strong class=\"primary-font\"><a href='viewprofile.php?userid=$chat_userid'>$chat_username</a> : $chat_userstudno</strong>
                    	<small class=\"pull-right text-muted\">
                        <i class=\"fa fa-clock-o fa-fw\"></i>$chat_time
                        </small>
                    </div>
					<p>$chat_message</p>
					</div>
                    </li>
			";
			
			
		}
	}
?>