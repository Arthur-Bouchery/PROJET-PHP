<?php
	setcookie("pagePref", $_GET['pagePref'],0);
	$_COOKIE['pagePref'] = $_GET['pagePref'];
	$_GET['controller'] = 'clients';
	require_once "index.php";
?>
