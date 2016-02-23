<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Actvos Fijos" class="easyui-datagrid" style="width:100%;"
			url="modules/afs/get_afs.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="codigo_af" width="50">Código</th>
				<th field="Nombre_af" width="50">Nombre</th>
				<th field="fechacompra_af" width="50">Fecha Compra</th>
				<th field="desc_categ" width="50">Categoría</th>
				<th field="nombre_prov" width="50">Proveedor</th>
				<th field="costo_af" width="50">Costo</th>
				<th field="desc_estado" width="50">Estado</th>
				<th field="desc_depto" width="50">Ubicación</th>
				<th field="nombre_user" width="50">Asignado a</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton new" iconCls="icon-add" plain="true" onclick="newAf()">Nuevo Activo Fijo</a>
		<a href="javascript:void(0)" class="easyui-linkbutton edit" iconCls="icon-edit" plain="true" onclick="editAf()">Editar Activo Fijo</a>
		<a href="javascript:void(0)" class="easyui-linkbutton detail" iconCls="icon-search" plain="true" onclick="verAf()">Ver Detalles</a>
		<a href="javascript:void(0)" class="easyui-linkbutton deposito" iconCls="icon-save" plain="true" onclick="enviarDeposito()">Enviar a Deposito</a>
		<a href="javascript:void(0)" class="easyui-linkbutton asignar" iconCls="icon-redo" plain="true" onclick="asignar()">Asignar A.F.</a>
		<a href="javascript:void(0)" class="easyui-linkbutton service" iconCls="icon-clear" plain="true" onclick="service()">Enviar a Service</a>
		<a href="javascript:void(0)" class="easyui-linkbutton baja" iconCls="icon-cancel" plain="true" onclick="darBaja()">Dar de Baja A.F.</a>
		<a href="javascript:void(0)" class="easyui-linkbutton react" iconCls="icon-ok" plain="true" onclick="activar()">Reactivar A.F.</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" data-options="top:150" style="width:500px;height:610;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Activo Fijo</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Cod_af:</label>			
				<input name="cod_af" class="easyui-textbox" >
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
				<a href="abm_proveeds.php" style="position:relative; top:2px"><img src="iconos/mini_add.png" height="12"></a>
			</div>
			<div class="fitem" style="display:none">
				<label>Departamento:</label>
				<input class="easyui-combobox" name="depto_af"
					data-options="
						url:'modules/deptos/get_deptos_hab.php',
						valueField:'cod_depto',
						textField:'desc_depto',
						panelHeight:'auto'
				" >
			</div>	
			<div class="fitem" style="display:none">
				<label>Asignado a:</label>
				<input class="easyui-combobox" name="user_af"
					data-options="
						url:'modules/users/get_user_hab.php',
						valueField:'cod_user',
						textField:'nombre_user',
						panelHeight:'auto'
				" >
			</div>	
	
	
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveAf();" style="width:90px">Guardar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
		
		<div id="dlgDetalle" class="easyui-dialog" data-options="top:150" style="width:500px;height:600;padding:10px 20px"
			closed="true" buttons="#dlgDetalle-buttons">
		<div class="ftitle">Informacion del Activo Fijo</div>
		<form id="fmDetalle" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Cod_af:</label>			
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Codigo:</label>			
				<input name="codigo_af" class="easyui-numberbox" data-options="min:0,max:99999999,precision:0" editable="false">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="Nombre_af" class="easyui-textbox" editable="false">
			</div>
			
			<div class="fitem">
				<label>Fecha de Compra:</label>
				<input name="fechacompra_af" class="easyui-textbox" editable="false">
			</div>
		
			<div class="fitem">
				<label>Categoria:</label>
				<input name="categoria" class="easyui-textbox" editable="false">
			</div>
			
			<div class="fitem">
				<label>Garantía (años):</label>
				<input name="garantia_af" class="easyui-numberbox" data-options="min:0,precision:0" editable="false">
			</div>
			
			<div class="fitem">
				<label>Costo (pesos):</label>
				<input name="costo_af" class="easyui-numberbox" data-options="min:0,precision:2" editable="false">
			</div>
			
			<div class="fitem">
				<label>S/N</label>
				<input name="nroserie_af" class="easyui-textbox" editable="false">
			</div>			
			
			<div class="fitem">
				<label>Hardware:</label><br/>
				<textarea name="hardware_af" maxlength="255" style="overflow:auto;resize:none" rows="13" cols="50" readonly></textarea>
			</div>
			
			<div class="fitem">
				<label>Proveedor:</label>
					<input name="proveedor" class="easyui-textbox" editable="false">
			</div>
			
			<div class="fitem">
				<label>Departamento:</label>
					<input name="depto_af" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Asigando a:</label>
					<input name="nombre_user" class="easyui-textbox" editable="false">
			</div>	
	
	
		</form>
	</div>
	<div id="dlgDetalle-buttons">
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:$('.red').remove();$('#dlgDetalle').dialog('close')" style="width:90px">Aceptar</a>
	</div>

	<div id="dlgDeposito" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px"
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
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgDeposito').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	<div id="dlgBaja" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px" closed="true" buttons="#dlgBaja-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmBaja" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
				<label>Desea dar de baja:</label>
			<div class="fitem">
				<input name="Nombre_af" class="easyui-textbox" editable="false">
			</div>
		</form>
	</div>
	<div id="dlgBaja-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="Baja();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgBaja').dialog('close')" style="width:90px">Cancelar</a>
	</div>

	<div id="dlgService" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px"	closed="true" buttons="#dlgService-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmService" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
				<label>Desea enviar a Service:</label>
			<div class="fitem">
				<label>Descripción:</label>
				<input name="Nombre_af" class="easyui-textbox" editable="false">
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
				<a href="abm_proveeds.php" style="position:relative; top:2px"><img src="iconos/mini_add.png" height="12"></a>
			</div>
		</form>
	</div>
	<div id="dlgService-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aService();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgService').dialog('close')" style="width:90px">Cancelar</a>
	</div>

	<div id="dlgAct" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px"	closed="true" buttons="#dlgAct-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmAct" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
				<label>Desea reactivar:</label>
			<div class="fitem">
				<input name="Nombre_af" class="easyui-textbox" editable="false">
			</div>
		</form>
	</div>
	<div id="dlgAct-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aActivar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgAct').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	<div id="dlgAsignar" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px"	closed="true" buttons="#dlgAsignar-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmAsignar" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_af" class="easyui-textbox" editable="false">
			</div>
				<label>Asiganr a:</label>
			<div class="fitem">
				<label>Departamento:</label>
				<input class="easyui-combobox" id="asig_depto" name="depto_af"
					data-options="
						url:'modules/deptos/get_deptos_users_hab.php',
						valueField:'cod_depto',
						textField:'desc_depto',
						panelHeight:'auto',
						onSelect:function(row){
								deshabilitar_user(row)}
				" >
			</div>
			<div class="fitem">
				<label>Usuario:</label>
				<input class="easyui-combobox" id="asig_user" name="user_af"
					data-options="
						url:'modules/users/get_users_hab.php',
						valueField:'cod_user',
						textField:'nombre_user',
						panelHeight:'auto',
						onSelect:function(row){
								deshabilitar_depto(row)}
				">
			</div>	
		</form>
	</div>
	<div id="dlgAsignar-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aAsignar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgAsignar').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	
	<script type="text/javascript">

		function deshabilitar_user(row){
				//$('#asig_user').textbox('readonly',true);
				$('#asig_user').textbox('setValue','');/*
			}else { 
				$('#vidautil_categ').textbox('readonly',false);
				$('#vidautil_categ').textbox('clear');			
				$('#ptopedido_categ').textbox('readonly',true);
				$('#ptopedido_categ').textbox('setValue','0');
			}*/
		}
		function deshabilitar_depto(row){
				//$('#asig_depto').textbox('readonly',true);
				$('#asig_depto').textbox('setValue','');
		}
		
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
				row.depto_af = row.depto_af;
				$('#fm').form('load',row);
				url = 'modules/afs/update_af.php';
			}
		}
		
		function verAf(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				$('#dlgDetalle').dialog('open').dialog('setTitle','Detalles');
				row.proveedor = row.nombre_prov;
				row.categoria = row.desc_categ;
				row.depto_af = row.desc_depto;
				$('#fmDetalle').form('load',row);
			}
		}
		function darBaja(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgBaja').dialog('open').dialog('setTitle','Confirmar Baja');
				$('#fmBaja').form('load',row);
				url = 'modules/afs/dar_baja.php';
			}
		}	
		function service(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgService').dialog('open').dialog('setTitle','Confirmar Service');
				$('#fmService').form('load',row);
				url = 'modules/afs/service.php';
			}
		}	
		function activar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgAct').dialog('open').dialog('setTitle','Confirmar Re-Activación');
				$('#fmAct').form('load',row);
				url = 'modules/afs/activar.php';
			}
		}		
			
		function asignar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);		  
				$('#dlgAsignar').dialog('open').dialog('setTitle','Asignar');
				$('#fmAsignar').form('load',row);
				url = 'modules/afs/asignar.php';
			}
		}		
					
		function Baja(){
            try{
			$('#fmBaja').form('submit',{
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
						$('#dlgBaja').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e.message())}
		}
		function aService(){
            try{
			$('#fmService').form('submit',{
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
						$('#dlgService').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e.message())}
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
                	if(!validate($(this))) return false;
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
		function aActivar(){
            try{
			$('#fmAct').form('submit',{
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
						$('#dlgAct').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e.message())}
		}			
		function aAsignar(){
            try{
			$('#fmAsignar').form('submit',{
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
						$('#dlgAsignar').dialog('close');		// close the dialog
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
                	if(!validate($(this))) return false;
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
		$('#dg').datagrid({
		    onClickRow: function(index,row){
		    	$('#toolbar').find('.edit').attr('onclick', 'editAf()');
				$('#toolbar').find('.new').attr('onclick', 'newAf()');
				$('#toolbar').find('.detail').attr('onclick', 'verAf()');
				$('#toolbar').find('.asignar').attr('onclick', 'asignar()');
				$('#toolbar').find('.service').attr('onclick', 'service()');
				$('#toolbar').find('.deposito').attr('onclick', 'enviarDeposito()');
		    	$('#toolbar').find('a').css('cursor', 'pointer');
		    	$('#toolbar').find('a').css('opacity', 1);
		    	$('#toolbar').find('.react').removeAttr("onclick");
		    	$('#toolbar').find('.react').css('cursor', 'default');
		    	$('#toolbar').find('.react').css('opacity', 0.5);

		    	if(row.cod_estado==3) {
		    		$('#toolbar').find('.deposito').removeAttr("onclick"),
		    		$('#toolbar').find('.deposito').css('cursor', 'default');
		    		$('#toolbar').find('.deposito').css('opacity', 0.5);
		    		//$('#toolbar').find('.deposito').hide();
		    	}
		    	if(row.cod_estado==5) {
		    		$('#toolbar').find('.service').removeAttr("onclick");
		    		$('#toolbar').find('.service').css('cursor', 'default');
		    		$('#toolbar').find('.service').css('opacity', 0.5);
		    		$('#toolbar').find('.react').attr('onclick', 'activar()');
		    		$('#toolbar').find('.react').css('cursor', 'pointer');
		    		$('#toolbar').find('.react').css('opacity', 1);
		    		$('#toolbar').find('.asignar').removeAttr("onclick"),
		    		$('#toolbar').find('.asignar').css('cursor', 'default');
		    		$('#toolbar').find('.asignar').css('opacity', 0.5);
		    	} 
		    	if(row.cod_estado==6) {
		    		$('#toolbar').find('.baja').removeAttr("onclick");
		    		$('#toolbar').find('.baja').css('cursor', 'default');
		    		$('#toolbar').find('.baja').css('opacity', 0.5);
		    		$('#toolbar').find('.asignar').removeAttr("onclick"),
		    		$('#toolbar').find('.asignar').css('cursor', 'default');
		    		$('#toolbar').find('.asignar').css('opacity', 0.5);
		    		$('#toolbar').find('.service').removeAttr("onclick"),
		    		$('#toolbar').find('.service').css('cursor', 'default');
		    		$('#toolbar').find('.service').css('opacity', 0.5);
		    		$('#toolbar').find('.deposito').removeAttr("onclick"),
		    		$('#toolbar').find('.deposito').css('cursor', 'default');
		    		$('#toolbar').find('.deposito').css('opacity', 0.5);
		    		$('#toolbar').find('.edit').removeAttr("onclick"),
		    		$('#toolbar').find('.edit').css('cursor', 'default');
		    		$('#toolbar').find('.edit').css('opacity', 0.5);
		    		//$('#toolbar').find('.deposito').hide();
		    	}          
		    }
		});
		$(document).ready(function() {
			$('#toolbar').find('a').removeAttr("onclick");
		    $('#toolbar').find('a').css('cursor', 'default');
		    $('#toolbar').find('a').css('opacity', 0.5);
			$('#toolbar').find('.new').attr('onclick', 'newAf()');
	    	$('#toolbar').find('.new').css('cursor', 'pointer');
	    	$('#toolbar').find('.new').css('opacity', 1);
	  		// Instrucciones a ejecutar al terminar la carga
			
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
