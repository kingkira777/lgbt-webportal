<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Topic List</title>
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
        		<h4 class="page-header">TOPIC LIST</h4>
                <!--Data -->
                <input type="text" id="tp_uid" value="<?php echo $_SESSION['id']; ?>" hidden="true">
                <input type="text" id="tp_studno" value="<?php echo $_SESSION['studentno']; ?>" hidden="true">
                <input type="text" id="tp_usename" value="<?php echo $_SESSION['studusername']; ?>" hidden="true">
                
                <table class="table table-bordered table-hover table-striped">
                 	<thead>
                    	<th>AUTHOR</th>
               	  		<th>TITLE</th>
                        <th>DESCRIPTIONS</th>
                        <th>DATE</th>
                        <th>OPTION</th>
                    </thead>
                    <tbody id="usertopiclist">
                    
                    </tbody>
            	</table>
                
                
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

<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>
$(document).ready(function() {
GetTopicList();
});	

 //DELETE TOPIC
 function DeleteTopic(id)
 {
	var dMessage = confirm("Are you sure you want to Delete this Topic?");
	
	if(dMessage == true)
	{
 		$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			tid :id
		},
		success: function(deleteTopic)
		{
			alert(deleteTopic);
			GetTopicList();
		}
		});
	}	 
}



 //GET LIST OF TOPIC
 function GetTopicList()
 {
 	$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			getlisttopic :'gettopiclist'
		},
		success: function(getlisttopicdata)
		{
			document.getElementById("usertopiclist").innerHTML = getlisttopicdata;
		}
	});
 }


	
</script>
</body>
</html>