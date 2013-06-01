<?php
	if(strcmp($_POST["login"], "password") == 0) {
		header("Location: index.php");
		session_start();
		$_SESSION['set'] = 1;
	}

	else {
		header("Location: error.html");
	}
?>
