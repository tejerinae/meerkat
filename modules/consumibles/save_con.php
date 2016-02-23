<?php

$codigo_cons = htmlspecialchars($_REQUEST['codigo_cons']);
$desc_cons = htmlspecialchars($_REQUEST['desc_cons']);
$fechacompra_con_orig = htmlspecialchars($_REQUEST['fechacompra_con']);
$fechacompra_con = substr($fechacompra_con_orig,6,4).'-'.substr($fechacompra_con_orig,0,2).'-'.substr($fechacompra_con_orig,3,2);
$cod_categ = htmlspecialchars($_REQUEST['categoria']);
$costo_cons = htmlspecialchars($_REQUEST['costo_cons']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons']);
$reciclable_cons = htmlspecialchars($_REQUEST['reciclable_cons']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);


include '../../include/conectar.php';

$sql = "insert into consumibles(codigo_cons,desc_cons,fechacompra_con,cod_categ,costo_cons,stock_cons,reciclable_cons,cod_prov,cod_estado) values('$codigo_cons','$desc_cons','$fechacompra_con','$cod_categ','$costo_cons','$stock_cons','$reciclable_cons','$cod_prov',3)";

echo $sql;

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
	'id' => mysql_insert_id(),
	'codigo_cons' => $codigo_cons,
	'desc_cons' => $desc_cons,
	'fechacompra_con' => $fechacompra_con,
	'cod_categ' => $cod_categ,
	'costo_cons' => $costo_cons,
	'stock_cons' => $stock_cons,
	'reciclable_cons' => $reciclable_cons,
	'cod_prov' => $cod_prov,
	'cod_estado' => $cod_estado
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}
?>
