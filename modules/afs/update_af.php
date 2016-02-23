<?php
$cod_af = htmlspecialchars($_REQUEST['cod_af']);
$codigo_af = htmlspecialchars($_REQUEST['codigo_af']);
$Nombre_af = htmlspecialchars($_REQUEST['Nombre_af']);
$fechacompra_af_orig = htmlspecialchars($_REQUEST['fechacompra_af']);
$fechacompra_af = substr($fechacompra_af_orig,6,4).'-'.substr($fechacompra_af_orig,0,2).'-'.substr($fechacompra_af_orig,3,2);
$cod_categ = htmlspecialchars($_REQUEST['categoria']);
$garantia_af = htmlspecialchars($_REQUEST['garantia_af']);
$costo_af = htmlspecialchars($_REQUEST['costo_af']);
$nroserie_af = htmlspecialchars($_REQUEST['nroserie_af']);
$hardware_af = htmlspecialchars($_REQUEST['hardware_af']);
$depto_af = htmlspecialchars($_REQUEST['depto_af']);
$cod_prov = htmlspecialchars($_REQUEST['proveedor']);


include '../../include/conectar.php';

$sql = "update activos_fijos set codigo_af='$codigo_af',Nombre_af='$Nombre_af',fechacompra_af='$fechacompra_af',cod_categ='$cod_categ',garantia_af='$garantia_af',costo_af='$costo_af',nroserie_af='$nroserie_af',cod_prov='$cod_prov',nroserie_af='$nroserie_af',depto_af='$depto_af' where cod_af=$cod_af";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
	'id' => $cod_af,
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
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>