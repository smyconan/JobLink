<?php
    $cname = $_POST["cname"];
    $industry = $_POST["industry"];
    $location = $_POST["location"];

    $cname = htmlspecialchars($cname, ENT_QUOTES);
    $industry = htmlspecialchars($industry, ENT_QUOTES);
    $location = htmlspecialchars($location, ENT_QUOTES);

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

    	$sql = "update company set cname = ?, industry = ?, location = ? where cid = ?";
    	$query = $con->prepare($sql);
        $query->bind_param('ssss',$cname, $industry, $location, $cid);
        $query->execute();


        echo "<h3>Update Successfully!</h3>";
        
		echo "<br><a href = 'companyHome.php'><button>Back to Home</button></a>";
    }
?>