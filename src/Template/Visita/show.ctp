<?php echo $this->Flash->render('error') ?>
<?php echo $this->Form->create($visita, ['action' => 'guardarVisita', 'id' => 'frm-updvisita']) ?>
<div id="content-visita">
<input type="hidden" name="id" value="<?php echo $visita->id ?>">
<input type="hidden" name="hdnorganigrama_id" value="<?php echo $visita->organigrama_id ?>">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Datos de la Visita</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Fecha de Visita</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="visita_fecha" id="Visitavisita_fecha" placeholder="dd-mm-yyyy" maxlength="10" value="<?php echo $visita->visita_fecha ?>" />
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Hora de Visita</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="visita_horaprogramada" id="Visita_horaprogramada" placeholder="yyyy-mm-dd" maxlength="10" value="<?php echo $visita->visita_horaprogramada ?>" />
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Lugar de reunión</label>
				<div class="col-sm-4">
					<?php echo $this->Form->select( 'lugar_id', $lugares, ['class' => 'form-control', 'default' => $visita->lugar_id]) ?>
				</div>
			</div>
        </div>
        <div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Motivo de reunión</label>
				<div class="col-sm-4">
	        		<?php echo $this->Form->select('motivo_id', $motivos, ['class' => 'form-control', 'default' => $visita->motivo_id]) ?>
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
					<?php echo $this->Form->select('organigrama_id', $organigramas, ['class' => 'form-control organigrama_cbo', 'id' => 'organigrama_id'], $visita->organigrama_id) ?>
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
		<input type="hidden" name="personal_id" value="<?php echo $visita->personal_id?>">
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Buscar Persona</label>
				<div class="col-sm-8">
					<div class="input-group">
						<input type="search" id="search_persona_visita_upd" class="form-control search_persona" value="<?php echo $personal->p['persona_nombre'].' '.$personal->p['persona_apepat'].' '.$personal->p['persona_apemat'] ?>">
						<span class="input-group-btn visibility-hide">
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
					<?php echo $this->Form->select('tipodocumento_id', $documentos, ['class' => 'form-control','default' => $personal->p['tipodocumento_id']]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Número DNI</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('documento_numero', ['class' => 'form-control', 'value' => $personal->p['documento_numero']]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Nombres</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_nombre', ['class' => 'form-control', 'value' => $personal->p['persona_nombre']]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Apellido Paterno</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_apepat', ['class' => 'form-control', 'value' => $personal->p['persona_apepat']]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Apellido Materno</label>
				<div class="col-sm-8">
					<?php echo $this->Form->text('persona_apemat', ['class' => 'form-control', 'value' => $personal->p['persona_apemat']]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label for="" class="control-label col-sm-2">Cargo</label>
				<div class="col-sm-8">
					<?php echo $this->Form->select('cargo_id', $cargos, ['class' => 'form-control', 'default' => $personal->cargo_id]) ?>
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
		<input type="button" value="Agregar Visitante" class="btn btn-default" data-toggle="modal" data-target="#modal-visitante">
		<hr>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Documento</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="tblVisitantes">
			<?php foreach ($visitantes as $key): ?>

			<input type="hidden" name="visitante_id[]" value="<?php echo $key->id ?>|<?php echo $key->v['id'] ?>">
			<tr data-id="<?php echo $key->id ?>">
				<td><?php echo $key->p['documento_numero'] ?></td>
				<td><?php echo $key->p['persona_nombre'] ?></td>
				<td><?php echo $key->p['persona_apepat'] . ' ' .$key->p['persona_apemat'] ?></td>
				<td>
					<button type="button" class="btn btn-xs btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete-confirm">Eliminar</button>
				</td>
			</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="form-group">
	<?php echo $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']); ?>
	<?php echo $this->Form->button(__('Limpiar'), ['type' => 'reset', 'class' => 'btn btn-default']); ?>
</div>
<br><br>
<?php echo $this->Form->end() ?>

<div class="modal fade" id="modal-delete-confirm" style="z-index:0">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Advertencia</h4>
		</div>
		<div class="modal-body">
			<?php echo $this->Form->create(null, ['url' => ['controller' => 'Visitante', 'action' => 'removeVisitante'], 'type' => 'put']) ?>
			<input type="hidden" name="id">
			<p>Segura de Eliminar este visitante de esta visita?</p>
			<div class="text-right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-danger">Eliminar</button>
			</div>
			<?php echo $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-visitante">
	  <div class="modal-dialog" style="z-index:2000">
	    <div class="modal-content">
	    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Registra Visitante</h4>
			</div>
		<div class="modal-body">
			<?php echo $this->Form->create(null, ['url' => ['controller' => 'Persona', 'action' => 'registrarVisitante'] ,'id' => 'frm-visitante-upd']); ?>
			<input type="hidden" name="persona_id" value="">
			<input type="hidden" name="visitante_id" value="">
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
				<div class="panel-heading"><h4 class="panel-title">Datos de la empresa</h4></div>
				<div class="panel-body">
					<input type="hidden" name="empresa_id">
					<div class="form-group">
						<div class="row">
							<label for="" class="control-label col-sm-4">Número de Ruc</label>
							<div class="col-sm-8">
								<?php echo $this->Form->text('ruc_numero', ['class' => 'form-control', 'id' => 'ruc_numero']) ?>
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
				<button class="btn btn-primary">Guardar</button>
			</div>
		</div>	
			<?php echo $this->Form->end() ?>
	      
	    </div>
	  </div>
	</div>
</div>	