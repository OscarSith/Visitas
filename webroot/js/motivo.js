$("#motivo_color").colorpicker();
$("#motivo_colorupd").colorpicker();

$("#modal-editar-motivo").on('show.bs.modal', function(e){
   	
   	var $tr = $(e.relatedTarget).closest('tr');   	
   	var form = $("#frm-editar-motivo");

   	$('[name=id]',form).val($tr.data('id'));
   	$('[name=motivo_descripcion]',form).val($tr.children(':eq(1)').text().trim());
  	$('[name=motivo_color]',form).val($tr.children(':eq(2)').text().trim());

});

$("#frm-motivo, #frm-motivo-editar").validate(validateOptions);

// $("#signupForm").validate({
// 			rules: {
// 				firstname: "required",
// 				lastname: "required",
// 				username: {
// 					required: true,
// 					minlength: 2
// 				},
// 				password: {
// 					required: true,
// 					minlength: 5
// 				},
// 				confirm_password: {
// 					required: true,
// 					minlength: 5,
// 					equalTo: "#password"
// 				},
// 				email: {
// 					required: true,
// 					email: true
// 				},
// 				topic: {
// 					required: "#newsletter:checked",
// 					minlength: 2
// 				},
// 				agree: "required"
// 			},
// 			messages: {
// 				firstname: "Please enter your firstname",
// 				lastname: "Please enter your lastname",
// 				username: {
// 					required: "Please enter a username",
// 					minlength: "Your username must consist of at least 2 characters"
// 				},
// 				password: {
// 					required: "Please provide a password",
// 					minlength: "Your password must be at least 5 characters long"
// 				},
// 				confirm_password: {
// 					required: "Please provide a password",
// 					minlength: "Your password must be at least 5 characters long",
// 					equalTo: "Please enter the same password as above"
// 				},
// 				email: "Please enter a valid email address",
// 				agree: "Please accept our policy",
// 				topic: "Please select at least 2 topics"
// 			}
// 		});