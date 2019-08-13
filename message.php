<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Message</title>
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
    	<h3 class="page-header"><strong>MY MESSAGES</strong></h3>
        
        <!--Data -->
        <input type="text" id="m_uid" value="<?php echo $_SESSION['id']?>" hidden="true">
        <input type="text" id="m_studno" value="<?php echo $_SESSION['studentno']?>" hidden="true">
        <input type="text" id="m_username" value="<?php echo $_SESSION['studusername']?>" hidden="true">
        <!--/Data -->
        
        <ul class="nav nav-tabs">
        	<li class="active">
            <a data-toggle="tab" data-target="#inbox" aria-expanded="true"><i class="fa fa fa-inbox fa-fw"></i>INBOX</a>
            </li>
            <li class="">
            <a data-toggle="tab" data-target="#sentitems" aria-expanded="false"><i class="fa fa-paper-plane-o fa-fw"></i>SENT ITEMS</a>
            </li>
        </ul>
        
        <!--INBOX ITEMS-->
        <div class="tab-content">
        	<div class="tab-pane in active" id="inbox">
            	<table class="table table-bordered table-striped table-hover">
                	<thead>
                        <th>FROM</th>
                        <th>MESSAGE</th>
                       	<th>DATE</th>
                    </thead>
                    <tbody id="inboxid">
                    
                    </tbody>
                </table>
                <div class="pull-right">
                	<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#createnewmessage"><strong>CREATE NEW MESSAGE</strong>&nbsp;<span class="fa fa-comment fa-fw"></span></button>
                </div>
            </div>
            
            <!--SENT ITEMS-->
            <div class="tab-pane" id="sentitems">
            	<table class="table table-bordered table-striped table-hover">
                	<thead>
                        <th>TO</th>
                        <th>MESSAGE</th>
                       	<th>DATE</th>
                    </thead>
                    <tbody id="sentitemsdata">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--MODAL CREATE NEW MESSAGE-->

<div id="createnewmessage" class="modal fade" role="dialog">
	<div class="modal-content createTopic">
		<div class="modal-header">
        	<h3><strong>CREATE MESSAGE</strong>
        </div>
        <div class="modal-body">
        	<label>Select Friend:</label>
            <select id="m_listofuser" class="form-control">
            	<option value="">Select--></option>
            </select>
            
            <label>MESSAGE</label>
            <textarea id="m_mymessage" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
        	<button class="btn btn-primary btn-sm" data-dismiss="modal"><strong>CANCEL</strong></button>
            <button class="btn btn-primary btn-sm" onClick="SentMessage()"><strong><i class="fa fa-paper-plane fa-fw"></i>SEND</strong></button>
        </div>
	</div>
</div>
<!--JS Extensions-->
<?php include'jsextentions.php'; ?>

<script>

$(document).ready(function() {
    GetUser();
	GetSentItems();
	GetInboxMessage();
});

	//DELETE SENTITEMS
	function DeleteSentItems(id)
	{
		var dMessage = confirm("Are you sure you want to delete this message?");	
		if( dMessage == true)
		{
			$.ajax({
				type:'post',
				url:'phpfunctions/messagefunctions.php',
				data:{
					d_sid : id
				},
				success: function(dmessagedata)
				{
					alert(dmessagedata);
					GetSentItems();
				}
			});	
		}
		
		
	}


	//DELETE MESSAGE
	function DeleteMessage(id)
	{
		var dMessage = confirm("Are you sure you want to delete this message?");
		if( dMessage == true)
		{
			$.ajax({
				type:'post',
				url:'phpfunctions/messagefunctions.php',
				data:{
					d_mid : id
				},
				success: function(dmessagedata)
				{
					alert(dmessagedata);
					GetInboxMessage();
				}
			});	
		}
	}


	//SEND MESSAGE
	function SentMessage()
	{
		var m_uid = document.getElementById("m_uid").value;
		var m_studno = document.getElementById("m_studno").value;
		var m_username = document.getElementById("m_username").value;
		var m_mymessage = document.getElementById("m_mymessage").value;
		
		var m_listofuser = document.getElementById("m_listofuser").value;
		
		
		if(m_listofuser == '')
		{
			alert("Select user first");	
		}
		else if(m_mymessage =='' )
		{
			alert("Message is Empty");	
		}
		else
		{
			$.ajax({
				type:'post',
				url:'phpfunctions/messagefunctions.php',
				data:
				{
					sm_uid : m_uid,
					sm_studno : m_studno,
					sm_username : m_username,
					sm_mymessage : m_mymessage,
					sm_listofuser : m_listofuser	
				},
				success: function(sentmessagedata)
				{
					alert(sentmessagedata);
					GetSentItems();
					document.getElementById("m_mymessage").value = "";
					//Close Modal using jQuery
					$('#createnewmessage').fadeOut(); //get the modal ID
					$('body').removeClass('modal-open'); //remoview the class from Bootstrap
					$('.modal-backdrop').remove();	//Remove the Transparent Backdrop	
				}
			});	
		}
	}
	
	
	//Get INBOX MESSAGE
	function GetInboxMessage()
	{
		var m_uid = document.getElementById("m_uid").value;
		var m_username = document.getElementById("m_username").value;
		$.ajax({
			type:'post',
			url:'phpfunctions/messagefunctions.php',
			data:{
				ginbox :'getinbox',	
				guid : m_uid,
				gm_username : m_username
			},
			success: function(getinboxdata)
			{
				document.getElementById("inboxid").innerHTML = getinboxdata;	
			}
		});		
	}

	//GET SENT ITEMS
	function GetSentItems()
	{
		var m_uid = document.getElementById("m_uid").value;
		$.ajax({
			type:'post',
			url:'phpfunctions/messagefunctions.php',
			data:{
				gsentitems :'getsentitems',	
				guid : m_uid
			},
			success: function(getsentitemsdata)
			{
				document.getElementById("sentitemsdata").innerHTML = getsentitemsdata;	
			}
		});
		
	}
	
	
	//GET USER FOR NOW (FRIENDS)
	function GetUser()
	{
		var m_uid = document.getElementById("m_uid").value;
		$.ajax({
			type:'post',
			url:'phpfunctions/messagefunctions.php',
			data:{
				guser :'getusers',	
				gm_uid : m_uid
			},
			success: function(getusersdata)
			{
				document.getElementById("m_listofuser").innerHTML = getusersdata;	
			}
		});
	}
</script>
</body>
</html>