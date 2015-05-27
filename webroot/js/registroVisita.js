
$( "#Visitavisita_fecha" ).datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        language: "es",
        yearRange: "1930:1996"
});

function agregarVisitanteTable (values) {
    var $this = $('#tblVisitantes'),
        $noData = $this.children('.no-data'),
        tr = '<tr data-id="'+ values.id +'"><td>'+ values.documento_numero +'</td>'+
            '<td>'+ values.persona_nombre +'</td>'+
            '<td>'+ values.persona_apellidos +'</td>'+
            '<td><button type="button" class="btn btn-xs btn-danger">Eliminar</button></td></tr>';
    
    if ($noData.length) {
        $noData.remove();
    }

    $this.append(tr);
    $('#frm-visita').prepend('<input type="hidden" name="visitante_id[]" value="'+ values.id +'" id="vit'+values.id+'">');
}
function getData (id, obj) {
    var $form = $(obj).closest('form'),
        url = 'persona/show/',
        view = 'p';

    if ($form.attr('id') == 'frm-visitante') {
        url = 'persona/showByVisitanteId/';
        view = 'v';
    }
    $.getJSON(url + id, function(rec) {
        var documento = null,
            nombre = null,
            apellidoPat = null,
            apellidoMat = null;

        if (view === 'v') {
            documento = rec.persona.documento_numero;
            nombre = rec.persona.persona_nombre;
            apellidoPat = rec.persona.persona_apepat;
            apellidoMat = rec.persona.persona_apemat;

            $form.find('[name=visitante_id]').val(rec.persona[view].id);
            $form.find('[name=tipodocumento_id]').val(rec.persona.tipodocumento_id);
        } else {
            documento = rec.documento_numero;
            nombre = rec.persona_nombre;
            apellidoPat = rec.persona_apepat;
            apellidoMat = rec.persona_apemat;

            $form.find('[name=personal_id]').val(rec[view].id);
        }
        $form.find('[name=documento_numero]').val(documento);
        $form.find('[name=persona_nombre]').val(nombre);
        $form.find('[name=persona_apepat]').val(apellidoPat);
        $form.find('[name=persona_apemat]').val(apellidoMat);

        if (view === 'p') {
            $form.find('[name=cargo_id]').val(rec[view].cargo_id);
        } else {
            $form.find('[name=empresa_id]').val(rec.empresa.empresa_id);
            $form.find('[name=ruc_numero]').val(rec.empresa.p.persona_nombres);
            $form.find('[name=empresa_nombre]').val(rec.empresa.p.documento_numero);
        }
    });
}
$('#frm-visitante').on('submit', function(e) {
    e.preventDefault();
    var $this = $(this),
        data = $this.serialize(),
        $inputs = $this.find(':input');

    $inputs.prop('disabled', true);
    $.ajax({
        'url': $this.attr('action'),
        'type': 'POST',
        'data': data,
        dataType: 'json'
    }).done(function(rec) {
        $this.trigger('reset');
        agregarVisitanteTable(rec);
        $this.closest('.modal').modal('hide');
    }).fail(function(xhr) {
        alert(xhr.responseJSON.message);
        console.log();
    }).always(function() {
        $inputs.prop('disabled', false);
    })
});
$('#tblVisitantes').on('click', '.btn-danger', function() {
    if(confirm('Seguro de eliminar esta persona de esta visita?')) {
        var $this = $(this),
            $tr = $this.closest('tr');

        $('#vit' + $tr.data('id')).remove();
        $tr.fadeOut('fast', function() {
            $tr.remove();
        });
    }
});
var $search = $('#search_persona_visitante');
if ($search.length) {
    var options = {
        serviceUrl: '/persona/searchByDni',
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
    dniOptions.serviceUrl = '/persona/search';
    $('#search_persona_visita').autocomplete(dniOptions);

    var rucOptions = $.extend(true, {}, options);
    rucOptions.serviceUrl = '/persona/showByRuc';
    $('#ruc_numero').autocomplete(rucOptions);

	$('#content-visita').on('click', '.btn-remove-text-autoc', function() {
		var $this = $(this);
		var $text = $this.parent().addClass('visibility-hidden').prev().prop('readonly', false).focus();
		$text.closest('.panel-body').find(':input').val('');
		$text.data('exec', false);
	});
}

$('#modal-visitante').on('hide.bs.modal', function() {
	$(this).find('[name=visitante_id]').val('');
});
