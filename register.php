<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
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
                                    <li><a href="index.php">Welcome</a></li>
                                    <!--<li><a href="login.php">Login</a></li>!-->
                                    <li class="current"><a href="register.php">Register</a></li>
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
            <form method="post" action="registering.php" id="register-form">
                <div class="row clearfix">
                    <!--Title-->
                    <div class="form-title col-md-12 col-sm-12 col-xs-12">
                            <h2>Register</h2>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="group-inner">
                                <input type="text" name="username" value="" placeholder="Your Username..." required>
                                <input type="password" name="password" value="" placeholder="Your Password..." required>
                                <input type="password" name="validation_pwd" value="" placeholder="Retype Your Password..." required>
                                <div class="form-select">
                                    <input type="radio" name="group" value="company">Company
                                </div>
                                <div class="form-select2">
                                    <input type="radio" name="group" value="student" checked>Student
                                </div>
                                <button type="submit">SUBMIT </button>
                            </div>
                    </div>

                </div>
            <form>
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
