<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Actvos Fijos" class="easyui-datagrid" style="width:100%;"
			url="modules/afs/get_afs_asig.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="codigo_af" width="50">Código</th>
				<th field="Nombre_af" width="50">Nombre</th>
				<th field="desc_categ" width="50">Categoría</th>
				<th field="desc_estado" width="50">Estado</th>
				<th field="asignado" width="50">Asignado</th>
			</tr>
		</thead>
	</table>
		<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newAf()">Asignar Activo Fijo</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editAf()">Reasignar Activo Fijo</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="enviarDeposito()">Liberar Activo Fijo</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:600;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Activo Fijo</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Cod_af:</label>			
				<input name="cod_af" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Codigo:</label>			
				<input name="codigo_af" class="easyui-numberbox" data-options="min:0,max:99999999,precision:0" required="true">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="Nombre_af" class="easyui-textbox" required="true">
			</div>
			
			<div class="fitem">
				<label>Fecha de Compra:</label>
				<input name="fechacompra_af" class="easyui-datebox" required="true">
			</div>
		
			<div class="fitem">
				<label>Categoria:</label>
				<input class="easyui-combobox" name="categoria"
					data-options="
						url:'modules/categorias/get_categ_hab_af.php',
						valueField:'cod_categ',
						textField:'desc_categ',
						panelHeight:'auto'
				" required="true">
			</div>
			
			<div class="fitem">
				<label>Garantía (años):</label>
				<input name="garantia_af" class="easyui-numberbox" data-options="min:0,precision:0" required="true">
			</div>
			
			<div class="fitem">
				<label>Costo (pesos):</label>
				<input name="costo_af" class="easyui-numberbox" data-options="min:0,precision:2" required="true">
			</div>
			
			<div class="fitem">
				<label>S/N</label>
				<input name="nroserie_af" class="easyui-textbox" required="true">
			</div>			
			
			<div class="fitem">
				<label>Hardware:</label><br/>
				<textarea name="hardware_af" maxlength="255" style="overflow:auto;resize:none" rows="13" cols="50" required="true"></textarea>
			</div>
			
			<div class="fitem">
				<label>Proveedor:</label>
				<input class="easyui-combobox" name="proveedor"
					data-options="
						url:'modules/proveedores/get_proveed_hab.php',
						valueField:'cod_prov',
						textField:'nombre_prov',
						panelHeight:'auto'
				" required="true">
			</div>	
	
	
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveAf();" style="width:90px">Guardar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
		

	<div id="dlgDeposito" class="easyui-dialog" style="width:400px;height:200;padding:10px 20px"
			closed="true" buttons="#dlgDeposito-buttons">
	

	<div class="ftitle">Confirmar</div>
		<form id="fmDeposito" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
				<label>Desea enviar al deposito:</label>
			<div class="fitem">
				<input name="Nombre_af" class="easyui-textbox" editable="false">
			</div>
		</form>
	</div>
	<div id="dlgDeposito-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aDeposito();" style="width:90px">Aceptar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgDeposito').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	<script type="text/javascript">
		var url;
		function newAf(){
			$('#dlg').dialog('open').dialog('setTitle','Nuevo Activo Fijo');
			$('#fm').form('clear');
			url = 'modules/afs/save_af.php';
		}
		
		function editAf(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Activo Fijo');
				row.proveedor = row.cod_prov;
				row.categoria = row.cod_categ;
				$('#fm').form('load',row);
				url = 'modules/afs/update_af.php';
			}
		}

		function enviarDeposito(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				$('#dlgDeposito').dialog('open').dialog('setTitle','Confirmar');
				$('#fmDeposito').form('load',row);
				url = 'modules/afs/enviar_deposito.php';
			}
		}		
					
		function aDeposito(){
            try{
			$('#fmDeposito').form('submit',{
				url: url,
                onSubmit: function(){
					//return $(this).form('validate');
				},
				success: function(result){
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlgDeposito').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e.message())}
		}
		function saveAf(){
            try{
			$('#fm').form('submit',{
				url: url,
                onSubmit: function(){
					//return $(this).form('validate');
				},
				success: function(result){
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						// close the dialog
						$('#dlg').dialog('close');		
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
            });
            }catch(e){console.log(e.message())}
		}
	
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
