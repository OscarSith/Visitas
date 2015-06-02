
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
    }).find('.organigrama_cbo').change();
	