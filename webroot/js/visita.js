
    $('#content-visita').on('change', '.organigrama_cbo', function(e) {
    	var $this = $(this);
    	$.getJSON('persona/getOrganigramaByPadre/' + $this.val(), function(rec) {
            var size = rec.length;
            if (size) {
        		var options = '',
        			template = Handlebars.compile($('#cbo-organigramas').html());
        		for (var i = 0; i < size; i++) {
        			options += '<option value="' + rec[i].id + '">' + rec[i].organigrama_nombre + '</option>';
        		}
    		  $this.closest('.panel-body').append( template({label: 'Prueba ', options: options}) );
            }
    	});
<<<<<<< HEAD
    }).find('.organigrama_cbo').change();
	
=======
    }).find('.organigrama_cbo').change();
>>>>>>> cb7606098cb97e6e547fe85c0dca7d14b3ce624b
