	$("#modal-horaingreso").on('show.bs.modal', function(e){
    	var $tr = $(e.relatedTarget).closest('tr');
    	
    	$('[name=id]').val($tr.data('id'));
    	$('#funcionario').html($tr.children(':eq(0)').text().trim());
    	$('#visitante').html($tr.children(':eq(1)').text().trim());
    	$('#fecha').html($tr.children(':eq(2)').text().trim());
    });

    $('#content-visita').on('change', '.organigrama_cbo', function(e) {
    	var $this = $(this);
    	$.getJSON('persona/getOrganigramaByPadre/' + $this.val(), function(rec) {
    		var options = '',
    			template = Handlebars.compile($('#cbo-organigramas').html());
    		for (var i = 0; i < rec.length; i++) {
    			options += '<option value="' + rec[i].id + '">' + rec[i].organigrama_nombre + '</option>';
    		}

    		$this.closest('.panel-body').append( template({label: 'Prueba ', options: options}) );
    	});
    });