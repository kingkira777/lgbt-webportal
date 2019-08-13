<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LGBT Portal</title>
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
    	<h3 class="page-header">View Profile</h3>        
       <!-- GET THE USER PROFILE INFO AND DESPlay-->
      	  <?php
			include'connection.php';
			
			$v_uid = $_GET['userid'];
			$usename = $_GET['username'];
			
			$sqlViewProfile = "select * from tbluser where id='$v_uid'";
			$resultViewProfile = mysqli_query($con,$sqlViewProfile);
			
			if(mysqli_num_rows($resultViewProfile)> 0)
			{
				while($rowViewProfiel = mysqli_fetch_array($resultViewProfile))
				{
						$stud_id = $rowViewProfiel['id'];
						$stud_uno = $rowViewProfiel['stud_uno'];
						$stud_uusername = $rowViewProfiel['stud_uusername'];
						$stud_uemail = $rowViewProfiel['stud_uemail'];
						$stud_ugender = $rowViewProfiel['stud_ugender'];
						$stud_birthday = $rowViewProfiel['stud_birthday'];
						$stud_firstname = $rowViewProfiel['stud_firstname'];
						$stud_lastname = $rowViewProfiel['stud_lastname'];
						$stud_mi = $rowViewProfiel['stud_mi'];
						$stud_yearlevel = $rowViewProfiel['stud_yearlevel'];
						$stud_campus = $rowViewProfiel['stud_campus'];
						$stud_course = $rowViewProfiel['stud_course'];
						$stud_profilepath = $rowViewProfiel['stud_profilepath'];
						
						$fullname = $stud_firstname ." ". $stud_lastname . " " . $stud_mi;
						
						
						if(!empty($stud_profilepath))
						{
							$imageEmpty = $stud_profilepath;	
						}
						else
						{
							$imageEmpty = "images/profileimages/user-logo.jpg";
						}
						
				}
			}
			else
			{
				echo"USER NOT FOUND";
			}
			
			
			
		?>
      	
        <div class="row">  
      		<div class="col-sm-6">
        		 <img src="<?php echo $imageEmpty ?>" style="width:350px; height:350px;">
        	</div>
            
            <div class="col-sm-6">
            	<!-- CURRENT LOGIN BY SESSION-->
                <input type="text" id="sf_uid" value="<?php echo $_SESSION['id']?>" hidden="true">
               	<input type="text" id="sf_studno" value="<?php echo $_SESSION['studentno']?>" hidden="true" >
               	<input type="text" id="sf_username" value="<?php echo $_SESSION['studusername']?>" hidden="true">
               
                <input type="text" id="v_uid" value="<?php echo $stud_id?>" hidden="true">
               	<input type="text" id="v_studno" value="<?php echo $stud_uno?>" hidden="true">
                <input type="text" id="v_username" value="<?php echo $stud_uusername?>" hidden="true">
               
      			  	<label>Name:</label>
                    <p><?php echo $fullname?></p>
                    <input type="text" id="v_fullname" value="<?php echo $fullname?>" hidden="true"><br>
                    <label>Course:</label>
                    <p><?php echo $stud_course?></p>
                    <input type="text" id="v_course" value="<?php echo $stud_course?>"hidden="true"><br>
                    <label>Gender:</label>
                    <p><?php echo $stud_ugenderg?></p>
                    <input type="text" id="v_gender" value="<?php echo $stud_ugender?>"hidden="true"><br>
                    <label>Year level:</label>
                    <p><?php echo $stud_yearlevel?></p>
                    <input type="text" id="v_ylevel" value="<?php echo $stud_yearlevel?>"hidden="true"><br>  
                    <label>Birthday:</label>
                    <p><?php echo $stud_birthday?></p>
                    <input type="text" id="v_birthday" value="<?php echo $stud_birthday?>"hidden="true">      
            </div>
            
            <div class="pull-right">
            <span id="addfriendid">
            <!--<button class="btn btn-primary btn-sm" type="button" onClick="AddFriend()" id="addfriend">
            <i class="glyphicon glyphicon-plus-sign"></i>
            ADD FRIEND
            </button>-->
            
            </span>
            </div>
            
        </div>
        <!--/end Row-->
    
    </div>
</div>

<!--JS Extensions-->
<?php include'jsextentions.php'; ?>

<script>

$(document).ready(function() {
    CheckFriendRequest();
});


function CheckFriendRequest()
{
	
	var chv_uid = document.getElementById("v_uid").value;
	var chv_studno = document.getElementById("v_studno").value;
	var chv_fullname = document.getElementById("v_fullname").value;
	var chv_username = document.getElementById("v_username").value;
	
	//Who Send Friend Request
	var chc_uid = document.getElementById("sf_uid").value;
	var chc_studno = document.getElementById("sf_studno").value;
	var chc_username = document.getElementById("sf_username").value;
	
	
	$.ajax({
		type:'post',
		url:'phpfunctions/userfunctions.php',
		data:{
				schv_uid : chv_uid,
				schv_studno : chv_studno,
				schv_username : chv_username,
				//TO
				schc_uid : chc_uid,
				schc_studno : chc_studno,
				schc_username : chc_username
		},
		success: function(checkfrq)
		{
			document.getElementById("addfriendid").innerHTML = checkfrq;
		}
	});	
	
}




function AddFriend()
{
	var v_uid = document.getElementById("v_uid").value;
	var v_studno = document.getElementById("v_studno").value;
	var v_username = document.getElementById("v_username").value;
	
	//Who Send Friend Request
	var sf_uid = document.getElementById("sf_uid").value;
	var sf_studno = document.getElementById("sf_studno").value;
	var sf_username = document.getElementById("sf_username").value;
	
	
	
	if(v_uid == sf_uid)
	{
		alert("You Can't Add your Self");	
	}
	else
	{

		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				ssf_uid : sf_uid,
				ssf_studno : sf_studno,
				ssf_username : sf_username,
				//TO
				sv_uid : v_uid,
				sv_studno : v_studno,
				sv_username : v_username
				
			},
			success: function(addfrienddata)
			{
				alert(addfrienddata);
			}
		});	
	}
}



</script>
</body>
</html>