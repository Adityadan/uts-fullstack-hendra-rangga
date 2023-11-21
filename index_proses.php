<?php
// login proses
require_once("class/user.php");
session_start();
if (isset($_POST['login'])) {
	$users = new Users();
	$userid = $_POST['userid'];
	$pwd = $_POST['password'];
	$users = new Users();
	//$_SESSION["username"]=$users;
	$hasil = $users->doLogin($userid, $pwd);
	if ($hasil == 'sukses') {
		header("location: home.php");
	} else {
		header("location: index.php?error=login");
	}
} else {
	header("location: index.php");
}

// session_start();
// $_SESSION["userid"] = $_POST["userid"];
