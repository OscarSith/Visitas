<h1>Empresas</h1>
<hr>
<table>
	<thead>
		<tr>
			<th>Persona_id</th>
			<th>Creado por</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($empresas as $key): ?>
		<tr>
			<td><?php echo $key->persona_id ?></td>
			<td><?php echo $key->usuario_creador ?></td>
			<td><?php echo $key->fecha_creacion ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>