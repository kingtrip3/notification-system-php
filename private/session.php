<?php

session_start();

function logged_in() {
	if (isset($_SESSION["logged_in"])) {
		return $_SESSION["logged_in"];
	} else {
		return false;
	}
}

function get_username() {
	return $_SESSION['username'];
}

function check_login() {
	if (!isset($_SESSION["logged_in"])) {
		header("Location: login.php?error=You need to login first");
	}	
}

function log_in($username) {
	$_SESSION["logged_in"] = true;
	$_SESSION["username"] = $username;
	header("Location: dashboard.php");
}

function log_out() {
	session_unset();
	session_destroy();
	header("Location: index.php");
}

?>
