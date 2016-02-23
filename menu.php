<div class="Menutop"> </div>
<ul id="css3menu1" class="topmenu">
<?php if($_SESSION['rol']==1) { ?>	<li class="topfirst"><a href="abm_afs.php" style="height:18px;line-height:18px;"><span>Activo Fijo</span></a></li><?php } ?>
<?php if($_SESSION['rol']==1) { ?>	<li class="topmenu"><a href="abm_consumibles.php" style="height:18px;line-height:18px;"><span>Consumible</span></a></li><?php } ?>
<?php if($_SESSION['rol']==1) { ?>	<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>ABM's</span></a><?php } ?>
<?php if($_SESSION['rol']==1) { ?>	<ul>
		<li><a href="abm_areas.php">Areas</a></li>
		<li><a href="abm_deptos.php">Departamentos</a></li>
		<li><a href="abm_puestos.php">Puestos</a></li>
		<li><a href="abm_users.php">Usuarios</a></li>
		<li><a href="abm_categs.php">Categorias</a></li>
		<li><a href="abm_proveeds.php">Proveedores</a></li>
	</ul></li> <?php } ?>
	<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span>Informes</span></a>
	<ul>
<?php if($_SESSION['rol']==1 || $_SESSION['rol']==2) { ?>		<li><a href="inf_af.php">AF's existentes</a></li><?php } ?>
<?php if($_SESSION['rol']==1 || $_SESSION['rol']==4) { ?>		<li><a href="inf_con.php">Insumos faltantes</a></li><?php } ?>
<?php if($_SESSION['rol']==1 || $_SESSION['rol']==2) { ?>		<li><a href="inf_af_presu.php">AF's para presupuesto</a></li><?php } ?>
<?php if($_SESSION['rol']==1 || $_SESSION['rol']==3) { ?>		<li><a href="inf_gastos.php">Gastos</a></li><?php } ?>
<?php if($_SESSION['rol']==1 || $_SESSION['rol']==3) { ?>		<li><a href="inf_act.php">Activos Amortizables</a></li><?php } ?>
	</ul></li>
	<li class="toplast"><a href="logout.php" style="height:18px;line-height:18px;">Salir</a></li>
</ul>
