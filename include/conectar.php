<?php
//$link = mysql_connect('localhost', 'meerkat', 'm33rk4t');
//$link = mysql_connect('localhost', 'tejerinae', 'Quequi75');
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('No se puede conectar a la base de datos: ' . mysql_error());
}
//mysql_select_db("tejerinae_mini",$link);
mysql_select_db("meerkat_db",$link);
?>