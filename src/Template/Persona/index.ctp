<h1>Dashboard</h1>
<hr>
<?php echo $this->Flash->render() ?>
<?php echo $this->Form->create($persona, ['action' => 'registrarVisita', 'id' => 'frm-visita']) ?>
	<fieldset>
		<legend>Datos de la Visita</legend>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Fecha de Visita</label>
				<div class="col-sm-3">
					<?php echo $this->Form->text('visita_fecha', ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Lugar de reunión</label>
				<div class="col-sm-4">
	        		<?php echo $this->Form->select('lugar_id', $lugares, ['class' => 'form-control']) ?>
				</div>
			</div>
        </div>
        <div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Motivo de reunión</label>
				<div class="col-sm-4">
	        		<?php echo $this->Form->select('motivo_id', $motivos, ['class' => 'form-control']) ?>
				</div>
			</div>
        </div>
	</fieldset>
	<fieldset>
		<legend>Datos Empleado Público</legend>
		<input type="hidden" name="persona_id" value="">
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Buscar Persona</label>
				<div class="col-sm-8">
					<input type="search" id="search_persona_visita" class="form-control search_persona">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Tipo Documento</label>
				<div class="col-sm-8">
					<?php echo $this->Form->select('tipodocumento_id', $documentos, ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Número DNI</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('documento_numero', ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Nombres</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_nombre', ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Apellido Paterno</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_apepat', ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Apellido Materno</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_apemat', ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Cargo</label>
				<div class="col-sm-8">
					<?php echo $this->Form->select('cargo_id', $cargos, ['class' => 'form-control']) ?>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Visitantes</legend>
		<input type="button" value="Agregar Visitante" class="btn btn-default" data-toggle="modal" data-target="#modal-visitante">
		<table class="table">
			<thead>
				<tr>
					<th>N</th>
					<th>Documento</th>
					<th>Nombres</th>
					<th>Apellidos</th>
				</tr>
			</thead>
			<tbody id="tblVisitantes">
				<tr class="no-data">
					<td colspan="4" class="text-center">No hay registros que mostrar</td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<div class="form-group">
		<?php echo $this->Form->button(__('Enviar'), ['class' => 'btn btn-primary']); ?>
		<?php echo $this->Form->button(__('Limpiar'), ['type' => 'reset', 'class' => 'btn btn-default']); ?>
	</div>
	<br><br>
<?php echo $this->Form->end() ?>
<div class="modal fade" id="modal-visitante">
  <div class="modal-dialog" style="z-index:2000">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Registra Visitante</h4>
	</div>
	<div class="modal-body">
		<?php echo $this->Form->create($persona, ['action' => 'registrarVisitante', 'id' => 'frm-visitante']) ?>
		<input type="hidden" name="persona_id" value="">
		<fieldset>
			<legend>Información Básica</legend>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Buscar Persona</label>
					<div class="col-sm-8">
						<input type="search" id="search_persona_visitante" class="form-control search_persona">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Tipo Documento</label>
					<div class="col-sm-8">
						<?php echo $this->Form->select('tipodocumento_id', $documentos, ['type' => 'select', 'class' => 'form-control']) ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Número DNI</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('documento_numero', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Nombres</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('persona_nombre', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Apellido Paterno</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('persona_apepat', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Apellido Materno</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('persona_apemat', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Datos de la empresa</legend>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Número de Ruc</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('documento_numero', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="" class="control-label col-sm-4">Nombre Empresa</label>
					<div class="col-sm-8">
						<?php echo $this->Form->text('persona_nombres', ['class' => 'form-control']) ?>
					</div>
				</div>
			</div>
		</fieldset>
		<hr>
		<div class="text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        	<button class="btn btn-primary">Guardar</button>
		</div>
		<?php echo $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>