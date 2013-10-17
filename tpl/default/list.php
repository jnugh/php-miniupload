<?php
include('head.php');
global $TPL;
?>
<div class="page-header">
	<h1>Dateiliste</h1>
</div>
<?php 
if($_SESSION['login_msg']) {
	$_SESSION['login_msg']=false;
	?>
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Erfolgreich eingeloggt.</h4>
	Willkommen
	<?php echo $_SESSION['whoami']; ?>
</div>
<?php 
}
?>
<p>Folgende Dateien wurden gefunden:</p>
<?php
include('foot.php');
?>
<script type="text/javascript">
	var filelist = <?php echo json_encode($TPL['files']) . ';';
	?>
</script>
<script src="tpl/default/js/filelist.js"></script>