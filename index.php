<?php
require('./src/global.php');
if(!LOGIN || (isset($_SESSION['online']) && $_SESSION['online'])){
  header("Location: ./list.php");
  exit;
}

$tpl = new Tpl('login');
$tpl->render();
