<?php
session_start();
$cod_af = htmlspecialchars($_REQUEST['cod_af']);
$depto_af = htmlspecialchars($_REQUEST['depto_af']);
$user_af = htmlspecialchars($_REQUEST['user_af']);
$cod_user = $_SESSION['sidu'];
$fecha_actual = date("Y-m-d");
$cod_estado = 4;


include '../../include/conectar.php';

$sql = "insert into asignaciones (fecha_asig, cod_user, cod_tipo, codigo_asig, cod_depto) values (NOW(), $cod_user, 0, $cod_af, $depto_af)";
$sql1 = "update activos_fijos set cod_estado='$cod_estado', depto_af='$depto_af', user_af='$user_af'  where cod_af=$cod_af";
$result = @mysql_query($sql);
$result1 = @mysql_query($sql1);
if ($result){
	echo json_encode(array(
		'id' => $cod_af,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}

?>
