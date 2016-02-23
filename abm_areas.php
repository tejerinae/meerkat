<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Areas" class="easyui-datagrid" style="width:100%;"
			url="modules/areas/get_areas.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="des_area" width="50">Descripcion</th>
				<th field="desc_estado" width="50">Estado</th>
				<th field="nombre_user" width="50">Responsable</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton new" iconCls="icon-add" plain="true" onclick="newArea()">Nueva Area</a>
		<a href="javascript:void(0)" class="easyui-linkbutton edit" iconCls="icon-edit" plain="true" onclick="editArea()">Editar/Deshabilitar Area</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Area</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Codigo:</label>
				<input name="cod_area" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Descripcion:</label>
				<input name="des_area" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Responsable:</label>
				<input class="easyui-combobox" name="user"
					data-options="
						url:'modules/users/get_users_hab.php',
						valueField:'cod_user',
						textField:'nombre_user',
						panelHeight:'auto'
				" required="true">
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveArea();" style="width:90px">Guardar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	<div id="dlgEdit" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlgEdit-buttons">
		<div class="ftitle">Informacion del Area</div>
		<form id="fmEd" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Codigo:</label>
				<input name="cod_area" class="easyui-textbox">
			</div>
			<div class="fitem">
				<label>Descripcion:</label>
				<input name="des_area" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Responsable:</label>
				<input class="easyui-combobox" name="user"
					data-options="
						url:'modules/users/get_users_hab.php',
						valueField:'cod_user',
						textField:'nombre_user',
						panelHeight:'auto'
				" required="true">
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
			$('#dlg').dialog('open').dialog('setTitle','Nueva Area');
			$('#fm').form('clear');
			url = 'modules/areas/save_area.php';
		}
		function editArea(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlgEdit').dialog('open').dialog('setTitle','Editar Area');
                // te agrego estos porque el objeto row tiene que tener los 
                // elementos con los mismos nombres que el input type del html
                // sino no te los llena
                row.user = row.cod_user;
                row.estado = row.cod_estado;
                // console.log(row);
				$('#fmEd').form('load',row);
				url = 'modules/areas/update_area.php';
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
