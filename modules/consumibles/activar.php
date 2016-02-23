<?php
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$cantidad = htmlspecialchars($_REQUEST['cantidad']);
$accion = htmlspecialchars($_REQUEST['accion']);
$recicla_cons = htmlspecialchars($_REQUEST['recicla_cons']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons']);
$recicla=$recicla_cons-$cantidad;
$cod_estado = 1;
if($accion=='Activar'){
	$stock_cons = $stock_cons + $cantidad;
}



include '../../include/conectar.php';

$sql = "update consumibles set cod_estado='$cod_estado', stock_cons=$stock_cons, recicla_cons=$recicla where cod_cons=$cod_cons";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_cons,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}

?>
