<?php
include('head.php');
?>
<div class="page-header">
  <h1>Login</h1>
</div>
<div class="well">
  <form action="login.php" method="post">
    <p><label for="user">Username: </label><input class="login" type="text" id="user" name="user" /><br />
    <label for="password">Passwort: </label><input class="login" type="password" id="password" name="password" /><br />
    <input type="submit" value="Login" class="loginbtn" name="login" /></p>
  </form>
</div>
<?php
include('foot.php');
?>
