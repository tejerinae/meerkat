<?php

$cod_user = htmlspecialchars($_REQUEST['cod_user']);
$pass_user = md5(htmlspecialchars($_REQUEST['pass']));


include '../../include/conectar.php';

$sql = "update usuarios set pass_user='$pass_user' where cod_user=$cod_user";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array(
		'id' => $cod_user,
		'pass_user' => $pass_user,
	));
} else {
	echo json_encode(array('errorMsg'=>'Algo fallo.'));
}
?>