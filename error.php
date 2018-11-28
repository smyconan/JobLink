<?php
	$error = $_GET["error"];
	$error = htmlspecialchars($error, ENT_QUOTES);
	if ($error == 0) { echo "Wrong login username, password or account type!!!"; }
	else if ($error == 1) { echo "Wrong status to load that page!!!"; }
	else if ($error == 2) { echo "You can not talk to that person!!!"; }
	else if ($error == 3) { echo "Wrong password validation!!!"; }
	else if ($error == 4) { echo "Username has been registered!!!"; }
	echo "<br><a href = 'index.php' ><button>Back to index</button></a>";
?>