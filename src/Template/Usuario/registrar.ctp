<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Registrar</h3>
		</div>
		<div class="panel-body" id="register-user">
			<?php echo $this->Form->create($usuario, ['action' => 'add', 'id' => 'frm-register-user']); ?>
			<?php include 'fields.ctp'; ?>
			<?php echo $this->Form->button(__('Grabar'), ['class' => 'btn btn-primary']); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>