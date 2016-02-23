<?php
$cod_cons = htmlspecialchars($_REQUEST['cod_cons']);
$codigo_cons = htmlspecialchars($_REQUEST['codigo_cons']);
$desc_cons = htmlspecialchars($_REQUEST['desc_cons']);
$fechacompra_con_orig = htmlspecialchars($_REQUEST['fechacompra_con']);
$fechacompra_con = substr($fechacompra_con_orig,6,4).'-'.substr($fechacompra_con_orig,0,2).'-'.substr($fechacompra_con_orig,3,2);
$cod_categ = htmlspecialchars($_REQUEST['categoria']);
//$cod_estado = htmlspecialchars($_REQUEST['estado']);
$reciclable_cons = htmlspecialchars($_REQUEST['reciclable_cons']);
$costo_cons = htmlspecialchars($_REQUEST['costo_cons']);
$stock_cons = htmlspecialchars($_REQUEST['stock_cons']);
//$nroserie_con = htmlspecialchars($_REQUEST['nroserie_con']);
//$hardware_con = htmlspecialchars($_REQUEST['hardware_con']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);


include '../../include/conectar.php';

$sql = "update consumibles set codigo_cons='$codigo_cons',desc_cons='$desc_cons',fechacompra_con='$fechacompra_con',cod_categ='$cod_categ',costo_cons='$costo_cons',stock_cons='$stock_cons',cod_prov='$cod_prov', reciclable_cons='$reciclable_cons' where cod_cons=$cod_cons";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
	'id' => $cod_cons,
	'cod_cons' => $cod_cons,
	'desc_cons' => $desc_cons,
	'fechacompra_con' => $fechacompra_con,
	'cod_categ' => $cod_categ,
	'costo_cons' => $costo_cons,
	'cod_prov' => $cod_prov/*,
	'cod_estado' => $cod_estado*/
	));
} else {
	echo json_encode(array('errorMsg'=>$sql));
}
?>