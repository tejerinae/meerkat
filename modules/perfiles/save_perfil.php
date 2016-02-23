<?php

$nombre_perf = htmlspecialchars($_REQUEST['nombre_perf']);
$desc_perf = htmlspecialchars($_REQUEST['desc_perf']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "insert into perfiles (nombre_perf,desc_perf,cod_estado) values('$nombre_perf','$desc_perf','$cod_estado')";

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'nombre_perf' => $nombre_perf,
		'desc_perf' => $desc_perf,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}
?>
