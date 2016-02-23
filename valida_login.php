<?php
session_start();
require_once('include/conectar.php');
require_once('modules/usuarios.php');

$user	=	$_POST['usu'];
$pass	=	$_POST['pass'];

$usu			=	new usuarios();
$usu->login_usr	=	$user;
$usu->contrasena=	$pass;

//Esto comprueba si existe
if ($usu->login() == 1){
	header('Location: index.php');
	}  else {

		$_SESSION['usuariou'] 				=	$usu->login_usr;
		$_SESSION['estadou'] 				=	"conectado";
		$_SESSION['nombreu'] 				=	$usu->nombre;
		$_SESSION['sidu']					=	$usu->sid;
		$_SESSION['rol']					=	$usu->rol;
		
		header('Location: home.php');
		
}
?>
