<?php
	$toid = $_GET["id"];
	$jid = $_GET['jid'];
    $myid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    
	$toid = htmlspecialchars($toid, ENT_QUOTES);
	$jid = htmlspecialchars($jid, ENT_QUOTES);
    $myid = htmlspecialchars($myid, ENT_QUOTES);
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
		$sql = "select cid from joba where jid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $jid);
        $query->execute();
        $res = $query->get_result();
        $rows = $res->fetch_all();

		$sql = "insert into `notification` (`jid`, `sid`, `cid`) values (?, ?, ?)";
        $query = $con->prepare($sql);
        $query->bind_param('sss', $jid, $toid, $rows[0][0]);
		$query->execute();
		
		
        echo "<h3>Forward Successfully!</h3>";
        echo '<br><a href = "forwardFriend.php?jid='.$jid.'"><button>Back to Friends</button></a>';
    
    }



?>