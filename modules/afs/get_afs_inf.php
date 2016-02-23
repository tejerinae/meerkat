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
					$cond .= " WHERE (af.$field='%$value%')";
				} else if ($op == 'greater'){
					$cond .= " and $field>$value";
				}
			}
		}
	}
	$offset = ($page-1)*$rows;
	$result = array();

	include '../../include/conectar.php';
	
	$rs = mysql_query("select count(*) from activos_fijos ".$cond);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysql_query("SELECT af.cod_af, af.codigo_af, Nombre_af, DATE_FORMAT(af.fechacompra_af,'%m/%d/%Y') as fechacompra_af, af.cod_estado, e.desc_estado, af.costo_af, af.garantia_af, af.nroserie_af, af.hardware_af, af.cod_categ, c.desc_categ, af.cod_prov, p.nombre_prov, af.depto_af, d.desc_depto FROM activos_fijos af LEFT JOIN estados e ON af.cod_estado = e.cod_estado LEFT JOIN categorias c ON af.cod_categ = c.cod_categ LEFT JOIN proveedores p ON af.cod_prov = p.cod_prov LEFT JOIN departamentos d ON af.depto_af = d.cod_depto ".$cond." ORDER BY af.cod_categ LIMIT $offset,$rows");
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>
