<?php
require('src/global.php');
$_SESSION['online'] = false;
$_SESSION['whoami'] = '';
header("Location: ./index.php");
exit;