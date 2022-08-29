$(function() {
    $("#step-form").validate({
        rules: {
            email: {
                email: true,
                required: true
            }
        }
    });
});