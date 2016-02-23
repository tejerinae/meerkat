<?php

$login_user = htmlspecialchars($_REQUEST['login_user']);
$nombre_user = htmlspecialchars($_REQUEST['nombre_user']);
$tel_user = htmlspecialchars($_REQUEST['tel_user']);
$mail_user = htmlspecialchars($_REQUEST['mail_user']);
$cod_puesto = htmlspecialchars($_REQUEST['puesto']);
$cod_perf = htmlspecialchars($_REQUEST['perfil']);
$cod_estado = htmlspecialchars($_REQUEST['estado']);

include '../../include/conectar.php';

$sql = "insert into usuarios(login_user,nombre_user,tel_user,mail_user,cod_puesto,cod_perf,cod_estado) values('$login_user','$nombre_user','$tel_user','$mail_user','$cod_puesto','$cod_perf','1')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'login_user' => $login_user,
		'nombre_user' => $nombre_user,
		'tel_user' => $tel_user,
		'mail_user' => $mail_user,
		'cod_puesto' => $cod_puesto,
		'cod_perf' => $cod_perf,
		'cod_estado' => $cod_estado,
	));
} else {
	echo json_encode(array('errorMsg'=>'Fallo al agregar area.'));
}
?>
