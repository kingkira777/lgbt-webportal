<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User List</title>
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
    	<h4 class="page-header">USER LIST</h4>
        
        <ul class="nav nav-tabs">
        	<li class="active"><a data-toggle="tab" data-target="#userlist">USER LIST</a></li>
        	<li class=""><a data-toggle="tab" data-target="#adminlist">ADMIN LIST</a></li>
            <li class=""><a data-toggle="tab" data-target="#usernotupdated">USER (Profle Not Updated)</a></li>
        </ul>
        
        <input type="text" id="u_uid" value="<?php echo $_SESSION['id'] ?>" hidden="true"> 
        <div class="tab-content">
        	<div id="userlist" class="tab-pane in active">
             <span><strong>COLOR:</strong></span>
             <span style="background-color:#ff9372; border: solid 1px #000000; padding:1px;">BANNED</span>
        	 <span style="background-color:#f7f3f2; border: solid 1px #000000; padding:1px;">NOT BANNED</span>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>STUDENT&nbsp;NO</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>GENDER</th>
                    <th>BIRTHDAY</th>
                    <th style="width:250px;"><i class='fa fa-cog fa-fw'></i>OPTIONS</th>
                </thead>
                <tbody id="userlistid">
                
                </tbody>
            </table>
            </div>
            <div id="adminlist" class="tab-pane">
            <i>You can't see your username here</i>
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>STUDENT&nbsp;NO</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>GENDER</th>
                    <th>BIRTHDAY</th>
                    <th style="width:250px;"><i class='fa fa-cog fa-fw'></i>OPTIONS</th>
                </thead>
                <tbody id="adminlistid">
                
                </tbody>
            </table>
            </div>
            
            <div id="usernotupdated" class="tab-pane">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <th>STUDENT&nbsp;NO</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>GENDER</th>
                    <th>BIRTHDAY</th>
                </thead>
                <tbody id="useraccountnotupdated">
                
                </tbody>
            </table>
            </div>
            
            
        </div>        
    </div>
</div>


<!--MODAL CREATE NEW MESSAGE-->

<div id="notuserid" class="modal fade" role="dialog">
	<div class="modal-content createTopic">
		<div class="modal-header">
        	<h3><strong>CREATE MESSAGE</strong>
        </div>
        <div class="modal-body">
        	<input type="text" id="s_uid" hidden="true"> 
            <input type="text" id="s_studno" hidden="true"> 
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
    GetUserList();
	GetAdminList();
	GetUserAccountNotUpdated();
});


//SEND MESSAGE
function SentMessage()
	{
		//TO
		var s_uid =document.getElementById("s_uid").value;
		var s_studno= document.getElementById("s_studno").value;
		
		var m_mymessage= document.getElementById("m_mymessage").value;
		//SENDER
		var u_uid = document.getElementById("u_uid").value;
		var not_studno = document.getElementById("not_studno").value;
		var not_username = document.getElementById("not_username").value


		if(m_mymessage =='' )
		{
			alert("Message is Empty");	
		}
		else
		{
			$.ajax({
				type:'post',
				url:'phpfunctions/adminfunctions.php',
				data:
				{
					ss_uid : s_uid,
					ss_studno : s_studno,
					
					sm_mymessage: m_mymessage,
					
					su_uid : u_uid,
					snot_studno: not_studno,
					snot_username : not_username	
				},
				success: function(sentmessagedata)
				{
					alert(sentmessagedata);
					document.getElementById("m_mymessage").value = "";
					//Close Modal using jQuery
					$('#notuserid').fadeOut(); //get the modal ID
					$('body').removeClass('modal-open'); //remoview the class from Bootstrap
					$('.modal-backdrop').remove();	//Remove the Transparent Backdrop	
				}
			});	
		}
	}



 function Message(uid,studno)
 {
	document.getElementById("s_uid").value = uid; 
	document.getElementById("s_studno").value = studno;
 }

//MOVE TO USER
 function MoveToUser(id)
 {
	  var dMessage = confirm("Are you sure you want to MOVE this User to USER privilage?");
	 if(dMessage == true)
	{
		$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			up_id :id
		},
		success: function(unpromoteuserdata)
		{
			alert(unpromoteuserdata);
			GetUserList();
			GetAdminList();
		}
		});
	}
	 
 }


//PROMOTE USER TO ADMIN
 function PromoteUser(id)
 {
	 var dMessage = confirm("Are you sure you want to PROMOTE this User to ADMIN privilage?");
	 if(dMessage == true)
	{
		$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			pu_id :id
		},
		success: function(promoteuserdata)
		{
			alert(promoteuserdata);
			GetUserList();
			GetAdminList();
		}
		});
	}
 }



//UNBANNED USER
function UnBannedUser(id)
{
	var dMessage = confirm("Are you sure you want to UN-BANNED this user?");
	if(dMessage == true)
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/adminfunctions.php',
			data:{
				ub_id : id
			},
			success: function(unbanuserdata)
			{
				alert(unbanuserdata);
				GetUserList();
			}	
		});
	}
}


//BAN USER
function BanUser(id)
{
	var uid = document.getElementById("u_uid").value;
	if(uid == id)
	{
		alert("This is your Account, you can't banned it.");	
	}else
	{	
	
	var dMessage = confirm("Are you sure you want to BANNED this user?");
		if(dMessage == true)
		{
		
			$.ajax({
				type:'post',
				url:'phpfunctions/adminfunctions.php',
				data:{
					b_id : id
				},
				success: function(banuserdata)
				{
					alert(banuserdata);
					GetUserList();
				}	
			});
		}
	}
}


//GET USER ACCOUNT NOT UPDATED
function GetUserAccountNotUpdated()
{
	
	$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			getusernotupdated : 'getuserlist'
		},
		success: function(getuserlistdata)
		{
			document.getElementById("useraccountnotupdated").innerHTML = getuserlistdata;
		}	
	});

}



//GET USER LIST
function GetUserList()
{
	$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			getuserlist : 'getuserlist'
		},
		success: function(getuserlistdata)
		{
			document.getElementById("userlistid").innerHTML = getuserlistdata;
		}	
	});
}

//GET ADMIN LIST
function GetAdminList()
{
	var u_uid = document.getElementById("u_uid").value;
	
	$.ajax({
		type:'post',
		url:'phpfunctions/adminfunctions.php',
		data:{
			getadminlist : 'getadminlist',
			getadminid : u_uid
		},
		success: function(getadminlistdata)
		{
			document.getElementById("adminlistid").innerHTML = getadminlistdata;
		}	
	});
}


</script>
</body>
</html>