<?php
	$username = $_POST["username"];
	$password = $_POST["password"];
	$group = $_POST["group"];

	$username = htmlspecialchars($username, ENT_QUOTES);
	$password = htmlspecialchars($password, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);

    #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
	$con = new mysqli("127.0.0.1","root","12345","Proj");
  	if (!$con) {
  		echo "Wrong Database Connection!<br>";
  	} else {
  		if ($group == "student") {
  			$sql = "select sid from student where username = ? and spwd = ?";
  			$query = $con->prepare($sql);
  			$query->bind_param('ss',$username, $password);
  			$query->execute();
  			$results = $query->get_result();
  			$rows = $results->fetch_all();
  			if (count($rows) == 0) {
  				echo "<script type='text/javascript'>";
				  echo "window.location.href='error.php?error=0';";
				  echo "</script>";
  			} else {
  				$userid = $rows[0][0];
  				setcookie("userid", $userid, time()+3600, "/");
				  setcookie("class", $group, time()+3600, "/");
				  echo "<script type='text/javascript'>";
				  echo "window.location.href='studentHome.php';";
				  echo "</script>";
  			}
  		} else {
  			//TODO Company Login

  			$sql = "select cid from company where cname = ? and cpwd = ?";
  			$query = $con->prepare($sql);
  			$query->bind_param('ss',$username, $password);
  			$query->execute();
  			$results = $query->get_result();
  			$rows = $results->fetch_all();
  			if (count($rows) == 0) {
  				echo "<script type='text/javascript'>";
				  echo "window.location.href='error.php?error=0';";
				  echo "</script>";
  			} else {
  				$userid = $rows[0][0];
  				setcookie("userid", $userid, time()+3600, "/");
				  setcookie("class", $group, time()+3600, "/");
				  echo "<script type='text/javascript'>";
				  echo "window.location.href='companyHome.php';";
				  echo "</script>";
  			}

  		}
  		
  	}	


  	/*
	if (($username == "validUser")and($password == "validPwd")and($group == "student")) {

		setcookie("userid", 1, time()+3600, "/");
		setcookie("class", $group, time()+3600, "/");
		echo "<script type='text/javascript'>";
		echo "window.location.href='studentHome.php';";
		echo "</script>";

	} else {
		echo "<script type='text/javascript'>";
		echo "window.location.href='error.php?error=0';";
		echo "</script>";
	}
	*/
?>