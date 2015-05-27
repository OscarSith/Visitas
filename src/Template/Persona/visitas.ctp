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
			<tr>
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
					  		<li><a href="#" >Hora Inicio</a></li>	
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
<?php // print_r($visitas->toArray())?>