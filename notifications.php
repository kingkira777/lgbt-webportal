<?php
	include'Auth.php'; //try natin e remove to
	include'connection.php';
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
    	<h3 class="page-header">Notifications</h3>
        
        <h4><strong>Friend Request</strong></h4>
        <p id="sentfrequestid"></p>
        
        <table class="table">
        	<thead>
            	<th></th>
                <th></th>
                <th></th>
                <th>STUDENT NO</th>
                <th>USERNAME</th>
                <th>FIRSTNAME</th>
            </thead>
            <tbody>
            
            	<?php
					$myuid = $_SESSION['id'];
					$mystudno = $_SESSION['studentno'];
					$isconfirmed = "confirmed";
					$sqlGetFriendRequest="select * from tblfriendsrequest where f_touid='$myuid' and f_tostudno='$mystudno' and f_confirmed != '$isconfirmed'";
					$resultGetFriendRequest= mysqli_query($con,$sqlGetFriendRequest);
					
					if(mysqli_num_rows($resultGetFriendRequest)> 0)
					{
						while($rowFrequest = mysqli_fetch_array($resultGetFriendRequest))
						{
							$id = $rowFrequest['id'];
							$fr_uid = $rowFrequest['f_uid'];
							$fr_studno = $rowFrequest['f_studno'];
							$fr_username = $rowFrequest['f_username'];
							
							$sqlGetinfo2 = "select * from tbluser where stud_uno ='$fr_studno'";
							$reGetInfo2 = mysqli_query($con,$sqlGetinfo2);
							$rowInfo2 = mysqli_fetch_array($reGetInfo2);
							$image2 = $rowInfo2['stud_profilepath'];
							$fname2 = $rowInfo2['stud_firstname'];
							
							
							echo"
								<tr>
									<td>
										<input type='text' id='wsf_id' value='".$fr_uid."' hidden='true'>
										<input type='text' id='wsf_studno' value='".$fr_studno."'  hidden='true'>
										<input type='text' id='wsf_username' value='".$fr_username."'  hidden='true'>
										
										<input type='text' id='wac_id' value='".$_SESSION['id']."'  hidden='true'>
										<input type='text' id='wac_stundno' value='".$_SESSION['studentno']."'  hidden='true'>
										<input type='text' id='wac_username' value='".$_SESSION['studusername']."'  hidden='true'>
									</td>
									<td><img src='$image2' style='width:50px;height:50px;'></td>
									<td><input type='text' value='$id' hidden='true' id='fr_id'></td>
									<td>".$fr_studno."</td>
									<td>".$fr_username."</td>
									<td>".$fname2."</td>
									<td>
									<button type='button' class='btn btn-default btn-sm' onClick='AcceptFriendRequest()'>
										ACCEPT
									</button>
									</td>
								</tr>
							";
					
						}	
						
					}
				
				?>
            </tbody>
        </table>
        
        
    </div>
</div>

<!--JS Extensions-->
<?php include'jsextentions.php'; ?>

<script>
	
	function AcceptFriendRequest()
	{
		
		//Fr ID
		var fr_id = document.getElementById("fr_id").value;
		
		var wsf_id = document.getElementById("wsf_id").value;
		var wsf_studno = document.getElementById("wsf_studno").value;
		var wsf_username = document.getElementById("wsf_username").value;
		
		var wac_id = document.getElementById("wac_id").value;
		var wac_stundno = document.getElementById("wac_stundno").value;
		var wac_username = document.getElementById("wac_username").value;
		
		
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				
				sfr_id : fr_id,
				
				swsf_id : wsf_id,
				swsf_studno : wsf_studno,
				swsf_username : wsf_username,
				
				swac_id : wac_id,
				swac_stundno : wac_stundno,
				swac_username : wac_username
			},
			success: function(acceptfrdata)
			{
				document.location.reload();
			}
		});	
		
	}
</script>
</body>
</html>