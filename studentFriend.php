<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Student Friend</title>
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
<script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

<?php
    $userid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);
    if ($class != "student") {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
    }

    $N = 0;
    $rows = NULL;
    $fmsg = NULL;

    $RN = 0;
    $Rrows = NULL;
    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {

        $sql = "select s.sid as sid, s.realname as realname from friend f, student s where (f.sid1 = ? and f.sid2 = s.sid) or (f.sid2 = ? and f.sid1 = s.sid)";
        $query = $con->prepare($sql);
        $query->bind_param('ss',$userid, $userid);
        $query->execute();
        $results = $query->get_result();
        $rows = $results->fetch_all();
        $N = count($rows);

        $sql = "select sidFrom from message where sidTo = ? and mstatus = 'unread'";
        $query = $con->prepare($sql);
        $query->bind_param('s',$userid);
        $query->execute();
        $results = $query->get_result();
        $fmsgs = $results->fetch_all();
        for($i=0; $i<count($fmsgs); $i++) {
            $fmsgs[$i] = $fmsgs[$i][0];
        }

        $sql = "select fr.sidFrom, s.realname, fr.frstatus 
                from friendRequest fr, student s 
                where fr.sidTo = ? and fr.sidFrom = s.sid and (fr.frstatus = 'read' or fr.frstatus = 'unread')";
        $query = $con->prepare($sql);
        $query->bind_param('s',$userid);
        $query->execute();
        $results = $query->get_result();
        $Rrows = $results->fetch_all();
        $RN = count($Rrows);

        
        $sql = "update friendRequest set frstatus = 'read' where sidTo = ? and frstatus = 'unread'";
        $query = $con->prepare($sql);
        $query->bind_param('s',$userid);
        $query->execute();
        

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
                                    <li><a href="studentProfile.php">Profile</a></li>
                                    <li class = "current"><a href="#">Friend</a></li>
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
    <section>
        <br><br><br><br><br>
        <div class = "staff-list"> 
            <table><tr>

            <th><ul>
            <?php
                $maxlen = 0; 
                for($i = 0; $i<$N; $i = $i + 3) {
                   echo "<li>";
                   echo '<a href = "studentshow.php?id='.$rows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                   echo "<h3>".$rows[$i][1]."</h3>";
                   if (in_array($rows[$i][0], $fmsgs)) { echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk(NEW MSG)</button>'; }
                   else {  echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk</button>';  }
                   echo "</li>";
                   $maxlen = $maxlen + 1;
                }
            ?>
            </ul></th>

            <th><ul>
            <?php 
                $len = 0;
                for($i = 1; $i<$N; $i = $i + 3) {
                   echo "<li>";
                   echo '<a href = "studentshow.php?id='.$rows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                   echo "<h3>".$rows[$i][1]."</h3>";
                   if (in_array($rows[$i][0], $fmsgs)) { echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk(NEW MSG)</button>'; }
                   else {  echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk</button>';  }
                   echo "</li>";
                   $len = $len + 1;
                }
                if ($len < $maxlen) {
                    echo "<li><img src = 'images/blank.png' /></li>";
                }
            ?>
            </ul></th>

            <th><ul>
            <?php 
                $len = 0;
                for($i = 2; $i<$N; $i = $i + 3) {
                   echo "<li>";
                   echo '<a href = "studentshow.php?id='.$rows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                   echo "<h3>".$rows[$i][1]."</h3>";
                   if (in_array($rows[$i][0], $fmsgs)) { echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk(NEW MSG)</button>'; }
                   else {  echo '<button onClick = "talkFunction('.$rows[$i][0].')">talk</button>';  }
                   echo "</li>";
                   $len = $len + 1;
                }
                if ($len < $maxlen) {
                    echo "<li><img src = 'images/blank.png' /></li>";
                }
            ?>
            </ul></th>
            <!--
            <th><ul>  
                <li>  
                    <a href = "studentshow.php?id=XXX" target="view_window"><img src="images/head.png" /></a>
                    <h3>Headline</h3>  
                    <button id = "talk">talk</button>
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
            </ul></th>

            <th><ul>  
                <li>  
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>   
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
            </ul></th>

            <th><ul>  
                <li>  
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>   
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
            </ul></th>
            -->
            </tr>
            </table>  
        </div> 
    </section>

    <section>
         <br><br><br><br><br>
        <div class = "staff-list"> 
            <table> 
            <tr>

            <th><ul> 

                <?php
                    $maxlen = 0;  
                    for($i = 0; $i<$RN; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$Rrows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                        if ($Rrows[$i][2] == 'unread') {
                            echo "<h3>".$Rrows[$i][1]."(NEW)</h3>";
                        } else {
                            echo "<h3>".$Rrows[$i][1]."</h3>";
                        }
                        echo '<button id = "acc'.$i.'" onClick = "accFunction('.$Rrows[$i][0].','.$i.')">Accept</button><br>';
                        echo '<button id = "rej'.$i.'" onClick = "rejFunction('.$Rrows[$i][0].','.$i.')">Reject</button>';
                        
                        echo "</li>";
                        $maxlen = $maxlen + 1;
                    }

                ?>

                <?php 
                    $len = 0;
                    for($i = 1; $i<$RN; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$Rrows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                        if ($Rrows[$i][2] == 'unread') {
                            echo "<h3>".$Rrows[$i][1]."(NEW)</h3>";
                        } else {
                            echo "<h3>".$Rrows[$i][1]."</h3>";
                        }
                        echo '<button id = "acc'.$i.'" onClick = "accFunction('.$Rrows[$i][0].','.$i.')">Accept</button><br>';
                        echo '<button id = "rej'.$i.'" onClick = "rejFunction('.$Rrows[$i][0].','.$i.')">Reject</button>';

                        echo "</li>";
                        $len = $len + 1;
                    }
                    if ($len < $maxlen) {
                        echo "<li><img src = 'images/blank.png' /></li>";
                    }
                ?>

                <?php 
                    $len = 0;
                    for($i = 2; $i<$RN; $i = $i + 3) {
                        echo "<li>";
                        echo '<a href = "studentshow.php?id='.$Rrows[$i][0].'" target="view_window"><img src="images/head.png" /></a>';
                        if ($Rrows[$i][2] == 'unread') {
                            echo "<h3>".$Rrows[$i][1]."(NEW)</h3>";
                        } else {
                            echo "<h3>".$Rrows[$i][1]."</h3>";
                        }
                        echo '<button id = "acc'.$i.'" onClick = "accFunction('.$Rrows[$i][0].','.$i.')">Accept</button><br>';
                        echo '<button id = "rej'.$i.'" onClick = "rejFunction('.$Rrows[$i][0].','.$i.')">Reject</button>';

                        echo "</li>";
                        $len = $len + 1;
                    }
                    if ($len < $maxlen) {
                        echo "<li><img src = 'images/blank.png' /></li>";
                    }
                ?>
                <!--
                <li>  
                    <a href = "studentshow.php?id=XXX" target="view_window"><img src="images/head.png" /></a>
                    <h3>Headline</h3>  
                    <button id = "agree">agree</button>
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li>  
                <li>   
                    <img src="images/head.png" />  
                    <h3>Headline</h3>  
                    <p>Lorem ipsum dolor sit amet...</p>  
                </li> 
                --> 
            </ul></th>
            </tr>
            </table>  
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