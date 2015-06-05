<div class="row">
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