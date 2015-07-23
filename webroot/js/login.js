
var form = document.getElementsByTagName('form')[0];

	form.addEventListener('submit', function(){
		var btn = document.getElementById('btn-sign-in');
			btn.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Ingresando...';
			btn.disabled = true;
	});