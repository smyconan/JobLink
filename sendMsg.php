<?php
	//get from myself

	$class = $_COOKIE["class"];
	$class = htmlspecialchars($class, ENT_QUOTES);
  if ($class != "student") {
    echo "<script type='text/javascript'>";
    echo "window.location.href='error.php?error=1';";
    echo "</script>";
  }

	$userid = $_COOKIE["userid"];
	$to = $_POST["toid"];
	$msg = $_POST["msg"];

	$userid = htmlspecialchars($userid, ENT_QUOTES);
	$to = htmlspecialchars($to, ENT_QUOTES);
	$msg = htmlspecialchars($msg, ENT_QUOTES);

	//TODO：向数据库的Message表格中添加(userid, toid, msg)数据项
	#$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
	$con = new mysqli("127.0.0.1","root","12345","Proj");
  	if (!$con) {
  		echo "Wrong Database Connection!<br>";
  	} else {
  		$sql = "insert into message (sidFrom, sidTo, mstatus, content) values (?, ?, 'unread', ?)";
  		$query = $con->prepare($sql);
  		$query->bind_param('sss',$userid, $to, $msg);
  		$query->execute();
  	}
?>
