<?php 	
	
	echo $this->Form->create($motivos,['action' => 'index', 'id' => 'frm-buscarmotivo', 'type' => 'get' ]) 
?>
	<div class="box box-danger">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					Motivo
				</div>
				<div class="col-sm-3">
					Estado
				</div>
				<div class="col-sm-3">					
				</div>
				<div class="col-sm-3">					
				</div>
			</div>		
			<div class="row">
				<div class="col-sm-3">
					<input type="text" class="form-control" name="nombre_motivo" id="nombre_motivo" placeholder="Usuario Login" maxlength="35" value="<?= $valores['nombre_motivo'];?>"/>
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->select( 'estado', $estados, ['class' => 'form-control', 'empty' => 'Seleccione', 'default' => $valores['estado'] ]) ?>
				</div>
				<div class="col-sm-3">
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->button(__('Buscar'), ['class' => 'btn btn-danger']); ?>			
					<a class="btn btn-success" href="motivo/registrar">Registrar</a>
				</div>
			</div>		
		</div>
	</div>

<?php echo $this->Form->end() ?>

<div class="box box-warning">
	<div class="box-body">

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
	</div>	
</div>