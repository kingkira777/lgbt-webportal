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
    
    	<?php
			$topicid = $_GET['topicid']; //Get the topic from the URL		
			$sqlGetTopic = "select * from tbltopics where t_id='$topicid'";
			$resultGettopic = mysqli_query($con,$sqlGetTopic);
			
			if(mysqli_num_rows($resultGettopic)>0)
			{
				while($rowGetTopic = mysqli_fetch_array($resultGettopic))
				{
					$t_id = $rowGetTopic['t_id'];
					$t_title = $rowGetTopic['t_title'];
					$t_description = $rowGetTopic['t_description'];
					$t_author = $rowGetTopic['t_author'];
					$t_content = $rowGetTopic['t_content'];		
			
		?>
        <div class="panel panel-primary">
        	<div class="panel-heading">
            	<div class="pull-right">
                	<h5><strong>AUTHOR: </strong><?php echo$t_author ?></h5>  
                </div>
                <h4><strong><?php echo $t_title ?></strong></h4>
                <p><strong>DESCRIPTIONS: </strong><?php echo$t_description ?></p>        
            	
            
            <!--HIDDEN TExt-->
            	<div style="color:#000">
                <input type="text"  value="<?php echo $_SESSION['id'] ?>" hidden="true" id="c_uid">
                <input type="text"  value="<?php echo $t_id ?>" hidden="true" id="c_id">
            	<input type="text"  value="<?php echo $studno ?>" hidden="true" id="c_studno">
                <input type="text"  value="<?php echo $_SESSION['studusername'] ?>" hidden="true" id="c_studuser">
            	<input type="text"  value="<?php echo $t_author; ?>" hidden="true" id="c_author">
                <input type="text"  value="<?php echo $t_description; ?>" hidden="true" id="c_descriptions">
                <input type="text"  value="<?php echo $t_title; ?>" hidden="true" id="c_title">
                </div>
           <!--/HIDDEN TExt-->
            </div>
            <div class="panel-body">
            	<p><?php echo $t_content ?></p>
            </div>
        <?php
				}	
			}else{
				
				echo"
					<div class=\"alert-warning\" align=\"center\">
					<h2>TOPIC NOT FOUND!</h2>
					<i>Select another topic</i>
					</div>
					";
				
			}
		?>
    	 </div>
         
         
         <!--COMMETN SECTION-->
         <div class="panel panel-info">
         	<div class="panel-body">
            	<div id="showcomments"></div>
                <table class="table table-hover table-striped">
                	<thead>
                    	<th style="width:100px;"></th>
                    	<th style="width:150px;">USER</th>
                        <th>COMMENT</th>
                        <th style="width:180px;"></th>
                    </thead>
                	<tbody id="commentshow">
             
                    
                    </tbody>
                </table>
         		
            </div>
            <div class="panel-footer">
            	<div class="container-fluid">
                	<div class="input-group">
                	<input type="text" id="c_commenttext" class="form-control" placeholder="write your comment here.....">
                    <div class="input-group-btn">
                	<button type="button" class="btn btn-info" onClick="SaveComment()">Submit</button>
                    </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>



<!-- MODAL PANEL-->
<div id="editComment" class="modal fade" role="dialog">
	<div class="modal-content createTopic">
		<div class="modal-header">
        	<h3>Edit Comment</h3>
        </div>
        
        <div class="modal-body">
        	<div id="showCommentId"></div>  
        </div>
        
        <div class="modal-footer">
        	<div class="container-fluid">
            	<div class="pull-right">
                	<button class="btn btn-primary" data-dismiss="modal" data-target="#createTopic"><strong><i class="glyphicon glyphicon-remove-sign fa-fw"></i>CANCEL</strong></button>
                    <button class="btn btn-primary" onClick="SaveEditComment()"><strong><i class="glyphicon glyphicon-save fa-fw"></i>Save</strong></button>
                </div>
            </div>
        </div>
	</div>
</div>

<!--JS Extensions-->
<?php include'jsextentions.php'; ?>
<script>
$(document).ready(function() {
	GetCommentList();
});


//DELETE COMMENT
 function DeleteComment(uid, cid)
 {
	 var c_uid = document.getElementById("c_uid").value;
	
	 
	 if(uid == c_uid)
	 {
		 var msgBoxDelet = confirm("Are you sure you want to delete your comment?");
		 if( msgBoxDelet == true)
	 	{
			$.ajax({
				type:'post',
				url:'phpfunctions/commentfunctions.php',
				data:{
					
					_uid : uid,
					_cid : cid
				},
				success: function(deletecommentdata)
				{
					alert(deletecommentdata);
					GetCommentList();	
				}	
			});	
		}
	 }
	 else
	 {
		 alert("This is not your comment");
	 }
 }

//SAVE EDIT COMMENT
 function SaveEditComment()
 {
	  var c_uid = document.getElementById("c_uid").value;
	  var _cid = document.getElementById("_cid").value;
	  var editComment = document.getElementById("saveeditcomment").value;
	  
	  //DEBUG muna natin para sure na my laman ung Variables natin
	
	if(editComment == '')
	{
		alert("Your Comment is Empty");	
	}
	else
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/commentfunctions.php',
			data:{
				
				esdc_uid : c_uid,
				esd_cid : _cid,
				esdeditComment : editComment
				
			},
			success: function(saveeditdata)
			{
				alert(saveeditdata);
				GetCommentList();
				//Close Modal using jQuery
				$('#editComment').fadeOut(); //get the modal ID
				$('body').removeClass('modal-open'); //remoview the class from Bootstrap
				$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
			}
		});
	} 
 }

//SHOW MY COMMENT
 function ShowComment(id, pcid)
 {
	 var c_uid = document.getElementById("c_uid").value; 
	 if(c_uid ==  id)
	 {
		//send natin ung data to PHP using Ajax
		$.ajax({
			type:'post',
			url:'phpfunctions/commentfunctions.php',
			data:{
				gid : id,
				gcid : pcid
			},
			success: function(showCommentData)
			{
				document.getElementById("showCommentId").innerHTML = showCommentData;
			}
		});
		
		
		//OPEN MODAL PANEL USING jQuery
		 $("#editComment").modal();
		 $("#editComment").show();
		 
		
	 }
	 else
	 {
		 alert("This is not your Comment");
	 }
 }

//Save Comment
 function SaveComment()
 {
	 var c_id = document.getElementById("c_id").value;
	 var c_studno = document.getElementById("c_studno").value;
	 var c_author = document.getElementById("c_author").value;
	 var c_descriptions = document.getElementById("c_descriptions").value;
	 var c_title = document.getElementById("c_title").value;
	 var c_commenttext = document.getElementById("c_commenttext").value;
	 var c_studuser = document.getElementById("c_studuser").value;
	 var c_uid = document.getElementById("c_uid").value;

	 
	 if(c_commenttext == '')
	 {
		alert("Comment Box is Empty");	
	 }else{
		$.ajax({
			type:'post',
			url:'phpfunctions/commentfunctions.php',
			data:{
				sc_studno : c_studno,
				sc_author : c_author,
				sc_descriptions : c_descriptions,
				sc_title :c_title,
				sc_commenttext :c_commenttext,
				sc_id : c_id,
				sc_studuser : c_studuser,
				sc_uid : c_uid
			},
			success: function(savecommentdata)
			{
				document.getElementById("c_commenttext").value = "";
				GetCommentList();
			}
		});	 
	}

 }
 
 //GET COMMENT LIST
 function GetCommentList()
 {
	 var c_id = document.getElementById("c_id").value;
	 var not_uid = document.getElementById("not_uid").value;
	 $.ajax({
		type:'post',
		url:'phpfunctions/commentfunctions.php',
		data:{
			topicid : c_id,
			tsnot_uid : not_uid
		},
		success: function(getcommentslistdata)
		{
			document.getElementById("commentshow").innerHTML = getcommentslistdata;
		}
		 
	}); 
 }


</script>
</body>
</html>