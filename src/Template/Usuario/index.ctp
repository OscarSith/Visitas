<?php echo $this->Form->create(null,['action' => 'index', 'id' => 'frm-buscarusuario', 'type' => 'GET', 'class' => 'form-inline']) ?>
	<div class="box box-danger">
		<div class="box-body">
			<div class="form-group">
				<input type="text" class="form-control" name="login_usuario" id="login_usuario" placeholder="Usuario Login" maxlength="35" value="<?= $valores['login_usuario'];?>"/>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre Usuario" maxlength="100" value="<?= $valores['nombre_usuario'];?>"/>
			</div>
			<div class="form-group">
				<?php echo $this->Form->select( 'estado', $estados, ['class' => 'form-control', 'empty' => 'Seleccione', 'default' => $valores['estado'] ]) ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->button(__('<i class="glyphicon glyphicon-search"></i>&nbsp; Buscar'), ['class' => 'btn btn-danger']); ?>
				<a class="btn btn-success" href="usuario/registrar"><i class="fa fa-plus fa-fw"></i> Registrar</a>
				<a href="#modal-add-credentials" class="btn btn-primary" data-toggle="modal" title="Agregar Login y Contraseña a un Usuario"><i class="fa fa-user"></i> Agregar</a>
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
								<li><a href="#" class="activar" data-toggle="modal"><i class="fa fa-edit fa-fw"></i>Activar</a></li>
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
<div class="modal fade" id="modal-add-credentials">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Credenciales a un Usuario</h4>
			</div>
			<div class="modal-body">
				<?php echo $this->Form->create(null, ['action' => 'addUserCredentials', 'id' => 'frm-add-user-credentials', 'type' => 'post']) ?>
				<input type="hidden" name="persona_id">
				<div class="form-group">
					<div class="input-group">
						<input type="text" id="inputSearchPerson" placeholder="Buscar Persona" class="form-control">
						<span class="input-group-btn visibility-hidden">
							<a href="#" class="btn btn-danger btn-remove-text-autoc" type="button"><i class="fa fa-times"></i></a>
						</span>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<?php echo $this->Form->text('usuario_login', ['class' => 'form-control', 'placeholder' => 'Usuario Login', 'required']); ?>
						</div>
						<div class="col-sm-6">
							<?php echo $this->Form->password('usuario_clave', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']); ?>
						</div>
					</div>
				</div>
				<hr>
				<div class="text-right">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary">Agregar</button>
				</div>
				<?php echo $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>