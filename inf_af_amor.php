<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");
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
	$mesAnt=$ano.'-'.intval($mes-1).'-01';
	$finMes = date('Y-m-d', strtotime ( '-1 day' , strtotime ( $mesAnt ) )) ;
	$priMes=$ano.'-'.$mes.'-01';
?>
	<br /> <br /> <br />

	<table id="dg"  class="easyui-datagrid" title="Actvos Fijos" style="width:100%;" toolbar="#toolbar" url="modules/afs/get_afs.php" pagination="true" rownumbers="true"  fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<!--<th field="fecha_asig" width="50">Fecha 1</th>
				<th field="fecha_asig" width="50">Fecha 2</th>
				<th field="desc_depto" width="50">Departamento</th>-->
				<th field="cod_cons" width="50">Código</th>
				<th field="desc_cons" width="50">Nombre</th>
				<th field="cantidad" width="50">Cantidad</th>
				<th field="fecha_asig" width="50">Fecha</th>
				<th field="multi" width="50">Precio total</th>
				<th field="nombre_user" width="50">Usuario</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar" style="padding:5px;height:auto">
	    <div>
	    	<label>Departamento:</label>
			<input class="easyui-combobox" name="desc_depto"
				data-options="
					url:'modules/deptos/get_deptos_hab_combo.php',
					valueField:'cod_depto',
					textField:'desc_depto',
					panelHeight:'auto'
			" required="true">
			<label>Fecha:</label>
			<input id="desde" class="easyui-datebox" style="width:100px">
	    </div>
	</div>

	
    <script type="text/javascript">
		    function doSearch(){
		    	console.log($('#desde').datebox('getValue'));
		    	console.log($('#hasta').datebox('getValue'));
			    $('#dg').datagrid('load',{
			        desde: $('#desde').datebox('getValue'),
			        hasta: $('#hasta').datebox('getValue'),
			        depto: $('#depto').val()
			    });
			}
        	$("#btnExport").click(function(e) {
				window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dg').html()));
				e.preventDefault(); 
			});

    </script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:130px;
		}
		.fitem input{
			width:160px;
		}
	</style>
<?php
require_once("include/footer.php");
?>
