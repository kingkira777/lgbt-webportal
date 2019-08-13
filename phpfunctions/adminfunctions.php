<?php
	include'../connection.php';
	
	
	//NOTIFY USER
	if(isset($_POST['ss_uid']) && !empty($_POST['ss_uid']))
	{
		///TO
		$s_uid = $_POST['ss_uid'];
		$s_studno = $_POST['ss_studno'];
		
		$m_mymessage = $_POST['sm_mymessage'];
		
		
		$u_uid = $_POST['su_uid'];
		$not_studno = $_POST['snot_studno'];
		$not_username  = $_POST['snot_username'];
		
		
		
		$getUsername = "select  * from tbluser where stud_uno='$s_studno'";
		$reGetUname = mysqli_query($con,$getUsername);
		$rowUname = mysqli_fetch_array($reGetUname);
		
		$toUname = $rowUname['stud_uusername'];
		$datenow = date('Y-m-d');
		
		$sqlSentMessage = "insert into tblinboxmessage(im_senderuserid, im_senderstudno, im_sender, im_message, im_reicever, im_date)
					Values('$u_uid', '$not_studno', '$not_username', '$m_mymessage', '$toUname', '$datenow')";
		$resultSentMessage = mysqli_query($con,$sqlSentMessage);
		
		if(!$resultSentMessage)
		{
			echo"Error". mysqli_error($con);
		}
		else
		{
			echo"Message Succesfuly Sent";	
		}
		
		
	
	}
	
	//MOVE ADMIN TO USER
	if(isset($_POST['up_id']) && !empty($_POST['up_id']))
	{
		$up_id = $_POST['up_id'];	
		$strPromote = "";
		$sqlPromoteUser = "update tbluser set stud_position='$strPromote' where id='$up_id'";
		$resultPromoteuser =mysqli_query($con,$sqlPromoteUser);
		
		if(!$resultPromoteuser)
		{
			echo"Error";
		}
		else
		{
			echo "Succesfuly Move ADMIN TO USER";	
		}
	}
	
	
	//PROMOTE USER
	if(isset($_POST['pu_id']) && !empty($_POST['pu_id']))
	{
		$pu_id = $_POST['pu_id'];
		$strPromote = "admin";
		$sqlPromoteUser = "update tbluser set stud_position='$strPromote' where id='$pu_id'";
		$resultPromoteuser =mysqli_query($con,$sqlPromoteUser);
		
		if(!$resultPromoteuser)
		{
			echo"Error";
		}
		else
		{
			echo "Succesfuly Promoted";	
		}
		
	}
	
	
	//DELETE TOPIC
	if(isset($_POST['tid']) && !empty($_POST['tid']))
	{
		$tid = $_POST['tid'];
		$sqlDeleteTopic = "delete from tbltopics where t_id='$tid'";
		$resultDeleteTopic = mysqli_query($con,$sqlDeleteTopic);
		
		if(!$resultDeleteTopic)
		{
			echo"Error";	
		}
		else
		{
			echo"Succesfuly Deleted the Topic";
		}	
	}
	
	//GET LIST OF TOPIC
	if(isset($_POST['getlisttopic']) && !empty($_POST['getlisttopic']))
	{
		$sqlGetListTopic = "select * from tbltopics";
		$resultGetListTopic = mysqli_query($con,$sqlGetListTopic);
		
		if(mysqli_num_rows($resultGetListTopic)> 0)
		{
			while($rowGetListTopic = mysqli_fetch_array($resultGetListTopic))	
			{
				$t_id = $rowGetListTopic['t_id'];
				$t_author = $rowGetListTopic['t_author'];
				$t_title = $rowGetListTopic['t_title'];
				$t_description = $rowGetListTopic['t_description'];
				$date = $rowGetListTopic['t_date'];
				
				echo "
					<tr>
						<td>".$t_author."</td>
						<td>".$t_title."</td>
						<td>".$t_description."</td>
						<td>".$date."</td>
						<td><button type='button' class='btn btn-default btn-sm' onclick='DeleteTopic($t_id)'>
							<span class='glyphicon glyphicon-remove-sign'>
							</span>
							DELETE
							</button>
						</td>
					</tr>
				";
			}
		}
		else
		{
			echo"
				<tr>
					<td colspan='5' class='alert-warning' align='center'><strong>NO TOPIC LIST</strong</td>
				</tr>
			";	
		}
		
	}
	
	
	//DELETE ANNOUNCEMENT
	if(isset($_POST['dan_id']) && !empty($_POST['dan_id']))
	{
		$an_id = $_POST['dan_id'];
		
		$sqlDeleteAn =  "delete from tblannouncement where id='$an_id'";
		$resultDeleteAn = mysqli_query($con,$sqlDeleteAn);
		
		if(!$resultDeleteAn)
		{
			echo"Error";	
		}
		else
		{
			echo"Succesfuly Deleted";
		}
	}
	
	
	//UPDATE ANNOUNCEMENT
	if(isset($_POST['su_anid']) && !empty($_POST['su_anid']))
	{
		$su_anid = $_POST['su_anid'];
		$sutp_title = $_POST['sutp_title'];
		$sutp_content = $_POST['sutp_content'];
		
		$sqlUpdateAnnounce  = "update tblannouncement set an_title='$sutp_title', an_announce='$sutp_content' where id='$su_anid'";
		$resultUpdateAnnounce = mysqli_query($con,$sqlUpdateAnnounce);
		
		if(!$resultUpdateAnnounce)
		{
			echo"Error";		
		}
		else
		{
			echo"Successfuly Updated";
		}
	}
	
	
	//GET INFO ANNOUCMETN
	if(isset($_POST['getanddata']) && !empty($_POST['getanddata']))
	{
		$ga_id = $_POST['getanddata'];	
		$sqlGetAnnounce = "select * from tblannouncement where id='$ga_id'";
		$resultGetAnnounce = mysqli_query($con,$sqlGetAnnounce);
		$rowGetAnnounce = mysqli_fetch_array($resultGetAnnounce);
		
		echo"
			<input type='text' id='u_anid' value='$ga_id' hidden='true'>
			<label>TITLE</label>
			<input type=\"text\" id=\"utp_title\" class=\"form-control input-sm\" value='".$rowGetAnnounce['an_title']."'>
			<label>CONTENT</label>
            <textarea id=\"utp_content\" class=\"form-control input-sm\" style=\"height:200px;\">".$rowGetAnnounce['an_announce']."</textarea>
			";
	}
	
	//GET ANNOUNCEMENT LIST
	if(isset($_POST['g_announce']) && !empty($_POST['g_announce']))
	{
		$userid = $_POST['g_uid'];
		
		$sqlGetAnnounce = "select * from tblannouncement where an_uid ='$userid'";
		$resultGetAnnounce = mysqli_query($con,$sqlGetAnnounce);
		if(mysqli_num_rows($resultGetAnnounce)> 0)
		{
			while($rowGetAnnounce = mysqli_fetch_array($resultGetAnnounce))
			{
				$tid = $rowGetAnnounce['id'];
				$an_uid = $rowGetAnnounce['an_uid'];
				$an_username = $rowGetAnnounce['an_username'];
				$an_content = $rowGetAnnounce['an_announce'];
				$an_date = $rowGetAnnounce['an_date'];
				$an_title = $rowGetAnnounce['an_title'];
				$an_studno = $rowGetAnnounce['an_studno'];
				
				echo "
				
				
					<div class='panel panel-primary'>
                            <div class='panel-heading'>
                            	<h4>$an_title</h4>
                                <div class='container-fluid'>
                                    <div class='pull-right'>
										Date: $an_date                               
                                    </div>
                                </div>
                            </div>
                            <div class='panel-body'>
                            	$an_content
                            
                            </div>
                            <div class='panel-footer'>
							<div class='container-fluid'>
								<div class='pull-right'>
									<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='#editannouncementid' onclick='GetAnData($tid)'>
										<i class='glyphicon glyphicon-edit'></i>
										EDIT
									</button>
									<button type='button' class='btn btn-default btn-sm' onclick='DeleteAnnouncement($tid)'>
										<i class='glyphicon glyphicon-remove-sign'></i>
										DELETE
									</button>
                            	</div>
							</div>
                            </div>
                        </div>
				";
			}	
		}
	
	}
	
	//SAVE ANNOUNCEMT
	if(isset($_POST['stp_uid']) && !empty($_POST['stp_uid']))
	{
		$tp_uid = $_POST['stp_uid'];
		$tp_studno = $_POST['stp_studno'];
		$tp_usename = $_POST['stp_usename'];
		$tp_title = $_POST['stp_title'];
		$tp_content = $_POST['stp_content'];
		
		$datenow = date("Y-m-d"); 
		
		$sqlSaveAnnouncement = "insert into  tblannouncement(
								an_uid, an_username, an_announce, an_date, an_title)
								Values('$tp_uid', '$tp_usename', '$tp_content', '$datenow', '$tp_title' )
								";
		$resultSaveAnnouncement = mysqli_query($con,$sqlSaveAnnouncement);
		
		if(!$resultSaveAnnouncement)
		{
			echo"Erro";	
		}
		else
		{
			echo"Succesfuly Save";
		}
		
	}
	//UnBanned User
	if(isset($_POST['ub_id']) &&!empty($_POST['ub_id']))
	{
		$uid = $_POST['ub_id'];
		$tagging = "";
		//DELET USER FROM BANNING
		$sqlDeleteUserFromBan = "delete from tblbanuser where user_uid='$uid'";
		$resultDeleteUserFromBan = mysqli_query($con,$sqlDeleteUserFromBan);
		if(!$resultDeleteUserFromBan)
		{
				echo"Error";
		}
		else
		{
			$sqlUpdateTagging = "update tbluser set stud_ifban='$tagging' where id='$uid'";
			mysqli_query($con,$sqlUpdateTagging);
			echo "Succesfuly Unbanned";	
			
		}
	}
	
	//BAN USER
	if(isset($_POST['b_id']) && !empty($_POST['b_id']))
	{
		$uid = $_POST['b_id'];
		
		$sqlCheckBanUser = "select * from tblbanuser where user_uid='$uid'";
		$resulChecBanUser = mysqli_query($con,$sqlCheckBanUser);
		
		if(mysqli_num_rows($resulChecBanUser)>0)
		{	
			echo"USER is already BANNED";
		}
		else
		{
		
			$sqlGetUserList = "select * from tbluser where id='$uid'";
			$resultGetUserList = mysqli_query($con,$sqlGetUserList);
			if(mysqli_num_rows($resultGetUserList)> 0)
			{
				while($rowGetUserList = mysqli_fetch_array($resultGetUserList))
				{
					$id = $rowGetUserList['id'];
					$studno = $rowGetUserList['stud_uno'];
					$fname = $rowGetUserList['stud_firstname'];
					$lname = $rowGetUserList['stud_lastname'];
					$mi = $rowGetUserList['stud_mi'];
					$usename = $rowGetUserList['stud_uusername'];
					$email = $rowGetUserList['stud_uemail'];
					$gender = $rowGetUserList['stud_ugender'];
					$bday = $rowGetUserList['stud_birthday'];
					
					$fullname = $lname . ", " . $fname . " " . $mi;
				}
				
				//SAVE TAGGING
				$sqlSaveUserBan =  "update tbluser set stud_ifban='baned' where id='$uid'";
				mysqli_query($con,$sqlSaveUserBan);
				
				
				//SAVE BAN USER TO TBLBANED
				$sqlSaveBanUser = "insert into  tblbanuser(user_studno, user_name, user_fullname, user_bday, user_uid)
										Values('$studno', '$usename', '$fullname', '$bday','$id')";
				$resultSaveBanUser = mysqli_query($con,$sqlSaveBanUser);
				if(!$resultSaveBanUser)
				{
					echo"Error";
				}
				else
				{
					echo"USER succesfuly BANNED!";
				}
			}
		}

	}
	
	
	//GET USER ACCOUNT NOT UDPATED
	if(isset($_POST['getusernotupdated']) && !empty($_POST['getusernotupdated']))
	{
		$admin = "admin";
		$sqlGetUserList = "select * from tbluser where stud_position !='$admin' 
							and stud_firstname='' and stud_lastname='' and stud_mi=''";
		$resultGetUserList = mysqli_query($con,$sqlGetUserList);
		
		if(mysqli_num_rows($resultGetUserList)> 0)
		{
			while($rowGetUserList = mysqli_fetch_array($resultGetUserList))
			{
				$uid = $rowGetUserList['id'];
				$studno = $rowGetUserList['stud_uno'];
				$fname = $rowGetUserList['stud_firstname'];
				$lname = $rowGetUserList['stud_lastname'];
				$mi = $rowGetUserList['stud_mi'];
				$usename = $rowGetUserList['stud_uusername'];
				$email = $rowGetUserList['stud_uemail'];
				$gender = $rowGetUserList['stud_ugender'];
				$bday = $rowGetUserList['stud_birthday'];
				
				
				$isPosition = $rowGetUserList['stud_position'];	
				$isBan = $rowGetUserList['stud_ifban'];
				
				$fullname = $lname . ", " . $fname . " " . $mi;
				
				
				echo"
					<tr>
						<td>".$studno."</td>
						<td>".$fullname."</td>
						<td>".$usename."</td>
						<td>".$email."</td>
						<td>".$gender."</td>
						<td>".$bday."</td>
						<td>
						<button class='btn btn-primary btn-sm' onclick='Message($uid,$studno)' data-toggle='modal' data-target='#notuserid'>
							SEND MESSAGE
						</button>
						</td>
					</tr>
				";
			}
		}
	}

	//GET USER LIST
	if(isset($_POST['getuserlist']) && !empty($_POST['getuserlist']))
	{
		$admin = "admin";
		$sqlGetUserList = "select * from tbluser where stud_position !='$admin'";
		$resultGetUserList = mysqli_query($con,$sqlGetUserList);
		
		if(mysqli_num_rows($resultGetUserList)> 0)
		{
			while($rowGetUserList = mysqli_fetch_array($resultGetUserList))
			{
				$uid = $rowGetUserList['id'];
				$studno = $rowGetUserList['stud_uno'];
				$fname = $rowGetUserList['stud_firstname'];
				$lname = $rowGetUserList['stud_lastname'];
				$mi = $rowGetUserList['stud_mi'];
				$usename = $rowGetUserList['stud_uusername'];
				$email = $rowGetUserList['stud_uemail'];
				$gender = $rowGetUserList['stud_ugender'];
				$bday = $rowGetUserList['stud_birthday'];
				
				
				$isPosition = $rowGetUserList['stud_position'];	
				$isBan = $rowGetUserList['stud_ifban'];
				
				$fullname = $lname . ", " . $fname . " " . $mi;
				
				
				if(!empty($isPosition))
				{
					$color = "#f9c013";
				}
				else
				{
					$color = "#f7f3f2";
				}
				if(!empty($isBan))
				{
					$color = "#ff9372";	
				}
				else
				{
					$color = "#f7f3f2";	
				}
				
				
				echo"
					<tr style='background-color:$color'>
						<td>".$studno."</td>
						<td>".$fullname."</td>
						<td>".$usename."</td>
						<td>".$email."</td>
						<td>".$gender."</td>
						<td>".$bday."</td>
						<td align='center'>
							<button type='button' class='btn btn-primary btn-sm' onclick='BanUser($uid)'><i class='fa fa-lock fa-fw'></i>BAN</button>
							<button type='button' class='btn btn-primary btn-sm' onclick='UnBannedUser($uid)'><i class='fa fa-unlock fa-fw'></i>UNBAN</button>
							<button type='button' class='btn btn-warning btn-sm' onclick='PromoteUser($uid)'>PROMOTE USER TO ADMIN</button>
						</td>
					</tr>
				";
			}
		}
	}
	
	//GET ADMIN LIST
	if(isset($_POST['getadminlist']) && !empty($_POST['getadminlist']))
	{
		
		$adminid = $_POST['getadminid'];
		$adminposition = "admin";
		
		$sqlGetUserList = "select * from tbluser where id !='$adminid' and stud_position='$adminposition'";
		$resultGetUserList = mysqli_query($con,$sqlGetUserList);
		
		if(mysqli_num_rows($resultGetUserList)> 0)
		{
			while($rowGetUserList = mysqli_fetch_array($resultGetUserList))
			{
				$uid = $rowGetUserList['id'];
				$studno = $rowGetUserList['stud_uno'];
				$fname = $rowGetUserList['stud_firstname'];
				$lname = $rowGetUserList['stud_lastname'];
				$mi = $rowGetUserList['stud_mi'];
				$usename = $rowGetUserList['stud_uusername'];
				$email = $rowGetUserList['stud_uemail'];
				$gender = $rowGetUserList['stud_ugender'];
				$bday = $rowGetUserList['stud_birthday'];
				
				
				$isPosition = $rowGetUserList['stud_position'];	
				$isBan = $rowGetUserList['stud_ifban'];
				
				$fullname = $lname . ", " . $fname . " " . $mi;
				
				
				if(!empty($isPosition))
				{
					$color = "#f9c013";
				}
				else
				{
					$color = "#f7f3f2";
				}
				if(!empty($isBan))
				{
					$color = "#ff9372";	
				}
				else
				{
					$color = "#f7f3f2";	
				}
				
				
				echo"
					<tr style='background-color:$color'>
						<td>".$studno."</td>
						<td>".$fullname."</td>
						<td>".$usename."</td>
						<td>".$email."</td>
						<td>".$gender."</td>
						<td>".$bday."</td>
						<td align='center'>
							<button type='button' class='btn btn-primary btn-sm' onclick='BanUser($uid)'><i class='fa fa-lock fa-fw'></i>BAN</button>
							<button type='button' class='btn btn-primary btn-sm' onclick='UnBannedUser($uid)'><i class='fa fa-unlock fa-fw'></i>UNBAN</button>
							<button type='button' class='btn btn-warning btn-sm' onclick='MoveToUser($uid)'>MOVE USER TO USER Privilege</button>
						</td>
					</tr>
				";
			}
		}
		
	} 
	
	
	

?>


