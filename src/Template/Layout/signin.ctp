<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Oscar Larriega <larriega@gmail.com>">
    <title>Admin</title>
    <?= $this->Html->css('admin.min.css') ?>
</head>
<body>
    <div class="container">
        <div class="row">
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