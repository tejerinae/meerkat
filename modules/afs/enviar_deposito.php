<?php
$cod_af = htmlspecialchars($_REQUEST['cod_af']);
$cod_estado = 3;


include '../../include/conectar.php';

$sql = "update activos_fijos set cod_estado='$cod_estado', depto_af=4, user_af=0 where cod_af=$cod_af";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_af,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}

?>
