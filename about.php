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
    background-color: rgba(245, 245, 245, 0.8);
}
.panel.panel-heading{
    background-color: rgba(245, 245, 245, 0.8);
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
    <div class="nav navbar-brand">
    	<h4><strong>
        <a href="index.php" style="cursor:pointer; text-decoration:none;">
        LGBT-PORTAL
        </a>
        </strong></h4>
    </div>
	
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">

        <li><a href="about.php"> <strong>ABOUT</strong></a></li>
        <li><a href="termsofuse.php"> <strong>TERMS OF USE</strong></a></li>
        <li><a href="tips.php"> <strong>TIPS FOR DATING</strong></a></li>
      </ul>
      
    </div>
  </div>
</nav>

	<!--LOGIN CONTAINER-->
<div class="container">	
	
	<div class="panel panel-primary" style="margin-top:100px;">
    	<div class="panel-heading">
        	<h4><strong>ABOUT US</strong></h4>
        </div>
        <div class="panel-body">
        	<p>
            Just Like our users, One of us is Gay and diversified. With our website , 
            we choose to provide a friendly environment for all LGBT Students of our school 
            to truly live out all aspectsof their LGBT Life-show it, talk about it, and by 
            all means, share it.We aren’t like other dating platforms in that we’re not just 
            in it for the money. We feel a greater responsibility towards the larger LGBT 
            Community. We give back to our community, which makes us unique compared to others.
            </p>
        </div>
        <div class="panel-footer">
    	
        </div>
    </div>
</div>
<?php include'jsextentions.php'; ?>
   
    
</body>
</html>