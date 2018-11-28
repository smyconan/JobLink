<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Notify My Job</title>
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

    error_reporting(E_ALL&~E_NOTICE);
	$cid = $_COOKIE["userid"];
    $group = $_COOKIE["class"];
    $jid = $_GET["jid"];
    $cid = htmlspecialchars($cid, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);

	if ($group != 'company') {
		echo "<script type='text/javascript'>";
		echo "window.location.href='error.php?error=1'";
		echo "</script>";
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
                                    <?php 
                                        if ($group == 'student')  { echo '<li><a href="studentHome.php" target="view_window">My Account</a></li>'; }
                                        else { echo '<li><a href="companyHome.php" target="view_window">My Account</a></li>'; }
                                    ?>
                                    <!-- <li><a href="studentHome.php" target="view_window">My Account</a></li> -->

                                 </ul>
                            </div>
                        </nav><!-- Main Menu End-->
                        
                    </div><!--Nav Outer End-->
                    
                    <!-- Hidden Nav Toggler -->
                    <div class="nav-toggler">
                    <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                    </div><!-- / Hidden Nav Toggler -->
                    
            	</div>    
            </div>
        </div>
    
    </header>


<section class = "register-form-section">
	<div class = "register-form">	
		<form method = "post" action="notifying.php">
			<div class="row clearfix">
				<div class="form-title col-md-12 col-sm-12 col-xs-12"><h2>NOTIFY FILTER</h2></div>
				<div class="form-group col-md-12 col-sm-12 col-xs-12"><div class="group-inner">
					<!--
					<input type = "text"  name = "keyword" value = "" placeholder = "Input Keyword..." required>

					<div class="form-select" ><input type = "radio" name = "stype"   value = "company" checked>Company</div>
					<div class="form-select2"><input type = "radio" name = "stype"   value = "student" >Student</div>
					<div class="form-select2"><input type = "radio" name = "stype"   value = "job" >Job</div>

					<button type="submit">Search</button>-->

					<?php echo "<input type = 'hidden' name = 'jid' value = ".$jid.">"; ?>

					<div class = "profile"><input type = "text"  name = "keyword" value = "" placeholder = "Input Keyword..."></div>
                    
                    <div class = "profile"><input type = "text"  name = "gpa" value = "" placeholder = "GPA > ?"></div>

                    <button type = "submit">Notify!</button>


				</div></div>
			</div>
		</form>
	</div>
</section>


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

<script src="js/jquery.js"></script>
<script src="js/revolution.min.js"></script> 
<script src="js/pagenav.js"></script>
<script src="js/script.js"></script>

</body>
</html>
