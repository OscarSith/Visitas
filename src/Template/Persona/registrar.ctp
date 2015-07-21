	<h1>Registrar persona</h1>
<?php
	echo $this->Form->create($persona);
	echo '<input type="hidden" name="fecha_creacion" value="'.date('Y-m-d').'">';
	echo $this->Form->input('persona_nombre');
	echo $this->Form->input('persona_apepat');
	echo $this->Form->input('persona_apemat');
	echo $this->Form->select('tipodocumento_id', ['CARNET DE EXTRANJERIA', 'DNI']);
	echo $this->Form->input('documento_numero');
	echo $this->Form->input('usuario_creador');
	echo $this->Form->button(__('Grabar'));
	echo $this->Form->end();