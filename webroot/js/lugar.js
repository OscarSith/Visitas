$("#modal-editar-lugar").on('show.bs.modal', function(e){
   	
   	var $tr = $(e.relatedTarget).closest('tr');   	
   	var form = $("#frm-editar-lugar");

   	$('[name=id]',form).val($tr.data('id'));
   	$('[name=sede_id]',form).val($tr.data('sedeid'));
   	$('[name=lugar_nombre]',form).val($tr.children(':eq(2)').text().trim());
  	$('[name=lugar_referencia]',form).val($tr.children(':eq(3)').text().trim());

});

$("#frm-registrar-lugar").validate(validateOptions);
$("#frm-editar-lugar").validate(validateOptions);