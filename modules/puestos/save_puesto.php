<?php

$desc_puesto = htmlspecialchars($_REQUEST['desc_puesto']);
$cod_depto = htmlspecialchars($_REQUEST['depto']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "insert into puestos(desc_puesto,cod_depto,cod_estado) values('$desc_puesto','$cod_depto','1')";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'desc_puesto' => $desc_puesto,
		'cod_depto' => $cod_depto,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar area.'));
}
?>
