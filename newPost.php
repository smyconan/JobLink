<?php
    $location = $_POST["location"];
    $title = $_POST["title"];
	$salary = $_POST["salary"];
	$requirement = $_POST['requirement'];
	$description = $_POST['description'];

    $location = htmlspecialchars($location, ENT_QUOTES);
    $title = htmlspecialchars($title, ENT_QUOTES);
	$salary = htmlspecialchars($salary, ENT_QUOTES);
	$requirement = htmlspecialchars($requirement, ENT_QUOTES);
	$description = htmlspecialchars($description, ENT_QUOTES);

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

    	$sql = "insert into `joba` (`cid`, `location`, `title`, `salary`, `requirement`, `description`) values (?, ?, ?, ?, ?, ?)";
    	$query = $con->prepare($sql);
        $query->bind_param('ssssss',$cid, $location, $title, $salary, $requirement, $description);
        $query->execute();

        $sql = "select max(jid) from joba where cid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s', $cid);
        $query->execute();
        $results = $query->get_result();
        $rows = $results->fetch_all();

        $jid = $rows[0][0];

        $sql = "select sid from follow where cid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('s',$cid);
        $query->execute();
        $results = $query->get_result();
        $rows = $results->fetch_all();

        foreach($rows as $row){
            $sid = $row[0];
            $sql = "insert into notification (jid, sid, cid) values (?, ?, ?)";
            $query = $con->prepare($sql);
            $query->bind_param('sss', $jid, $sid, $cid);
            $query->execute();
        }

        echo "<h3>Post Successfully!</h3>";
        #echo $jid." ".$sid." ".$cid;
        
		echo "<br><a href = 'companyPost.php'><button>Back to Post</button></a>";
    }
?>