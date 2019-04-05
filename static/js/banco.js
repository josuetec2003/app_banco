$(function () {
	$('.editar-nombre').editable({
		type: 'text'
	});
	$('#telefono').mask('0000-0000');

	$('.btn-d').on('click', function () {
		var monto = prompt('Ingrese el monto del deposito');
		var cuenta = $(this).data('cuenta');

		if (monto.trim() != '')
		{
			if ( !isNaN(monto) )
			{
				var ctx = {
					'accion': 'deposito', 
					'idc': cuenta, 
					'monto': monto
				};

				alert('Tengo duda en esta linea');

				$.get('/app_banco/scripts/cuenta.php', ctx, function (respuesta) {
					$('#cuenta-msj').fadeIn().text(respuesta.msj);

					setTimeout(function () {
						document.location.reload();
					}, 2000);
				}, 'json');
			} 
		}
	});
})









