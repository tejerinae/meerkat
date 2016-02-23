<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Usuarios" class="easyui-datagrid" style="width:100%;"
			url="modules/perfiles/get_perfiles.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nombre_perf" width="50">Nombre</th>
				<th field="desc_perf" width="50">Descripcion</th>
				<th field="desc_estado" width="50">Estado</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<!--<a href="javascript:void(0)" class="easyui-linkbutton new" iconCls="icon-add" plain="true" onclick="newArea()">Nuevo Perfil</a>-->
		<a href="javascript:void(0)" class="easyui-linkbutton edit" iconCls="icon-edit" plain="true" onclick="editArea()">Editar/Deshabilitar Perfil</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Perfil</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Codigo:</label>			
				<input name="cod_perf" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="nombre_perf" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Descripcion:</label>
				<input name="desc_perf" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Estado:</label>
				<input class="easyui-combobox" name="estado"
					data-options="
						url:'modules/estados/get_estados.php',
						valueField:'cod_estado',
						textField:'desc_estado',
						panelHeight:'auto'
				" required="true">
			</div>	
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveArea();" style="width:90px">Guardar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	<script type="text/javascript">
		var url;
		function newArea(){
			$('#dlg').dialog('open').dialog('setTitle','Nuevo Puesto');
			$('#fm').form('clear');
			url = 'modules/perfiles/save_perfil.php';
		}
		function editArea(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Departamento');
				row.estado = row.cod_estado;
				$('#fm').form('load',row);
				url = 'modules/perfiles/update_perfil.php';
			}
		}
		function saveArea(){
            try{
			$('#fm').form('submit',{
				url: url,
                onSubmit: function(){
                	if(!validate($(this))) return false;
				},
				success: function(result){
					console.log(result);
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
            });
            }catch(e){console.log(e.message())}
		}
		$('#dg').datagrid({
		    onClickRow: function(index,row){
		    	$('#toolbar').find('.edit').attr('onclick', 'editArea()');
		    	$('#toolbar').find('a').css('cursor', 'pointer');
		    	$('#toolbar').find('a').css('opacity', 1);               
		    }
		});
		$(document).ready(function() {
			$('#toolbar').find('.edit').removeAttr("onclick"),
	    	$('#toolbar').find('.edit').css('cursor', 'default');
	    	$('#toolbar').find('.edit').css('opacity', 0.5);
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
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
<?php
require_once("include/footer.php");
?>
