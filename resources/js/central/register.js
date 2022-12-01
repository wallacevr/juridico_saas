$(function() {

   // $('#register-form #taxvat').mask('000.000.000-00');
// Mascara de CPF e CNPJ
var CpfCnpjMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
},
cpfCnpjpOptions = {
onKeyPress: function(val, e, field, options) {
  field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
}
};
$(function() {
	$('.cpfcnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);
})



    $('#phone').mask('(00) 00000-0000');
    $('#telephone').mask('(00) 0000-0000');

    $("#register-form").validate({
        rules: {
            company: {
                required: true
            },email: {
                email: true
            },
            password: {
                required: true,
                minlength: 5
            },
            password_confirmation: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            taxvat:{
                documentId: true
            }
        }
    });
});
