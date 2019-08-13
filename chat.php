<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chat</title>
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
            <div class="row">
        		<div class="col-sm-12">
                <input type="text" id="ch_uid" value="<?php echo $_SESSION['id'] ?>" hidden="true">
                <input type="text" id="ch_stdudno" value="<?php echo $_SESSION['studentno'] ?>" hidden="true">
                <input type="text" id="ch_username" value="<?php echo $_SESSION['studusername'] ?>" hidden="true">
                	<br>        
						<div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i><strong>Public Chat</strong>
                       	</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="height:450px;">
                            <ul class="chat" id="chatmessageid">
                               
                                
                             
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <input type="text" id="ch_message" class="form-control input-sm" placeholder="Type your message here...">
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat" onClick="SentMessage()">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.CHAT PANEL -->
               </div>
                  <!-- /.col-sm-12 -->  
                   
                   
                   
                   
                </div>
                <!--/ROW-->
       	</div>
   	</div>
</div>
        
<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>
$(document).ready(function() {
    GetChat();	
	//REtrieve Our Chat Logs
	setInterval(function()
	{
    GetChat();
	}, 1000);
	
	//KEY PRESS usng jQuery
	$('#ch_message').keydown(function(e)
	{
		if(e.keyCode == 13)
		{
		SentMessage();
		}
	});

	
	
});

 function GetChat()
 {
	 
	 var ch_uid = document.getElementById("ch_uid").value;
	 $.ajax({
			type:'post',
			url:'phpfunctions/chatfunctions.php',
			data:
			{
				getchat : 'getchatmessage',
				gch_uid :ch_uid
			},
			success: function(getchatdata)
			{
				document.getElementById("chatmessageid").innerHTML = getchatdata;
				ScrollDown();
			}	
		});	 
	 
 }


 function SentMessage()
 {
	 var ch_uid = document.getElementById("ch_uid").value;
	 var ch_stdudno = document.getElementById("ch_stdudno").value;
	 var ch_username = document.getElementById("ch_username").value;
	 
	 var ch_message = document.getElementById("ch_message").value;
	 
	 if(ch_message == '')
	 {
		alert("Please Enter youre message");	 
	 }
	 else
	 {
		$.ajax({
			type:'post',
			url:'phpfunctions/chatfunctions.php',
			data:
			{
				sch_uid : ch_uid,
				sch_stdudno : ch_stdudno,
				sch_username : ch_username,
				sch_message : ch_message
			},
			success: function(chatdata)
			{
				ScrollDown();
				GetChat();
				
			}	
		});	 
	 }
 }

function ScrollDown()
{
	$(".panel-body").animate({ scrollDown: $(this).height() }, "slow");
  	return false;
	//$(".panel-body").animate({ scrollTop: $(document).height() }, "slow");
  	//return false;
}


</script>
</body>
</html>