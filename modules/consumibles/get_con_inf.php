<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$filterRules = isset($_POST['filterRules']) ? ($_POST['filterRules']) : '';
	$cond='';
	if (!empty($filterRules)){
		$filterRules = json_decode($filterRules);
		print_r ($filterRules);
		foreach($filterRules as $rule){
			$rule = get_object_vars($rule);
			$field = $rule['field'];
			$op = 'equal';
			$value = $rule['value'];
			if (!empty($value)){
				if ($op == 'equal'){
					$cond .= " AND (con.$field='%$value%')";
				} else if ($op == 'greater'){
					$cond .= " and $field>$value";
				}
			}
		}
	}
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from consumibles ".$cond);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT con.cod_cons, con.codigo_cons, desc_cons, DATE_FORMAT(con.fechacompra_con,'%m/%d/%Y') as fechacompra_con, con.cod_estado, e.desc_estado, con.costo_cons, con.stock_cons, con.reciclable_cons, con.cod_categ, c.desc_categ, con.cod_prov, p.nombre_prov, c.ptopedido_categ, (c.ptopedido_categ-con.stock_cons) as resta  FROM consumibles con LEFT JOIN estados e ON con.cod_estado = e.cod_estado LEFT JOIN categorias c ON con.cod_categ = c.cod_categ  LEFT JOIN proveedores p ON con.cod_prov = p.cod_prov WHERE con.stock_cons <= c.ptopedido_categ AND con.cod_estado<>6 ".$cond." ORDER BY con.cod_categ LIMIT $offset,$rows");
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>
