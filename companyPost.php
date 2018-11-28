<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Company Post</title>
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
    $userid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];

    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);

    if ($class != "company") {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
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
                                <li><a href="companyHome.php">Home</a></li>
                                    <li><a href="companyProfile.php">Profile</a></li>
                                    <li><a href="companyFollower.php">Follower</a></li>
                                    <li class = "current"><a href="#">Post</a></li>
                                    <li><a href="companyApplication.php">Application</a></li>
                                    <li><a href="search.php" target="view_window">Search</a></li>
                                    <li><a href="logouting.php">Logout</a></li>
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
    <section>
        <br><br><br><br><br>

        <style>               
.noti-list {   
   margin-left:200px;
   width: 1000px;   
 }   
             
 .noti-list h2 {   
   font: 400 40px/1.5 Helvetica, Verdana, sans-serif;   
   margin: 0;   
   padding: 0;   
 }   
             
 .noti-list ul {   
   list-style-type: none;   
   margin: 0;   
   padding: 0;   
 }   
             
 .noti-list li {   
   font: 200 20px/1.5 Helvetica, Verdana, sans-serif;   
   border-bottom: 1px solid #ccc;   
 }   
             
 .noti-list li:last-child {   
   border: none;   
 }   
             
 .noti-list li a {   
   text-decoration: none;   
   color: #000;   
   display: block;   
   width: 1000px;   
             
   -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;   
   -moz-transition: font-size 0.3s ease, background-color 0.3s ease;   
   -o-transition: font-size 0.3s ease, background-color 0.3s ease;   
   -ms-transition: font-size 0.3s ease, background-color 0.3s ease;   
   transition: font-size 0.3s ease, background-color 0.3s ease;   
 }   
             
 .noti-list li a:hover {   
   font-size: 30px;   
   background: #f6f6f6;   
 } 
        </style>

        <div class = "noti-list">
            <h2>Posts</h2>   
            <ul>  
                <?php
                    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
                    $con = new mysqli("127.0.0.1","root","12345","Proj");
                    if (!$con) {
                        echo "Wrong Database Connection!<br>";
                    } else {
                        $sql = "select jid, cid, location, title, salary, jatime, expired from joba where cid = ?";
                        $query = $con->prepare($sql);
                        $query->bind_param('s',$userid);
                        $query->execute();
                        $results = $query->get_result();
                        $rows = $results->fetch_all();
                        
                        foreach ($rows as $row) {
                            if ($row[6] == 0) {
                                echo "<li><a href='jobShow.php?id=".$row[0]."'>
                                        <b>".$row[2]." ".$row[3]."<br>Salary: ".$row[4]."</b><br>".$row[5]."</a></li>";
                            }
                            else {
                                echo "<li><a href='jobShow.php?id=".$row[0]."'>
                                        ".$row[2]." ".$row[3]."<br>Salary: ".$row[4]."<br>".$row[5]."</a></li>";
                            }
                        }
                        
                    }
                ?> 
                

            </ul>   
        </div>

    </section>
    <section class = "register-form-section">
        <div class = "register-form">
            <form action="newPost.php" method="post">
                <div class = "row clearfix">
                <div class="form-title col-md-12 col-sm-12 col-xs-12">
                            <h2>Post a New Job</h2>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="group-inner">
                
                    <div class = "profile"><font size=5>Location&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='location'>"; ?></div>
                    
                    <div class = "profile"><font size=5>Title&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='title'>"; ?></div>

                    <div class = "profile"><font size=5>Salary&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='salary'>"; ?></div>

                    <div class = "profile"><font size=5>Requirement&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='requirement'>"; ?></div>

                    <div class = "profile"><font size=5>Description&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font><?php echo "<input type='text' name='description''>"; ?></div>
                    
                    <br><br>
                    <button type="submit">+New</button>
                
                <div class="group-inner">
                </div>

                </div>
            </form>

            <!-- <br><h3><a href = 'newPost.php'><button>+New</button></a></h3> -->

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