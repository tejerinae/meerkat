<?php
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$cod_estado = 6;


include '../../include/conectar.php';

$sql = "update consumibles set cod_estado='$cod_estado' where cod_cons=$cod_cons";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_cons,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}

?>
