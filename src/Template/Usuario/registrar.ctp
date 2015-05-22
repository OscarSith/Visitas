<?php
	echo $this->Form->create($usuario, ['action' => 'add']);
	echo $this->Form->input('persona_nombre');
	echo $this->Form->input('persona_apepat');
	echo $this->Form->input('persona_apemat');
	echo $this->Form->select('tipodocumento_id', $documentos);
	echo $this->Form->input('documento_numero');
	echo $this->Form->input('cargo_id', $cargos, ['type' => 'select']);
	echo $this->Form->input('usuario_login');
	echo $this->Form->input('usuario_clave', ['type' => 'password']);
	echo $this->Form->button(__('Grabar'));
	echo $this->Form->end();