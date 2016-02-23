<?php
	include '../../include/conectar.php';
	$rs2 = mysql_query("SELECT cod_categ, desc_categ FROM categorias WHERE cod_estado = 1 AND cod_tipo = 2 ORDER BY 2");
	$items2 = array();
   while($row2 = mysql_fetch_object($rs2)){
      array_push($items2, $row2);
	}
   $result2 = $items2;
   echo json_encode($result2);

?>