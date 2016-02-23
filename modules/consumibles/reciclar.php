<?php
session_start();
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$recicla_cons = htmlspecialchars($_REQUEST['recicla_cons']);
$cantidad = htmlspecialchars($_REQUEST['cantidad']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons'])-$cantidad;
$cod_estado = 7;
$recicla = $recicla_cons + $cantidad;

include '../../include/conectar.php';

$sql = "update consumibles set stock_cons='$stock_cons', recicla_cons=$recicla where cod_cons=$cod_cons";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_cons,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}

?>
