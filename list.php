<?php
require('src/global.php');
if(LOGIN && !(isset($_SESSION['online']) && $_SESSION['online'])){
	header("Location: ./index.php");
	exit;
}

$startdir = realpath('files');
$minPath = $startdir;
if(isset($_GET['start'])){
	$startdir .= '/' . $_GET['start'];

}

if(isset($_GET['idMount'])){
	if(!isset($_SESSION['fileIDs'][$_GET['start']]))
		throw new Exception('Link invalid');
	$startdir = $_SESSION['fileIDs'][$_GET['start']];
}

$startdir = realpath($startdir);
if(!$startdir || substr($startdir, 0, strlen($minPath)) != $minPath || !is_dir($startdir))
	throw new Exception("The file you requested is not available!");

$dir = opendir($startdir);
$id = sha1($startdir.time());
$_SESSION['fileIDs'][$id] = $startdir;
$files = array('id' => $id, 'files' => array());
while($file = readdir($dir)){
	if(substr_compare($file, '.', 0, 1) == 0)
		continue;
	$path = $startdir . '/' . $file;
	$isDir = is_dir($path);
	$size = filesize($path);

	$id = sha1($path.time());
	$_SESSION['fileIDs'][$id] = $path;
	$files['files'][] = array(
			'name' => $file,
			'dir' => $isDir,
			'id' => $id,
			'size' => $size
	);
}

$TPL['files'] = $files;

if(isset($_GET['noTpl'])){
	die(json_encode($files));
}
$tpl = new Tpl('list');
$tpl->render();
