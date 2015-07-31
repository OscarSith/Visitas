<div class="col-sm-10 col-sm-offset-1">
	<?php echo $this->Form->create($this, ['action' => 'addOtherService', 'id' => 'content-org']) ?>
		<input type="hidden" name="personal_id" value="<?php echo $personal_id ?>">
		<div class="panel panel-default">
			<div class="panel-body pb0">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-sm-2">Organigrama</label>
						<div class="col-sm-4">
							<?php echo $this->Form->select( 'organigrama_id', $organigramas, ['class' => 'form-control organigrama_cbo', 'empty' => 'Seleccione', 'data-place' => '0' ]) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-sm-2">Cargo</label>
				<div class="col-sm-4">
					<?php echo $this->Form->select('cargo_id', $cargos, ['class' => 'form-control chosen-select','empty' => 'Seleccione']); ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="control-label col-sm-2">Sede</label>
				<div class="col-sm-4">
					<?php echo $this->Form->select( 'sede_id', $sedes, ['class' => 'form-control', 'empty' => 'Seleccione' ]) ?>
				</div>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<button class="btn btn-primary"><i class="fa fa-sitemap"></i> Agregar</button>
		</div>
	<?php echo $this->Form->end() ?>
</div>