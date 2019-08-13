<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Announcement</title>
<!--CSS Extensions-->
<?php include'cssextentions.php'; ?>
<!--CSS Extensions-->
</head>
<body>
<!--Header-->
<?php include'header.php';?>
<!--PAGE CONTENT-->
<div id="page-wrapper">
	<div class="row">
		<div class="tab-content">
        	<!--DASHBOARD-->
        		<div class="col-sm-12">
        		<h4 class="page-header"><strong>ANNOUNCEMENT</strong></h4>
                <!--Data -->
                <input type="text" id="tp_uid" value="<?php echo $_SESSION['id']; ?>" hidden="true">
                <input type="text" id="tp_studno" value="<?php echo $_SESSION['studentno']; ?>" hidden="true">
                <input type="text" id="tp_usename" value="<?php echo $_SESSION['studusername']; ?>" hidden="true">
                
             	<div id="myannouncid">
                
                
                </div>
                
                	<div class="pull-right">
                		<button type="button" onClick="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newannouncementid">
                        <i class="fa fa-bullhorn fa-fw"></i>
                        <strong>NEW ANNOUNCMENT</strong>
                        </button>
                	</div>
                </div>
	</div>
</div>

<!--MODAL-->
<div id="newannouncementid" class="modal fade" role="dialog">
	<div class="modal-content" style="width:60%; margin-left:20%; margin-top:5em;">
		<div class="modal-header">
        	<h4>Create New Announcement</h4>
        </div>
        <div class="modal-body">
        	<label>TITLE</label>
            <input type="text" id="tp_title" class="form-control input-sm">
            <label>CONTENT</label>
            <textarea id="tp_content" class="form-control input-sm" style="height:200px;"></textarea>
        </div>
        <div class="modal-footer">
        	<div class="container-fluid">
            	<div class="pull-right">
                	<button class="btn btn-primary btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> CANCEL</button>
                	<button class="btn btn-primary btn-sm" onClick="SaveAnnouncement()"><span class="glyphicon glyphicon-remove-sign"></span> SAVE</button>
                </div>
            </div>
        </div>
	</div>
</div>

<!--EDIT ANNOUNCEMENT-->
<div id="editannouncementid" class="modal fade" role="dialog">
	<div class="modal-content" style="width:60%; margin-left:20%; margin-top:5em;">
		<div class="modal-header">
        	<h4>Update Announcement</h4>
        </div>
        <div class="modal-body" id="updateannounceid">
        
        </div>
        <div class="modal-footer">
        	<div class="container-fluid">
            	<div class="pull-right">
                	<button class="btn btn-primary btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> CANCEL</button>
                	<button class="btn btn-primary btn-sm" onClick="UpdateAnnouncement()"><span class="glyphicon glyphicon-remove-sign"></span> SAVE</button>
                </div>
            </div>
        </div>
	</div>
</div>



<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>
$(document).ready(function() {
    GetAnList();
});	


	//DELETE Announcement
	function DeleteAnnouncement(id)
	{
		var dMessage = confirm("Are you sure you want to delete this Announcement?");
		
		if(dMessage == true)
		{
			
			$.ajax({
				type:'post',
				url:'phpfunctions/adminfunctions.php',
				data:{
					dan_id : id
					
				},
				success: function(deleteanouncementdata)
				{
					GetAnList();
					alert(deleteanouncementdata);
				
				}	
				});	
		}
	}

	
	//UPDATE Announcement
	function UpdateAnnouncement()
	{
		var u_anid = document.getElementById("u_anid").value;
		var	utp_title = document.getElementById("utp_title").value;
		var utp_content = document.getElementById("utp_content").value;
		
		if(utp_title == '')
		{
			alert("Title is Empty");	
		}
		else if(utp_content == '')
		{
			alert("Announcement Content is Empty");	
		}
		else
		{
			$.ajax({
			type:'post',
			url:'phpfunctions/adminfunctions.php',
			data:{
				su_anid : u_anid,
				sutp_title : utp_title,
				sutp_content : utp_content
				
			},
			success: function(updateannouncedata)
			{
				GetAnList();
				alert(updateannouncedata);
				//Close Modal using jQuery
				$('#editannouncementid').fadeOut(); //get the modal ID
				$('body').removeClass('modal-open'); //remoview the class from Bootstrap
				$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
			}	
			});	
			
		}
	}
	
	//GET Announcement data to be updated
	function GetAnData(id)
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/adminfunctions.php',
			data:{
				getanddata : id
			},
			success: function(getandata)
			{
				document.getElementById("updateannounceid").innerHTML = getandata;
			}	
		});
	
	}
	//SAVE Announcement
	function SaveAnnouncement()
	{
		var tp_uid = document.getElementById("tp_uid").value;
		var tp_studno = document.getElementById("tp_studno").value;
		var tp_usename = document.getElementById("tp_usename").value;
		var tp_title = document.getElementById("tp_title").value;
		var tp_content = document.getElementById("tp_content").value;
		
		
		if( tp_title == '' )
		{
			alert("Title is Empty");	
		}
		else if (tp_content == '')
		{
			alert("Content is Empty");
		}
		else
		{
			$.ajax({
				type:'post',
				url:'phpfunctions/adminfunctions.php',
				data:
				{
					stp_uid : tp_uid,
					stp_studno : tp_studno,
					stp_usename : tp_usename,
					stp_title : tp_title,
					stp_content : tp_content
				},
				success: function(saveannouncedata)
				{
					GetAnList();
					alert(saveannouncedata);
					document.getElementById("tp_title").value = "";
					document.getElementById("tp_content").value ="";
					//Close Modal using jQuery
					$('#newannouncementid').fadeOut(); //get the modal ID
					$('body').removeClass('modal-open'); //remoview the class from Bootstrap
					$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
				}
			});
		}
		
	}
	
	function GetAnList()
	{
		var tp_uid = document.getElementById("tp_uid").value;
	
		$.ajax({
			type:'post',
			url:'phpfunctions/adminfunctions.php',
			data:
			{
				g_announce : 'getannouncementdat',
				g_uid : tp_uid
			},
			success: function(getanlistdata)
			{
				document.getElementById("myannouncid").innerHTML = getanlistdata;				
			}	
		});	
		
	}
	
</script>
</body>
</html>