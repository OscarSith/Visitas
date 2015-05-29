<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Registrar</h3>
		</div>
		<div class="panel-body">
			<?php echo $this->Form->create($usuario, ['action' => 'add']); ?>
			<div class="form-group">
				<?php echo $this->Form->input('persona_nombre', ['class' => 'form-control', 'placeholder' => 'Persona_nombre', 'autofocus', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('persona_apepat', ['class' => 'form-control', 'placeholder' => 'Persona_apepat', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('persona_apemat', ['class' => 'form-control', 'placeholder' => 'Persona_apemat', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->select('tipodocumento_id', $documentos); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('documento_numero', ['class' => 'form-control', 'placeholder' => 'Documento_numero', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('cargo_id', $cargos, ['type' => 'select'], ['class' => 'form-control', 'placeholder' => 'Cargo_id', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('organigrama_id', $organigramas, ['type' => 'select'], ['class' => 'form-control', 'placeholder' => 'Organigrama_id', 'required']); ?>
			<div class="form-group">
				<?php echo $this->Form->input('sede_id', $sedes, ['type' => 'select'], ['class' => 'form-control', 'placeholder' => 'Sede_id', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('usuario_login', ['class' => 'form-control', 'placeholder' => 'Usuario_login', 'required']); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->input('usuario_clave', ['type' => 'password'], ['class' => 'form-control', 'placeholder' => 'Usuario_clave', 'required']); ?>
				</div>
			<?php echo $this->Form->button(__('Grabar'), ['class' => 'btn btn-primary']); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>