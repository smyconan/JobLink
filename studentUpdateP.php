<?php
	$realname = $_POST["realname"];
	$university = $_POST["university"];
	$major = $_POST["major"];
	$gpa = $_POST["gpa"];
	$interest = $_POST["interest"];
	$qua = $_POST["qua"];
	$private = $_POST["private"];

	$realname = htmlspecialchars($realname, ENT_QUOTES);
	$university = htmlspecialchars($university, ENT_QUOTES);
	$major = htmlspecialchars($major, ENT_QUOTES);
	$gpa = htmlspecialchars($gpa, ENT_QUOTES);
	$interest = htmlspecialchars($interest, ENT_QUOTES);
	$qua = htmlspecialchars($qua, ENT_QUOTES);
	$private = htmlspecialchars($private, ENT_QUOTES);


	$userid = $_COOKIE['userid'];
	$class = $_COOKIE['class'];

	$userid = htmlspecialchars($userid, ENT_QUOTES);
    $class = htmlspecialchars($class, ENT_QUOTES);

	if ($class != 'student') {
        echo "<script type='text/javascript'>";
        echo "window.location.href='error.php?error=1';";
        echo "</script>";
	} 
	
	#$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
	$con = new mysqli("127.0.0.1","root","12345","Proj");
	if (!$con) {
		echo "Wrong Database Connnection!<br>";
	} else {

		$sql = 'update student set realname = ?, university = ?, major = ?, gpa = ?, interest = ?, qualification = ?, private = ? where sid = ?';
		$query = $con->prepare($sql);
		$query->bind_param('ssssssss', $realname, $university, $major, $gpa, $interest, $qua, $private, $userid);
		$query->execute();

		echo "<h3>Update Successfully!</h3>";
		echo "<br><a href = 'studentHome.php'><button>Back to Home</button></a>";
	}
