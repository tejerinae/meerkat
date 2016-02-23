<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from consumibles");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT con.cod_cons, con.codigo_cons, desc_cons, DATE_FORMAT(con.fechacompra_con,'%m/%d/%Y') as fechacompra_con, con.cod_estado, e.desc_estado, con.costo_cons, con.stock_cons, con.reciclable_cons, con.cod_categ, c.desc_categ, con.cod_prov, p.nombre_prov, con.recicla_cons FROM consumibles con LEFT JOIN estados e ON con.cod_estado = e.cod_estado LEFT JOIN categorias c ON con.cod_categ = c.cod_categ LEFT JOIN proveedores p ON con.cod_prov = p.cod_prov  ORDER BY 4, 2, 1 LIMIT $offset,$rows");
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);
	//print_r(($result));

?>
