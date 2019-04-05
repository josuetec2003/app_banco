<?php
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DBNM', 'banco_db');

	// mysql (obsoleta por cuestiones de seguridad)
	// mysqli * (estructurada, orientada a objetos) consultas prepardas
	// pdo

	$cnn = new mysqli(HOST, USER, PASS, DBNM);
	$cnn->set_charset('utf8');

	if ($cnn->connect_errno)
	{
		die('Error de conexion: ' . $cnn->connect_errno);
	}
?>