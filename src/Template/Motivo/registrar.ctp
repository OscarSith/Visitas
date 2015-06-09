
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

					<div class="row">
                    	<label class="control-label col-sm-2">Color picker with addon:</label>
                    	<div class="col-sm-4">
                    		<input type="text" class="form-control" id="motivo_color" name="motivo_color" />
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
	<?php echo $this->Form->end() ?>	