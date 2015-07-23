$(".chosen-select").chosen({max_selected_options: 5});

$('#content-visita').on('change', '.organigrama_cbo', function(e) {
	var $this = $(this),
        $body = $this.closest('div.panel-body');
	$.getJSON('persona/getOrganigramaByPadre/' + $this.val(), function(rec) {
        var size = rec.length,
            place = $this.data('place') == null ? 1 : $this.data('place');
        if (size) {
    		var options = '',
    			template = Handlebars.compile($('#cbo-organigramas').html());

    		for (var i = 0; i < size; i++) {
    			options += '<option value="' + rec[i].id + '">' + rec[i].organigrama_nombre + '</option>';
    		}

            // Elimino los combos para abajo apartir del actual
            // (selects - 1) se resta uno porque el indice empieza desde 0
            $body.find('.form-group:gt(' + place + ')').remove();
            $this.closest('.panel-body').append( template({label: '', options: options, place: $body.find('select').length}) );
        } else {
            $body.find('.form-group:gt(' + place + ')').remove();
        }
	});
}).find('.organigrama_cbo').change();

$('#modal-delete-confirm')
    .on('show.bs.modal', function(e) {
        $(this).find('[name=id]').val($(e.relatedTarget).closest('tr').data('id'));
    })
   .on('hide.bs.modal', function(e) {
        $(this).find('[name=id]').val('');
    });
