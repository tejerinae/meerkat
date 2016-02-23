<?php 
session_start();
require_once('include/header.php');
$error	= 1;
if(isset($_GET['all'])) $error = $_GET['all'];
?>
<form class="box login" action="valida_login.php" method="post">
	<header></header>
	<fieldset class="boxBody">
	  <label>Usuario</label>
	  <input type="text" name="usu" tabindex="1" placeholder="RS+DNI" required>
	  <label>Password</label>
	  <input type="password" name="pass" tabindex="2" required>
	<?php
		if ($error == '0'){
			
			echo "<label type='error'>Usuario o contraseña errónea</label>";
		};
	?> 
	</fieldset>
	<footer>
	  <input type="button" class="btnLogin" value="Login" tabindex="3" onClick="submit();">
	</footer>
</form>
<?php
require_once("include/footer.php");
?>
