<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from usuarios");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT u.cod_user, u.login_user, u.nombre_user, u.tel_user, u.mail_user, u.cod_estado, e.desc_estado, u.pass_user, u.cod_puesto, p.desc_puesto, u.cod_perf, perf.nombre_perf FROM usuarios u INNER JOIN estados e ON u.cod_estado = e.cod_estado INNER JOIN puestos p ON u.cod_puesto = p.cod_puesto INNER JOIN perfiles perf ON u.cod_perf = perf.cod_perf ORDER BY 6, 3, 9 LIMIT $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>