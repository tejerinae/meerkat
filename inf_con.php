<?php
require_once('validacion.php'); 
require_once("include/header.php");
require_once("menu.php");?>
	<br /> <br /> <br />

	<table id="dg" title="Insumos Faltantes" style="width:100%;" style="width:100%;"	toolbar="#toolbar" >
		<thead>
			<tr>
				<th field="cod_cons" width="50">Código</th>
				<th field="desc_cons" width="50">Nombre</th>
				<th field="stock_cons" width="50">Cantidad</th>
				<th field="desc_categ" width="50">Categoria</th>
				<th field="ptopedido_categ" width="50">Stock minimo</th>
				<th field="nombre_prov" width="50">Proveedor</th>
				<th field="resta" width="50">Comprar</th>
			</tr>
		</thead>
	</table>
	<!--<div id="toolbar">
		<a href="" id="btnExport" class="easyui-linkbutton new" iconCls="icon-add" plain="true">Exportar</a>
	</div>-->
	
    <script type="text/javascript">
        $(function(){
        	var dg = $('#dg').datagrid({
                url: 'modules/consumibles/get_con_inf.php',
                pagination: true,
                rownumbers: true,
                fitColumns:true,
                singleSelect:true
            });
            dg.datagrid('enableFilter', [{
                field:'desc_categ',
                type:'combobox',
                options:{
                    panelHeight:'auto',
                	url:'modules/categorias/get_categ_hab_con_combo.php',
					valueField:'cod_categ',
					textField:'desc_categ',
                    onChange:function(value){
                        if (value == ''){
                            dg.datagrid('removeFilterRule', 'cod_categ');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'cod_categ',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                        console.log(value);
                    }
                }
            }]);
            
        	$("#btnExport").click(function(e) {
				window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dg').html()));
				e.preventDefault(); 
			});

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
