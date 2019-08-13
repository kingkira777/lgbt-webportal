<?php
	 // kialngan to pag mag ssave na SESSIOn
	include'connection.php';//lagi tong ttwagin everytime na mag ssave or may kukunin tayong
							//data sa databse natin
	$flag = true;
	$ifuser = 0;
	if(isset($_POST['login'])) //name ng Login button ung kailangan dito		
	{
		$flag = true;	
		//then kunin natin ung username and password using post
		$username = $_POST['username']; //itong user name is ung name ng TEXTBOX
		$password = $_POST['password'];
		
		
		//CHECK if the user is BANED OR NOT
		$sqlCheckUser = "select user_name from tblbanuser where user_name='$username'";
		$resultCheckUser = mysqli_query($con,$sqlCheckUser);
		$rowCheckuser = mysqli_fetch_array($resultCheckUser);
		if(!empty($rowCheckuser['user_name']))
		{
			$ifuser = 6;
		}
		else
		{

			$sqlIdentify =  "select stud_position from tbluser where stud_uusername='$username' and stud_upassword='$password' ";
			$resultIdentify = mysqli_query($con,$sqlIdentify);
			$rowIdentify = mysqli_fetch_array($resultIdentify);
			
			if(mysqli_num_rows($resultIdentify)> 0)
			{
				//pag  si Admin ung Nag Login	
				$adminPosition = $rowIdentify['stud_position'];
				if($adminPosition == "Admin" || $adminPosition == "admin")
				{
					$ifuser = 0;
					$sqlLogin = "select id, stud_uno, stud_uusername, stud_upassword, stud_position from tbluser where stud_uusername='$username' 
																					  and stud_upassword='$password'";
					$resultLogin = mysqli_query($con,$sqlLogin); //Execute Query
					if(mysqli_num_rows($resultLogin) > 0 )
					{
									//First Loop muna ng Details
						while($getSession = mysqli_fetch_array($resultLogin))
						{
							//Dito natin e store ung SESSION
							session_start();	
							//dti ung mali kc nag e store tyo sa Variable hindi sa SESSION
							$_SESSION['id'] = $getSession['id']; //kunin natin ung DATA sa Database
							$_SESSION['studentno'] = $getSession['stud_uno'];
							$_SESSION['studusername'] = $getSession['stud_uusername'];
							$_SESSION['studpassword'] = $getSession['stud_upassword'];
						}
								
						//pag greater than 0 means nag matched ung username and password
						//or pag may nahanap
						$flag = true; //mag set tayo ng Boolean para ok sya makakapag lagay tayo ng Alert or message
						header("Location: ad_home.php"); //then E redirect natin ung user sa Home Page natin
						//para lang tong Hyper Link
					}
					else
					{
						//else pag walng nahanp ibig sabhin is Login Failed
						
						$flag = false;		
					}					
					
				}
				else
				{
					$ifuser = 1;	
				}
			}
			else
			{
				//PAG user lang nag Login	
				$ifuser =1;
			}
		
		}
		
		if($ifuser == 1)
		{
			$sqlLogin = "select id, stud_uno, stud_uusername, stud_upassword from tbluser where stud_uusername='$username' 
																				  and stud_upassword='$password'";
				$resultLogin = mysqli_query($con,$sqlLogin); //Execute Query
				
				if(mysqli_num_rows($resultLogin) > 0 )
				{
								//First Loop muna ng Details
					while($getSession = mysqli_fetch_array($resultLogin))
					{
						//Dito natin e store ung SESSION
						session_start();	
						//dti ung mali kc nag e store tyo sa Variable hindi sa SESSION
						$_SESSION['id'] = $getSession['id']; //kunin natin ung DATA sa Database
						$_SESSION['studentno'] = $getSession['stud_uno'];
						$_SESSION['studusername'] = $getSession['stud_uusername'];
						$_SESSION['studpassword'] = $getSession['stud_upassword'];
					}
							
					//pag greater than 0 means nag matched ung username and password
					//or pag may nahanap
					$flag = true; //mag set tayo ng Boolean para ok sya makakapag lagay tayo ng Alert or message
					
					header("Location: home.php"); //then E redirect natin ung user sa Home Page natin
					//para lang tong Hyper Link
				}else
				{
					//else pag walng nahanp ibig sabhin is Login Failed
					
					$flag = false;		
				}	
		}
		
		
	}
?>
<!DOCTYPE html>
<style>

body{
	background-image:url(images/Background/BgImage03.jpg);
	background-repeat:no-repeat;
	background-size:cover;
	background-attachment:fixed;
	}
.carousel{
    background: #2f4357;
    margin-top: 20px;
}
.carousel .item{
    min-height: 280px; /* Prevent carousel from being distorted if for some reason image doesn't load */
}
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.bs-example{
	margin: 20px;
}
.school-logo{
	background-image:url(images/Logo/Logo01.jpg);
}	
.panel.panel-primary{
    background-color: rgba(245, 245, 245, 0.5);
}
.panel.panel-heading{
    background-color: rgba(245, 245, 245, 0.5);
}

</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include'cssextentions.php'; ?>
<title>Login</title>
</head>
<body>

<nav class="nav navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
	
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">

        <li><a href="about.php"> <strong> ABOUT</strong></a></li>
        <li><a href="termsofuse.php"> <strong>TERMS OF USE</strong></a></li>
        <li><a href="tips.php"> <strong>TIPS FOR DATING</strong></a></li>
      </ul>
      
    </div>
  </div>
</nav>

	<!--LOGIN CONTAINER-->
      <div class="container">
       
        <div class="row">
            <div class="col-md-4">      
                <div class="panel panel-primary fa-inverse  panel-transparent" style="margin-top:60px;">
                    <div class="panel-heading">
                    	<div class="pull-left">
						<img src="images/Logo/Logo01.jpg" style="width:50px; height:50px; border-radius:50%;">  
                       	</div>
                        <div class="container-fluid">
                        	<div class="pull-right">
                            <h3>LGBT-PORTAL</h3>
                              	
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                    <ul class="nav nav-tabs">
                                	<li class="active"><a data-toggle="tab" data-target="#login" style="color:#000;"><strong>Login</strong></a></li>	
                                	<li class="tab"><a data-toggle="tab" data-target="#register"style="color:#000;"><strong>Register</strong></a></li>		
                    			</ul>     
                    <div class="tab-content">
               		
                    <!--LOGIN-->
                    	<div class="tab-pane in active" id="login">
                        
                          <!-- ALERT MESSAGE -->
						 <?php if($ifuser == 6){echo"<p class=\"alert alert-warning\" align=\"center\"><strong>ACCOUNT IS BANNED</strong></p>";} ?>
                         <?php if($flag == false){echo"<p class=\"alert alert-warning\" align=\"center\"><strong>LOGIN FAILED!</strong></p>";} ?>
                         <!--/ALERT MESSAGE -->
                       <h4 align="center" style="color:#000"><strong>START</strong></h4> 		
                       <h3 align="center" style="color:#000"><strong>SOMETHING</strong></h3>
                       <h2 align="center" style="color:#000"><strong>NEW</strong></h2>
                        <form method="post">  <!--wla siyang POST method-->
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
           
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="container-fluid">
                                	<div class="pull-right">
                             			<button class="btn btn-primary" name="login">Login<i class="fa fa-sign-in fa-fw"></i></button>
                            		</div>
                                </div>
                            </fieldset>
                        </form>
                       
                        </div>
                        
                        <!--REGISTER-->
                        <div class="tab-pane" id="register">
                            <table class="table">
                            	<tbody>
                                	<tr>
                                        <td>
                                       	<input type="text" id="r_studid" class="form-control input-sm" placeholder="Student No." required>
                                        </td>
                                    </tr>
                                	<tr>
                                        <td>
                                       	<input type="text" id="r_username" class="form-control input-sm" placeholder="Username" required>
                                        <span id="warningusename"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                       	<input type="password" id="r_password" class="form-control input-sm" placeholder="Password" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                       	<input type="password" id="r_repassword"  class="form-control input-sm" placeholder="Re-Enter Password" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                       	<input type="email" id="r_email" class="form-control input-sm" placeholder="Email" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                       	<select id="r_gender" class="form-control input-sm">
                                        	<option value="">Select GENDER--></option>
                                            <option value="Lesbian">Lesbian</option>
                                            <option value="Gay">Gay</option>
                                            <option value="Bisexual">Bisexual</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <label>Birhtday</label>
                                        <input type="date" id="r_bday" class="form-control input-sm">
                                    	</td>
                                    </tr>
                                    <tr>
                                        <td>
                                        	<span id="result" style="color:#000;"><strong></strong></span>
                                        	<button class="btn btn-primary btn-sm pull-right" onClick="Register()"><strong>REGISTER</strong></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                  <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel" style="margin-top:60px; height:450px;">
                    <!-- Carousel indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>   
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="images/slide/image0111.jpg" alt="First Slide" style="height:450px;">
                        </div>
                        <div class="item">
                            <img src="images/slide/image0222.jpg" alt="Second Slide" style="height:450px;">
                        </div>
                        <div class="item">
                            <img src="images/slide/image0333.jpg" alt="Third Slide" style="height:450px;">
                        </div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>    
            </div>
            
        </div>
        <!--/ROW-->
        
    </div>
<?php include'jsextentions.php'; ?>
    
<script>
function Register()
{    

	var isTaken = "";


	//GET THE VALUE usign its ID
	var r_studid = document.getElementById("r_studid").value;
 	var r_username = document.getElementById("r_username").value;
	var r_password = document.getElementById("r_password").value;
	var r_repassword = document.getElementById("r_repassword").value;
	var r_email = document.getElementById("r_email").value;
	var r_gender = document.getElementById("r_gender").value;
	var r_bday = document.getElementById("r_bday").value
	
	//Check if its empty or not
	if(r_studid=='' || r_username == '' || r_password=='' || r_repassword=='' || r_email=='' || r_gender=='' || r_bday=='')
	{
		alert("Some field(s) is Empty");
	}else if (r_password != r_repassword) //Compare password for matching
	{
		alert("Password not matched!");	
	}else{
		//if all is OK then will use Ajax to pass the data form HTML ot PHP
		
		$.ajax({
			type:'post',
			url:'phpfunctions/loginregisterfunctions.php',
			data:{
				//ito ung mga Varible na kukunin natin
				sr_studid : r_studid,
				sr_username : r_username,
				sr_password : r_password,
				sr_email : r_email,
				sr_gender : r_gender,
				sr_bday : r_bday
				
			},
			success: function(saveregisteruserdata)
			{
				
				isTaken = saveregisteruserdata
				 if(isTaken == 'Taken')
				{
					alert("Username is Already Taken");
					document.getElementById("r_studid").value = "";
					document.getElementById("r_username").value = "";
					document.getElementById("r_password").value = "";
					document.getElementById("r_repassword").value = "";
					document.getElementById("r_email").value = "";
					document.getElementById("r_gender").value = "";
					document.getElementById("r_bday").value = "";
				}
				else
				{
					alert(isTaken);
					window.location.reload(); //Reload the Page
				}
			}
		});
		
	}
	
}

$(document).ready(function() {         
$('#r_password').keyup(function() {
$('#result').html(checkStrength($('#r_password').val()))
})
function checkStrength(password) {
var strength = 0
if (password.length < 6) {
$('#result').removeClass()
$('#result').addClass('short')
return 'Too short'
}
if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('weak')
return 'Weak'
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('good')
return 'Good'
} else {
$('#result').removeClass()
$('#result').addClass('strong')
return 'Strong'
}
}
});

</script>
    
</body>
</html>