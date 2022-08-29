$(function() {
    
    $('#register-form #taxvat').mask('000.000.000-00');
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