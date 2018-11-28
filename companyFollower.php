<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Company Follower</title>
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
        $num = 0;
        $rows = NULL;
        
        $sql = "select s.sid as sid, s.realname as realname from company c, follow f, student s where f.cid = c.cid and f.sid = s.sid and c.cid = ? order by realname";
        $query = $con->prepare($sql);
        $query->bind_param('s', $cid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();
        $num = count($rows);


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
                                    <li class = "current"><a href="#">Follower</a></li>
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
    <section>
        <br><br><br><br><br>
        <div class = "staff-list">
            <table>
                <tr>
                <th>
                <?php
                    $totalrow = 0;
                    for($i = 0; $i<$num; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$rows[$i][0].'"target="view_window"><img src="images/head.png" /></a>';
                        echo "<h3>".$rows[$i][1]. "</h3>";
                        echo "</li>";

                        $totalrow = $totalrow + 1;
                    }
                ?>
                </th>
                
                <th>
                <?php
                    $whichrow = 0;
                    for($i = 1; $i<$num; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$rows[$i][0].'"target="view_window"><img src="images/head.png" /></a>';
                        echo "<h3>".$rows[$i][1]. "</h3>";
                        echo "</li>";

                        $whichrow = $whichrow + 1;
                    }
                    if ($whichrow < $totalrow) {
                        echo "<li><img src='images/blank.png' /></li>";
                    }
                ?>
                </th>
                
                <th>
                <?php
                    $whichrow = 0;
                    for($i = 2; $i<$num; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$rows[$i][0].'"target="view_window"><img src="images/head.png" /></a>';
                        echo "<h3>".$rows[$i][1]. "</h3>";
                        echo "</li>";

                        $whichrow = $whichrow + 1;
                    }
                    if ($whichrow < $totalrow) {
                        echo "<li><img src='images/blank.png' /></li>";
                    }
                ?>
                </th>
                
                </tr>
            </table>
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
    /*
    var obj = $('#talk');
    obj.click(function(){
        window.open("http://www.google.com");
    });
    */
    function talkFunction(talkto) {
        window.open("talk.php?toid="+talkto);
    }

    /*
    var obj2 = $('#agree');
    obj2.click(function(){
        //TODO
        obj2.attr('disabled',true);
    })
    */
    function accFunction(accto, i) {
        var obj1 = $("#acc"+i);
        var obj2 = $("#rej"+i);
        obj1.attr('disabled',true);
        obj2.attr('disabled',true);
        //TODO
        jQuery.noConflict();
        jQuery("div p").hide();
        jQuery.ajax({
            url: 'accFriend.php',
            method: 'post',
            data: {fid:accto}
        }).done(function(res){});
    }

    function rejFunction(rejto, i) {
        var obj1 = $("#acc"+i);
        var obj2 = $("#rej"+i);
        obj1.attr('disabled',true);
        obj2.attr('disabled',true);
        //TODO
        jQuery.noConflict();
        jQuery("div p").hide();
        jQuery.ajax({
            url: 'rejFriend.php',
            method: 'post',
            data: {fid:rejto}
        }).done(function(res){});
    }

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