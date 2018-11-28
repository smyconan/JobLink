<?php
	setcookie("userid", NULL, time()-100, "/");
	setcookie("class", NULL, time()-100, "/");
	echo "<script type='text/javascript'>";
	echo "window.location.href='index.php';";
	echo "</script>";
?>
