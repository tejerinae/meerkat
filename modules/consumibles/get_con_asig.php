<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from activos_fijos");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT af.cod_af, af.codigo_af, af.Nombre_af, af.cod_estado, e.desc_estado, af.cod_categ, c.desc_categ, af.depto_af, af.user_af, CASE WHEN af.user_af <> 0 THEN u.nombre_user WHEN af.depto_af <> 0 THEN CONCAT('Depto ',d.desc_depto) WHEN af.depto_af = 0 AND af.user_af = 0 THEN 'Sin Asignar' END AS asignado FROM activos_fijos af INNER JOIN estados e ON af.cod_estado = e.cod_estado INNER JOIN categorias c ON af.cod_categ = c.cod_categ LEFT JOIN usuarios u ON af.user_af = u.cod_user LEFT JOIN departamentos d ON af.depto_af = d.cod_depto WHERE af.cod_estado IN(3,4) ORDER BY 4, 2, 1 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>
