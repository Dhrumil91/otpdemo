<?php
	session_start();
	session_destroy();
	unset($_SESSION['MOBILE']);
	unset($_SESSION['NAME']);
	header("Location:login.php");
?>