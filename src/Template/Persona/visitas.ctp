<h1 class="page-header">Listado de visitas</h1>
<?php echo $this->Flash->render() ?>
<ul class="pagination">
	<?= $this->Paginator->prev('«') ?>
	<?= $this->Paginator->numbers() ?>
	<?= $this->Paginator->next('»') ?>
</ul>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Funcionario</th>
			<th>Visitante</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Hora Ingreso</th>
			<th>Hora Salida</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $n = 1;
		foreach ($visitas as $key): ?>
			<tr data-id="<?php echo $key->id ?>">
				<td><?php echo $key->pr['persona_nombres']?></td>
				<td><?php echo $key->pe['persona_nombres'] ?></td>
				<td><?php echo $key->visita_fecha ?></td>
				<td><?php echo $key->visita_horaprogramada ?></td>
				<td><?php echo $key->vv['visita_horaingreso'] ?></td>
				<td><?php echo $key->vv['visita_horasalida'] ?></td>
				<td>
					<?php 
						$color;
						if($key->vv['estado']=='R'){
							$color='warning';
						}elseif ($key->vv['estado']=='D') {
							$color='success';
						}elseif ($key->vv['estado']=='F') {
							$color='primary';
						}elseif ($key->vv['estado']=='A') {
							$color='danger';
						}
					?>
					<div class="btn btn-<?=$color?>"></div>
				</td>
				<td>
					<?php if ($key->vv['estado'] !='F'): ?>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
					  <ul class="dropdown-menu dropdown-menu-right" role="menu">
					  		<li><a href="/visita-edit/<?php echo $key->id ?>">Editar</a></li>
					  	<?php if ($key->vv['estado'] =='R'): ?>
					  		<li><a href="#modal-horaingreso" data-toggle="modal">Hora Inicio</a></li>
					  		<li><a href="#" class="anular" data-toggle="modal">Anular</a></li>
					  	<?php elseif ($key->vv['estado'] =='D') : ?>
					  		<li><a href="#modal-horasalida" data-toggle="modal">Hora Salida</a></li>
					  	<?php elseif ($key->vv['estado'] =='A') : ?>
					  		<li><a href="#" class="activar" data-toggle="modal">Activar</a></li>
					  	<?php endif ?>
					  </ul>
					</div>
					<?php endif ?>
				</td>
			</tr>
		<?php $n++;
		endforeach ?>
	</tbody>
</table>

<div class="modal fade" id="modal-horaingreso">
  <div class="modal-dialog" style="z-index:2000">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Registra Hora Ingreso</h4>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->create($visitavisitante , ['action' => 'registrarHoraInreso', 'id' => 'frm-horaingreso']) ?>
			<input type="hidden" name="id" value="">
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Funcionario</label>
					<div class="col-sm-8">
						<div id="funcionario"> </div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Visitante</label>
					<div class="col-sm-8">
						<div id="visitante"> </div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Fecha hora</label>
					<div class="col-sm-8">
						<div id="fecha"> </div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Hora Ingreso</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="visita_horaingreso" id="visita_horaingreso"/>
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        	<button class="btn btn-primary">Guardar</button>
			</div>

		<?php echo $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal:: Registro de Hora de salida -->

<div class="modal fade" id="modal-horasalida">
  <div class="modal-dialog" style="z-index:2000">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Registrar Hora de Salida</h4>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->create($visitavisitante , ['action' => 'registrarHoraSalida', 'id' => 'frm-horasalida']) ?>
			<input type="hidden" name="id" value="">
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Funcionario</label>
					<div class="col-sm-8">
						<div id="funcionario"> </div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Visitante</label>
					<div class="col-sm-8">
						<div id="visitante"> </div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Fecha y hora</label>
					<div class="col-sm-8">
						<div id="fecha"> </div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Hora de ingreso</label>
					<div class="col-sm-8">
						<div id="horaingreso"> </div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Hora Salida</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="visita_horasalida" id="visita_horasalida"/>
					</div>
				</div>
			</div>

			<div class="text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	        	<button class="btn btn-primary">Guardar</button>
			</div>

		<?php echo $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>