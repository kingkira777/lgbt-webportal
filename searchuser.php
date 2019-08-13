<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Result</title>
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
    	<h3 class="page-header"><strong>Search Result..	</strong></h3>
    </div>
    
    <table class="table">
    	<thead>
        	<th></th>
    		<th>STUDENT NO</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
    	</thead>
    	<tbody>
        <?php
			include'connection.php';
			$s_username = $_GET['username'];
			
			
			if($s_username == "")
			{
				echo"
					<tr>
						<td colspan=\"4\" align='center' class='alert alert-warning'>
						<strong>
							PLEASE ENTER USERNAME 
						</strong>
						</td>
					</tr>
					";
			}
			else
			{
				$sqlSearchUser = "select * from tbluser where stud_firstname LIKE '$s_username%' or stud_lastname LIKE '$s_username%' or stud_uemail LIKE '$s_username%'";
				$resultSearchuser = mysqli_query($con,$sqlSearchUser);
				if(mysqli_num_rows($resultSearchuser))
				{
					while($rowSearchUser = mysqli_fetch_array($resultSearchuser))
					{
						$s_uid = $rowSearchUser['id'];
						$s_studno = $rowSearchUser['stud_uno'];
						$s_username = $rowSearchUser['stud_uusername'];		
						$s_proimage = $rowSearchUser['stud_profilepath'];
						$s_email = $rowSearchUser['stud_uemail'];
						
						if(!empty($s_proimage))
						{
							$pimage = $s_proimage;	
						}
						else
						{
							$pimage = "images/profileimages/user-logo.jpg";
						}
						
						echo"
						<tr>
							<td><img src='$pimage' style='width:50px;height:50px;'></td>
							<td><a href='viewprofile.php?userid=$s_uid'>".$s_studno."</a></td>
							<td>".$s_username."</td>
							<td>".$s_email."</td>
						</tr>
						";
					}	
					
				}
				else
				{
					echo"
					<tr>
						<td colspan=\"4\" align='center' class='alert alert-warning'>
						<strong>
							NO RESULT
						</strong>
						</td>
					</tr>
					";
				}
			}
        
        ?>
        </tbody>
    </table>
    
    
</div>
<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>
	
</script>
</body>
</html>