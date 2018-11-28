<?php

$cid = $_COOKIE["userid"];
$group = $_COOKIE["class"];
$cid = htmlspecialchars($cid, ENT_QUOTES);
$group = htmlspecialchars($group, ENT_QUOTES);

if ($group != 'company') {
	echo "<script type='text/javascript'>";
    echo "window.location.href='error.php?error=1';";
    echo "</script>";
}

$jid = $_POST["jid"];
$keyword = $_POST["keyword"];
if ($keyword == " ") { $keyword = ""; }

$gpamin = $_POST["gpa"];
$jid = htmlspecialchars($jid, ENT_QUOTES);
$keyword = htmlspecialchars($keyword, ENT_QUOTES);
$gpamin = htmlspecialchars($gpamin, ENT_QUOTES);

$con = new mysqli("127.0.0.1","root","12345","Proj");
    if (!$con) {
        echo "Wrong Database Connection!<br>";
    } else {
    	
    	$sql = "select sid, GPA from student where (realname like CONCAT('%',?,'%'))or
    										  (university like CONCAT('%',?,'%'))or
    										  (major like CONCAT('%',?,'%'))or
    										  (interest like CONCAT('%',?,'%'))or
    										  (qualification like CONCAT('%',?,'%'))or
    										  (resume like CONCAT('%',?,'%'))";
    	$query = $con->prepare($sql);
  		$query->bind_param('ssssss',$keyword, $keyword,$keyword, $keyword,$keyword, $keyword);
  		$query->execute();
  		$results = $query->get_result();
  		$rows = $results->fetch_all();

  		#$res = Array();

  		foreach($rows as $row) {
  			if (($gpamin == "")or($row[1] >= ((float)$gpamin))) { 
  				$sql = "insert into notification (jid, sid, cid) values (?, ?, ?)";
  				$query = $con->prepare($sql);
  				$query->bind_param('sss', $jid, $row[0], $cid);
  				$query->execute();
  			}
  		}

  		echo "<script type='text/javascript'>";
    	echo "window.location.href='companyHome.php';";
    	echo "</script>";

    }

?>