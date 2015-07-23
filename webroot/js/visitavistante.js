//muestra datos de la tabla en el modal
$("#modal-horaingreso").on('show.bs.modal', function(e){
	var $tr = $(e.relatedTarget).closest('tr');

	$('[name=id]').val($tr.data('id'));
	$('#funcionario').html($tr.children(':eq(0)').text().trim());
	$('#visitante').html($tr.children(':eq(1)').text().trim());
	$('#fecha').html($tr.children(':eq(2)').text().trim());
});

//formato de hora de salida
$('#visita_horasalida').timepicker({
    minuteStep: 30,
    showInputs: true,
    disableFocus: true
});

//muestra datos de la tabla en el modal
$("#modal-horasalida").on('show.bs.modal', function(e){
	var $tr = $(e.relatedTarget).closest('tr');
	var form = $("#frm-horasalida");

	$('[name=id]',form).val($tr.data('id'));
	$('#funcionario',form).html($tr.children(':eq(0)').text().trim());
	$('#visitante',form).html($tr.children(':eq(1)').text().trim());
	$('#fecha',form).html($tr.children(':eq(2)').text().trim()+' '+$tr.children(':eq(3)').text().trim() );
	$('#horaingreso',form).html($tr.children(':eq(4)').text().trim());
});

$('#modal-confirm-anular')
	.on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).closest('tr').data('id'),
			$form = $(e.currentTarget).find('form');

		$form.children('[name=id]').val(id);
	})
	.on('hide.bs.modal', function() {
		$(this).find('form [name=id]').val('');
	});

$('#modal-confirm-activar')
	.on('show.bs.modal', function(e) {
		var id = $(e.relatedTarget).closest('tr').data('id'),
			$form = $(e.currentTarget).find('form');

		$form.children('[name=id]').val(id);
	})
	.on('hide.bs.modal', function() {
		$(this).find('form [name=id]').val('');
	});
