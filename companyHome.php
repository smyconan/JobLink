<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Company Home</title>
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
<!--  =======================  PHP Function Start ======================== -->
<?php
    $cid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    $cid = htmlspecialchars($cid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);
    if ($class != "company") {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
    }

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {
        $rows = NULL;

        $sql = "select cid, cname, industry, location from company where cid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $cid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();

    }
    ?>
<!--  =======================  PHP Function End ======================== -->
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
                                    <li class = "current"><a href="#">Home</a></li>
                                    <li><a href="companyProfile.php">Profile</a></li>
                                    <li><a href="companyFollower.php">Follower</a></li>
                                    <li><a href="companyPost.php">Post</a></li>
                                    <li><a href="companyApplication.php">Application</a></li>
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
    
    <!-- ============================= Page TODO  ============================== -->
    <section class = "register-form-section">
        <div class = "register-form">
            <form action="companyUpdateP.php" method="post">
                <div class = "row clearfix">
                <div class="form-title col-md-12 col-sm-12 col-xs-12">
                            <h2>Homepage</h2>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="group-inner">
                
                    <h3><?php echo "Company id &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][0];?></h3>
                    <br>
                    <h3><?php echo "Company name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][1];?></h3>
                    <br>
                    <h3><?php echo "Industry&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][2];?></h3>
                    <br>    
                    <h3><?php echo "Headquarters Location&nbsp&nbsp".$rows[0][3];?></h3>
                    
                
                <div class="group-inner">
                </div>

                </div>
            </form>


        </div>
    </section>


    <!-- ============================== Page END  ============================== -->

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

    <!-- ============================== Script Start  ============================== 
    
<script type="text/javascript">


</script>

     ============================== Script End  ============================== -->



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