<?php echo $this->Flash->render() ?>
<div class="form-group">
	<?php echo $this->Form->text('persona_nombre', ['class' => 'form-control', 'placeholder' => 'Nombre Completo', 'autofocus', 'required']); ?>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-sm-6">
			<?php echo $this->Form->text('persona_apepat', ['class' => 'form-control', 'placeholder' => 'Apellido Paterno', 'required']); ?>
		</div>
		<div class="col-sm-6">
			<?php echo $this->Form->text('persona_apemat', ['class' => 'form-control', 'placeholder' => 'Apellido Materno', 'required']); ?>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-sm-6">
			<?php echo $this->Form->select('tipodocumento_id', $documentos, ['class' => 'form-control chosen-select','empty' => 'Seleccione']); ?>
		</div>
		<div class="col-sm-6">
			<?php echo $this->Form->text('documento_numero', ['class' => 'form-control', 'placeholder' => 'Número de documento', 'required']); ?>
		</div>
	</div>
</div>
<div class="form-group">
	<label>Organigrama</label>
	<?php echo $this->Form->select('organigrama_id', $organigramas, ['class' => 'form-control chosen-select','empty' => 'Seleccione']); ?>
</div>
<div class="form-group">
	<label>Perfil</label>
	<?php echo $this->Form->select('perfil_id', $perfiles, ['class' => 'form-control']); ?>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-sm-6">
			<label>Cargo</label>
			<?php echo $this->Form->select('cargo_id', $cargos, ['class' => 'form-control chosen-select','empty' => 'Seleccione']); ?>
		</div>
		<div class="col-sm-6">
			<label for="">Sede</label>
			<?php echo $this->Form->select('sede_id', $sedes, ['class' => 'form-control chosen-select','empty' => 'Seleccione']); ?>
		</div>
	</div>
</div>
<div class="form-group">
	<div class="row">
		<div class="col-sm-6">
			<?php echo $this->Form->text('usuario_login', ['class' => 'form-control', 'placeholder' => 'Usuario Login', 'required']); ?>
		</div>
		<?php if ($route !== 'edit'): ?>
			<div class="col-sm-6">
				<?php echo $this->Form->password('usuario_clave', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']); ?>
			</div>
		<?php endif ?>
	</div>
</div>