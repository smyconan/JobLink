<?php

	$toid = $_GET['toid'];
	$myid = $_COOKIE["userid"];
    $class = $_COOKIE["class"];
    
    $toid = htmlspecialchars($toid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);
    $myid = htmlspecialchars($myid, ENT_QUOTES);

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
		
    	$sql = "insert into `friendrequest` (`sidFrom`, `sidTo`) values (?, ?)";
    	$query = $con->prepare($sql);
        $query->bind_param('ss',$myid, $toid);
        $query->execute();


        echo "<h3>Request Sent!</h3>";
        
		echo "<br><a href = 'studentShow.php?id=".$toid."'><button>Back</button></a>";
    }
?>