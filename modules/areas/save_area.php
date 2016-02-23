<?php

$des_area = htmlspecialchars($_REQUEST['des_area']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);
$cod_user = htmlspecialchars($_REQUEST['user']);

include '../../include/conectar.php';

$sql = "insert into areas(des_area,cod_estado,cod_user) values('$des_area','1','$cod_user')";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'des_area' => $des_area,
		'cod_estado' => $cod_estado,
		'cod_user' => $cod_user,
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar area.'));
}
?>
