<h1 class="page-header">Listado de Motivos</h1>
<?php echo $this->Flash->render() ?>

<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

<ul class="pagination">
	<?= $this->Paginator->prev('«') ?>
	<?= $this->Paginator->numbers() ?>
	<?= $this->Paginator->next('»') ?>
</ul>

<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>N°</th>
			<th>Motivo</th>
			<th>Estado</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $n = 1;
		foreach ($motivos as $key): ?>
			<tr data-id="<?php echo $key->id?>">
				<td><?php echo $n ?></td>
				<td><?php echo $key->motivo_descripcion ?></td>
				<td><?php echo $key->estado ?></td>
				<td>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu dropdown-menu-right" role="menu">
					  	<?php if ($key->estado=='R'): ?>
					  		<li><a href="#modal-horaingreso" data-toggle="modal">Hora Inicio</a></li>	
					  		<li><a href="#modal-anular" data-toggle="modal">Anular</a></li>
					  	<?php elseif ($key->estado=='D') : ?>
					  		<li><a href="#modal-horasalida" data-toggle="modal">Hora Salida</a></li>	
					  	<?php elseif ($key->estado=='A') : ?>
					  		<li><a href="#modal-activar" data-toggle="modal">Activar</a></li>	
					  	<?php endif ?>
					  </ul>
					</div>

				</td>
			</tr>
		<?php $n++;
		endforeach ?>
	</tbody>
</table>

