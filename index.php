<?php
	session_start();

	if(!isset($_SESSION['set'])) {
		echo("The session has not been set.<br>");
		header("Location: error.html");
	}
	else {
		echo("The session has started<br>");
	}
?>

Hello there
