  <input type="text" id="not_uid" value="<?php echo $_SESSION['id'] ?>" hidden="true" />
  <input type="text" id="not_studno" value="<?php echo $_SESSION['studentno'] ?>" hidden="true" />
  <input type="text" id="not_username" value="<?php echo $_SESSION['studusername'] ?>" hidden="true" />
  
  <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="pull-left">
                <img src="images/Logo/LgbtLogo.png" style="width:80px; height:50px; margin-left:5px;" />
                </div>
                <a class="navbar-brand" href="home.php">LGBT-PORTAL</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a  href="notifications.php">
                        <i class="fa fa-bell fa-fw"></i>
                        <span class="badge" id="friendnotid"></span>
                    </a>
                    <!-- /.dropdown-messages -->
                </li>
                
                <li class="dropdown">
                    <a  href="message.php" onclick="SeenMessageNotifications()">
                        <i class="fa fa-envelope fa-fw"></i>
                        <span class="badge" id="messagenotid"></span>
                    </a>
                    <!-- /.dropdown-messages -->
                </li>
        
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span><strong><?php echo $_SESSION['studusername']; ?></strong></span>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profilepage.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
               
                        <li class="divider"></li>
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Enter Username.." id="global_searchfriends">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="SearchPeople()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="dashboard.php" ><i class="fa fa-dashboard fa-fw"></i> <strong>DASHBOARD</strong></a>
                        </li>
                        <li>
                            <a href="forum.php" onclick="GetTopicList()" ><i class="fa fa-forumbee fa-fw"></i> <strong>FORUM</strong></a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="chat.php"><i class="fa fa-comments fa-fw" aria-hidden="true"></i> <strong>PUBLIC CHAT</strong></a>
                            
                            <!-- /.nav-second-level -->
                        </li>     
                        
                        <?php
                        	include'connection.php';
                        	$uid = $_SESSION['id'];
							$sqlIdentifyAdmin =  "select stud_position from tbluser where id='$uid'";
							$resultIdentifyAdmin = mysqli_query($con,$sqlIdentifyAdmin);
							$rowIdentifyAdmin = mysqli_fetch_array($resultIdentifyAdmin);
			
							if($rowIdentifyAdmin['stud_position'] == "Admin" || $rowIdentifyAdmin['stud_position'] == "admin")
							{
								echo"
								 <h5 align='center'><strong>ADMIN PANEL</strong></h5>
								 <li>
                            		<a href=\"ad_userlist.php\"><i class=\"fa fa-users fa-fw\" aria-hidden=\"true\"></i> <strong>USER LIST</strong></a>
                            
                         		</li> 
								<li>
                            		<a href=\"ad_announce.php\"><i class=\"fa fa-bullhorn fa-fw\" aria-hidden=\"true\"></i> <strong>MY ANNOUNCEMENT</strong></a>
                         		</li>  
								<li>
                            		<a href=\"ad_topiclist.php\"><i class=\"fa fa-list-alt fa-fw\" aria-hidden=\"true\"></i> <strong>TOPIC LIST</strong></a>
                         		</li> 
								";
							}
                        ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
	</nav>