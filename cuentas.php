<?php include 'header.php' ?>
<?php
	$idc = $_GET['idc'];

	// para mostrar la informacion del cliente
	$query  = 'SELECT nombre, apellido ';
	$query .= 'FROM clientes WHERE idcliente = ?';

	$data = $cnn->prepare($query);
	$data->bind_param('i', $idc);
	$data->execute();
	$data->bind_result($nombre, $apellido);
	$data->store_result();
	$num_rows = $data->num_rows;

	$data->fetch();

	// para mostrar las cuentas del cliente
	$query2  = 'SELECT C.numcuenta, TC.descripcion, TC.moneda, C.saldo ';
	$query2 .= 'FROM cuentas C INNER JOIN tipocuenta TC ';
	$query2 .= 'ON C.idtipo = TC.idtipo WHERE C.idcliente = ?';

	//echo $query2;

	$data2 = $cnn->prepare($query2);
	$data2->bind_param('i', $idc);
	$data2->execute();
	$data2->bind_result($numcuenta, $tipocuenta, $moneda, $saldo);
	$data2->store_result();
	$num_rows = $data2->num_rows;
?>

<h2>Cuentas de <?php echo $nombre . ' ' . $apellido ?></h2>

<hr>

<div class="row">
	<div class="col-md-4">
		<form action="scripts/cuenta.php" method="post">
			<input type="hidden" name="accion" value="insert">
			<input type="hidden" name="id" value="<?php echo $idc ?>">

			<div class="form-group">
				<label for="tipocuenta">Tipo cuenta</label>
				<select name="tipocuenta" id="tipocuenta" class="form-control" required>
					<option value="">Seleccione el tipo</option>
					<option value="1">Ahorros en lempiras</option>
					<option value="2">Ahorros en dólares</option>
					<option value="3">Cheques en lempiras</option>
					<option value="4">Cheques en dólares</option>
				</select>
			</div>

			<div class="form-group">
				<label for="saldo">Saldo</label>
				<input type="number" name="saldo" id="saldo" class="form-control" required>
			</div>			

			<div class="form-group">
				<input type="submit" class="btn btn-primary btn-block" value="Crear cuenta">
			</div>
		</form>
	</div>
	<div class="col-md-8">
		<?php if ($num_rows == 0): ?>
			<div class="alert alert-danger">Este cliente no tiene cuentas registradas</div>
		<?php else:  ?>
			<div class="alert alert-success" id="cuenta-msj" style="display: none"></div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th># Cuenta</th>
						<th>Tipo Cuenta</th>
						<th>Moneda</th>
						<th>Saldo</th>
						<th class="text-center">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php while ( $data2->fetch() ): ?>
					<tr>
						<td><?php echo $numcuenta ?></td>
						<td><?php echo $tipocuenta ?></td>
						<td><?php echo $moneda ?></td>
						<td><?php echo $saldo ?></td>
						<td class="text-center">
							<a href="" class="btn btn-danger btn-sm">D-</a> 
							<button data-cuenta="<?php echo $numcuenta ?>" class="btn btn-success btn-sm btn-d">D+</button>
							<button class="btn btn-warning btn-sm">R-</button>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>	
		<?php endif; ?>
	</div>
</div>


<?php include 'footer.php' ?>










