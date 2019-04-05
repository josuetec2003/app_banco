<?php
	#error_reporting(0); // en produccion

	$id 	= $_GET['id'];
	$accion = $_REQUEST['accion']; // viene por POST y por GET

	// datos del formulario
	$nombre    = $_POST['nombre'];
	$apellido  = $_POST['apellido'];
	$direccion = $_POST['direccion'];
	$telefono  = $_POST['telefono'];

	if (isset($accion) && !empty($accion))
	{
		include 'conexion.php';

		switch ($accion)
		{
			case 'delete':
				// $sql = 'DELETE FROM clientes WHERE idcliente = ?';

				$sql = 'UPDATE clientes SET estado = 0 WHERE idcliente = ?';
				$data = $cnn->prepare($sql);
				$data->bind_param('i', $id);
				$data->execute();
				header('Location: ../'); // para redireccionar

				break;
			case 'insert':
				$sql  = "INSERT INTO clientes (nombre, apellido, direccion, telefono) ";
				$sql .= "VALUES (?, ?, ?, ?)";

				$data = $cnn->prepare($sql);
				$data->bind_param("ssss", $nombre, $apellido, $direccion, $telefono);
				$data->execute();
				header('Location: ../'); // para redireccionar

				break;
			case 'update':
				break;
			default:
				echo 'No tienes acceso a esta area';
		}
	} else {
		echo 'No tienes acceso a esta area';
	}


?>