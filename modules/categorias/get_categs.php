<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from categorias");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT c.cod_categ, c.desc_categ, c.ptopedido_categ, c.vidautil_categ, c.cod_estado, e.desc_estado, ct.desc_tipo, c.cod_tipo FROM categorias c INNER JOIN estados e ON c.cod_estado = e.cod_estado INNER JOIN tipos_categ ct ON c.cod_tipo = ct.cod_tipo ORDER BY 5, 2, 7 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>