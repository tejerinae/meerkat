<?php
session_start();
$cod_af = htmlspecialchars($_REQUEST['cod_af']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);
$cod_user = $_SESSION['sidu'];
$fecha_actual = date("Y-m-d");
$cod_estado = 5;


include '../../include/conectar.php';

$sql = "insert into services (fecha_serv, cod_af, cod_prov) values (NOW(), $cod_af, $cod_prov)";
$sql1 = "update activos_fijos set cod_estado=".$cod_estado.", depto_af=4 where cod_af=".$cod_af."";
$result = @mysql_query($sql);
$result1 = @mysql_query($sql1);
if ($result){
	echo json_encode(array(
		'id' => $cod_af,
		'cod_prov' => $cod_prov,
		'sql' => $sql,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}

?>
