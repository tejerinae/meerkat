<?php

$cod_depto = htmlspecialchars($_REQUEST['cod_depto']);
$desc_depto = htmlspecialchars($_REQUEST['desc_depto']);
$cod_area = htmlspecialchars($_REQUEST['area']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);
$cod_user = htmlspecialchars($_REQUEST['user']);

include '../../include/conectar.php';

$sql = "update departamentos set desc_depto='$desc_depto',cod_estado='$cod_estado',cod_user='$cod_user', cod_area='$cod_area' where cod_depto=$cod_depto";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_depto,
		'desc_depto' => $desc_depto,
		'cod_area' => $cod_area,
		'cod_estado' => $cod_estado,
		'cod_user' => $cod_user,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>