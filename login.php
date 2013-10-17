<?php
require('src/global.php');
if(!LOGIN || (isset($_SESSION['online']) && $_SESSION['online'])){
	header("Location: ./list.php");
	exit;
}

if(!isset($_POST['user']) || !isset($_POST['password']) || !isset($_POST['login'])){
	throw new Exception("Please use the login form!");
}

$userName = trim($_POST['user']);
$userPassword = $_POST['password'];

$userFile = fopen('private/users', 'r');
while($line = fread($userFile, 1000)){
	if(strncmp($line . ':', $userName . ':', strlen($userName) + 1) == 0){
		//User found!
		$origpwd = substr($line, strlen($userName) + 1);
		if($origpwd == sha1($userPassword)){
			$_SESSION['online'] = true;
			$_SESSION['whoami'] = $userName;
			$_SESSION['login_msg'] = true;
			header("Location: ./list.php");
			exit;
		}
	}
}

$tpl = new Tpl('login_fail');
$tpl->render();
