<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Search</title>
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
	  $userid = $_COOKIE["userid"];
    $group = $_COOKIE["class"];
    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);
	if ($userid == NULL) {
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
		<form method = "post" action="#result">
			<div class="row clearfix">
				<div class="form-title col-md-12 col-sm-12 col-xs-12"><h2>SEARCH</h2></div>
				<div class="form-group col-md-12 col-sm-12 col-xs-12"><div class="group-inner">

					<input type = "text"  name = "keyword" value = "" placeholder = "Input Keyword..." required>

					<div class="form-select" ><input type = "radio" name = "stype"   value = "company" checked>Company</div>
					<div class="form-select2"><input type = "radio" name = "stype"   value = "student" >Student</div>
					<div class="form-select2"><input type = "radio" name = "stype"   value = "job" >Job</div>

					<button type="submit">Search</button>

				</div></div>
			</div>
		</form>
	</div>
</section>

<section id="result">
<br><br><br><br>


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


<div class = 'noti-list'>
<h2>Result</h2>
<ul>
<?php
	$userid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];

    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);

	$keyword = $_POST["keyword"];
    $stype = $_POST["stype"];
    
    $keyword = htmlspecialchars($keyword, ENT_QUOTES);
    $stype = htmlspecialchars($stype, ENT_QUOTES);


    //echo $class." ".$userid." want to search ".count($words)." in ".$stype;
	//---------------------------------TODO------------------------------------

    $allwords = explode(" ",$keyword);
    $words = array();
    foreach($allwords as $word) {
        if ($word != "") {
            array_push($words, $word);
        }
    }
    $N = count($words);

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {
        if ($stype == 'student') {

          $objTable = "";

          if ($class == 'company') {  

            //echo "company search student";
            
            $sql = "create view cview".$userid."1 as select sid, realname, university, major from student";
            $query = $con->prepare($sql);
            $query->execute();

            $sql = "create view cview".$userid."2 as 
                        (select 
                            s.sid as sid,
                            s.realname as realname,
                            s.university as university,
                            s.major as major,
                            s.GPA as GPA,
                            s.interest as interest,
                            s.qualification as qualification,
                            s.resume as resume
                         from student s, application a
                         where (s.sid = a.sid and a.cid = ".$userid.")
                         )
                         union (
                            select sid, realname, university, major, GPA, interest, qualification, resume from student where private = 0
                         )
                    ";
            $con->query($sql);

            $sql = "create view studentcView".$userid." as
                        select v1.sid as sid, v1.realname as realname, v1.university as university, v1.major as major,
                               GPA, interest, qualification, resume
                        from cview".$userid."1 v1 left join cview".$userid."2 v2 on v1.sid = v2.sid
                    ";
            $query = $con->prepare($sql);
            $query->execute();
            $objTable = "studentcView".$userid;

          } else {  

            //echo "student search student";
            
            $sql = "create view sview".$userid."1 as select sid, realname, university, major from student";
            $query = $con->prepare($sql);
            $query->execute();
            
            $sql = "create view sview".$userid."2 as (select
                            s.sid as sid,
                            s.realname as realname,
                            s.university as university,
                            s.major as major,
                            s.GPA as GPA,
                            s.interest as interest,
                            s.qualification as qualification,
                            s.resume as resume
                        from student s, friend f
                        where ((f.sid1 = ".$userid.")and(f.sid2 = s.sid)) or ((f.sid2 = ".$userid.")and(f.sid1 = s.sid))
                        )
                        union (
                          select sid, realname, university, major, GPA, interest, qualification, resume from student where private = 0
                        )
                   ";
            $con->query($sql);

            $sql = "create view studentsView".$userid." as
                        select v1.sid as sid, v1.realname as realname, v1.university as university, v1.major as major,
                               GPA, interest, qualification, resume
                        from sview".$userid."1 v1 left join sview".$userid."2 v2 on v1.sid = v2.sid
                    ";
            $query = $con->prepare($sql);
            $query->execute();
            $objTable = "studentsView".$userid;
          }

          
          $res = NULL;
          for($i=0; $i<$N; $i++) {
                $sql = "select sid, realname
                        from ".$objTable."
                        where (realname like CONCAT('%',?,'%')) or (university like CONCAT('%',?,'%')) or (major like CONCAT('%',?,'%')) 
                           or (interest like CONCAT('%',?,'%')) or (qualification like CONCAT('%',?,'%')) or (resume like CONCAT('%',?,'%'))
                        ";
                $query = $con->prepare($sql);
                $query->bind_param('ssssss',$words[$i],$words[$i],$words[$i],$words[$i],$words[$i],$words[$i]);
                $query->execute();
                $results = $query->get_result();
                $rows = $results->fetch_all();
                if ($i == 0) { $res = $rows; } else {
                    $tmp = array();
                    foreach($res as $ares) {
                        if (in_array($ares, $rows)) {
                            array_push($tmp, $ares);
                        }
                    }
                    $res = $tmp;
                }
          }

          //print
          for ($i=0; $i<count($res); $i++) {
            echo "<li><a href = studentShow.php?id=".$res[$i][0].">".$res[$i][0]." ".$res[$i][1]."</a></li>";
          }

          $sql = "drop view if exists ".$objTable;   $query = $con->prepare($sql);   $query->execute();
          $sql = "drop view if exists cview".$userid."1";   $query = $con->prepare($sql);   $query->execute();
          $sql = "drop view if exists cview".$userid."2";   $query = $con->prepare($sql);   $query->execute();
          $sql = "drop view if exists sview".$userid."1";   $query = $con->prepare($sql);   $query->execute();
          $sql = "drop view if exists sview".$userid."2";   $query = $con->prepare($sql);   $query->execute();

        }
        else if ($stype == 'company') {

            // search company
            $res = NULL;
            for($i=0; $i<$N; $i++) {
                $sql = "select cid, cname from company where
                        (cname like CONCAT('%',?,'%')) or (industry like CONCAT('%',?,'%')) or (location like CONCAT('%',?,'%'))
                       ";
                $query = $con->prepare($sql);
                $query->bind_param('sss', $words[$i], $words[$i], $words[$i]);
                $query->execute();
                $results = $query->get_result();
                $rows = $results->fetch_all();

                if ($i == 0) { $res = $rows; } else {
                    $tmp = array();
                    foreach($res as $ares) {
                        if (in_array($ares, $rows)) {
                            array_push($tmp, $ares);
                        }
                    }
                    $res = $tmp;
                }
            }

            for ($i=0; $i<count($res); $i++) {
                echo "<li><a href = companyShow.php?cid=".$res[$i][0].">".$res[$i][0]." ".$res[$i][1]."</a></li>";
            }


        } else {

            //TODO - search job
            $res = NULL;
            for($i=0; $i<$N; $i++) {

                $sql = "create view jobcomp".$group.$userid." as
                        select j.jid as jid, j.cid as cid, c.cname as cname, j.title as title, 
                               j.salary as salary, j.location as location, j.requirement as requirement,
                               j.description as description, j.expired as expired
                        from joba j, company c
                        where j.cid = c.cid";
                $con->query($sql);

                $sql = "select jid, cname, title from jobcomp".$group.$userid." where 
                        ((cname like CONCAT('%',?,'%')) or (location like CONCAT('%',?,'%')) or (title like CONCAT('%',?,'%')) or (salary like CONCAT('%',?,'%')) 
                        or (requirement like CONCAT('%',?,'%')) or (description like CONCAT('%',?,'%'))) and (expired = 0)
                       ";
                $query = $con->prepare($sql);
                $query->bind_param('ssssss', $words[$i], $words[$i], $words[$i], $words[$i], $words[$i], $words[$i]);
                $query->execute();
                $results = $query->get_result();
                $rows = $results->fetch_all();

                if ($i == 0) { $res = $rows; } else {
                    $tmp = array();
                    foreach($res as $ares) {
                        if (in_array($ares, $rows)) {
                            array_push($tmp, $ares);
                        }
                    }
                    $res = $tmp;
                }
            }

            for ($i=0; $i<count($res); $i++) {
                echo "<li><a href = jobShow.php?id=".$res[$i][0].">".$res[$i][0]." ".$res[$i][1]." ".$res[$i][2]."</a></li>";
            }

            $sql = "drop view if exists jobcomp".$group.$userid;   $query = $con->prepare($sql);   $query->execute();

        }
    }
    
	//----------------------------------END-------------------------------------
?>
</ul>
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
