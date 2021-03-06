$("#Visitavisita_fecha").datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    language: "es",
    startDate: moment().subtract(0, 'd')._d
});

$("#Visitavisita_fechaF").datepicker({
    format: "dd/mm/yyyy",
    autoclose: true,
    language: "es",
});

$('#Visita_horaprogramada').timepicker({
    minuteStep: 30,
    showInputs: true,
    disableFocus: true
});

$('#Visita_horaingreso').timepicker({
    minuteStep: 30,
    showInputs: true,
    disableFocus: true
});

$("#frm-visita, #frm-visitante").validate(validateOptions);

function agregarVisitanteTable (values, tipo) {
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
    if(tipo=='insert'){
        $('#frm-visita').prepend('<input type="hidden" name="visitante_id[]" value="'+ values.id +'" id="vit'+values.id+'">');    
    }else{
        $('#frm-updvisita').prepend('<input type="hidden" name="visitante_id[]" value="0|'+ values.id +'" id="vit'+values.id+'">');
    }
    
}

function getData (id, obj) {
    var $form = $(obj).closest('form'),
        url = '/persona/show/',
        view = 'p';

    if ($form.attr('id') == 'frm-visitante') {
        url = '/persona/showByVisitanteId/';
        view = 'v';
    }

    if ($form.attr('id') == 'frm-visitante-upd') {
        url = '/persona/showByVisitanteId/';
        view = 'v';
    }

    if ($form.attr('id') == 'frm-updvisita') {
        url = '/persona/show/';
        view = 'p';
    }

    $.getJSON(url_app + url + id, function(rec) {
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
            $form.find('[name=persona_id]').val(rec.persona.id);
        } else {
            documento = rec.documento_numero;
            nombre = rec.persona_nombre;
            apellidoPat = rec.persona_apepat;
            apellidoMat = rec.persona_apemat;

            $form.find('[name=tipodocumento_id]').val(rec.tipodocumento_id);
            $form.find('[name=personal_id]').val(rec.p.id);
            $form.find('[name=hdnorganigrama_id]').val(rec.s.organigrama_id);
        }

        $form.find('[name=documento_numero]').val(documento);
        $form.find('[name=persona_nombre]').val(nombre);
        $form.find('[name=persona_apepat]').val(apellidoPat);
        $form.find('[name=persona_apemat]').val(apellidoMat);

        if (view === 'p') {
            $form.find('[name=cargo_id]').val(rec.s.cargo_id);
            $form.find('[name=cargo_id]').trigger("chosen:updated");
        } else {
            if (rec.empresa.p) {
                $form.find('[name=empresa_nombre]').prop('disabled', true);
                $form.find('[name=ruc_numero]').prop('disabled', true);
                $form.find('[name=empresa_id]').val(rec.empresa.empresa_id);
                $form.find('[name=empresa_nombre]').val(rec.empresa.p.persona_nombres);
                $form.find('[name=ruc_numero]').val(rec.empresa.p.documento_numero);
                if( rec.empresa.id==1 ){
                    $('#btn-visitante').prop('disabled', true);
                    $('#mensaje-registro-visitante').show();
                }
            }
        }
    });
}

    function getDatos( id, obj) {
        var $form = $(obj).closest('form'),
            url = '/persona/showByEmpresaID/';

        $.getJSON(url_app + url + id, function(rec) {

            if( rec.id == 1 ) {
                $('#btn-visitante').prop('disabled', true);
                $('#mensaje-registro-visitante').show();
            }
            $form.find('[name=personal_emp_id]').val('');
            $form.find('[name=ruc_numero]').val(rec.persona.p.documento_numero);
            $form.find('[name=empresa_nombre]').val(rec.persona.p.persona_nombres);
            $form.find('[name=empresa_id]').val(rec.persona.id);

            $form.find('[name=empresa_nombre]').prop('disabled', true);
            $form.find('[name=ruc_numero]').prop('disabled', true);
        });
    }

    $('#frm-visitante').on('submit', function(e) {

         var isvalidate=$("#frm-visitante").valid();
        if(isvalidate)
        {
            e.preventDefault();
            var $this = $(this),
                data = $this.serialize(),
                $inputs = $this.find(':input');

            $inputs.prop('disabled', true);
            $.ajax({
                'url': url_app + '/' + $this.data('action'),
                'type': 'POST',
                'data': data,
                dataType: 'json'
            }).done(function(rec) {
                $this.trigger('reset');
                agregarVisitanteTable(rec,'insert');
                $this.closest('.modal').modal('hide');
            }).fail(function(xhr) {
                alert(xhr.responseJSON.message);
                console.log();
            }).always(function() {
                $inputs.prop('disabled', false);
            })
        }    
    });


    $('#frm-visitante-upd').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this),
            data = $this.serialize(),
            $inputs = $this.find(':input');

        $inputs.prop('disabled', true);
        $.ajax({
            'url': url_app + '/' + $this.attr('action'),
            'type': 'POST',
            'data': data,
            dataType: 'json'
        }).done(function(rec) {
            $this.trigger('reset');
            agregarVisitanteTable(rec,'update');
            $this.closest('.modal').modal('hide');
        }).fail(function(xhr) {
            alert(xhr.responseJSON.message);
            console.log();
        }).always(function() {
            $inputs.prop('disabled', false);
        })
    });

    $('#tblVisitantes').on('click', '.btn-danger', function() {
        if(confirm('¿Seguro de eliminar esta persona de esta visita?')) {
            var $this = $(this),
                $tr = $this.closest('tr');

            $('#vit' + $tr.data('id')).remove();
            $tr.fadeOut('fast', function() {
                $tr.remove();
            });
        }
    });

    var $search = $('#search_persona_visitante');

    $('#search_persona_visitante').on('change', function() {
        $('[name=documento_numero]',$("#frm-visitante")).val($('#search_persona_visitante').val());
    });

    var $buscar = $('#ruc_numero');
    if ($buscar.length) {
        var optiones = {
            serviceUrl: url_app + '/' + '/persona/searchByRuc',
            minChars: 3,
            onSelect: function (suggestion) {
                var $this = $(this),
                flag = $this.data('exec');
                if (!flag) {
                    getDatos(suggestion.data, this);
                    $this.data('exec', true);
                }
            }
        };
    }

    if ($search.length) {
        var options = {
            serviceUrl: url_app + '/' + '/persona/searchByDni',
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
        dniOptions.serviceUrl = url_app + '/persona/search';

        var dniOptionsUpd = $.extend(true, {}, options);
        dniOptionsUpd.serviceUrl = url_app + '/persona/search';

        var arr = [];
        $('[name=organigrama_id], [name=organigrama]').each(function(id, el) {
            arr.push($(el).val());
        });
        $('#search_persona_visita').autocomplete($.extend(dniOptions, {
            params: {org: arr.join(',')},
            onSearchStart: function(q) {
                var arr = [];
                $('[name=organigrama_id], [name=organigrama]').each(function(id, el) {
                    arr.push($(el).val());
                });
                q.org = arr.join(',');
            }
        }));

        $('#search_persona_visita_upd').autocomplete(dniOptionsUpd);

        var rucOptions = $.extend(true, {}, optiones);
    
        $('#ruc_numero').autocomplete(rucOptions);

        $('#content-visita').on('click', '.btn-remove-text-autoc', function() {
              $('#search_persona_visita_upd').val('');
              var $this = $(this);
              var $text = $this.parent().addClass('visibility-hidden').prev().prop('readonly', false).focus();
              $text.closest('form').find(':input').val('').prop('disabled', false);
              $('#btn-visitante').prop('disabled', false);
              $('#mensaje-registro-visitante').hide();
              $text.data('exec', false);
        });
    }

    $('#modal-visitante').on('hide.bs.modal', function() {
        var $this = $(this);
        $this.find('[name=visitante_id]').val('');
        $this.find('[name=persona_id]').val('');
        $this.find('[name=empresa_id]').val('');
        $this.find('[name=empresavisitante_id]').val('');
        $this.find('.btn-remove-text-autoc').click();
    });
