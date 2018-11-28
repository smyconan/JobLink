<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Profile</title>
<!-- Stylesheets -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/revolution-slider.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<!--Favicon-->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="css/responsive.css" rel="stylesheet">

</head>

<body>

<?php

    #include ".\class.pdf2text.php.php";
    $userid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);
    if ($class != "student") {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
    }


    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
	if (!$con) {
		echo "Wrong Database Connection!<br>";
	} else {
        //$a = new PDF2Text();
        //$a->setFilename('1.pdf');
        //$a->decodePDF();

        $sql = "select * from student where sid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $userid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();
        /*
        $sql = "update student set resume = ? where sid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('ss', $resume, $userid);
        $query->execute();
        */
	}
?>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>
    <!-- Main Header-->
    <header class="main-header">
    	<!-- Main Box -->
    	<div class="main-box">
        	<div class="auto-container">
            	<div class="outer-container clearfix">
                    <!--Logo Box-->
                    <div class="logo-box">
                        <div class="logo"><a href="index.php"><img src="images/logo.png" alt=""></a></div>
                    </div>
                    <!--Nav Outer-->
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->    	
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse scroll-nav clearfix">
                                <ul class="navigation clearfix">
                                    <li><a href="studentHome.php">Home</a></li>
                                    <li class = "current"><a href="#">Profile</a></li>
                                    <li><a href="studentFriend.php">Friend</a></li>
                                    <li><a href="studentFollow.php">Follow</a></li>
                                    <li><a href="studentNotification.php">Notification</a></li>
                                    <li><a href="search.php" target="view_window">Search</a></li>
                                    <li><a href = "logouting.php">Logout</a></li>
                                 </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                    <!--Nav Outer End-->
                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                    <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                    </div><!-- / Hidden Nav Toggler -->
            	</div>    
            </div>
        </div>
    </header>
    
    <!-- =============================  TODO  ============================== -->
    <section class = "register-form-section">
        <div class = "register-form">
            <form action="studentUpdateP.php" method="post">
                <div class = "row clearfix">
                <div class="form-title col-md-12 col-sm-12 col-xs-12">
                            <h2>Profile</h2>
                </div>
                
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="group-inner">
                
                    <h3><?php echo "Student id &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][0];?></h3>
                    <br>
                    <h3><?php echo "Username &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][1];?></h3>

                    <div class = "profile"><font size=5>Realname&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='realname' value='".$rows[0][3]."'>"; ?></div>
                    
                    <div class = "profile"><font size=5>University&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='university' value='".$rows[0][4]."'>"; ?></div>

                    <div class = "profile"><font size=5>Major&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='major' value='".$rows[0][5]."'>"; ?></div>
                    
                    <div class = "profile"><font size=5>GPA&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='gpa' value='".$rows[0][6]."'>"; ?></div>

                    <div class = "profile"><font size=5>Interest&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='interest' value='".$rows[0][7]."'>"; ?></div>

                    <div class = "profile"><font size=5>Qualification&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='qua' value='".$rows[0][8]."'>"; ?></div>
                    
                    <div class = "profile"><font size=5>Set Privacy&nbsp0/1&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='private' value='".$rows[0][10]."'>"; ?></div>
                    
                    <br><br>
                    <button type="submit">Update</button>
                
                <div class="group-inner">
                </div>

                </div>
            </div>
        </div>
            </form>
        </div>
    
        
    </section>
    <div class="register-form">
        <form action="upload_file.php" method="post" enctype="multipart/form-data">
            <label for="file">Upload new resume here</label>
            <input type="file" name="file" id="file" /> 
            <br />
            <input type="submit" name="submit" value="Upload" />
        </form>
        </div>
    <!-- ==============================  END  ============================== -->

    <!--Footer-->
    <div class="footer">
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="column col-md-6 col-sm-6 col-xs-12">
                    <div class="copyright">Copyright &copy;</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>

<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/revolution.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/mixitup.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/pagenav.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<script src="js/validate.js"></script>
<script src="js/script.js"></script>

</body>
</html>