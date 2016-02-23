<?php

$cod_perf = htmlspecialchars($_REQUEST['cod_perf']);
$nombre_perf = htmlspecialchars($_REQUEST['nombre_perf']);
$desc_perf = htmlspecialchars($_REQUEST['desc_perf']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "update perfiles set nombre_perf='$nombre_perf',desc_perf='$desc_perf',cod_estado='$cod_estado' where cod_perf=$cod_perf";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_perf,
		'nombre_perf' => $nombre_perf,
		'desc_perf' => $desc_perf,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}
?>