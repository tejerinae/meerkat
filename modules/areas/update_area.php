<?php

$cod_area = htmlspecialchars($_REQUEST['cod_area']);
$des_area = htmlspecialchars($_REQUEST['des_area']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);
$cod_user = htmlspecialchars($_REQUEST['user']);

include '../../include/conectar.php';

$sql = "update areas set des_area='$des_area',cod_estado='$cod_estado',cod_user='$cod_user' where cod_area=$cod_area";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_area,
		'des_area' => $des_area,
		'cod_estado' => $cod_estado,
		'cod_user' => $cod_user,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>