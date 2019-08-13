<?php
include'../connection.php';
//for Flag, Global Variable
	$isconfirmed = "confirmed"; //FRIEND Request  
	$isadd = "added";
	
	
	$isRead = "isread"; //MESSAGE notifications
	
	$isFriend = false;
	
//FRIENDS FUNCTIONS----------------------------------------------------------------

//CHECK IF FRIEDNS ALREADY
if(isset($_POST['schv_uid']) && !empty($_POST['schv_uid']))
{
	//Viewimg USer
	$schv_uid = $_POST['schv_uid'];
	$schv_studno = $_POST['schv_studno'];
	$schv_username = $_POST['schv_username'];
	
	
	//Current USEr
	$schc_uid = $_POST['schc_uid'];
	$schc_studno = $_POST['schc_studno'];
	$schc_username = $_POST['schc_username'];

	//CHECK if Friend Request is Already Sent v1
	$sqlCheckFriendRequest = "select * from tblfriends where f_studno='$schc_studno' and f_afstudno='$schv_studno'";
	$resultCheckFriendRequest = mysqli_query($con,$sqlCheckFriendRequest);
	if(mysqli_num_rows($resultCheckFriendRequest)> 0)
	{
		echo "
		<button class=\"btn btn-primary btn-sm\" type=\"button\" disabled=\"disabled\" onClick=\"AddFriend()\" id=\"addfriend\">
            <i class=\"glyphicon glyphicon-plus-sign\"></i>
            ADD FRIEND
            </button>
		";
	}
	else
	{
		//CHECK if Friend Request is Already Sent v2
		$sqlCheckFriendRequest1 = "select * from tblfriends where f_studno='$schv_studno' and f_afstudno='$schc_studno'";
		$resultCheckFriendRequest1 = mysqli_query($con,$sqlCheckFriendRequest1);
		if(mysqli_num_rows($resultCheckFriendRequest1)> 0)
		{
			echo "
			<button class=\"btn btn-primary btn-sm\" type=\"button\" disabled=\"disabled\" onClick=\"AddFriend()\" id=\"addfriend\">
            <i class=\"glyphicon glyphicon-plus-sign\"></i>
            ADD FRIEND
            </button>
			";
		}else{
			echo"
			<button class=\"btn btn-primary btn-sm\" type=\"button\" onClick=\"AddFriend()\" id=\"addfriend\">
            <i class=\"glyphicon glyphicon-plus-sign\"></i>
            ADD FRIEND
            </button>
			";
		}
	}
}


//ACCEPT Friend Request
if(isset($_POST['sfr_id']) && !empty($_POST['sfr_id']))
{
	$sfr_id = $_POST['sfr_id'];
	//SEND
	$wsf_id = $_POST['swsf_id'];
	$wsf_studno = $_POST['swsf_studno'];
	$wsf_username = $_POST['swsf_username'];
	//ACCEPT
	$wac_id = $_POST['swac_id'];
	$wac_stundno = $_POST['swac_stundno'];
	$wac_username = $_POST['swac_username'];
	
	$sqlAcceptFriend = "insert into tblfriends(f_uid, f_studno, f_username, f_afuid, f_afstudno, f_afusername)
						values('$wac_id', '$wac_stundno', '$wac_username', '$wsf_id', '$wsf_studno','$wsf_username')";
	$resultAcceptFriend = mysqli_query($con,$sqlAcceptFriend);
	if(!$resultAcceptFriend)
	{
		echo"Error";
	}
	else
	{
		$sqlUpdateFrequest = "update tblfriendsrequest set f_confirmed='$isconfirmed', f_isadd='$isadd' where id='$sfr_id'";
		mysqli_query($con,$sqlUpdateFrequest);
	}
}

//ADD FRIEND
if(isset($_POST['ssf_uid']) && !empty($_POST['ssf_uid']))
{
	
	//CURRENT USER
	$ssf_uid = $_POST['ssf_uid'];
	$ssf_studno = $_POST['ssf_studno'];
	$ssf_username = $_POST['ssf_username'];
	
	//TO
	$sv_uid = $_POST['sv_uid'];
	$sv_studno = $_POST['sv_studno'];
	$sv_fullname = $_POST['sv_username'];
	
	
	$sqlCheckProfile ="select * from tbluser where stud_firstname='' and stud_lastname='' and stud_mi=''";
	$resCheckProfile = mysqli_query($con,$sqlCheckProfile);
	
	if(mysqli_num_rows($resCheckProfile)> 0)
	{
		echo"You Can't Add the user's Yet, due to his/her Profile is not Updated";	
	}
	else
	{	
		$sqlCheckAlreadyF = "select * from tblfriendsrequest where f_studno='$ssf_studno' and f_tostudno='$sv_studno' and f_confirmed!='$isconfirmed'";
		$resultCheckAlreadyF = mysqli_query($con,$sqlCheckAlreadyF);
		if(mysqli_num_rows($resultCheckAlreadyF)> 0)
		{
			echo "Friend Request Already Sent";
		}else{
			$sqlCheckAlreadyF1 = "select * from tblfriendsrequest where f_studno='$sv_studno' and f_tostudno='$ssf_studno' and f_confirmed!='$isconfirmed'";
			$resultCheckAlreadyF1 = mysqli_query($con,$sqlCheckAlreadyF1);
			if(mysqli_num_rows($resultCheckAlreadyF1)> 0)
			{
				echo "Friend Request Already Sent";
			}
			else
			{
				$sqlAddFriend ="insert into  tblfriendsrequest(f_uid, f_studno, f_username, f_touid, f_tostudno, f_tousername)
								values('$ssf_uid', '$ssf_studno', '$ssf_username', '$sv_uid', '$sv_studno', '$sv_fullname')";
				$resultAddFriend = mysqli_query($con,$sqlAddFriend);
				if(!$resultAddFriend)
				{
					echo"Error Sending Friend Request";	
				}
				else
				{
					echo"Succesfuly Send Request";	
				}
			}
		}
			
	}
}


//Friends Notifications
if(isset($_POST['sfnot_uid']) && !empty($_POST['sfnot_uid']))
{
	$sfnot_uid = $_POST['sfnot_uid'];
	$sfnot_studno = $_POST['sfnot_studno'];
	$sfnot_username = $_POST['sfnot_username'];
	
	$sqlFrienNot = "select * from tblfriendsrequest where f_uid='$sfnot_uid' and f_studno='$sfnot_studno' and 
					f_confirmed !='$isconfirmed' and f_isadd!='$isadd'";
	$resultFriendNot = mysqli_query($con,$sqlFrienNot);
	$rowCount = mysqli_num_rows($resultFriendNot);
	if(mysqli_num_rows($resultFriendNot)> 0)
	{
		echo $rowCount.",";
		while($rowGetusename = mysqli_fetch_array($resultFriendNot)){
		echo"You Send Friend Request to: <strong>".$rowGetusename['f_tousername']."</strong> Not Yet Accepted <br>";
		}
	}
	else
	{
		$sqlFrienNot1 = "select * from tblfriendsrequest where f_touid='$sfnot_uid' and f_tostudno='$sfnot_studno' and 
					f_confirmed !='$isconfirmed' and f_isadd!='$isadd'";
		$resultFriendNot1 = mysqli_query($con,$sqlFrienNot1);
		$rowGetusename1 = mysqli_fetch_array($resultFriendNot1);
		$rowCount1 = mysqli_num_rows($resultFriendNot1);
		
		if(mysqli_num_rows($resultFriendNot1)> 0)
		{
			echo $rowCount1;
				
		}
		else
		{
			echo"";	
		}
	
	}
}
	
//FRIENDS FUNCTIONS-----------------------------------------------------------


//SEEN MESSAGE NOTIFICATIONS
if(isset($_POST['seenmessagenot']) && !empty($_POST['seenmessagenot']))
{
	$snot_username = $_POST['snot_username'];
	
	$sqlSeenMessage = "update tblinboxmessage set im_isread='$isRead' where im_reicever='$snot_username'";
	$resultSeenMessage = mysqli_query($con,$sqlSeenMessage);
	
}


//NOTIFICTIONS MESSAGE
if(isset($_POST['snot_uid']) && !empty($_POST['snot_uid']))
{
	$snot_uid = $_POST['snot_uid'];
	$snot_studno = $_POST['snot_studno'];
	$snot_username = $_POST['snot_username'];
	
	$sqlMNotifications = "select * from tblinboxmessage where im_reicever='$snot_username' and im_isread != '$isRead'";
	$resultMNotifications = mysqli_query($con,$sqlMNotifications);	
	if(mysqli_num_rows($resultMNotifications)> 0)
	{
		$rowMNotifications = mysqli_num_rows($resultMNotifications);
		echo $rowMNotifications;		
	}
	else
	{
		echo "";
	}
}





//SEARCH TOPIC
if(isset($_POST['st_search']) && !empty($_POST['st_search']))
{
	$st_search = $_POST['st_search'];
	
	$sqlGetTopicList = "select * from tbltopics where t_title LIKE '$st_search%'";
	$resultGetTopicList = mysqli_query($con,$sqlGetTopicList); // Execute Query
	
	if(mysqli_num_rows($resultGetTopicList) > 0)
	{
		//if the database is note Empty	
		while($rowGetTopicList = mysqli_fetch_array($resultGetTopicList))
		{
				$t_id = $rowGetTopicList['t_id'];
				$t_title = $rowGetTopicList['t_title'];
				$t_description = $rowGetTopicList['t_description'];
				$t_author = $rowGetTopicList['t_author'];
				$t_content = $rowGetTopicList['t_content'];
				$t_uid = $rowGetTopicList['t_uid'];
				
				
				//echo means e output natin ung nasa Database
				echo"
					<tr>
						<td><strong>".$t_title."</stron></td>
						<td>".$t_description."</td>
						<td>".$t_author."</td>
						<td><button type='button' class='btn btn-primary btn-sm' onclick='OpenTopic($t_id)'><strong><span class='fa fa-external-link fa-fw'></span>OPEN</strong></button>
						<button type='button' class='btn btn-primary btn-sm' onclick='ViewTopic($t_id, $t_uid)'><strong><span class='fa fa-external-link fa-fw'></span>EDIT</strong></button></td>
					</tr>
				";
		}
	}else{
		echo"
			<tr>
				<td colspan=\"4\">
					<h4 align=\"center\"><strong>NO TOPIC(s) FOUND</strong></h4>
				</td>
			</tr>
		";	
	}
}  


//GET ANNOUNCEMENT DASHBOARD
if(isset($_POST['gd_announce']) && !empty($_POST['gd_announce']))
{
	$sqlGetAnnouncement = "select * from tblannouncement order by id desc LIMIT 10";
	$resulGetAnnounce = mysqli_query($con,$sqlGetAnnouncement);
	
	if(mysqli_num_rows($resulGetAnnounce)> 0)
		{
			while($rowGetAnnounce = mysqli_fetch_array($resulGetAnnounce))
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
										Date: $an_date   /Admin: $an_username                                
                                    </div>
                                </div>
                            </div>
                            <div class='panel-body'>
                            	$an_content
                            </div>
                            <div class='panel-footer'>
                            
                            </div>
                        </div>

				";
			}	
		}
}



//Update User Informations
if(isset($_POST['sup_uid']) && !empty($_POST['sup_uid']))
{
	$sup_uid = $_POST['sup_uid'];
	$sup_lname = $_POST['sup_lname'];
	$sup_mi = $_POST['sup_mi'];
	$sup_fname = $_POST['sup_fname'];
	$sup_ylevel = $_POST['sup_ylevel'];
	$sup_campus = $_POST['sup_campus'];
	$sup_course = $_POST['sup_course'];
	
	$sqlUpdateUserInfo = "update tbluser set stud_firstname='$sup_fname', stud_lastname='$sup_lname',
						stud_mi='$sup_mi', stud_yearlevel='$sup_ylevel', stud_campus='$sup_campus',
						stud_course='$sup_course' where id='$sup_uid'";
	$resultUpdateUserInfo = mysqli_query($con,$sqlUpdateUserInfo);
	if(!$resultUpdateUserInfo)
	{
		echo "Error" . mysqli_error($con);	
	}
	else
	{
		echo "Succesfuly Updated!";
	}
}

//SAVE EDITED TOPIC
if(isset($_POST['set_id']) && !empty($_POST['set_id']))
{
	$set_id = $_POST['set_id'];
	$set_Title = $_POST['set_Title'];
	$set_Descriptions = $_POST['set_Descriptions'];
	$set_Content = $_POST['set_Content'];
	
	$sqlSaveEdited = "update tbltopics set t_title='$set_Title', t_description='$set_Descriptions', t_content='$set_Content' 
						where t_id='$set_id'";	
	
	$resultSaveEdited = mysqli_query($con,$sqlSaveEdited);
	
	if(!$resultSaveEdited)
	{
		echo"Error";	
	}
	else
	{
		echo"Succesfuly Updated";	
	}
}

//VIEW TOPIC
if(isset($_POST['gtid']) && !empty($_POST['gtid']))
{
	$gtid = $_POST['gtid'];	
	$gtuid = $_POST['gtuid'];
	
	$sqlViewTopic = "select * from tbltopics where t_id='$gtid' and t_uid='$gtuid'";
	$resultViewTopic = mysqli_query($con,$sqlViewTopic);
	
	while($rowViewTopic = mysqli_fetch_array($resultViewTopic))
	{
		$tid = $rowViewTopic['t_id'];
		$title = $rowViewTopic['t_title'];
		$des = $rowViewTopic['t_description'];
		$content = $rowViewTopic['t_content'];
		
		echo"
		
			<tr>
            	<td>
					<input type=\"text\" id=\"et_id\"  value='$tid' hidden='true'>
                	<label>Title</label>
                    <input type=\"text\" id=\"et_Title\" class=\"form-control\" value='".$title."'>
                </td>
           	</tr>
            	
			<tr>
            	<td>
                	<label>Descriptions</label>
                    <input type=\"text\" id=\"et_Descriptions\" class=\"form-control\" value='".$des."'>
              	</td>
            </tr>
            <tr>
            	<td>
                	<label>Content</label>
                	<textarea id=\"et_Content\" class=\"form-control\" style=\"height:100px;\">".$content."</textarea>
                </td>
            </tr>
		";
			
	}
}


//Save New Topic
if(isset($_POST['st_Author']) && !empty($_POST['st_Author']))
{
	$st_author = $_POST['st_Author'];
	$st_title = $_POST['st_Title'];
	$st_descriptions = $_POST['st_Descriptions'];
	$st_content = $_POST['st_Content'];
	$st_uid = $_POST['st_uid'];
	$st_date = date("Y-m-d");

	$sqlSaveNewTopic = "insert into tbltopics(t_title, t_description, t_author, t_content, t_uid, t_date)
						Values('$st_title', '$st_descriptions', '$st_author','$st_content', '$st_uid', '$st_date')";
	$resultSaveNewTopic = mysqli_query($con,$sqlSaveNewTopic);
	
	if(!$resultSaveNewTopic)
	{
		echo"Saving Failed";	
	}
	else
	{
		echo"Your Topic has been Saved!";	
	}
}

//Now GAWA tayo ng PHP na mag rRetrieve ng Data sa DATABASE
//GET TOPIC LISTs
if(isset($_POST['gettopiclist']) &&!empty($_POST['gettopiclist']))
{
	
	$xsnot_uid = $_POST['xsnot_uid'];
	//gawa tayo ng Query
	$sqlGetTopicList = "select * from tbltopics";
	$resultGetTopicList = mysqli_query($con,$sqlGetTopicList); // Execute Query
	
	if(mysqli_num_rows($resultGetTopicList) > 0)
	{
		//if the database is note Empty	
		while($rowGetTopicList = mysqli_fetch_array($resultGetTopicList))
		{
				$t_id = $rowGetTopicList['t_id'];
				$t_title = $rowGetTopicList['t_title'];
				$t_description = $rowGetTopicList['t_description'];
				$t_author = $rowGetTopicList['t_author'];
				$t_content = $rowGetTopicList['t_content'];
				$t_date = $rowGetTopicList['t_date'];
				$t_uid = $rowGetTopicList['t_uid'];	
				
				if($xsnot_uid == $t_uid)
				{
					$button = "
						<button type='button' class='btn btn-primary btn-sm' onclick='OpenTopic($t_id)'><strong><span class='fa fa-external-link fa-fw'></span>OPEN</strong></button>
						<button type='button' class='btn btn-primary btn-sm' onclick='ViewTopic($t_id, $t_uid)'><strong><span class='fa fa-external-link fa-fw'></span>EDIT</strong></button>
					";
				}else
				{
					$button = "
						<button type='button' class='btn btn-primary btn-sm' onclick='OpenTopic($t_id)'><strong><span class='fa fa-external-link fa-fw'></span>OPEN</strong></button>
					";	
				}
				
				//echo means e output natin ung nasa Database
				echo"
					<tr>
						<td><strong>".$t_title."</stron></td>
						<td>".$t_description."</td>
						<td>".$t_author."</td>
						<td>".$t_date."</td>
						<td>$button</td>
					</tr>
				";
		}
	}else{
		echo"
			<tr>
				<td colspan=\"5\">
					<h4 align=\"center\"><strong>NO TOPIC(s) FOUND</strong></h4>
				</td>
			</tr>
		";	
	}
}

?>