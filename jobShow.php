<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Job Show</title>
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
    $jid = $_GET["id"];
    $myid = $_COOKIE["userid"];      // Myself.
    $group = $_COOKIE["class"];

    $jid = htmlspecialchars($jid, ENT_QUOTES);
    $myid = htmlspecialchars($myid, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);
    
    $rows = NULL;
    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {
        $sql = "select j.jid as jid, 
                       j.cid as cid,
                       c.cname as cname,
                       j.location as location,
                       j.title as title,
                       j.salary as salary,
                       j.requirement as requirement,
                       j.jatime as jatime,
                       j.description as description,
                       j.expired as expired
                from joba j, company c where c.cid = j.cid and j.jid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $jid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();

        if ($group == 'student') {
            $sql = "update notification set nfstatus = 'read' where sid = ? and jid = ?";
            $query = $con->prepare($sql);
            $query->bind_param('ss', $myid, $jid);
            $query->execute();
        }

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

        <div class = "staff-list">
                 <table>
                    <tr><th><h3><?php echo "Company: ".$rows[0][2];?></h3></th></tr>
                    <tr><th><h3><?php echo "Title: ".$rows[0][4];?></h3></th></tr>
                    <tr><th><h3><?php echo "Salary: ".$rows[0][5];?></h3></th></tr>
                    <tr><th><h3><?php echo "Location:".$rows[0][3];?></h3></th></tr>
                    <tr><th><h3><?php echo "Requirement: ".$rows[0][6];?></h3></th></tr>
                    <tr><th><h3><?php echo "Post Time: ".$rows[0][7];?></h3></th></tr>
                    <tr><th><h3><?php echo "Description:".$rows[0][8];?></h3></th></tr>
                </table>
        </div>
        <div class = "register-form">
            <div class = "row clearfix">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="group-inner"> 
                        <?php 
                            if (($group == 'company')and($myid == $rows[0][1])) { 
                                if ($rows[0][9] == 1) {
                                    echo '<h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspThe job announcement is already expired.</h3>'; 

                                } else {
                                    echo '<a href = "notifyFilter.php?jid='.$rows[0][0].'"><button>Notify Filter</button></a>';
                                    echo '<a href = "expireJob.php?jid='.$rows[0][0].'"><button>Expire it</button></a>'; 
                                }

                            } else if ($group == 'student') {
                                if ($rows[0][9] == 1) {
                                    echo '<h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspThe job announcement is already expired.</h3>';
                                    $sql = "select * from application where jid = ? and sid = ?";
                                    $query = $con->prepare($sql);
                                    $query->bind_param('ss', $jid, $myid);
                                    $query->execute();
                                    $res = $query->get_result();
                                    $apps = $res->fetch_all();
                                    if (count($apps) > 0) {
                                        echo "<h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspYou have already applied this job.</h3>";
                                    }

                                } else {
                                    echo '<a href = "forwardFriend.php?jid='.$rows[0][0].'"><button>Forward</button></a>';

                                    $sql = "select * from application where jid = ? and sid = ?";
                                    $query = $con->prepare($sql);
                                    $query->bind_param('ss', $jid, $myid);
                                    $query->execute();
                                    $res = $query->get_result();
                                    $apps = $res->fetch_all();
                                    if (count($apps) > 0) {
                                        echo "<h3>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspYou have already applied this job.</h3>";
                                    } else {
                                        echo '<a href = "applyJob.php?jid='.$rows[0][0].'&cid='.$rows[0][1].'"><button>Apply</button></a>';
                                    }
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