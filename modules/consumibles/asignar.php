<?php
session_start();
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$depto_con = htmlspecialchars($_REQUEST['depto_con']);
$cantidad = htmlspecialchars($_REQUEST['cantidad']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons'])-$cantidad;
$user_con = htmlspecialchars($_REQUEST['user_con']);
$fecha_actual = date("Y-m-d");
$cod_estado = 4;
if(strlen($depto_con)==0)
	$depto_con='NULL';
if(strlen($user_con)==0)
	$user_con='NULL';


include '../../include/conectar.php';

//$sql = "update consumibles set cod_estado='$cod_estado', depto_con='$depto_con'  where cod_cons=$cod_cons";

//echo $_SESSION['sidu'];
$sql = "insert into asignaciones (fecha_asig, cod_user, cod_tipo, codigo_asig, cod_depto, cantidad) values (NOW(), $user_con, 1, $cod_cons, $depto_con, $cantidad)";
$sql1 = "update consumibles set stock_cons='$stock_cons' where cod_cons=$cod_cons";

$result = @mysql_query($sql);
$result1 = @mysql_query($sql1);
if ($result && $result1){
	echo json_encode(array(
		'id' => $cod_cons,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}

?>
