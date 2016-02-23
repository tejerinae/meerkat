<?php
session_start();

if (!$_SESSION['estadou'] == "conectado"){
	header("Location: ../index.php");
	exit();
}	
?>