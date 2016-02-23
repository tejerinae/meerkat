<?php
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$cantidad = htmlspecialchars($_REQUEST['cantidad']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons'])+$cantidad;
//$cod_estado = 3;


include '../../include/conectar.php';

$sql = "update consumibles set stock_cons=$stock_cons where cod_cons=$cod_cons";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_cons,
		'stock_cons' => $stock_cons,
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}

?>
