<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from areas");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT cod_area, a.cod_estado, a.cod_user, des_area, desc_estado, nombre_user FROM areas a INNER JOIN estados e ON a.cod_estado = e.cod_estado INNER JOIN usuarios u ON a.cod_user = u.cod_user ORDER BY 2,4 limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>