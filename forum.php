<?php
	include'Auth.php'; //try natin e remove to
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forum</title>
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
<div class="col-sm-12">
	<br>
    	<div class="panel panel-green">
        	<div class="panel-heading">
            	<div class="pull-left">
            	<h3><strong><i class="fa fa-forumbee fa-1x fa-fw"></i>TOPIC LIST</strong></h3>
               	</div>
                <div class="container-fluid">
                <div class="pull-right">
                	<br>
                	<div class="input-group" style="width:300px;">
                    <input  type="text" id="t_search" class="form-control input-sm" placeholder="Enter Topic Title..">
                    <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-sm" onClick="SearchTopic()">
                    	<span class="glyphicon glyphicon-search"></span>
                        SEARCH
                    </button>
                    </div>
                    </div>
                </div>                
                </div>
                
                <input type="text" id="t_uid" value="<?php echo $_SESSION['id']?>" hidden="true">
                <input type="text" hidden="true" id="t_Author"  value="<?php echo $_SESSION['studusername']; ?>">
            </div>
            
            <div class="panel-body">
        	<table class="table table-striped table-bordered table-hover">
            	<thead>
                	<th>TITLE</th>
                    <th>DESCRIPTIONS</th>
                    <th>AUTHOR</th>
                    <th>DATE</th>
                    <th style="width:200px;"><span class="fa fa-gear fa-fw"></span>OPTIONS</th>
                </thead>
             	<tbody id="topiclist"> <!--SEt tayo ng ID sa table natin-->
             
             	</tbody>
             </table>
             </div>
             
             <div class="panel-footer">
             	<div class="container-fluid">
             		<div class="pull-right">
                    	<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createTopic"><strong><i class="fa fa-plus-square fa-fw"></i>CREATE NEW TOPIC</strong></button>
                    </div>
                </div>
             </div>       
    </div>
</div>
</div>

<!-- MODAL PANEL-->
<div id="createTopic" class="modal fade" role="dialog">
	<div class="modal-content createTopic">
		<div class="modal-header">
        	<h3>CREATE TOPIC</h3>
        </div>
        
        <div class="modal-body">
        	<table class="table">
        		<tbody>
                	<tr>
                    	<td>
                        	<label>Title</label>
                            <input type="text" id="t_Title" class="form-control">
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label>Descriptions</label>
                            <input type="text" id="t_Descriptions" class="form-control">
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label>Content</label>
                           	<textarea id="t_Content" class="form-control" style="height:100px;"></textarea>
                        </td>
                    </tr>
            	</tbody>
            </table>
        </div>
        
        <div class="modal-footer">
        	<div class="container-fluid">
            	<div class="pull-right">
                	<button class="btn btn-primary" data-dismiss="modal" data-target="#createTopic"><strong><i class="glyphicon glyphicon-remove-sign fa-fw"></i>CANCEL</strong></button>
                    <button class="btn btn-primary" onClick="CreateNewTopic()"><strong><i class="glyphicon glyphicon-save fa-fw"></i>SAVE TOPIC</strong></button>
                </div>
            </div>
        </div>
	</div>
</div>




<!--EDIT TOPIC -->

<div id="editTopic" class="modal fade" role="dialog">
	<div class="modal-content createTopic">
		<div class="modal-header">
        	<h3>EDIT TOPIC</h3>
        </div>
        
        <div class="modal-body">
        	<table class="table">
        		<tbody id="editTopicData">
                	
            	</tbody>
            </table>
        </div>
        
        <div class="modal-footer">
        	<div class="container-fluid">
            	<div class="pull-right">
                	<button class="btn btn-primary" data-dismiss="modal" data-target="#createTopic"><strong><i class="glyphicon glyphicon-remove-sign fa-fw"></i>CANCEL</strong></button>
                    <button class="btn btn-primary" onClick="SaveUpdate()"><strong><i class="glyphicon glyphicon-save fa-fw"></i>SAVE</strong></button>
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


function SearchTopic()
{
	var t_search = document.getElementById("t_search").value;
	
	if(t_search == '')
	{
		alert("Search Box is Empty!");
	}
	else
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				st_search : t_search
		
			},
			success: function(searchtopicdata)
			{
				document.getElementById("topiclist").innerHTML = searchtopicdata;
			}	
		});		
	}
}




//SAVE UPDATE
function SaveUpdate()
{
	var et_id = document.getElementById("et_id").value	
	var et_Title = document.getElementById("et_Title").value;
	var et_Descriptions = document.getElementById("et_Descriptions").value;
	var et_Content = document.getElementById("et_Content").value;
	
	if(et_Title == '' || et_Descriptions == '' || et_Content == '')
	{
		alert("Some field(s) is Empty");	
	}
	else
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				set_id : et_id,
				set_Title : et_Title,
				set_Descriptions : et_Descriptions,
				set_Content : et_Content

			},
			success: function(saveeditedtopic)
			{
				alert(saveeditedtopic);
				GetTopicList();
				//Close Modal using jQuery
				$('#editTopic').fadeOut(); //get the modal ID
				$('body').removeClass('modal-open'); //remoview the class from Bootstrap
				$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
			}	
		});		
	}
	
}


//VIEW TOPIC FOR EDITING
function ViewTopic(tid, tuid)
{
	var t_uid = document.getElementById("t_uid").value;
	
	if(tuid == t_uid)
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
				gtid : tid,
				gtuid :tuid
			},
			success: function(edittopiclistdata)
			{
				document.getElementById("editTopicData").innerHTML = edittopiclistdata;	
			}
		});
		//SHOW MODAL
		$('#editTopic').modal();
		$('#editTopic').show();
	
	}
	else
	{
		alert("This is not your Topic");
	}		
}


//OPEN TOPIC
function OpenTopic(id) //pass natin ung parameter sa function
{
	document.location.href = "opentopic.php?topicid=" + id;	
}


//SAVE TOPIC
function CreateNewTopic()
{
	var t_Author = document.getElementById("t_Author").value;
	var t_Title = document.getElementById("t_Title").value;
	var t_Descriptions = document.getElementById("t_Descriptions").value;
	var t_Content = document.getElementById("t_Content").value;
	var t_uid = document.getElementById("t_uid").value;
	
	if(t_Author == '' || t_Title == '' || t_Descriptions == '' || t_Content == '')
	{
		alert("Some Field(s) is Empty");	
	}
	else
	{
		$.ajax({
			type:'post',
			url:'phpfunctions/userfunctions.php',
			data:{
					st_Author:t_Author,
					st_Title:t_Title,
					st_Descriptions:t_Descriptions,
					st_Content:t_Content,
					st_uid : t_uid
				},
			success: function(savenewtopicdata)
			{
				alert(savenewtopicdata);
				GetTopicList();
				ClearText();
				//Close Modal using jQuery
				$('#createTopic').fadeOut(); //get the modal ID
				$('body').removeClass('modal-open'); //remoview the class from Bootstrap
				$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
			}	
		});	
	}	
}


//CLEAR TEXT IN EDIT
function ClearTextEdit()
{
	document.getElementById("et_Title").value = "";
	document.getElementById("et_Descriptions").value ="";
	document.getElementById("et_Content").value = "";
	
}


//CLEAR TEXT
function ClearText()
{
	document.getElementById("t_Title").value = "";
	document.getElementById("t_Descriptions").value ="";
	document.getElementById("t_Content").value = "";
	
}



function GetTopicList()
{
	var not_uid = document.getElementById("not_uid").value;
	//then gamit tayo ajax para kunin ung DAta
	$.ajax({
		type:'post',
		url:'phpfunctions/userfunctions.php',
		data:{
			//ung Data na e ssend mo sa PHP
			gettopiclist : 'gettopiclist', //kahit ano to fro retrieving ng Data lang
			xsnot_uid : not_uid
		},
		success: function(gettopiclistdata) // sa loob ng Function "gettopiclistdata" kahit ano
											//e lagay nyo
		{
			//then gamit tayo ng DOM(HTML) to get the HTML5 element(s)
			document.getElementById("topiclist").innerHTML = gettopiclistdata;
		}
	});
}

</script>
</body>
</html>