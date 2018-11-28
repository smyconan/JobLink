<?php

	$username = $_POST["username"];
	$pwd1 = $_POST["password"];
	$pwd2 = $_POST["validation_pwd"];
	$group = $_POST["group"];

	$username = htmlspecialchars($username, ENT_QUOTES);
	$pwd1 = htmlspecialchars($pwd1, ENT_QUOTES);
	$pwd2 = htmlspecialchars($pwd2, ENT_QUOTES);
    $group = htmlspecialchars($group, ENT_QUOTES);

	if ($pwd1 != $pwd2) { 
		echo "<script type='text/javascript'>";
		echo "window.location.href='error.php?error=3';";
		echo "</script>";

	} else {
		#$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
		$con = new mysqli("127.0.0.1","root","12345","Proj");
  		if (!$con) {
  			echo "Wrong Database Connection!<br>";
  		} else {

  			if ($group == "student") {

  				$sql = "select * from student where username = ?";
  				$query = $con->prepare($sql);
  				$query->bind_param('s',$username);
  				$query->execute();
  				$results = $query->get_result();
  				$rows = $results->fetch_all();

  				if (count($rows) != 0) {

  					echo "<script type='text/javascript'>";
					  echo "window.location.href='error.php?error=4';";
					  echo "</script>";

  				} else {

  					$sql = "insert into student (username, spwd) values (?, ?)";
  					$query = $con->prepare($sql);
  					$query->bind_param('ss',$username, $pwd1);
  					$query->execute();

  					echo "<script type='text/javascript'>";
					  echo "window.location.href='index.php';";
					  echo "</script>";

  				}

  			} else {


  				$sql = "select * from company where cname = ?";
  				$query = $con->prepare($sql);
  				$query->bind_param('s',$username);
  				$query->execute();
  				$results = $query->get_result();
  				$rows = $results->fetch_all();
  				
  				if (count($rows) != 0) {

  					echo "<script type='text/javascript'>";
					  echo "window.location.href='error.php?error=4';";
					  echo "</script>";

  				} else {

  					$sql = "insert into company (cname, cpwd) values (?, ?)";
  					$query = $con->prepare($sql);
  					$query->bind_param('ss',$username, $pwd1);
  					$query->execute();

  					echo "<script type='text/javascript'>";
					  echo "window.location.href='index.php';";
					  echo "</script>";

  				}

  			}

  		}

	}

?>