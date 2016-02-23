<?php

$cod_categ = htmlspecialchars($_REQUEST['cod_categ']);
$desc_categ = htmlspecialchars($_REQUEST['desc_categ']);
$ptopedido_categ = htmlspecialchars($_REQUEST['ptopedido_categ']);
$vidautil_categ = htmlspecialchars($_REQUEST['vidautil_categ']);
$cod_tipo = htmlspecialchars($_REQUEST['tipo']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "update categorias set desc_categ='$desc_categ',cod_estado='$cod_estado',ptopedido_categ='$ptopedido_categ',vidautil_categ='$vidautil_categ',cod_tipo='$cod_tipo' where cod_categ=$cod_categ";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_categ,
		'desc_categ' => $desc_categ,
		'ptopedido_categ' => $ptopedido_categ,
		'vidautil_categ' => $vidautil_categ,
		'cod_estado' => $cod_estado,
		'cod_tipo' => $cod_tipo,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>