<div id="content-visita">
	<h1 class="page-header"><?php echo $title ?></h1>
	<?php if (!empty($this->Flash)): ?>
		<div class="alert alert-warning">
			<?php echo $this->Flash->render('error') ?>
		</div>
	<?php endif ?>
	<div>
	<?php echo $this->Form->create($persona, ['action' => 'registrarVisita', 'id' => 'frm-visita']) ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Datos de la Visita</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Fecha de Visita</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="visita_fecha" id="Visitavisita_fecha" placeholder="dd-mm-yyyy" maxlength="10"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Hora de Visita</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="visita_horaprogramada" id="Visita_horaprogramada" placeholder="yyyy-mm-dd" maxlength="10"/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Lugar de reunión</label>
						<div class="col-sm-4">
			        		<?php echo $this->Form->select('lugar_id', $lugares, ['class' => 'form-control chosen-select', 'empty' => 'Seleccione']) ?>
						</div>
					</div>
		        </div>
		        <div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Motivo de reunión</label>
						<div class="col-sm-4">
			        		<?php echo $this->Form->select('motivo_id', $motivos, ['class' => 'form-control chosen-select','empty' => 'Seleccione']) ?>
						</div>
					</div>
		        </div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Organigrama</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-sm-2">Organigrama</label>
						<div class="col-sm-4">
							<?php echo $this->Form->select('organigrama_id', $organigramas, ['class' => 'form-control organigrama_cbo chosen-select', 'id' => 'organigrama_id']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Datos Empleado Público</h3>
			</div>
			<div class="panel-body">
				<input type="hidden" name="personal_id" value="">
				<input type="hidden" name="hdnorganigrama_id" value="">
				<div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Buscar Persona</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="search" id="search_persona_visita" class="form-control search_persona">
								<span class="input-group-btn visibility-hidden">
									<button class="btn btn-danger btn-remove-text-autoc" type="button"><i class="fa fa-times"></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="" class="control-label col-sm-2">Tipo Documento</label>
						<div class="col-sm-8">
							<?php echo $this->Form->select('tipodocumento_id', $documentos, ['class' => 'form-control chosen-select']) ?>
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
							<?php echo $this->Form->select('cargo_id', $cargos, ['class' => 'form-control chosen-select']) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Visitantes</h3>
			</div>
			<div class="panel-body">
				<input type="button" value="Agregar Visitante" class="btn btn-default ativa-scroll" data-toggle="modal" data-target="#modal-visitante">
				<hr>
				<table class="table table-condensed">
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
			</div>
		</div>
		<div class="form-group">
			<?php echo $this->Form->button(__('Enviar'), ['class' => 'btn btn-primary']); ?>
			<?php echo $this->Form->button(__('Limpiar'), ['type' => 'reset', 'class' => 'btn btn-default']); ?>
		</div>
		<br><br>
	<?php echo $this->Form->end() ?>
	</div>
	<div class="modal fade" id="modal-visitante">
	  <div class="modal-dialog" style="z-index:2000">
	    <div class="modal-content">
	    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Registra Visitante</h4>
			</div>
		<div class="modal-body">
			<div class="alert alert-warning" id="mensaje-registro-visitante" style="display	:none;">
				Este persona se encuentra registrada como personal de la institución.
			</div>
			<?php echo $this->Form->create($persona, ['action' => 'registrarVisitante', 'id' => 'frm-visitante']) ?>
			<input type="hidden" name="visitante_id" value="">
			<input type="hidden" name="persona_id" value="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"></h4>Información Básica
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="row">
							<label for="" class="control-label col-sm-4">Buscar Persona</label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="search" id="search_persona_visitante" class="form-control search_persona">
									<span class="input-group-btn visibility-hidden">
										<button class="btn btn-danger btn-remove-text-autoc" type="button"><i class="fa fa-times"></i></button>
									</span>
								</div>
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
				</div>
			</div>
			<div class="panel panel-default">
				<input type="hidden" name="personal_emp_id" value="">
				<div class="panel-heading"><h4 class="panel-title">Datos de la empresa</h4></div>
				<div class="panel-body">
					<input type="hidden" name="empresa_id">
					<div class="form-group">
						<div class="row">
							<label for="" class="control-label col-sm-4">Número de Ruc</label>
							<div class="col-sm-8">
								<input type="buscar" id="ruc_numero" name="ruc_numero" class="form-control search_empresa">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label for="" class="control-label col-sm-4">Nombre Empresa</label>
							<div class="col-sm-8">
								<?php echo $this->Form->text('empresa_nombre', ['class' => 'form-control']) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
		</div>
		<div class="modal-footer">			
			<div class="text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" id="btn-visitante">Guardar</button>
			</div>
		</div>	
			<?php echo $this->Form->end() ?>
	      
	    </div>
	  </div>
	</div>
</div>
<script id="cbo-organigramas" type="text/x-handlebars-template">
  <div class="form-group form-group-sm">
		<div class="row">
			<label class="control-label col-sm-2">{{ label }}</label>
			<div class="col-sm-4">
				<select name="organigrama" class="form-control organigrama_cbo">
					{{{ options }}}
				</select>
			</div>
		</div>
	</div>
</script>