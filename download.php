<?php
require('src/global.php');
if(LOGIN && !(isset($_SESSION['online']) && $_SESSION['online'])){
	header("Location: ./index.php");
	exit;
}
if(!isset($_GET['file']) || !isset($_SESSION['fileIDs'][$_GET['file']]))
	exit;
$file = $_SESSION['fileIDs'][$_GET['file']];
header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
header("Content-Length: " . filesize($file));

readfile($file);