<?php
require('src/global.php');
if(LOGIN && !(isset($_SESSION['online']) && $_SESSION['online'])){
	header("Location: ./index.php");
	exit;
}

$startdir = realpath('files');
$minPath = $startdir;
try{
if(!isset($_GET['position']) || !isset($_GET['name'])){
	throw new Exception("No start position set.");
}
if(!isset($_SESSION['fileIDs'][$_GET['position']]))
	throw new Exception('Link invalid');
$startdir = $_SESSION['fileIDs'][$_GET['position']];


$startdir = realpath($startdir);
if(!$startdir || substr($startdir, 0, strlen($minPath)) != $minPath || !is_dir($startdir))
	throw new Exception("The file you requested is not available!");

if(file_exists($startdir . '/' . $_GET['name']))
	throw new Exception("File already exists.");

die(mkdir($startdir . '/' . $_GET['name']));
}catch(Exception $e) {
	die($e->getMessage());
}