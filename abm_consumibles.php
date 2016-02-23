<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />
	<table id="dg" title="Consumibles" class="easyui-datagrid" style="width:100%;"
			url="modules/consumibles/get_con.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="codigo_cons" width="50">Código</th>
				<th field="desc_cons" width="50">Nombre</th>
				<th field="fechacompra_con" width="50">Fecha Compra</th>
				<th field="desc_categ" width="50">Categoría</th>
				<th field="nombre_prov" width="50">Proveedor</th>
				<th field="costo_cons" width="50">Costo</th>
				<th field="desc_estado" width="50">Estado</th>
				<th field="reciclable_cons" width="25">Reciclable</th>
				<th field="stock_cons" width="50">Cantidad</th>
				<th field="recicla_cons" width="50">En reciclaje</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton new" iconCls="icon-add" plain="true" onclick="newCon()">Nuevo Consumible</a>
		<a href="javascript:void(0)" class="easyui-linkbutton edit" iconCls="icon-edit" plain="true" onclick="editCon()">Editar Consumible</a>
		<a href="javascript:void(0)" class="easyui-linkbutton detail" iconCls="icon-search" plain="true" onclick="verCon()">Ver Detalles</a>
		<a href="javascript:void(0)" class="easyui-linkbutton deposito" iconCls="icon-save" plain="true" onclick="enviarDeposito()">Enviar a Deposito</a>
		<a href="javascript:void(0)" class="easyui-linkbutton asignar" iconCls="icon-redo" plain="true" onclick="asignar()">Asignar Consumible</a>
		<a href="javascript:void(0)" class="easyui-linkbutton baja" iconCls="icon-cancel" plain="true" onclick="darBaja()">Baja de Consumible</a>
		<a href="javascript:void(0)" class="easyui-linkbutton react" iconCls="icon-ok" plain="true" onclick="activar()">Reactivar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton recicla" iconCls="icon-cancel" plain="true" onclick="reciclar()">Reciclar</a>
		<a href="javascript:void(0)" class="easyui-linkbutton compra" iconCls="icon-ok" plain="true" onclick="compra()">Compra</a>
		<a href="javascript:void(0)" class="easyui-linkbutton descartar" iconCls="icon-ok" plain="true" onclick="descartar()">descartar</a>
	</div>
	
	<div id="dlg" class="easyui-dialog"  data-options="top:150" style="width:500px;height:410;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informacion del Consumible</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Cod_con:</label>			
				<input name="cod_cons" class="easyui-textbox" >
			</div>
			<div class="fitem">
				<label>Codigo:</label>			
				<input name="codigo_cons" class="easyui-numberbox" data-options="min:0,max:99999999,precision:0" required="true">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="desc_cons" class="easyui-textbox" required="true">
			</div>
			
			<div class="fitem">
				<label>Fecha de Compra:</label>
				<input name="fechacompra_con" class="easyui-datebox" required="true">
			</div>
		
			<div class="fitem">
				<label>Categoria:</label>
				<input class="easyui-combobox" name="categoria"
					data-options="
						url:'modules/categorias/get_categ_hab_con.php',
						valueField:'cod_categ',
						textField:'desc_categ',
						panelHeight:'auto'
				" required="true">
			</div>
			
			<div class="fitem">
				<label>Costo (pesos):</label>
				<input name="costo_cons" class="easyui-numberbox" data-options="min:0,precision:2" required="true">
			</div>
			
			<div class="fitem">
				<label>Cantidad (unidades):</label>
				<input name="stock_cons" class="easyui-numberbox" data-options="min:0,precision:0" required="true" >
			</div>
			<div class="fitem">
				<label>Reciclable:</label>
				<input name="reciclable_cons" class="easyui-combobox" data-options="
					valueField: 'label',
					textField: 'value',
					data: [{
						label: 'Si',
						value: 'Si'
					},{
						label: 'No',
						value: 'No'
					}],
					panelHeight:'auto'
					" required="true" />
			</div>
			<!--<div class="fitem">
				<label>Reciclable:</label>
				<input name="reciclable_cons" class="easyui-textbox" required="true" />
			</div>-->
			
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
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCon();" style="width:90px">Guardar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('.red').remove();$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
	</div>
		
		<div id="dlgDetalle" class="easyui-dialog" data-options="top:150" style="width:500px;height:600;padding:10px 20px"
			closed="true" buttons="#dlgDetalle-buttons">
		<div class="ftitle">Informacion del Consumible</div>
		<form id="fmDetalle" method="post" novalidate>
			<div class="fitem" hidden>
				<label>Cod_cons:</label>			
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Codigo:</label>			
				<input name="codigo_cons" class="easyui-numberbox" data-options="min:0,max:99999999,precision:0" editable="false">
			</div>
			<div class="fitem">
				<label>Nombre:</label>
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
			
			<div class="fitem">
				<label>Fecha de Compra:</label>
				<input name="fechacompra_con" class="easyui-textbox" editable="false">
			</div>
		
			<div class="fitem">
				<label>Categoria:</label>
				<input name="cod_categ" class="easyui-textbox" editable="false">
			</div>
						
			<div class="fitem">
				<label>Costo (pesos):</label>
				<input name="costo_cons" class="easyui-numberbox" data-options="min:0,precision:2" editable="false">
			</div>
			
			<div class="fitem">
				<label>Stock (unidad):</label>
				<input name="stock_cons" class="easyui-numberbox" data-options="min:0,precision:2" editable="false">
			</div>
						
			<div class="fitem">
				<label>Proveedor:</label>
					<input name="proveedor" class="easyui-textbox" editable="false">
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
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Desea enviar al deposito:</label>
			<div class="fitem">
				<label>Descripción:</label>
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" class="easyui-numberbox" data-options="min:1,precision:0" value="1">
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
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Desea dar de baja:</label>
			<div class="fitem">
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
		</form>
	</div>
	<div id="dlgBaja-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="Baja();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgBaja').dialog('close')" style="width:90px">Cancelar</a>
	</div>

	<div id="dlgRecicle" class="easyui-dialog" data-options="top:150" style="width:400px;height:300;padding:10px 20px"	closed="true" buttons="#dlgRecicle-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmRecicle" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="recicla_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Desea reciclar:</label>
			<div class="fitem">
				<label>Descripción:</label>
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Proveedor:</label>
				<input class="easyui-combobox" name="proveedor"
					data-options="
						url:'modules/proveedores/get_proveed_hab_recicla.php',
						valueField:'cod_prov',
						textField:'nombre_prov',
						panelHeight:'auto'
				" required="true">
			</div>
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" class="easyui-numberbox" data-options="min:1,precision:0" value="1">
			</div>	
		</form>
	</div>
	<div id="dlgRecicle-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aRecicle();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgRecicle').dialog('close')" style="width:90px">Cancelar</a>
	</div>

	<div id="dlgAct" class="easyui-dialog" data-options="top:150" style="width:400px;height:200;padding:10px 20px"	closed="true" buttons="#dlgAct-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmAct" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="recicla_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Desea reactivar:</label>
			<div class="fitem">
				<label>Descripcion:</label>
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" id="cant_act" class="easyui-numberbox" data-options="min:1,precision:0" value="1">
			</div>
			<div class="fitem">
				<label>Accion:</label>
				<input name="accion" class="easyui-combobox" data-options="
					valueField: 'label',
					textField: 'value',
					data: [{
						label: 'Descarta',
						value: 'descartar'
					},{
						label: 'Activar',
						value: 'activar'
					}],
					panelHeight:'auto'
					" required="true" />
			</div>
		</form>
	</div>
	<div id="dlgAct-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aActivar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgAct').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	<div id="dlgAsignar" class="easyui-dialog" data-options="top:150" style="width:400px;height:300;padding:10px 20px"	closed="true" buttons="#dlgAsignar-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmAsignar" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Asiganr a:</label>
			<div class="fitem">
				<label>Departamento:</label>
				<input class="easyui-combobox" id="asig_depto" name="depto_con"
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
				<input class="easyui-combobox" id="asig_user" name="user_con"
					data-options="
						url:'modules/users/get_users_hab.php',
						valueField:'cod_user',
						textField:'nombre_user',
						panelHeight:'auto',
						onSelect:function(row){
								deshabilitar_depto(row)}
				">
			</div>	
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" class="easyui-numberbox" id="cant_asig" data-options="min:1,precision:0" value="1">
			</div>	
		</form>
	</div>
	<div id="dlgAsignar-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aAsignar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgAsignar').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	

	<div id="dlgComprar" class="easyui-dialog" data-options="top:150" style="width:400px;height:300;padding:10px 20px"	closed="true" buttons="#dlgComprar-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmComprar" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Compra de:</label>
				<input name="desc_cons" class="easyui-textbox" editable="true	">
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
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" class="easyui-numberbox" id="cant_asig" data-options="min:1,precision:0" value="1">
			</div>
			<div class="fitem">
				<label>Costo (pesos):</label>
				<input name="costo_cons" class="easyui-numberbox" data-options="min:0,precision:2" editable="true">
			</div>	
		</form>
	</div>
	<div id="dlgComprar-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aComprar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgComprar').dialog('close')" style="width:90px">Cancelar</a>
	</div>
	
	<div id="dlgDescartar" class="easyui-dialog" data-options="top:150" style="width:400px;height:300;padding:10px 20px"	closed="true" buttons="#dlgDescartar-buttons">
		<div class="ftitle">Confirmar</div>
		<form id="fmDescartar" method="post" novalidate>
			<div class="fitem" hidden>
				<input name="cod_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem" hidden>
				<input name="stock_cons" class="easyui-textbox" editable="false">
			</div>
				<label>Desea descartar:</label>
			<div class="fitem">
				<label>Descripción:</label>
				<input name="desc_cons" class="easyui-textbox" editable="false">
			</div>
			<div class="fitem">
				<label>Cantidad:</label>
				<input name="cantidad" class="easyui-numberbox" id="cant_desc" data-options="min:1,precision:0" value="1">
			</div>	
		</form>
	</div>
	<div id="dlgDescartar-buttons">
		<a href="#" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="aDescartar();" style="width:90px">Aceptar</a>
		<a href="javascript:$('.red').remove();void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.red').remove();$('#dlgDescartar').dialog('close')" style="width:90px">Cancelar</a>
	</div>


	<script type="text/javascript">
		function deshabilitar_user(row){
				$('#asig_user').textbox('setValue','');
		}
		function deshabilitar_depto(row){
				$('#asig_depto').textbox('setValue','');
		}
		var url;
		function newCon(){
			$('#dlg').dialog('open').dialog('setTitle','Nuevo Consumible');
			$('#fm').form('clear');
			url = 'modules/consumibles/save_con.php';
		}
		
		function editCon(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Editar Consumible');
				row.proveedor = row.cod_prov;
				row.categoria = row.cod_categ;
				$('#fm').form('load',row);
				url = 'modules/consumibles/update_con.php';
			}
		}
		
		function verCon(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				$('#dlgDetalle').dialog('open').dialog('setTitle','Detalles');
				row.proveedor = row.nombre_prov;
				row.categoria = row.desc_categ;
				$('#fmDetalle').form('load',row);
			}
		}
		function darBaja(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgBaja').dialog('open').dialog('setTitle','Confirmar Baja');
				$('#fmBaja').form('load',row);
				url = 'modules/consumibles/dar_baja.php';
			}
		}	
		function compra(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgComprar').dialog('open').dialog('setTitle','Compra');
				$('#fmComprar').form('load',row);
				url = 'modules/consumibles/compra.php';
			}
		}	
		function activar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgAct').dialog('open').dialog('setTitle','Confirmar Re-Activación');
				$('#fmAct').form('load',row);
				maxi = parseInt(row.recicla_cons);
				$('#cant_act').numberbox({
				    max:maxi
				});
				url = 'modules/consumibles/activar.php';
			}
		}		
			
		function descartar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgDescartar').dialog('open').dialog('setTitle','Confirmar Descarte');
				$('#fmDescartar').form('load',row);
				maxi = parseInt(row.stock_cons);
				$('#cant_desc').numberbox({
				    max:maxi
				});
				url = 'modules/consumibles/descartar.php';
			}
		}		
			
		function reciclar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgRecicle').dialog('open').dialog('setTitle','Confirmar Reciclaje');
				$('#fmRecicle').form('load',row);
				url = 'modules/consumibles/reciclar.php';
			}
		}		
		function asignar(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				console.log(row);
				$('#dlgAsignar').dialog('open').dialog('setTitle','Asignar');
				$('#fmAsignar').form('load',row);
				maxi = parseInt(row.stock_cons);
				$('#cant_asig').numberbox({
				    max:maxi
				});
				url = 'modules/consumibles/asignar.php';
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
            }catch(e){console.log(e)}
		}
		function aComprar(){
            try{
			$('#fmComprar').form('submit',{
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
						$('#dlgComprar').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e)}
		}

		function aDescartar(){
            try{
			$('#fmDescartar').form('submit',{
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
						$('#dlgDescartar').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e)}
		}
		function aRecicle(){
            try{
			$('#fmRecicle').form('submit',{
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
						$('#dlgRecicle').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e)}
		}
		function enviarDeposito(){
			var row =$('#dg').datagrid('getSelected');
			if (row){
				$('#dlgDeposito').dialog('open').dialog('setTitle','Confirmar');
				$('#fmDeposito').form('load',row);
				url = 'modules/consumibles/enviar_deposito.php';
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
					console.log(result);
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
            }catch(e){console.log(e)}
		}			
		function aActivar(){
            try{
			$('#fmAct').form('submit',{
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
						$('#dlgAct').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');
					}
				}
            });
            }catch(e){console.log(e)}
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
            }catch(e){console.log(e)}
		}
		function saveCon(){
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
						// close the dialog
						$('#dlg').dialog('close');	
						$('.red').remove();
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
            });
            }catch($e){console.log($e);}
		}
		$('#dg').datagrid({
		    onClickRow: function(index,row){
		    	$('#toolbar').find('.edit').attr('onclick', 'editCon()');
				$('#toolbar').find('.new').attr('onclick', 'newCon()');
				$('#toolbar').find('.detail').attr('onclick', 'verCon()');
				$('#toolbar').find('.asignar').attr('onclick', 'asignar()');
				$('#toolbar').find('.descartar').attr('onclick', 'descartar()');
				$('#toolbar').find('.recicla').attr('onclick', 'reciclar()');
				$('#toolbar').find('.compra').attr('onclick', 'compra()');
				$('#toolbar').find('.react').attr('onclick', 'activar()');
				$('#toolbar').find('.baja').attr('onclick', 'darBaja()');
				$('#toolbar').find('.deposito').attr('onclick', 'enviarDeposito()');
		    	$('#toolbar').find('a').css('cursor', 'pointer');
		    	$('#toolbar').find('a').css('opacity', 1);
		  
		    	
		    	if(row.cod_estado==5) {
		    		$('#toolbar').find('.service').removeAttr("onclick"),
		    		$('#toolbar').find('.service').css('cursor', 'default');
		    		$('#toolbar').find('.service').css('opacity', 0.5);
		    		$('#toolbar').find('.react').attr('onclick', 'activar()');
		    		$('#toolbar').find('.react').css('cursor', 'pointer');
		    		$('#toolbar').find('.react').css('opacity', 1);
		    	}
		    	if(row.cod_estado==6) {
		    		$('#toolbar').find('.asignar').removeAttr("onclick"),
		    		$('#toolbar').find('.asignar').css('cursor', 'default');
		    		$('#toolbar').find('.asignar').css('opacity', 0.5);
		    		$('#toolbar').find('.deposito').removeAttr("onclick"),
		    		$('#toolbar').find('.deposito').css('cursor', 'default');
		    		$('#toolbar').find('.deposito').css('opacity', 0.5);
		    		$('#toolbar').find('.baja').removeAttr("onclick"),
		    		$('#toolbar').find('.baja').css('cursor', 'default');
		    		$('#toolbar').find('.baja').css('opacity', 0.5);
		    		$('#toolbar').find('.recicla').removeAttr("onclick"),
		    		$('#toolbar').find('.recicla').css('cursor', 'default');
		    		$('#toolbar').find('.recicla').css('opacity', 0.5);
		    		$('#toolbar').find('.react').removeAttr("onclick"),
		    		$('#toolbar').find('.react').css('cursor', 'default');
		    		$('#toolbar').find('.react').css('opacity', 0.5);
		    		$('#toolbar').find('.compra').removeAttr("onclick"),
		    		$('#toolbar').find('.compra').css('cursor', 'default');
		    		$('#toolbar').find('.compra').css('opacity', 0.5);
		    		$('#toolbar').find('.descartar').removeAttr("onclick"),
		    		$('#toolbar').find('.descartar').css('cursor', 'default');
		    		$('#toolbar').find('.descartar').css('opacity', 0.5);
		    		$('#toolbar').find('.edit').removeAttr("onclick"),
		    		$('#toolbar').find('.edit').css('cursor', 'default');
		    		$('#toolbar').find('.edit').css('opacity', 0.5);
		    		//$('#toolbar').find('.deposito').hide();
		    	}
		    	if(row.recicla_cons<=0){
		    		$('#toolbar').find('.react').removeAttr("onclick"),
		    		$('#toolbar').find('.react').css('cursor', 'default');
		    		$('#toolbar').find('.react').css('opacity', 0.5);
		    	}
		        if(row.reciclable_cons!='Si'){
		        	$('#toolbar').find('.recicla').removeAttr("onclick"),
		    		$('#toolbar').find('.recicla').css('cursor', 'default');
		    		$('#toolbar').find('.recicla').css('opacity', 0.5);
		        }
		    }
		});
	$(document).ready(function() {
		$('#toolbar').find('a').removeAttr("onclick"),
	    $('#toolbar').find('a').css('cursor', 'default');
	    $('#toolbar').find('a').css('opacity', 0.5);
		$('#toolbar').find('.new').attr('onclick', 'newCon()');
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
