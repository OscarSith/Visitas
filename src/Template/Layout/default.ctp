<?php
$cakeDescription = 'Admin - Visitas';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('admin.min.css') ?>
    <?= $this->Html->css('main.css') ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('admin', 1) }}">Visita</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown"></li>
                <li class="dropdown"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $authUser ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- <i class="fa fa-fw fa-power-off"></i>  -->
                            <?php echo $this->Html->link('Salir', ['controller' => 'Persona', 'action' => 'logout']) ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="/persona"><i class="fa fa-fw fa-dashboard"></i> Registrar Visita</a>
                    </li>
                    <li>
                        <a href="/persona/visitas">
                            <i class="fa fa-fw fa-bar-chart-o"></i> Visitas
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <ol class="breadcrumb mb0">
              <li><a href="#">Inicio</a></li>
              <li class="active"><?= $title ?></li>
            </ol>
            <?= $this->Flash->render() ?>
            <div class="container-fluid">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    <?= $this->Html->script('jquery-2.1.1.min') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('jquery.autocomplete.min') ?>
    <script>
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
                    $form.find('[name=ruc_numero]').val(rec.empresa.persona_apepat);
                    $form.find('[name=empresa_nombre]').val(rec.empresa.persona_apemat);
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
                    getData(suggestion.data, this);
                }
            };
            $search.autocomplete(options);

            var dniOptions = $.extend(true, {}, options);
            dniOptions.serviceUrl = '/persona/search';
            $('#search_persona_visita').autocomplete(dniOptions);

            var rucOptions = $.extend(true, {}, options);
            rucOptions.serviceUrl = '/persona/showByRuc';
            $('#ruc_numero').autocomplete(rucOptions);
        }
    </script>
</body>
</html>
