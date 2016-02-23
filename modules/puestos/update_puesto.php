<?php

$cod_puesto = htmlspecialchars($_REQUEST['cod_puesto']);
$desc_puesto = htmlspecialchars($_REQUEST['desc_puesto']);
$cod_depto = htmlspecialchars($_REQUEST['depto']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "update puestos set desc_puesto='$desc_puesto',cod_estado='$cod_estado',cod_depto='$cod_depto' where cod_puesto=$cod_puesto";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_puesto,
		'desc_puesto' => $desc_puesto,
		'cod_depto' => $cod_depto,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>