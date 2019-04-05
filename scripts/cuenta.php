<?php
	error_reporting(0); // en produccion

	$id 	= $_REQUEST['id']; 	// id del cliente
	$idc 	= $_REQUEST['idc']; // numero de cuenta 
	$accion = $_REQUEST['accion']; // viene por POST y por GET

	$monto 	= $_GET['monto'];

	// datos del formulario
	$tipocuenta	= $_POST['tipocuenta'];
	$saldo  	= $_POST['saldo'];

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
				$sql  = "INSERT INTO cuentas (idcliente, idtipo, saldo) ";
				$sql .= "VALUES (?, ?, ?)";

				$data = $cnn->prepare($sql);
				$data->bind_param("iid", $id, $tipocuenta, $saldo);
				$data->execute();
				header("Location: ../cuentas.php?idc=$id"); // para redireccionar

				break;
			case 'update':
				break;
			case 'deposito':
				$sql = 'UPDATE cuentas SET saldo = saldo + ? WHERE numcuenta = ?';
				$data = $cnn->prepare($sql);
				$data->bind_param('di', $monto, $idc);
				$data->execute();
				
				echo json_encode(array('msj' => 'Deposito realizado con éxito'));
				break;
			default:
				echo 'No tienes acceso a esta area';
		}
	} else {
		echo 'No tienes acceso a esta area';
	}









?>