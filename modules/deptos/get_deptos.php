<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from departamentos");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT cod_depto, d.cod_estado, d.cod_user, desc_depto, desc_estado, nombre_user, d.cod_area, des_area FROM departamentos d INNER JOIN estados e ON d.cod_estado = e.cod_estado INNER JOIN usuarios u ON d.cod_user = u.cod_user INNER JOIN areas a ON d.cod_area = a.cod_area WHERE desc_depto!='En deposito' ORDER BY 2,4,8 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>