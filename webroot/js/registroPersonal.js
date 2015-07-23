var $search = $('#documento_numero');

function getData (id, obj) {
    var $form = $(obj).closest('form'),
    	url = url_app + '/persona/showByPersonalId/';

    $.getJSON(url + id, function(rec) {
        
        documento = rec.persona.documento_numero;
        nombre = rec.persona.persona_nombre;
        apellidoPat = rec.persona.persona_apepat;
        apellidoMat = rec.persona.persona_apemat;      
        
        $form.find('[name=persona_id]').val(rec.persona.id);
        $form.find('[name=documento_numero]').val(documento);
        $form.find('[name=persona_nombre]').val(nombre);
        $form.find('[name=persona_apepat]').val(apellidoPat);
        $form.find('[name=persona_apemat]').val(apellidoMat);
    });
}

if ($search.length) {

	var options = {
	    minChars: 3,
        onSelect: function (suggestion) {
            var $this = $(this),
                flag = $this.data('exec');
                
            if (!flag) {
                getData(suggestion.data, this);
                $this.prop('readonly', true).next().removeClass('visibility-hidden');
                $this.data('exec', true);
            }
        }
    };

    $search.autocomplete(options);

    var dniOptions = $.extend(true, {}, options);
    	dniOptions.serviceUrl = url_app + '/persona/searchByDni';
    	
    $('#documento_numero').autocomplete(dniOptions);
}