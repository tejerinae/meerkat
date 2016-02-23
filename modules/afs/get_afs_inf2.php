<?php
	$fecha_hoy = getdate();
	$ano=$fecha_hoy['year'];
	if ($fecha_hoy['mon']<10) {
		$mes='0'.$fecha_hoy['mon'];	
		$mes_atras='0'.(intVal($fecha_hoy['mon'])-1);	
	} else {
		$mes=$fecha_hoy['mon'];
		$mes_atras=intVal($fecha_hoy['mon'])-1;	
	}
	if ($fecha_hoy['mday']<10) {
		$dia='0'.$fecha_hoy['mday'];
	} else {
		$dia=$fecha_hoy['mday'];
	}
	$hoy=$ano.'-'.$mes.'-'.$dia;

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	if(isset($_POST['desde'])){
		$desdeArr=explode("/", $_POST['desde']);
		$anio=$desdeArr[2];
	} else {
		$anio = $ano;
	}

	//$depto = isset($_POST['depto']) ? intval($_POST['depto']) : "";
	if(isset($_POST['depto']) && $_POST['depto']!='nada'){
		$cond=' AND af.depto_af='.$_POST['depto'].' ';
	} else {
		$cond=' ';
	}

	$offset = ($page-1)*$rows;
	$result = array();
	include '../../include/conectar.php';
	
	$query="SELECT af.cod_af, af.codigo_af, af.depto_af, Nombre_af, DATE_FORMAT(af.fechacompra_af,'%m/%d/%Y') as fechacompra_af, af.costo_af, af.cod_categ, af.cod_estado, c.desc_categ, c.vidautil_categ FROM activos_fijos af LEFT JOIN categorias c ON af.cod_categ = c.cod_categ WHERE af.cod_estado!=6 $cond AND ($anio-year(af.fechacompra_af)) < c.vidautil_categ ORDER BY 4, 2, 1 LIMIT $offset,$rows";
	$rs = mysql_query($query);
	$row = mysql_num_rows($rs);
	$result["total"] = $row;
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	echo json_encode($result);

?>