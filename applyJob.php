<?php

    $class = $_COOKIE["class"];
    $class = htmlspecialchars($class, ENT_QUOTES);
	if ($class != 'student') {
		echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
	}

	$sid = $_COOKIE["userid"];
	$jid = $_GET["jid"];
    $cid = $_GET["cid"];
    
    $sid = htmlspecialchars($sid, ENT_QUOTES);
    $jid = htmlspecialchars($jid, ENT_QUOTES);
    $cid = htmlspecialchars($cid, ENT_QUOTES);

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {

    	$sql = "insert into application (jid, sid, cid) values (?, ?, ?)";
    	$query = $con->prepare($sql);
        $query->bind_param('sss', $jid, $sid, $cid);
        $query->execute();

        echo "<script type='text/javascript'>";
        echo "window.location.href='jobShow.php?id=".$jid."';";
        echo "</script>";
    }
?>