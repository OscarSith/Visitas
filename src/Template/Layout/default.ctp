<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('main.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="header-title">
            <span><?= $this->fetch('title') ?></span>
        </div>
        <div class="header-help">
            <span><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></span>
            <span><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></span>
        </div>
    </header>
    <div id="container" class="container">

        <div id="content">
            <?= $this->Flash->render() ?>
            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
        </div>
        <footer>
        </footer>
    </div>
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
            $.getJSON('persona/show/' + id, function(rec) {
                var $form = $(obj).closest('form');
                $form.find('[name=persona_id]').val(rec.id);
                $form.find('[name=documento_numero]').val(rec.documento_numero);
                $form.find('[name=persona_nombre]').val(rec.persona_nombre);
                $form.find('[name=persona_apepat]').val(rec.persona_apepat);
                $form.find('[name=persona_apemat]').val(rec.persona_apemat);
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
                serviceUrl: '/persona/search',
                minChars: 3,
                onSelect: function (suggestion) {
                    getData(suggestion.data, this);
                }
            };
            $search.autocomplete(options);
            $('#search_persona_visita').autocomplete(options);
        }
    </script>
</body>
</html>
