<div class="users form">
<?php echo $this->Flash->render() ?>
<?php echo $this->Flash->render('auth') ?>
<?php echo $this->Form->create() ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password') ?></legend>
        <?php echo $this->Form->input('usuario_login') ?>
        <?php echo $this->Form->input('usuario_clave', ['type' => 'password']) ?>
    </fieldset>
<?php echo $this->Form->button(__('Login')); ?>
<a href="registrar">Registrar</a>
<?php echo $this->Form->end() ?>
</div>