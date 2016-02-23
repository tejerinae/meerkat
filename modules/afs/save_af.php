<?php

$codigo_af = htmlspecialchars($_REQUEST['codigo_af']);
$Nombre_af = htmlspecialchars($_REQUEST['Nombre_af']);
$fechacompra_af_orig = htmlspecialchars($_REQUEST['fechacompra_af']);
$fechacompra_af = substr($fechacompra_af_orig,6,4).'-'.substr($fechacompra_af_orig,0,2).'-'.substr($fechacompra_af_orig,3,2);
$cod_categ = htmlspecialchars($_REQUEST['categoria']);
$garantia_af = htmlspecialchars($_REQUEST['garantia_af']);
$costo_af = htmlspecialchars($_REQUEST['costo_af']);
$nroserie_af = htmlspecialchars($_REQUEST['nroserie_af']);
$hardware_af = htmlspecialchars($_REQUEST['hardware_af']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);
$depto_af = htmlspecialchars($_REQUEST['depto_af']);


include '../../include/conectar.php';

$sql = "insert into activos_fijos(codigo_af,Nombre_af,fechacompra_af,cod_categ,garantia_af,costo_af,nroserie_af,hardware_af,cod_prov,cod_estado,depto_af) values('$codigo_af','$Nombre_af','$fechacompra_af','$cod_categ','$garantia_af','$costo_af','$nroserie_af','$hardware_af','$cod_prov',3,4)";

echo $sql;

$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
	'id' => mysql_insert_id(),
	'codigo_af' => $codigo_af,
	'Nombre_af' => $Nombre_af,
	'fechacompra_af' => $fechacompra_af,
	'cod_categ' => $cod_categ,
	'garantia_af' => $garantia_af,
	'costo_af' => $costo_af,
	'nroserie_af' => $nroserie_af,
	'hardware_af' => $hardware_af,
	'cod_prov' => $cod_prov,
	'depto_af' => $depto_af,
	'cod_estado' => $cod_estado
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar area.'));
}
?>
