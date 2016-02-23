<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from puestos");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT p.cod_puesto, p.desc_puesto, p.cod_depto, d.desc_depto, p.cod_estado, a.des_area, e.desc_estado FROM puestos p INNER JOIN departamentos d ON p.cod_depto = d.cod_depto INNER JOIN estados e ON p.cod_estado = e.cod_estado INNER JOIN areas a ON d.cod_area = a.cod_area ORDER BY 5, 2, 6, 1 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>