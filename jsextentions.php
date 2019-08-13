<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/metisMenu.min.js"></script>
<script src="js/sb-admin-2.js"></script>
<script src="dist/js/sb-admin-2.min.js"></script>

<script>
$(document).ready(function() {
NotificationMessage();
FriendNotifications();
var MyNotifications= setInterval(function(){NotificationMessage()},2000);
var MyFriendNotifications= setInterval(function(){FriendNotifications()},2000);
});

	//FriendNotifictions
	function FriendNotifications()
	{
		var fnot_uid = document.getElementById("not_uid").value;
		var fnot_studno = document.getElementById("not_studno").value;
		var fnot_username = document.getElementById("not_username").value;
		
		if(fnot_uid == null || fnot_studno == null || fnot_username == null)
		{
			
		}else{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:
			{
				sfnot_uid : fnot_uid,
				sfnot_studno : fnot_studno,
				sfnot_username : fnot_username
				
			},
			success: function(friendnotdata)
			{
				
				//ACCESS natin ung HTML DOM ng SPAN
				//document.getElementById("friendnotid").innerHTML = friendnotdata; 
			}
			
		}).done(function(htmlfdata){
			var htmlfdatasplit = htmlfdata.split(',');
			$('#friendnotid').html(htmlfdatasplit[0]);
			
			var sentfrequestid = document.getElementById("sentfrequestid");
			if( sentfrequestid == null)
			{
				//the Object HTML is Null
			}
			else
			{
			$('#sentfrequestid').html(htmlfdatasplit[1]);
			}
		});	
		}
		
	}


	//SEEN MESSAGE NOTIFICATIONS
	function SeenMessageNotifications()
	{
		var not_username = document.getElementById("not_username").value;
		if(not_username == null)
		{
		}
		else
		{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				seenmessagenot : 'SeenMessageNotfications',
				snot_username : not_username
			}
			
		});	
		}
	}


	//NOTIFICATION MESSAGE
	function NotificationMessage()
	{
		//NEED NATIN NG INFO para sa USER UNG CURRENT na naka Login
		var not_uid = document.getElementById("not_uid");
		var not_studno = document.getElementById("not_studno");
		var not_username = document.getElementById("not_username");
		
		if(not_uid == null  || not_studno == null || not_username == null)
		{
			
		}
		else
		{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:
			{
				snot_uid : not_uid.value,
				snot_studno : not_studno.value,
				snot_username : not_username.value
				
			},
			success: function(notificationmessagedata)
			{
				//ACCESS natin ung HTML DOM ng SPAN
				document.getElementById("messagenotid").innerHTML = notificationmessagedata; 
			}
			
		});	
		}
	}

	//ITO ung SEARCHING ng FRIENDS 
	function SearchPeople()
	{
		var global_searchfriends = document.getElementById("global_searchfriends").value;		
		document.location.href = "searchuser.php?username=" + global_searchfriends;	
	}
</script>

