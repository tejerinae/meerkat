<?php
	include '../../include/conectar.php';
	$rs1 = mysql_query("SELECT cod_depto, desc_depto FROM departamentos WHERE cod_estado = 1 ORDER BY 2");
	$items2 = array();
    while($row2 = mysql_fetch_array($rs1)){
    	if($row2['desc_depto']=='En deposito'){
          $row2['desc_depto']='Elija depto';
        } 
        array_push($items2, $row2); 
	}
	/*$rs2 = mysql_query("SELECT cod_user, nombre_user FROM usuarios WHERE cod_estado = 1 ORDER BY 2");
    while($row2 = mysql_fetch_object($rs2)){
      array_push($items2, $row2);
	}*/
   $result2 = $items2;
   echo json_encode($result2);

?>