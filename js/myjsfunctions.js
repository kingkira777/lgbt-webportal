// JavaScript Document

//SAVE TOPIC
function CreateNewTopic()
{
	var t_Author = document.getElementById("t_Author").value;
	var t_Title = document.getElementById("t_Title").value;
	var t_Descriptions = document.getElementById("t_Descriptions").value;
	var t_Content = document.getElementById("t_Content").value;
	
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
					st_Content:t_Content
				},
			success: function(savenewtopicdata)
			{
				alert(savenewtopicdata);
				GetTopicList();
				
				//Close Modal using jQuery
				$('#createTopic').fadeOut(); //get the modal ID
				$('body').removeClass('modal-open'); //remoview the class from Bootstrap
				$('.modal-backdrop').remove();	//Remove the Transparent Backdrop
			}	
		});	
	}
	
}