<h1>AGregar empresa</h1>
<?php
	echo $this->Form->create($empresa);
	echo '<input type="hidden" name="fecha_creacion" value="'.date('Y-m-d').'">';
	echo $this->Form->input('usuario_creador');
	echo $this->Form->button(__('Grabar'));
	echo $this->Form->end();