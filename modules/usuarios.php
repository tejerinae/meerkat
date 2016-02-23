<?php
class usuarios {
		 var  $sid;
		 var  $login_usr;
		 var  $contrasena;
		 var  $nombre;
	 
	 function login () {
		$usu	= mysql_real_escape_string($this->login_usr);
		$pass	= md5(mysql_real_escape_string($this->contrasena));
		$sql	=	"SELECT * FROM usuarios WHERE login_user='".$usu."' AND pass_user='".$pass."' AND cod_estado=1";
		$result	=	mysql_query($sql);
			//si no me devuelve nada es porque no existe el usuario, devuelve 1 y sale
		if (!mysql_num_rows($result)) return 1;
			//sino, si existe el usuario, me arma el array y asigna los privilegios
		$resul			=	mysql_fetch_array($result);
		$this->nombre	=	$resul['nombre_user'];
		$this->sid		=	$resul['cod_user'];
		$this->rol		=	$resul['cod_perf'];
		return $resul;
	}
}
?>
