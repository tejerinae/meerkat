<?php
	include '../../include/conectar.php';
	$rs2 = mysql_query("SELECT cod_depto, desc_depto FROM departamentos WHERE cod_estado = 1 AND cod_depto <> 4 ORDER BY 2");
	$items2 = array();
	array_push($items2,array("cod_depto"=> "", "desc_depto" =>"Todos"  ));
    while($row2 = mysql_fetch_object($rs2)){
      array_push($items2, $row2);
	}
   $result2 = $items2;
   echo json_encode($result2);

?>