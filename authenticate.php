<?php
session_start();
function checkUser($role)
{
	$oppRole = "guest";
	if ($role == "admin") {
		$oppRole = "dealer";
	} elseif ($role == "dealer") {
		$oppRole = "admin";
	}

	if (!isset($_SESSION['role']) || $_SESSION['role'] == $oppRole) {
		header("Location: $oppRole-page.php");
		exit();
	}
	// Check if the user is authenticated as an admin
	if (!isset($_SESSION['role']) || $_SESSION['role'] != $role) {
		echo $_SESSION['role'];
		// header('Location: login.php');
		exit();
	}
}
