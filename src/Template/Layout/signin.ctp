<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LOGIN</title>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../bower_components/fontawesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('dist/AdminLTE.css') ?>
    <?= $this->Html->css('dist/skins/_all-skins.min.css') ?>
</head>
<body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"> <?php echo $this->Html->image('onagi-rojo.png', ['alt' => 'ONAGI','width'=>'300px']);?> </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <?= $this->fetch('content') ?>
      </div>
    </div>
    <script>
		var form = document.getElementsByTagName('form')[0];
		form.addEventListener('submit', function(){
			var btn = document.getElementById('btn-sign-in');
			btn.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Ingresando...';
			btn.disabled = true;
		});
	</script>
</body>
</html>