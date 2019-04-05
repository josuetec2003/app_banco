<?php
	$name  = $_POST['name']; // nombre de la columna
	$pk    = $_POST['pk'];   // el ID del registro
	$value = $_POST['value'];// el valor de la columna

	include 'conexion.php';
	$sql = null;

	switch ($name)
	{
		case 'nombre':
			$sql = 'UPDATE clientes SET nombre = ? WHERE idcliente = ?';
			break;			
		case 'apellido':
			break;
		case 'direccion':
			break;
		case 'telefono':
			break;
	}

	$data = $cnn->prepare($sql);
	$data->bind_param('si', $value, $pk);
	$data->execute();
	
?>









