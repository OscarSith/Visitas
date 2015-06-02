	
//formato de hora de ingreso
	$('#visita_horaingreso').timepicker({
	    minuteStep: 30,
	    showInputs: true,
	    disableFocus: true
	});

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

    $(".anular").on('click',function(e){

    	var $tr = $(e.currentTarget).closest('tr');
		var id=$tr.data('id');
        bootbox.confirm("¿Esta seguro de anular esta visita?", function(result) {
			if(result){				
				$.ajax({
			        'url': '/persona/anularvisita',
			        'type': 'POST',
			        'data': 'id='+$tr.data('id'),
			        dataType: 'json'
			    }).done(function(rec) {
			    	bootbox.alert(rec.mensaje, function() {
			    		window.location.reload();
			    	});
			    }).fail(function(xhr) {
			        alert(xhr.responseJSON.message);
			        console.log();
			    }).always(function() {
			        $inputs.prop('disabled', false);
			    })
			}
				
		});

    });

    $(".activar").on('click',function(e){

    	var $tr = $(e.currentTarget).closest('tr');
		var id=$tr.data('id');
        bootbox.confirm("¿Esta seguro de actuvar esta visita?", function(result) {
			if(result){				
				$.ajax({
			        'url': '/persona/activarvisita',
			        'type': 'POST',
			        'data': 'id='+$tr.data('id'),
			        dataType: 'json'
			    }).done(function(rec) {
			    	bootbox.alert(rec.mensaje, function() {
			    		window.location.reload();
			    	});
			    }).fail(function(xhr) {
			        alert(xhr.responseJSON.message);
			        console.log();
			    }).always(function() {
			        $inputs.prop('disabled', false);
			    })
			}
				
		});

    });	
    