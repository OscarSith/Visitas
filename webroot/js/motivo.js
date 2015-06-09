$("#motivo_color").colorpicker();
$("#motivo_colorupd").colorpicker();

$("#modal-editar").on('show.bs.modal', function(e){
   	
   	var $tr = $(e.relatedTarget).closest('tr');   	
   	var form = $("#frm-editar");

   	$('[name=id]',form).val($tr.data('id'));
   	$('[name=motivo_descripcion]',form).val($tr.children(':eq(1)').text().trim());
  	$('[name=motivo_color]',form).val($tr.children(':eq(2)').text().trim());
  	
});	