<?php
	include'../connection.php';
	
	//DELETE COMMENT
	if(isset($_POST['_uid']) && !empty($_POST['_uid']))
	{
		$_uid = $_POST['_uid'];
		$_cid = $_POST['_cid'];
		
		$sqlDeleteComment = "delete from tblcomment where id='$_cid' and ct_uid='$_uid'";
		$resultDeleteComment = mysqli_query($con,$sqlDeleteComment);
		
		if(!$resultDeleteComment)
		{
			echo"Error";	
		}
		else
		{
			echo"Succesfuly Deleted!s";
		}
		
	}
	
	//SAVE EDIT COMMENT 
	if(isset($_POST['esdc_uid']) && !empty($_POST['esdc_uid']))
	{
		$esdc_uid = $_POST['esdc_uid'];	
		$esd_cid = $_POST['esd_cid'];
		$esdeditComment = $_POST['esdeditComment'];
		$sqlUpdateComment = "update tblcomment set ct_comment='$esdeditComment' where id='$esd_cid' and ct_uid='$esdc_uid'";
		$resultUpdateComment = mysqli_query($con,$sqlUpdateComment);
		
		if(!$resultUpdateComment)
		{
			echo"Error";	
		}
		else
		{
			echo"Comment Updated!";
		}
		
	}
	
	//EDIT COMMENT
	if(isset($_POST['gid']) && !empty($_POST['gid']))
	{
		
			$uid = $_POST['gid'];
			$cid = $_POST['gcid'];			
			
			$sqlShowComment = "select * from tblcomment where id='$cid' and ct_uid='$uid' "; // dito my mali
			$resultShowComment = mysqli_query($con,$sqlShowComment);
			
			if(mysqli_num_rows($resultShowComment) > 0)
			{
				while($rowShowComment = mysqli_fetch_array($resultShowComment))
				{
					$ct_id = $rowShowComment['id'];
					$ct_studno = $rowShowComment['ct_studno'];
					$ct_studusername = $rowShowComment['ct_studusername'];
					$ct_comment = $rowShowComment['ct_comment'];	
					
					echo"
						<input type=\"text\" id='_cid' value='$ct_id' hidden='true'>
						<label>User: <span>".$ct_studusername."</label>
						<textarea id=\"saveeditcomment\" class=\"form-control\">".$ct_comment."</textarea>
					";
				}	
			}
	}
	
	
	//SHOW COMMENTS
	if(isset($_POST['topicid']) && !empty($_POST['topicid']))
	{
		$topicid = $_POST['topicid'];
		$tsnot_uid = $_POST['tsnot_uid'];
		$sqlGetComments = "select * from tblcomment where ct_topicid ='$topicid'";	
		$resultGetComments = mysqli_query($con,$sqlGetComments);
		if(mysqli_num_rows($resultGetComments)>0)
		{
			while($rowGetComments = mysqli_fetch_array($resultGetComments))
			{
				$id = $rowGetComments['id'];
				$ct_uid = $rowGetComments['ct_uid'];
				$ct_studusername = $rowGetComments['ct_studusername'];
				$ct_comment = $rowGetComments['ct_comment'];
				
				
				if($tsnot_uid == $ct_uid)
				{
					$button = "
					<button class='btn btn-primary btn-sm' onclick='ShowComment($ct_uid, $id)'><strong><span class='fa fa-pencil-square-o fa-fw'></span>EDIT</strong></button>
							<button class='btn btn-primary btn-sm' onclick='DeleteComment($ct_uid, $id)'><strong><span class='fa fa-trash-o fa-fw'></span>DELETE</strong></button>
					";	
				}
				else
				{
					$button = "
					";	
				}
				
				
				
				$sqlGetinfo2 = "select * from tbluser where id ='$ct_uid'";
				$reGetInfo2 = mysqli_query($con,$sqlGetinfo2);
				$rowInfo2 = mysqli_fetch_array($reGetInfo2);
				$image2 = $rowInfo2['stud_profilepath'];
				$fname2 = $rowInfo2['stud_firstname'];
				
				
				echo"
					<tr>
						<td><img src='$image2' style='width:50px;height:50px;'></td>
						<td>
							<strong>".$ct_studusername."</strong>
							<input type='text' value='$id'  id='cid' hidden='true'>
						</td>
						<td>".$ct_comment."</td>
						<td>
							$button
						</td>
					</tr>
				";

			}	
		}else{
			echo"
				<tr>
					<td colspan=\"3\" align=\"center\"><h4><strong>NO COMMENT</strong></h4></td>
				</tr>
				";		
		}
	}

	//SAVE COMMENT
	if(isset($_POST['sc_studno']) && !empty($_POST['sc_studno']))
	{
		$sc_id = $_POST['sc_id'];
		$sc_studno = $_POST['sc_studno'];
		$sc_author = $_POST['sc_author'];
		$sc_descriptions = $_POST['sc_descriptions'];
		$sc_title = $_POST['sc_title'];
		$sc_commenttext = $_POST['sc_commenttext'];
		$sc_studuser = $_POST['sc_studuser'];
		$sc_uid = $_POST['sc_uid'];
		
		$sqlSaveComment = "insert into tblcomment(ct_studno, ct_studusername, ct_title, ct_comment, ct_topicid, ct_author, ct_uid)
							values('$sc_studno', '$sc_studuser', '$sc_title', '$sc_commenttext', '$sc_id', '$sc_author', '$sc_uid')";
		$resultSaveComment = mysqli_query($con,$sqlSaveComment);
		if(!$resultSaveComment)
		{
			echo"Comment not sent";	
		}
	}

?>