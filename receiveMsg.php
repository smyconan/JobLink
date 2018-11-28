<?php

header('Content-type: application/json; charset=UTF-8');

$class = $_COOKIE["class"];
$class = htmlspecialchars($class, ENT_QUOTES);
if ($class != "student") {
  echo "<script type='text/javascript'>";
  echo "window.location.href='error.php?error=1';";
  echo "</script>";
}

$userid = $_COOKIE["userid"];
$fromid = $_GET["fromid"];
$userid = htmlspecialchars($userid, ENT_QUOTES);
$fromid = htmlspecialchars($fromid, ENT_QUOTES);
/*$num = $_GET["num"];*/

// TODO：从数据库里查看，是不是有新Message from fromid to userid,存在data里
$data = array();

#$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
$con = new mysqli("127.0.0.1","root","12345","Proj");
  	if (!$con) {
  		echo "Wrong Database Connection!<br>";
  	} else {
  		$sql = "select mtime, content from message where sidFrom = ? and sidTo = ? and mstatus = 'unread'";
  		$query = $con->prepare($sql);
  		$query->bind_param('ss',$fromid, $userid);
  		$query->execute();
  		$results = $query->get_result();
  		$rows = $results->fetch_all();

      $sql = "update message set mstatus = 'read' where sidFrom = ? and sidTo = ? and mtime = ?";
      foreach($rows as $row) {
        array_push($data, $row[1]);
        $query = $con->prepare($sql);
        $query->bind_param('sss',$fromid, $userid, $row[0]);
        $query->execute();
      }
  		//$i = 0;
  		//foreach($rows as $row) {
  		//	$i = $i + 1;
  		//	if ($i > $num) {
  		//		array_push($data, $row[0]);
  		//		$num = $num + 1;
  		//	}

  		//}

		// 如果没有新回答，则返回空
		if( !is_array($data) || empty($data) ) 
			exit(json_encode( array('errcode'=>1, 'errmsg'=>'error'/*, 'num'=>$num*/) ));
		// 如果有新的回答，则返回数据
		exit(json_encode( array('errcode'=>0, 'errmsg'=>'success', 'data'=>$data/*, 'num'=>$num*/) ));
	}
?>