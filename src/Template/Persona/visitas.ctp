<h1 class="page-header">Listado de visitas</h1>
<?php echo $this->Flash->render() ?>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Funcionario</th>
			<th>Visitante</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $n = 1;
		foreach ($visitas as $key): ?>
			<tr data-id="<?php echo $key->vv['id'] ?>">
				<td><?php echo $key->pr['persona_nombres']?></td>
				<td><?php echo $key->pe['persona_nombres'] ?></td>
				<td><?php echo $key->visita_fecha ?></td>
				<td><?php echo $key->visita_horaprogramada ?></td>
				<td>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu dropdown-menu-right" role="menu">
					  	<?php if ($key->estado=='R'): ?>
					  		<li><a href="#modal-test" data-toggle="modal">Hora Inicio</a></li>	
					  		<li><a href="#">Anular</a></li>
					  	<?php elseif ($key->estado=='D') : ?>
					  		<li><a href="#">Hora Salida</a></li>	
					  	<?php elseif ($key->estado=='A') : ?>
					  		<li><a href="#">Activar</a></li>	
					  	<?php endif ?>
					  </ul>
					</div>

				</td>
			</tr>
		<?php $n++;
		endforeach ?>
	</tbody>
</table>
<div class="modal fade" id="modal-test">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->