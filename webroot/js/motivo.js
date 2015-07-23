$("#motivo_color").colorpicker();
$("#motivo_colorupd").colorpicker();

$("#modal-editar-motivo").on('show.bs.modal', function(e){
   	
   	var $tr = $(e.relatedTarget).closest('tr');
   	var form = $("#frm-editar-motivo");

   	$('[name=id]',form).val($tr.data('id'));
   	$('[name=motivo_descripcion]',form).val($tr.children(':eq(1)').text().trim());
  	$('[name=motivo_color]',form).val($tr.children(':eq(2)').text().trim());

});

$("#frm-motivo, #frm-motivo-editar").validate(validateOptions);