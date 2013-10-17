<?php
require_once('config.php');
session_start();

if(!LOGIN && !isset($_SESSION['online'])) {
	$_SESSION['online'] = true;
	$_SESSION['whoami'] = 'GUEST'+time();
	$_SESSION['login_msg'] = true;
}

require_once('tpl.class.php');
