		<p class="login-box-msg">Ingrese sus datos de usuario</p>
			<?php echo $this->Form->create() ?>
				<div class="form-group has-feedback">
					<?php echo $this->Form->text('usuario_login', ['class' => 'form-control', 'placeholder' => 'Usuario', 'autofocus', 'required']) ?>
					<span class="form-control-feedback">
						<i class="fa fa-envelope fa-lg"></i>
					</span>
				</div>
				<div class="form-group has-feedback">
					<?php echo $this->Form->text('usuario_clave', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) ?>
					<span class="form-control-feedback">
						<i class="fa fa-lock fa-lg"></i>
					</span>
				</div>
				<div>
					<div class="pull-left checkbox	">
						<label>
							<input type="checkbox" name="remember"> Recordarme 
						</label>
					</div>
					<!-- <div class="pull-right" id="forgot-pass">
						<a href="password">¿Olvidaste tu contraseña?</a>
					</div> -->
					<div class="clearfix"></div>
				</div>
				<div class="form-group">
					<button class="btn btn-warning" id="btn-sign-in">
						<i class="fa fa-sign-in"></i>
						Entrar
					</button>
				</div>
				<?php echo $this->Flash->render() ?>
				<?php echo $this->Flash->render('auth') ?>
			<?php echo $this->Form->end() ?>
