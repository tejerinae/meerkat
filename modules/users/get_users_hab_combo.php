<?php
	include '../../include/conectar.php';
	$rs2 = mysql_query("SELECT cod_user, nombre_user FROM usuarios WHERE cod_estado = 1 ORDER BY 2");
	$items2 = array();
	array_push($items2,array("cod_user"=> "", "nombre_user" =>"Todos"  ));
    while($row2 = mysql_fetch_object($rs2)){
      array_push($items2, $row2);
	}
   $result2 = $items2;
   echo json_encode($result2);

?>