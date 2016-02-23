<?php
	include '../../include/conectar.php';
	$rs2 = mysql_query("SELECT p.cod_perf, p.nombre_perf, p.desc_perf, p.cod_estado, e.cod_estado, e.desc_estado FROM perfiles p LEFT JOIN estados e ON p.cod_estado = e.cod_estado ORDER BY 2");
	$items2 = array();
   while($row2 = mysql_fetch_object($rs2)){
      array_push($items2, $row2);
	}
   $result2 = $items2;
   echo json_encode($result2);

?>