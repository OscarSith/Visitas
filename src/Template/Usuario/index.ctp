<?php
	echo $this->Form->create(null,['action' => 'index', 'id' => 'frm-buscarusuario', 'type' => 'GET']) 
?>
	<div class="box box-danger">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					Login del usuario
				</div>
				<div class="col-sm-3">
					Nombre del Usuario
				</div>
				<div class="col-sm-3">
					Estado
				</div>
				<div class="col-sm-3">
					
				</div>
			</div>		
			<div class="row">
				<div class="col-sm-3">
					<input type="text" class="form-control" name="login_usuario" id="login_usuario" placeholder="Usuario Login" maxlength="35" value="<?= $valores['login_usuario'];?>"/>
				</div>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre Usuario" maxlength="100" value="<?= $valores['nombre_usuario'];?>"/>
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->select( 'estado', $estados, ['class' => 'form-control', 'empty' => 'Seleccione', 'default' => $valores['estado'] ]) ?>
				</div>
				<div class="col-sm-3">
					<?php echo $this->Form->button(__('Buscar'), ['class' => 'btn btn-danger']); ?>			
					<a class="btn btn-success" href="usuario/registrar">Registrar</a>
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
		<table class="table table-stripe table-bordered">
			<thead>
				<tr>
					<th>Usuario</th>
					<th>Nombre</th>
					<th>Nro. Documento</th>
					<th>Creado por</th>
					<th>T. Usuario</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($usuarios as $key): ?>
				<tr>
					<td><?php echo $key->usuario_login ?></td>
					<td><?php echo $key->p['persona_nombres'] ?></td>
					<td><?php echo $key->p['documento_numero'] ?></td>
					<td><?php echo $key->usuario_creador ?></td>
					<td><?php echo $key->tipo_usuario ?></td>
					<td><?php echo $key->estado ?></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu dropdown-menu-right" role="menu">
								<li><a href="usuario/edit/<?php echo $key->id ?>"><i class="fa fa-edit fa-fw"></i>Editar</a></li>
								<li><a href="#" class="activar" data-toggle="modal">Activar</a></li>
							</ul>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
		<ul class="pagination">
			<?= $this->Paginator->prev('«') ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next('»') ?>
		</ul>
	</div>	
</div>