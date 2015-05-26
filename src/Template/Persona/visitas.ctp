<h1 class="page-header">Listado de visitas</h1>
<?php echo $this->Flash->render() ?>
<table class="table table-condensed table-hover">
	<thead>
		<tr>
			<th>Funcionario</th>
			<th>Visitante</th>
			<th>Fecha</th>
			<th>Hora</th>
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
			</tr>
		<?php $n++;
		endforeach ?>
	</tbody>
</table>
<?php // print_r($visitas->toArray())?>