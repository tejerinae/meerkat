<?php
?>
<html>
<head>
<title>Meerkat - Make IT Simple!</title>
<meta charset="UTF-8" />
<meta name="Designer" content="Coen - Salcedo - Hernandez">
<meta name="Author" content="Coen - Salcedo - Hernandez">
<link rel="stylesheet" type="text/css" href="include/meerkat.css" />
<link rel="stylesheet" type="text/css" href="include/menu.css" />
<link rel="stylesheet" type="text/css" href="include/easyui.css">
<link rel="stylesheet" type="text/css" href="include/icon.css">
<link rel="stylesheet" type="text/css" href="include/color.css">
<link rel="stylesheet" type="text/css" href="include/demo.css">
<!--<script type="text/javascript" src="include/jquery-1.6.min.js"></script>-->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js "></script>
<script type="text/javascript" src="include/jquery.easyui.min.js"></script>
<script type="text/javascript" src="include/datagrid-filter.js"></script>
<style type="text/css">._css3m{display:none}body {
	color: #009900;
}</style>
<script type="text/javascript">
		function validate(form){
			fail=false;
			$('.red').remove();
			form.find(':input').each(function(){
			    if(!$(this).attr('required')){
			        //console.log($(this)); 
			    } else {
					if($(this).hasClass('easyui-combobox') && $(this).combobox('getValue')==''){
						fail = true;
			        	console.log($(this)); 
	                    $(this).next().after('<div class="red" style="color:red">Debe ingresar este dato</div>');
	                } else if($(this).hasClass('easyui-datebox') && $(this).datebox('getValue')==''){
						fail = true;
			        	console.log($(this)); 
	                    $(this).next().after('<div class="red" style="color:red">Debe ingresar este dato</div>');
	                } else if(!$(this).hasClass('easyui-combobox') && !$(this).hasClass('easyui-datebox') && !$(this).val()){
	                	fail = true;
			        	console.log($(this)); 
	                    $(this).next().after('<div class="red" style="color:red">Debe ingresar este dato</div>');
	               
	                } 					
			    }
			});
			if ( fail ) {
				return false;
	        } else {
	        	return true;
	        }
		}
</script>
</head>
<body>
<?php

?>