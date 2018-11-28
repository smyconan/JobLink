<?php
	$fid = $_POST["fid"];
	$userid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    
    $fid = htmlspecialchars($fid, ENT_QUOTES);
    $userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);

    if ($class != "student") {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
    }

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
    $con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {

    	$sql = "update friendRequest set frstatus = 'accpeted' where sidFrom = ? and sidTo = ?";
    	$query = $con->prepare($sql);
        $query->bind_param('ss',$fid, $userid);
        $query->execute();

        $sql = "insert into friend (sid1, sid2) values (?, ?)";
        $query = $con->prepare($sql);
        $query->bind_param('ss',$userid, $fid);
        $query->execute();
    }
?>