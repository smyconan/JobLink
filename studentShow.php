<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Show</title>
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
    $seeid = $_GET["id"];            // Who I look.
    $myid = $_COOKIE["userid"];      // Myself.
    $group = $_COOKIE["class"];
    
    $seeid = htmlspecialchars($seeid, ENT_QUOTES);
    $myid = htmlspecialchars($myid, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);
    
    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {

        if ($group == 'company') {
            $sql = "update application set apstatus = 'read' where sid = ? and cid = ?";
            $query = $con->prepare($sql);
            $query->bind_param('ss', $seeid, $myid);
            $query->execute();
        }

        $sql = "select * from student where sid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $seeid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();
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
                                        if ($myid != NULL) {
                                            if ($group == 'student') {
                                                echo "<li><a href='studentHome.php' target='view_window'>My Home</a></li>";
                                            } else {
                                                echo "<li><a href='companyHome.php' target='view_window'>My Home</a></li>";
                                            }
                                        }
                                    ?>
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
            <div class = "row clearfix">
                <div class="form-title col-md-12 col-sm-12 col-xs-12">
                            <h2>Profile</h2>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="group-inner">
                
                    <h3><?php echo "Realname&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][3];?></h3>
                    <br>
                    <h3><?php echo "University&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][4];?></h3>
                    <br>
                    <h3><?php echo "Major&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][5];?></h3>
                </div>
                </div>
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="group-inner">
                <?php
                    
                    $flag = 0;
                    $isFriend = 0;
                    $Requested = 0;

                    if ($group == 'student') {
                        //check if friend
                        $sql = "select * from friend where (sid1 = ? and sid2 = ?)or(sid1 = ? and sid2 = ?)";
                        $query = $con->prepare($sql);
                        $query->bind_param('ssss', $seeid, $myid, $myid, $seeid);
                        $query->execute();
                        $res = $query->get_result();
                        $ans = $res->fetch_all();
                        if (count($ans) > 0) {
                            $flag = 1;
                            $isFriend = 1;
                        } else {
                            $sql = "select * from friendrequest where sidFrom = ? and sidTo = ?";
                            $query = $con->prepare($sql);
                            $query->bind_param('ss', $seeid, $myid);
                            $query->execute();
                            $res = $query->get_result();
                            $ans = $res->fetch_all();
                            if (count($ans) > 0) {
                                $flag = 1;
                                $Requested = 1;
                            }
                        }

                    } else {
                        //check if applied.
                        $sql = "select * from application where (cid = ?)and(sid = ?)";
                        $query = $con->prepare($sql);
                        $query->bind_param('ss', $myid, $seeid);
                        $query->execute();
                        $res = $query->get_result();
                        $ans = $res->fetch_all();
                        if (count($ans) > 0) {
                            $flag = 1;
                        }

                    }
                    
                    if (($flag == 1)or($rows[0][10] == 0)) {
						echo "<h3>GPA&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][6]."</h3><br>";

						echo "<h3>Interest&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][7]."</h3><br>";
						
						echo "<h3>Qualification&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][8]."</h3><br>";
						
						echo "<h3>Resume&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$rows[0][9]."</h3><br>";
	
                    }
				?>
				</div>
                </div>
        </div>
        <div class = "register-form">
            <div class = "row clearfix">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="group-inner"> 
						<?php
							if ($group == 'student') {
								if (($isFriend == 0) and ($seeid != $myid) and ($Requested == 0)){
									   echo '<a href = "friendReq.php?toid='.$seeid.'"><button>Add Friend</button></a>';
								}
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
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