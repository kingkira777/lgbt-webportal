<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<!--CSS Extensions-->
<?php include'cssextentions.php'; ?>
<!--CSS Extensions-->
</head>
<body>
<!--Header-->
<?php include'header.php';?>
<!--PAGE CONTENT-->
<div id="page-wrapper">
	<h3 class="page-header">ANNOUNCEMENT</h3>
	<div id="dashannouncement" style="overflow:scroll; height:500px;">
    
    </div>
</div>
<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>

$(document).ready(function() {
    GetDashAnnounce();
});

//GET ANNOUNCET  (DASHBOARD)
function GetDashAnnounce()
{
	$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:
			{
				gd_announce : 'getannouncementdat',
			},
			success: function(getanlistdata)
			{
				document.getElementById("dashannouncement").innerHTML = getanlistdata;				
			}	
		});	
	
}


</script>
</body>
</html>