<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from proveedores");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT p.cod_prov, p.nombre_prov, p.tel_prov, p.mail_prov, p.contacto_prov, p.cod_estado, e.desc_estado, p.recicla_prov FROM proveedores p INNER JOIN estados e ON p.cod_estado = e.cod_estado ORDER BY 6,2 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>
