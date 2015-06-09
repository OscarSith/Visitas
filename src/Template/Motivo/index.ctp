<?php 	
	
	echo $this->Form->create(null,['action' => 'index', 'id' => 'frm-buscarmotivo' ]) 
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
					<input type="text" class="form-control" name="nombre_motivo" id="nombre_motivo" placeholder="Motivo" maxlength="35" value="<?= $valores['nombre_motivo'];?>"/>
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->select( 'estado', $estados, ['class' => 'form-control', 'empty' => 'Seleccione', 'default' => $valores['estado'] ]) ?>
				</div>
				<div class="col-sm-3">
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->button(__('<i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;&nbsp;Buscar'), ['class' => 'btn btn-danger']); ?>			
					<a class="btn btn-success" href="motivo/registrar"><i class="fa fa-plus fa-fw"></i>  Registrar</a>
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

		<table class="table table-stripe table-bordered table-hover">
			<thead>
				<tr>
					<th>N°</th>
					<th>Motivo</th>
					<th>Color</th>
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
						<td><span class="label" style="background-color: <?= $key->motivo_color ?>;"><?= $key->motivo_color ?>
						   </span></td>
						<td><?php echo $key->estado ?></td>
						<td>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu dropdown-menu-right" role="menu">
							  	<?php if ($key->estado=='I'): ?>
							  		<li><a href="#modal-Activar" data-toggle="modal">Activar</a></li>				  		
							  	<?php elseif ($key->estado=='A') : ?>
							  		<li><a href="#modal-anular" data-toggle="modal">Anular</a></li>
							  	<?php endif ?>
							  		<li><a href="#modal-editar" data-toggle="modal">Editar</a></li>
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

<div class="modal fade" id="modal-editar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Editar Motivo</h4>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->create($motivos , ['action' => 'editar', 'id' => 'frm-editar']) ?>
			<input type="hidden" name="id" value="">
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Motivo</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('motivo_descripcion', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Motivo</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="motivo_colorupd" name="motivo_color" />
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