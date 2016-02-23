<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Proveedores" class="easyui-datagrid" style="width:100%;"
			url="modules/proveedores/get_proveeds.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nombre_prov" width="50">Nombre</th>
				<th field="tel_prov" width="50">Telefono</th>
				<th field="mail_prov" width="50">E-mail</th>
				<th field="contacto_prov" width="50">Contacto</th>
				<th field="recicla_prov" width="50">Recicla</th>
				<th field="desc_estado" width="50">Estado</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton new" iconCls="icon-add" plain="true" onclick="newArea()">Nuevo Proveedor</a>
		<a href="javascript:void(0)" class="easyui-linkbutton edit" iconCls="icon-edit" plain="true" onclick="editArea()">Editar/Deshabilitar Proveedor</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:375;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Usuario</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Codigo:</label>			
				<input name="cod_prov" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="nombre_prov" class="easyui-textbox" required="true">
			</div>
			
			<div class="fitem">
				<label>Telefono:</label>
				<input name="tel_prov" class="easyui-textbox" required="true">
			</div>
		
			<div class="fitem">
				<label>E-mail:</label>
				<input name="mail_prov" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Contacto:</label>
				<input name="contacto_prov" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Recicla?:</label>
				<select class="easyui-combobox" name="recicla" required="true" style="width:60px;"  data-options="panelHeight:'auto'">
				<option value="S">Si</option>
				<option value="N">No</option>
				</select>
			</div>
		
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveArea();" style="width:90px">Guardar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	<div id="dlgEdit" class="easyui-dialog" style="width:400px;height:375;padding:10px 20px"
			closed="true" buttons="#dlgEdit-buttons">
		<div class="ftitle">Informacion del Usuario</div>
		<form id="fmEd" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Codigo:</label>			
				<input name="cod_prov" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="nombre_prov" class="easyui-textbox" required="true">
			</div>
			
			<div class="fitem">
				<label>Telefono:</label>
				<input name="tel_prov" class="easyui-textbox" required="true">
			</div>
		
			<div class="fitem">
				<label>E-mail:</label>
				<input name="mail_prov" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Contacto:</label>
				<input name="contacto_prov" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Recicla?:</label>
				<select class="easyui-combobox" name="recicla" required="true" style="width:60px;"  data-options="panelHeight:'auto'">
				<option value="S">Si</option>
				<option value="N">No</option>
				</select>
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
	<div id="dlgEdit-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveEArea();" style="width:90px">Guardar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgEdit').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	<script type="text/javascript">
		var url;
		function newArea(){
			$('#dlg').dialog('open').dialog('setTitle','Nuevo Proveedor');
			$('#fm').form('clear');
			url = 'modules/proveedores/save_proveed.php';
		}
		function editArea(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlgEdit').dialog('open').dialog('setTitle','Editar Proveedor');
				row.recicla = row.recicla_prov;
                row.estado = row.cod_estado;
				$('#fmEd').form('load',row);
				url = 'modules/proveedores/update_proveed.php';
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
		
		function saveEArea(){
            try{
			$('#fmEd').form('submit',{
				url: url,
                onSubmit: function(){
                	if(!validate($(this))) return false;
				},
				success: function(result){
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlgEdit').dialog('close');		// close the dialog
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
