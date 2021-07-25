<?php
// Libreria de conexión
include_once('./adodb/adodb.inc.php');

$servidor_  = 'localhost';
$usuariobd_ = 'user_kardex';
$password_  = '123';
$base_      = 'kardex';

$_SESSION["servidor_bd"]  = $servidor_;
$_SESSION["usuario_bd"]   = $usuariobd_;
$_SESSION["password_bd"]  = $password_;
$_SESSION["nombre_bd"]    = $base_;

$ADODB_FORCE_TYPE=0;
$db = ADONewConnection('mysqli');

if(($db->Connect($_SESSION["servidor_bd"], $_SESSION["usuario_bd"], $_SESSION["password_bd"], $_SESSION["nombre_bd"]))==NULL):
	echo "
	<br><br>Hubo un error al intentar la conexion con el servidor de Bases de Datos.
	<br><br>Verifique los previlegios, usuario y contraseña en MySQl (phpMyAdmin).
	<br><br>Verifique el nombre de usuario, base y contraseña en el archivo de conexión.
	<br><br>";
	exit;
endif;
$db->SetFetchMode(ADODB_FETCH_NUM);
$db->setCharset('utf8');
?>
