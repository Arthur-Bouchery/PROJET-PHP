<?php
	setcookie("pagePref", $_GET['pagePref'],0);
	$_COOKIE['pagePref'] = $_GET['pagePref'];
	require_once "index.php";
?>
