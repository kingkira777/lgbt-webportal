<?php
	include'Auth.php'; //try natin e remove to
	include'connection.php';
	$flag = 5;
	if(isset($_POST['uploadProImage']))
	{
		//need natin ung ID ng User
		$up_uid = $_SESSION['id'];
		//kunin natin ung path ng Folder
		$folder = "images/profileimages/";
		$imageFile = $folder . basename($_FILES["profileImage"]["name"]); // then ung name image file
		//then check natin ung File Extension ng Image
		//para ma identify natin kung Image siya or hindi
		$imageType = pathinfo($imageFile,PATHINFO_EXTENSION);
		//Check natin rin kung ung file is nag eexists an
		if(file_exists($imageFile))
		{
			$flag = 0;
		}
		//Then check ung Extension ng Image
		if($imageType != "jpg" && $imageType!="jpeg" && $imageType!="png")
		{
			$flag = 1;	
		}
		//Check then natin ung SIZE ng IMAGE
		if($_FILES["profileImage"]["size"] > 5000000)
		{
			$flag = 2;	
			
		}
		if($flag == 0 || $flag== 1 || $flag==2)
		{
		}
		else
		{
			//upload ung profile image natin sa server
			if(move_uploaded_file($_FILES["profileImage"]["tmp_name"],$imageFile))
			{
				//save natin ung path sa tbluser for the current user
				$sqlSavePath = "update tbluser set stud_profilepath='$imageFile' where id='$up_uid'";
				mysqli_query($con,$sqlSavePath);
				$flag = 3;
			}
			else
			{
				$flag = 4;
			}	
		}
	}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>
<!--CSS Extensions-->
<?php include'cssextentions.php'; ?>
<style>
	.createTopic{
		max-width:50%;
		margin-left:25%;
		margin-top:2em;	
	}
</style>
<!--CSS Extensions-->
</head>
<body>
<!--Header-->
<?php include'header.php';?>
<!--PAGE CONTENT-->

<div id="page-wrapper">
	<div class="col-md-12">
       	<div class="pull-right">
       	<?php
			$g_uid = $_SESSION['id'];
			$ifNoImage = false;
			$sqlGetProfileImage = "select stud_profilepath from tbluser where id='$g_uid'";
			$resultGetProfileImage = mysqli_query($con,$sqlGetProfileImage);
			$rowGetProfileImage = mysqli_fetch_array($resultGetProfileImage);
			//Check natin kung my profile image na siya or wla
			if(!empty($rowGetProfileImage["stud_profilepath"]))
			{
				$ifNoImage = true;
				$imagePath = $rowGetProfileImage["stud_profilepath"];
			}
			else
			{
				$ifNoImage = false;
				echo "
					<br>
					<br>
					<br>
					<p align=\"center\" class=\"alert-info\"><strong>NO PROFILE IMAGE</strong></p>
				";
			}
		?>
        <p class="alert-warning" align="center">
        <strong>
       <?php
	   	if($flag == 0)
		{
			echo "Profile Image Already Exists";
		}
		else if ($flag == 1)
		{
			echo "Image must be JPG, JPEG, PNG only";
		}
		else if ($flag ==2)
		{
			echo"image size must be less than 5mb";
		}
		else if($flag ==3)
		{
			echo"Successfuly Uploaded";	
		}
		else if($flag == 4)
		{
			echo "Error uploading your Profile Image";	
		}
	   
	   ?> 	
        </strong>
        </p><br>
        <img src="<?php if($ifNoImage){ echo $imagePath; }else{echo"images/profileimages/user-logo.jpg";}?>" style="width:250px; height:250px; border-radius:40%">
         <div class="input-group" style="width:250px;" align="center">
			<form method="post" enctype="multipart/form-data">         	
                <input type="file" name="profileImage" id="profileImage" class="form-control input-sm" >
                <div class="input-group-btn">
                <button class="btn btn-primary btn-sm" type="submit" name="uploadProImage">Upload Profile Image</button>
            	</div>
             </form>
       	</div>
        </div>
       <div class="container-fluid">
      <h4 class="page-header"><strong>MY PROFILE INFORMATIONS</strong></h4>
      <input type="text" id="up_uid" value="<?php echo $_SESSION['id'] ?>" hidden="true">
       
       <!--Kunin natin ung info sa Database based kung sino ung naka Login -->
       <?php
       		$uid = $_SESSION['id'];
			$sqlGetuserInfo = "select * from tbluser where id='$uid'";
			$resultGetUserInfo = mysqli_query($con,$sqlGetuserInfo);
			$rowGetUserInfo = mysqli_fetch_array($resultGetUserInfo);
			$fname = $rowGetUserInfo['stud_firstname'];
			$mi = $rowGetUserInfo['stud_mi'];
			$lname = $rowGetUserInfo['stud_lastname'];
			$ylevel = $rowGetUserInfo['stud_yearlevel'];
			$campus = $rowGetUserInfo['stud_campus'];
			$course = $rowGetUserInfo['stud_course'];
       ?>
        <table style="font-size:20px;">
        	<tbody>
        		<tr>
                	<td><label>Firstname:&nbsp;</label></td>
                	<td><?php echo $fname; ?></td>
                </tr>
                <tr>
                	<td><label>Lastname:&nbsp;</label></td>
                   	<td><?php echo $lname; ?></td>
                </tr>
                <tr>
                	<td><label>MI:&nbsp;</label></td>
                	<td><?php echo $mi; ?></td>
                </tr>
                <tr>
                	<td><label>Year Level:&nbsp;</label></td>
                	<td><?php echo $ylevel; ?></td>
                </tr>
                <tr>
                	<td><label>Campus:&nbsp;</label></td>
                	<td><?php echo $campus; ?></td>
                </tr>
                <tr>
                	<td><label>Course:&nbsp;</label></td>
                	<td><p><?php echo $course; ?></p></td>
                </tr>
            </tbody>
        </table>
        <hr>
         <div class="pull-left">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfile"><strong>UPDATE PROFILE</strong></button>
        </div>
        </div>
        
        <hr>
       <!--FRIEND LIST-->
        <div class="panel panel-default">
        	<div class="panel-heading">
            	<h4 class="panel-title">
                	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed" style="text-decoration:none">
                    <span class="fa fa-users fa-fw"></span>
                    <strong>FRIENDS</strong>
                    </a>
                </h4>
             </div>
             <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
             <div class="panel-body">
             	<table class="table">
                	<thead>
                    	<th></th>
                    	<th>STUDENT NO</th>
                        <th>USERNAME</th>
                        <th>Firstname</th>
                    </thead>
                	<tbody>
           		<?php
					
					$c_uid = $_SESSION['id'];
					$c_studno = $_SESSION['studentno'];
					$isconfirmed = "confirmed";
					//Check kung sino ung mga friends and confirmed
					$sqlCheckConfirmedF = "select * from  tblfriends where f_studno='$c_studno'";
					$resultCheckConfirmedF = mysqli_query($con,$sqlCheckConfirmedF);
					if(mysqli_num_rows($resultCheckConfirmedF)> 0)
					{
						
							while($rowFriends = mysqli_fetch_array($resultCheckConfirmedF))
							{
								$fuid = $rowFriends['f_uid'];
								$ftouid = $rowFriends['f_afuid'];
								$ftostudno = $rowFriends['f_afstudno'];
								$ftousername = $rowFriends['f_afusername'];
								
								
								$sqlGetinfo = "select * from tbluser where stud_uno='$ftostudno'";
								$reGetInfo = mysqli_query($con,$sqlGetinfo);
								$rowInfo = mysqli_fetch_array($reGetInfo);
								$image = $rowInfo['stud_profilepath'];
								$fname = $rowInfo['stud_firstname'];
								
								if($fuid == $c_uid)
								{		
								echo"
									<tr>
										<td><img src='$image' style='width:50px;height:50px;'></td>
										<td>".$ftostudno."</td>
										<td>".$ftousername."</td>
										<td>".$fname."</td>
									</tr>
								";
								}
							}
							
							$sqlCheckConfirmedF2 = "select * from  tblfriends where f_afstudno='$c_studno'";
							$resultCheckConfirmedF2 = mysqli_query($con,$sqlCheckConfirmedF2);
							while($rowFriends2 =  mysqli_fetch_array($resultCheckConfirmedF2))
							{	
								$fuid2 = $rowFriends2['f_uid'];
								$fstudno2 = $rowFriends2['f_studno'];
								$fusername2 = $rowFriends2['f_username'];
								
								$sqlGetinfo1 = "select * from tbluser where stud_uno ='$fstudno2'";
								$reGetInfo1 = mysqli_query($con,$sqlGetinfo1);
								$rowInfo1 = mysqli_fetch_array($reGetInfo1);
								$image1 = $rowInfo1['stud_profilepath'];
								$fname1 = $rowInfo1['stud_firstname'];
								
								
								echo"
									<tr>
										<td><img src='$image1' style='width:50px;height:50px;'></td>
										<td>".$fstudno2."</td>
										<td>".$fusername2."</td>
										<td>".$fname1."</td>
										</tr>
									";
							}	
						
					}else{
						
								$sqlCheckConfirmedF1 = "select * from  tblfriends where f_afstudno='$c_studno'";
								$resultCheckConfirmedF1 = mysqli_query($con,$sqlCheckConfirmedF1);
								while($rowFriends1 = mysqli_fetch_array($resultCheckConfirmedF1))
								{
										$fuid1 = $rowFriends1['f_uid'];
										$fstudno = $rowFriends1['f_studno'];
										$fusername = $rowFriends1['f_username'];
										
										$sqlGetinfo2 = "select * from tbluser where stud_uno ='$fstudno'";
										$reGetInfo2 = mysqli_query($con,$sqlGetinfo2);
										$rowInfo2 = mysqli_fetch_array($reGetInfo2);
										$image2 = $rowInfo2['stud_profilepath'];
										$fname2 = $rowInfo2['stud_firstname'];
										
										if($fuid != $c_uid)
										{
											echo"
												<tr>
												<td><img src='$image2' style='width:50px;height:50px;'></td>
												<td>".$fstudno."</td>
												<td>".$fusername."</td>
												<td>".$fname2."</td>
											</tr>
										";
										}	
								}
					}
					
	
				?>
                </tbody>
             </table>
           
             </div>
            </div>
       </div>
        
        
     </div>
</div>




<!--MODAL PANEL-->
<div id="updateProfile" class="modal fade" role="dialog">
	<div class="modal-content" style="width:60%; margin-left:20%; margin-top:2em;">
    	<div class="modal-header">
        	<h4><strong>UPDATE PROFILE</strong></h4>
        </div>
        <div class="modal-body">
        	<table class="table">
            	<tr>
                	<td>
                        <label>Lastname</label>
                        <input type="text" id="up_lname" class="form-control input-sm" value="<?php echo $lname; ?>">
            		</td>
                    <td>
                        <label>Middlename</label>
                        <input type="text" id="up_mi" class="form-control input-sm" value="<?php echo $mi; ?>">
            		</td>
                    <td>
                        <label>Firstname</label>
                        <input type="text" id="up_fname" class="form-control input-sm" value="<?php echo $fname; ?>">
            		</td>
                </tr>
                <tr>
                	<td>
                        <label>Year Level</label>
                        <select id="up_ylevel" class="form-control input-sm">
                        	<option value="<?php echo $ylevel; ?>"><?php echo $ylevel; ?></option>
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth Year">Fourth Year</option>
                        </select>
            		</td>
                    <td>
                        <label>Campus</label>
                        <select id="up_campus" class="form-control input-sm">
                        	<option value="<?php echo $campus; ?>"><?php echo $campus; ?></option>
                            <option value="Sumacab">Sumacab</option>
                            <option value="Gen Tino">Gen Tinio</option>
                            <option value="San Isidro">San Isidro</option>
                            <option value="Atate">Atate</option>
                            <option value="Fort Magsaysay">Fort Magsaysay</option>
                            <option value="Gapan Academic">Gapan Academic</option>
                            <option value="Caranglan Academic">Caranglan Academic</option>
                            <option value="Penaranda Academic">Penaranda Academic</option>
                            <option value="Talavera Academic">Talavera Academic</option>
                            <option value="San Leonardo Academic">San Leonardo Academic</option>
                        </select>
            		</td>
                </tr>
            </table>
                	<tr>
                   		<td>
                        <label>Course</label>
                        <select id="up_course" class="form-control" style=" width:400px;">
                        	<option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                            <option value="College Of Engeneering">College Of Engeneering(COE)</option>
                            <option value="Bachelor Of Science in Information And Technology">Bachelor Of Science in Information And Technology(BSIT)</option>
                            <option value="College of Nursing">College of Nursing</option>
                            <option value="Hotel and Restaurant Management">Hotel and Restaurant Management(HRM)</option>
                            <option value="College of Criminology">College of Criminology</option>
                            <option value="College of Art and Science">College of Art and Science(CAS)</option>
                            <option value="College of Industrial Technology">College of Industrial Technology (CIT)</option>
                            <option value="College of Architecture">College of Architecture</option>
                            <option value="College of Business Administratio">College of Business Administratio</option>
                        </select>
            			</td>
                    </tr>
        </div>
        <div class="modal-footer">
        	<div class="container-fluid">
				<div class="pull-right">
                	<button class="btn btn-primary btn-sm" type="button" data-dismiss="modal"><strong><i class="glyphicon glyphicon-remove-sign fa-fw"></i>CANCEL</strong></button>
                	<button class="btn btn-primary btn-sm" type="button" onClick="UpdateUserInfo()"><strong><i class="glyphicon glyphicon-save fa-fw"></i>SAVE</strong></button>
                </div>            
            </div>
        </div>
    </div>
</div>
<!--JS Extensions-->
<?php include'jsextentions.php'; ?>

<script>
	
//Update User Info
	function UpdateUserInfo()
	{
		var up_uid = document.getElementById("up_uid").value;
		var up_lname = document.getElementById("up_lname").value;
		var up_mi = document.getElementById("up_mi").value;
		var up_fname = document.getElementById("up_fname").value;
		var up_ylevel = document.getElementById("up_ylevel").value;
		var up_campus = document.getElementById("up_campus").value;
		var up_course = document.getElementById("up_course").value;
		
		if(up_lname == '' || up_mi=='' || up_fname=='' || up_ylevel=='' || up_campus == '' || up_course == '')
		{
			alert("Some field(s) is Empty");	
		}else{
			//pag d siya empty pass natin to AJax which siya ung mag ppass ng Data to PHP
			
			$.ajax({
				type:'post',
				url:'phpfunctions/userfunctions.php',
				data:{
					
					sup_uid : up_uid,
					sup_lname : up_lname,
					sup_mi : up_mi,
					sup_fname : up_fname,
					sup_ylevel : up_ylevel,
					sup_campus : up_campus,
					sup_course : up_course
					
				},
				success: function(saveupdateuserinfodata)
				{
					alert(saveupdateuserinfodata);
					document.location.reload(); //reload natin ung Page Referesh
					//Close Modal using jQuery
					$('#updateProfile').fadeOut(); //get the modal ID
					$('body').removeClass('modal-open'); //remoview the class from Bootstrap
					$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
					
				}
			})
		}	
	}
</script>
</body>
</html>