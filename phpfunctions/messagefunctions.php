<?php

	include'../connection.php';

	if(isset($_POST['d_sid']) && !empty($_POST['d_sid']))
	{
		$isSentItems= "sentitems";
		$sid = $_POST['d_sid'];
		DeleteMessage($isSentItems,$sid,$con);
	}


	//DELETE MESSAGE
	if(isset($_POST['d_mid']) && !empty($_POST['d_mid']))
	{
		$isMessage = "inbox";
		$mid = $_POST['d_mid'];
		DeleteMessage($isMessage,$mid,$con);
	}

	//GET INBOX
	if(isset($_POST['ginbox']) && !empty($_POST['ginbox']))
	{
		$gm_username = $_POST['gm_username'];
		$sqlGetInBox = "select * from tblinboxmessage where im_reicever='$gm_username'";
		$resultGetInBox = mysqli_query($con,$sqlGetInBox);
		
		if(mysqli_num_rows($resultGetInBox)> 0 )
		{
			while($rowGetInbox = mysqli_fetch_array($resultGetInBox))
			{
				$im_id = $rowGetInbox['id'];
				$sm_from = $rowGetInbox['im_sender'];
				$sm_message = $rowGetInbox['im_message'];
				$sm_date = $rowGetInbox['im_date'];
				echo"
					<tr>
						<td>".$sm_from."</td>
						<td>".$sm_message."</td>
						<td>".$sm_date."</td>
						<td>
						<button type='button' class='btn btn-default btn-sm' onclick='DeleteMessage($im_id)'>
							<i class='fa fa-trash-o fa-fw'></i>
							<strong>DELETE</strong>
						</button>
						</td>
					</tr>
				";	
			}
		}
		else
		{
			echo "
				<tr>	
					<td colspan='4' class='alert-warning' align='center'><strong>INBOX IS EMPTY!</strong></td>
				</tr>
			";
		}	
	}

	//GET SENT ITEMS
	if(isset($_POST['gsentitems']) && !empty($_POST['gsentitems']))
	{
		$guid = $_POST['guid'];
		$sqlGetSentItems = "select * from tblsentmessage where sm_userid='$guid'";
		$resultSentItems = mysqli_query($con,$sqlGetSentItems);
		
		if(mysqli_num_rows($resultSentItems)> 0 )
		{
			while($rowSentItems = mysqli_fetch_array($resultSentItems))
			{
				$sm_id =$rowSentItems['id'];
				$sm_to = $rowSentItems['sm_to'];
				$sm_message = $rowSentItems['sm_message'];
				$sm_date = $rowSentItems['sm_date'];
				
				echo"
					<tr>
						<td>".$sm_to."</td>
						<td>".$sm_message."</td>
						<td>".$sm_date."</td>
						<td>
						<button type='button' class='btn btn-default btn-sm' onclick='DeleteSentItems($sm_id)'>
							<i class='fa fa-trash-o fa-fw'></i>
							<strong>DELETE</strong>
						</button>
						</td>
					</tr>
				";	
			}
		}
		else
		{
			echo "
				<tr>	
					<td colspan='4' class='alert-warning' align='center'><strong>SENT ITEMS IS EMPTY!</strong></td>
				</tr>
			";		
		}
		
	}

	//SEND MESSAGE
	if(isset($_POST['sm_uid']) && !empty($_POST['sm_uid']))
	{
		$sm_uid = $_POST['sm_uid'];
		$sm_studno = $_POST['sm_studno'];
		$sm_username = $_POST['sm_username'];
		$sm_mymessage = $_POST['sm_mymessage'];
		
		$sm_listofuser = $_POST['sm_listofuser'];
		$datenow = date("Y-m-d");		
		
		$sqlSentMessage = "insert into tblsentmessage(sm_userid, sm_studno, sm_username, sm_message, sm_to, sm_date)
					Values('$sm_uid', '$sm_studno', '$sm_username', '$sm_mymessage', '$sm_listofuser', '$datenow')";
		$resultSentMessage = mysqli_query($con,$sqlSentMessage);
		
		if(!$resultSentMessage)
		{
			echo "Error Sending Message";	
		}
		else
		{
			
			//SAVE natin sa tblmEssage ung na Send na
			$sqlSaveInbox = "insert into tblinboxmessage(im_senderuserid, im_senderstudno, im_sender, im_message, im_reicever, im_date )
							values('$sm_uid', '$sm_studno', '$sm_username', '$sm_mymessage', '$sm_listofuser', '$datenow')";
			$resultSaveInbox = mysqli_query($con,$sqlSaveInbox);
			if(!$resultSaveInbox)
			{
					
			}
			else
			{
				echo "Sent Message";
			}
		}
	}	

	//GET USERS
	if(isset($_POST['guser']) && !empty($_POST['guser']))
	{
		$gm_uid = $_POST['gm_uid'];
		$isconfirmed = "confirmed";
					//Check kung sino ung mga friends and confirmed
		$sqlGetFriends = "select * from tblfriendsrequest where (f_uid='$gm_uid' and f_confirmed='$isconfirmed') or (f_touid='$gm_uid' and f_confirmed='$isconfirmed')";
					
		$resultGetUser = mysqli_query($con,$sqlGetFriends);
		if(mysqli_num_rows($resultGetUser)> 0)
		{
			while($rowGetUser = mysqli_fetch_array($resultGetUser))
			{
				
				$f_uid = $rowGetUser['f_uid'];
				$f_uid1 =$rowGetUser['f_touid'];
				
				$f_guser = $rowGetUser['f_username'];
				$f_guser1 = $rowGetUser['f_tousername'];
				
				
				if($gm_uid != $f_uid)
				{
				echo"
					<option value='".$f_guser."'>".$f_guser."</option>
				";
				}
				if($gm_uid !=$f_uid1)
				{
				echo"
					<option value='".$f_guser1."'>".$f_guser1."</option>
					";
				}
			}
		}
	}

//FUNCTIONS
	function DeleteMessage($isInbox, $id, $connection)
	{
		
		if($isInbox == "inbox")
		{		
			$slqDeleteMessage = "delete from tblinboxmessage where id='$id'";
			$resultDeleteMessage = mysqli_query($connection,$slqDeleteMessage);
			if(!$resultDeleteMessage)
			{
				echo "Error";
			}
			else
			{
				echo"Deleted";	
			}
		}
		else if($isInbox == "sentitems")
		{
			$slqDeleteMessage = "delete from tblsentmessage where id='$id'";
			$resultDeleteMessage = mysqli_query($connection,$slqDeleteMessage);
			if(!$resultDeleteMessage)
			{
				echo "Error";
			}
			else
			{
				echo"Deleted";	
			}
		}
		
	}

?>