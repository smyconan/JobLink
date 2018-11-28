<?php

    $class = $_COOKIE["class"];
    $class = htmlspecialchars($class, ENT_QUOTES);
	if ($class != 'company') {
		echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
	}

	$cid = $_COOKIE["userid"];
    $jid = $_GET["jid"];
    $cid = htmlspecialchars($cid, ENT_QUOTES);
    $jid = htmlspecialchars($jid, ENT_QUOTES);

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {

    	$sql = "select * from joba where jid = ? and cid = ?";
    	$query = $con->prepare($sql);
        $query->bind_param('ss', $jid, $cid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();

        if (count($rows) == 0) {
        	echo "<script type='text/javascript'>";
        	echo "window.location.href='error.php?error=1';";
        	echo "</script>";
        }

        $sql = "update joba set expired = 1 where jid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $jid);
        $query->execute();

        echo "<script type='text/javascript'>";
        echo "window.location.href='jobShow.php?id=".$jid."';";
        echo "</script>";
    }


 ?>