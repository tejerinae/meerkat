<?php

$cod_prov = htmlspecialchars($_REQUEST['cod_prov']);
$nombre_prov = htmlspecialchars($_REQUEST['nombre_prov']);
$tel_prov = htmlspecialchars($_REQUEST['tel_prov']);
$mail_prov = htmlspecialchars($_REQUEST['mail_prov']);
$contacto_prov = htmlspecialchars($_REQUEST['contacto_prov']);
$recicla_prov = htmlspecialchars($_REQUEST['recicla']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "update proveedores set nombre_prov='$nombre_prov',tel_prov='$tel_prov',mail_prov='$mail_prov',contacto_prov='$contacto_prov',recicla_prov='$recicla_prov',cod_estado='$cod_estado' where cod_prov=$cod_prov";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_prov,
		'nombre_prov' => $nombre_prov,
		'tel_prov' => $tel_prov,
		'mail_prov' => $mail_prov,
		'contacto_prov' => $contacto_prov,
		'recicla_prov' => $recicla_prov,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>
