<?php include 'header.php' ?>
<?php 
	$query  = 'SELECT idcliente, nombre, apellido, direccion, telefono ';
	$query .= 'FROM clientes WHERE estado = 1 ORDER BY nombre';

	$data = $cnn->prepare($query);
	$data->execute();
	$data->bind_result($id, $nombre, $apellido, $direccion, $telefono);
	$data->store_result();
	$num_rows = $data->num_rows;
?>


<h1 class="alert alert-primary mb-4">
	Listado de afiliados
</h1>

<div class="row">
	<div class="col-md-4">
		<form action="scripts/cliente.php" method="post">
			<input type="hidden" name="accion" value="insert">

			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input maxlength="25" type="text" name="nombre" id="nombre" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" name="apellido" id="apellido" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="direccion">Dirección</label>
				<textarea name="direccion" id="direccion" class="form-control" required></textarea>
			</div>

			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" id="telefono" class="form-control" required>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary btn-block" value="Guardar afiliado">
			</div>
		</form>

	</div>
	<div class="col-md-8">	
		<span class="text-success">Hay <?php echo $num_rows ?> afiliados</span>
		<table class="table table-bordered table-hover table-sm mt-3">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Acción</th>
				</tr>
			</thead>

			<tbody>
				<?php while ( $data->fetch() ): ?>
				<tr>
					<td><?php echo $id ?></td>
					<td>
						<a href="#" class="editar-nombre" id="nombre">
							<?php echo $nombre ?>								
						</a>
					</td>
					<td><?php echo $apellido ?></td>
					<td><?php echo $direccion ?></td>
					<td><?php echo $telefono ?></td>
					<td>
						<a href="cuentas.php?idc=<?php echo $id ?>" class="btn btn-info btn-sm">
							Cuentas
						</a>

						<a class="btn btn-danger btn-sm" onclick="if (!confirm('Confirme la eliminación')) return false;" 
						   href="scripts/cliente.php?id=<?php echo $id ?>&accion=delete">
							Eliminar
						</a>
					</td>
				</tr>
				<?php endwhile ?>
			</tbody>
		</table>
	</div>
</div>

<?php include 'footer.php' ?>




