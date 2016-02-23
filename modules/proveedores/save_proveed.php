<?php

$nombre_prov = htmlspecialchars($_REQUEST['nombre_prov']);
$tel_prov = htmlspecialchars($_REQUEST['tel_prov']);
$mail_prov = htmlspecialchars($_REQUEST['mail_prov']);
$contacto_prov = htmlspecialchars($_REQUEST['contacto_prov']);
$recicla_prov = htmlspecialchars($_REQUEST['recicla']);
$cod_estado = 1;

include '../../include/conectar.php';

$sql = "insert into proveedores(nombre_prov,tel_prov,mail_prov,contacto_prov,recicla_prov,cod_estado) values('$nombre_prov','$tel_prov','$mail_prov','$contacto_prov','$recicla_prov','$cod_estado')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'nombre_prov' => $nombre_prov,
		'tel_prov' => $tel_prov,
		'mail_prov' => $mail_prov,
		'contacto_prov' => $contacto_prov,
		'recicla_prov' => $recicla_prov,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar Proveedor.'));
}
?>
