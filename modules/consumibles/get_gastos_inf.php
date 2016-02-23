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
	$principio=$ano.'-'.$mes.'-01';

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;

	if(isset($_POST['depto']) && $_POST['depto']!='nada'){
		$cond=' AND a.cod_depto='.$_POST['depto'].' ';
	} else {
		$cond=' ';
	}

	if(isset($_POST['desde']) && isset($_POST['hasta'])){
		$desdeArr=explode("-", $_POST['desde']);
		$desde=$desdeArr[2].'-'.$desdeArr[1].'-'.$desdeArr[0];

		$hastaArr=explode("-", $_POST['hasta']);
		$hasta=$hastaArr[2].'-'.$hastaArr[1].'-'.$hastaArr[0];
		$cond1="AND (a.fecha_asig BETWEEN '".$desde."' AND '".$hasta."')";
	} else if(isset($_POST['desde'])){
		$desdeArr=explode("-", $_POST['desde']);
		$desde=$desdeArr[2].'-'.$desdeArr[1].'-'.$desdeArr[0];
		$cond1="AND (a.fecha_asig > '".$desde."')";
	} else if(isset($_POST['hasta'])){
		$hastaArr=explode("-", $_POST['hasta']);
		$hasta=$hastaArr[2].'-'.$hastaArr[1].'-'.$hastaArr[0];
		$cond1="AND (a.fecha_asig < '".$hasta."')";
	} else {
		$cond1=' ';
	}


	$offset = ($page-1)*$rows;
	$result = array();
	include '../../include/conectar.php';
	
	$query="SELECT DATE_FORMAT(a.fecha_asig,'%d/%m/%Y') as fecha_asig, a.cod_user, a.cod_tipo, a.codigo_asig, a.cod_depto, a.cantidad, con.cod_cons, con.costo_cons, con.depto_con, con.desc_cons, u.cod_user, u.nombre_user, d.desc_depto, a.cantidad*con.costo_cons as multi FROM asignaciones a LEFT JOIN consumibles con ON con.cod_cons = a.codigo_asig LEFT JOIN usuarios u ON a.cod_user = u.cod_user  LEFT JOIN departamentos d ON a.cod_depto = d.cod_depto WHERE a.cod_tipo=1 AND a.cod_depto IS NOT NULL $cond1 $cond ORDER BY a.cod_depto LIMIT $offset,$rows";
	$rs = mysql_query($query);
	$row = mysql_num_rows($rs);
	$result["total"] = $row;
	$total_footer=0;
	$d=0;
	$items = array();
	while($row = mysql_fetch_object($rs)){
		if($d!=$row->cod_depto && $d!=0) {
			array_push($items, array('cod_cons'=>'Total '.$titu, 'multi'=>strval($total_footer)));
			$total_footer=0;			
		}
		$total_footer=$total_footer + $row->multi;
		array_push($items, $row);
		$titu=$row->desc_depto;
		$d=$row->cod_depto;	
	}
	array_push($items, array('cod_cons'=>'Total '.$titu, 'multi'=>strval($total_footer)));
	$result["rows"] = $items;
	echo json_encode($result);

?>