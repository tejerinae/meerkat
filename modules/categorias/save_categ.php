<?php

$desc_categ = htmlspecialchars($_REQUEST['desc_categ']);
$ptopedido_categ = htmlspecialchars($_REQUEST['ptopedido_categ']);
$vidautil_categ = htmlspecialchars($_REQUEST['vidautil_categ']);
$cod_tipo = htmlspecialchars($_REQUEST['tipo']);
//$cod_estado = htmlspecialchars($_REQUEST['estado']);
$cod_estado = 1;

include '../../include/conectar.php';

$sql = "insert into categorias(desc_categ,ptopedido_categ,vidautil_categ,cod_tipo,cod_estado) values('$desc_categ','$ptopedido_categ','$vidautil_categ','$cod_tipo','$cod_estado')";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'desc_categ' => $desc_categ,
		'ptopedido_categ' => $ptopedido_categ,
		'vidautil_categ' => $vidautil_categ,
		'cod_estado' => $cod_estado,
		'cod_tipo' => $cod_tipo,
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar area.'));
}
?>
