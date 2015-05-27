	
	$("#modal-horaingreso").on('show.bs.modal', function(e){
    	var $tr = $(e.relatedTarget).closest('tr');          
    	
    	$('[name=id]').val($tr.data('id'));
    	$('#funcionario').html($tr.children(':eq(0)').text().trim());
    	$('#visitante').html($tr.children(':eq(1)').text().trim());
    	$('#fecha').html($tr.children(':eq(2)').text().trim());
    });