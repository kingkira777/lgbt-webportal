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
        	<h4><strong>3 Tips for More Dates</strong></h4>
        </div>
        <div class="panel-body">
        	<p>In a way, LGBT Portal is a marketplace for meeting LGBT Students. 
            Your profile is your ad, and therefore your profile content is very important. 
            “You never get a second chance to make a first impression”, right? So we’ve put together 3 
            simple tips for improving your dating success.
            </p>
            
        <ol>
           <li><strong>A Picture Says a Thousand Words</strong></li> 
           <p>
           	We see it a lot in profiles, “No pic, no date,” and let’s be honest, it’s 
            understandable why. Have you ever bought something in a web shop without seeing 
            a picture first? Probably not. Therefore, we suggest you display at least one 
            picture in your profile. Ideally, it’s best to publish a combination of sexy 
            and “more respectable” pics, to give other LGBT a clear idea of who you are. 
            Remember, having a profile with pictures makes you more trustworthy
           </p>
           
           <p>
           	Bonus tip: Change your profile picture every once in a while. LGBT will 
            definitely notice a fresh pic in their search results!
           </p>
           
           <li><strong>People may HEAR your words, but they feel your ATTITUDE</strong></li>
           <p>
           It’s more fun expressing yourself through words, it can also affect other who will read it. So be bold and free stating your side. 
           Who knows maybe one of your readers is your Match Partner in life. 
           </p>
           <li><strong>Keep the conversation fun</strong></li>
           <p>
           Try to keep your conversation light-hearted. On your first date, you don’t want to get into an in-depth conversation about why you don’t enjoy your job, or other issues you’ve been having. LGBT want someone who can make them laugh and ask the right questions. 
           Yes you do have to be serious sometimes, but in the early stages of dating, have some fun.
           </p>
   			<p>
            
So there you go. Three quick-and-easy steps to give your dating life a boost. 

            </p>
        </ol>
        </div>
        <div class="panel-footer">
    	
        </div>
    </div>
</div>
<?php include'jsextentions.php'; ?>
   
    
</body>
</html>