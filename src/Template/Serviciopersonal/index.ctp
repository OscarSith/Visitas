<?= $this->Html->script('../bower_components/jquery/dist/jquery.min') ?>
<?= $this->Html->script('../bower_components/bootstrap/dist/js/bootstrap.min') ?>

<div class="box box-warning">
	<div class="box-body">
		<table class="table table-stripe table-bordered table-hover">
			<thead>
				<tr>
					<th></th>
					<th>Motivo</th>
					<th>Color</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php $n=1;				
				foreach ($serviciopersonal as $key): ?>
					<tr data-id="<?php echo $key->id?>" data-organigrama="<?php echo $key->o['id']?>" data-cargo="<?php echo $key->c['id']?>" data-sede="<?php echo $key->s['id']?>">
						<td><label><input type="radio" name="check"/></label></td>
						<td><?php echo $key->o['organigrama_nombre'] ?></td>
						<td><?php echo $key->c['cargo_nombre'] ?></td>
						<td><?php echo $key->s['sede_nombre'] ?></td>
					</tr>
				<?php $n++;
				endforeach ?>
			</tbody>
		</table>
	</div>	
</div>  

<div class="modal fade" id="modal-confirm-acceso">
  <div class="modal-dialog" style="z-index:2000">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title"><i class="fa fa-warning text-warning fa-lg fa-fw"></i>Advertencia</h4>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->create(null , ['action' => 'asignaingreso']) ?>
			<input type="hidden" name="id-cargo" value="">
			<input type="hidden" name="id-organigrama" value="">
			<input type="hidden" name="id-sede" value="">
			<p>¿Esta seguro de ingresar con estos datos?</p>
			<div class="text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        	<button class="btn btn-primary">Aceptar</button>
			</div>
		<?php echo $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('input[name="check"]:radio').click(function(e) {
	    
	    $('#modal-confirm-acceso')
	    	.on('show.bs.modal', function(a) {
	    		var idcargo =$(e.delegateTarget).closest('tr').data('cargo');
	    		var idorganigrama =$(e.delegateTarget).closest('tr').data('organigrama');
	    		var idsede =$(e.delegateTarget).closest('tr').data('sede');

				$form = $(a.currentTarget).find('form');
				$form.children('[name=id-cargo]').val(idcargo);
				$form.children('[name=id-organigrama]').val(idorganigrama);
				$form.children('[name=id-sede]').val(idsede);
			})
			.on('hide.bs.modal', function() {
				$(this).find('form [name=id]').val('');
			});
		$('#modal-confirm-acceso').modal('show');	
	});
</script>