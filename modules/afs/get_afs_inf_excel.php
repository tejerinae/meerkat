<?php

	$debug=false;
	if($debug){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
	}

	require_once '../../include/phpexcel/Classes/PHPExcel.php';

	$filename = 'activos_fijos'.date(' Y-m-d H-i').'.xls';

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("WARP | www.bywarp.com")
								 ->setTitle('Activos fijos');

	function limpiar($str){
		//return htmlspecialchars_decode(strip_tags(($str)));
		return htmlspecialchars_decode(strip_tags(utf8_decode($str)));
	}

	$alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
					'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
					'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ',
					'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ');
	$f=1;
	function fila($arr){
		global $f,$alpha,$objPHPExcel,$debug;
		if($debug) d('FILA NUMERO: '.$f);
		if($debug) d($arr);
		foreach($arr as $k=>$v)
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha[$k].$f,$v);
		$f++;
	}

	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
	$filterRules = isset($_GET['filterRules']) ? ($_GET['filterRules']) : '';
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
	while($row = mysql_fetch_array($rs)){
		$r=array();
		foreach ($row as $k => $v) {
			$fila=limpiar($v);
			$r[]=$fila;
		}
		fila($r);
	}
	if($debug) exit();

	// la magia

	$objPHPExcel->getActiveSheet()->setTitle('Activos Fijos');
	$objPHPExcel->setActiveSheetIndex(0);

	// Redirect output to a client’s web browser (Excel2007)
	//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // xlsx
	header('Content-Type: application/vnd.ms-excel'); // xls
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); // xlsx
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); // xls
	$objWriter->save('php://output');
	exit;

?>
