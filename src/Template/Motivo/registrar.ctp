<div id="content-visita">
	<h1 class="page-header"><?php echo $title ?></h1>
	<?php echo $this->Flash->render() ?>
	<div>
	<?php echo $this->Form->create($motivo, ['action' => 'add', 'id' => 'frm-motivo']) ?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Motivo</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<label class="control-label col-sm-2">Motivo</label>
						<div class="col-sm-4">
							<?php echo $this->Form->text('motivo_descripcion', ['class' => 'form-control']) ?>
						</div>
					</div>
				</div>
				<div class="form-group">
                    <label>Color picker with addon:</label>
                    <div class="input-group my-colorpicker2 colorpicker-element">
                      <input type="text" class="form-control">
                      <div class="input-group-addon">
                        <i style="background-color: rgb(132, 92, 92);"></i>
                      </div>
                    </div>
                  </div>
			</div>
		</div>
		
		<div class="form-group">
			<?php echo $this->Form->button(__('Enviar'), ['class' => 'btn btn-primary']); ?>
			<?php echo $this->Form->button(__('Limpiar'), ['type' => 'reset', 'class' => 'btn btn-default']); ?>
		</div>
		
		<br><br>
	</div>	
</div>	
	<?php echo $this->Form->end() ?>	