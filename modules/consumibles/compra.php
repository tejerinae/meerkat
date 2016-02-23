<?php
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$cantidad = htmlspecialchars($_REQUEST['cantidad']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons'])+$cantidad;
$desc_cons = htmlspecialchars($_REQUEST['desc_cons']);
$costo_cons = htmlspecialchars($_REQUEST['costo_cons']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);
$cod_estado = 1;



include '../../include/conectar.php';

$sql = "update consumibles set cod_estado='$cod_estado', stock_cons=$stock_cons, desc_cons='$desc_cons', costo_cons=$costo_cons where cod_cons=$cod_cons";
$sql1 = "insert into compra_cons (fecha_cpra, costounit_cpra, cantidad_cpra, cod_cons, cod_prov) values (NOW(), $costo_cons, $cantidad, $cod_cons, $cod_prov)";
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
