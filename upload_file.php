<?php

//echo $_FILES["file"]["type"];

if ($_FILES["file"]["type"] == "text/plain") {
  if ($_FILES["file"]["error"] > 0){
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  }
  else{
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";

    #echo $_FILES["file"]["name"];
    #echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";//need to cover old file
      }
    else
      {
      $str = "upload/".$_COOKIE["userid"].$_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"], $str);
      $myfile = fopen($str, "r");

      $res = "";
      while(!feof($myfile)){
        $res = $res.fgets($myfile)."<br>";
      }

      $con = new mysqli("127.0.0.1","root","12345","Proj");
      if (!$con) {
        echo "Wrong Database Connection!<br>";
      } else {
        $sid = $_COOKIE["userid"];
        $sql = "update student set resume = ? where sid = ?";
        $query = $con->prepare($sql);
        $query->bind_param('ss',$res, $sid);
        $query->execute();
      }

      fclose($myfile);

      echo "Stored in: " .$str;

      }
  }
}
else{
      echo "Invalid file";
}

  echo "<br><a href = 'studentHome.php'><button>Back to Home</button></a>";

?>