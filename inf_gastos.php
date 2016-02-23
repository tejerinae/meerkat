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

	<table id="dg"  class="easyui-datagrid" title="Gastos por Departamento" style="width:100%;" toolbar="#toolbar" url="modules/consumibles/get_gastos_inf.php" pagination="true" rownumbers="true"  fitColumns="true" singleSelect="true"  showFooter="true">
		<thead>
			<tr>
				<th field="cod_cons" width="50">Código</th>
				<th field="desc_cons" width="50">Nombre</th>
				<th field="fecha_asig" width="50">Fecha</th>
				<th field="cantidad" width="50">Cantidad</th>
				<th field="costo_cons" width="50">Precio Unitario</th>
				<th field="multi" width="50">Precio total</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar" style="padding:5px;height:auto">
	    <div>
	    	<label>Departamento:</label>
			<input class="easyui-combobox" id="depto" name="desc_depto"
				data-options="
					url:'modules/deptos/get_deptos_hab_combo.php',
					valueField:'cod_depto',
					textField:'desc_depto',
					panelHeight:'auto'
			" required="true">
			<label>Desde:</label>
			<input id="desde" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:100px">
			<label>Hasta:</label>
	        <input id="hasta" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:100px">
	        <a href="#" class="easyui-linkbutton" iconCls="icon-search"  onclick="doSearch()">Buscar</a>
	    </div>
	</div>
	<br />
	<table id="dg2"  class="easyui-datagrid" title="Gastos por Usuario" style="width:100%;" toolbar="#toolbar2" url="modules/consumibles/get_gastos_inf_user.php" pagination="true" rownumbers="true"  fitColumns="true" singleSelect="true"  showFooter="true">
		<thead>
			<tr>
				<th field="cod_cons" width="50">Código</th>
				<th field="desc_cons" width="50">Nombre</th>
				<th field="fecha_asig" width="50">Fecha</th>
				<th field="cantidad" width="50">Cantidad</th>
				<th field="costo_cons" width="50">Precio Unitario</th>
				<th field="multi" width="50">Precio total</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar2" style="padding:5px;height:auto">
	    <div>
	    	<label>Usuario:</label>
			<input class="easyui-combobox" id="depto2" name="desc_depto2"
				data-options="
					url:'modules/users/get_users_hab_combo.php',
					valueField:'cod_user',
					textField:'nombre_user',
					panelHeight:'auto'
			" required="true">
			<label>Desde:</label>
			<input id="desde2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:100px">
			<label>Hasta:</label>
	        <input id="hasta2" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser" style="width:100px">
	        <a href="#" class="easyui-linkbutton" iconCls="icon-search"  onclick="doSearch()">Buscar</a>
	    </div>
	</div>
	
    <script type="text/javascript">
    	$(function() {
    		var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();

			var output =
				((''+day).length<2 ? '0' : '') + day  + '-' +
			    ((''+month).length<2 ? '0' : '') + month + '-' +
			    d.getFullYear();
			    

    		$('#desde').datebox('setValue', '01-01-1990');
    		$('#hasta').datebox('setValue', output);
    		$('#desde2').datebox('setValue', '01-01-1990');
    		$('#hasta2').datebox('setValue', output);
    	});
    		function myformatter(date){
	            var y = date.getFullYear();
	            var m = date.getMonth()+1;
	            var d = date.getDate();
	            return (d<10?('0'+d):d)+'-'+(m<10?('0'+m):m)+'-'+y;
	        }
	        function myparser(s){
	            if (!s) return new Date();
	            var ss = (s.split('-'));
	            var y = parseInt(ss[2],10);
	            var m = parseInt(ss[1],10);
	            var d = parseInt(ss[0],10);
	            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
	                return new Date(y,m-1,d);
	            } else {
	                return new Date();
	            }
	        }
		    function doSearch(){
		    	console.log($('#desde').datebox('getValue'));
		    	console.log($('#hasta').datebox('getValue'));
		    	console.log($('#depto').combobox('getValue'));
		    	console.log($('#depto2').combobox('getValue'));
		    	depto = $('#depto').combobox('getValue')?$('#depto').combobox('getValue'):'nada';
		    	depto2 = $('#depto2').combobox('getValue')?$('#depto2').combobox('getValue'):'nada';
			    $('#dg').datagrid('load',{
			        depto: depto,
			        desde: $('#desde').datebox('getValue'),
			        hasta: $('#hasta').datebox('getValue'),
			    });
			    $('#dg2').datagrid('load',{
			        depto: depto2,
			        desde: $('#desde2').datebox('getValue'),
			        hasta: $('#hasta2').datebox('getValue'),
			    });
			};
        	$("#btnExport").click(function(e) {
				window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dg').datagrid('getrows')));
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
