<?php
	session_start();
	unset($_SESSION["name"]);
	unset($_SESSION["email"]);
	unset($_SESSION["emp_ID"]);
	header("Location: login.php");
?>