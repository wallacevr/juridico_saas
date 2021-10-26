$(document).ready(function () {
    // Show option modal form and clear input
    $('#new-option-button').click(function (e) {
        e.preventDefault()

        $('#option-modal').show()
        $('#add-label').show()
        $('#update-label').hide()
        $('#optionForm').attr('action', '/admin/options')

        clearOptionForm()
    })

    // Show option modal form and show diff inputs based on type value
    $('.update-option-button').click(function (e) {
        e.preventDefault()

        $('#option-modal').show()
        $('#add-label').hide()
        $('#update-label').show()
        $('#optionForm').attr('action', '/admin/options/' + $(this).data('id'))
        $('#_method').val('PUT')

        if ($(this).data('type') === 'IMAGE') {
            $('#type').val('IMAGE').change()

            let currentImageUrl = $('#option-' + $(this).data('id')).attr('src')

            $('#file-upload-image').attr('src', currentImageUrl)

            $('#image-upload-wrap').hide()
            $('#file-upload-content').show()
        } else if ($(this).data('type') === 'COLOR') {
            $('#type').val('COLOR').change()

            $('#color-input').val($(this).data('value'))
            $('#color-picker').val($(this).data('value'))
        } else {
            $('#value').val($(this).data('value'))
        }

        $('#option_id').val($(this).data('id'))
        $('#option_name').val($(this).data('name'))
    })

    // Close modal and clear input
    $('.close-modal').click(function (e) {
        e.preventDefault()

        clearOptionForm()
        $('#option-modal').hide()
    })

    // Change color input value on change
    $('#color-picker').bind('input', function (e) {
        e.preventDefault()

        $('#color-input').val($('#color-picker').val())
    })

    // Display/hide inputs based on type
    $('#type').change(function (e) {
        e.preventDefault()

        if (this.value === 'IMAGE') {
            $('.color-block').hide()
            $('.image-block').show()
        } else {
            $('.image-block').hide()
            $('.color-block').show()
        }
    })

    // Form input clear function
    function clearOptionForm () {
        $('#_method').val(null)
        $('#option_id').val(null)
        $('#option_name').val(null)
        $('#color-input').val(null)
        $('#color-picker').val('#000000')
        $('#type').val($('#type option:first').val())
        $('#image_url').val(null)
        $('.image-block').hide()
        $('.color-block').show()
        $('#file-upload-content').hide()
        $('#image-upload-wrap').show()
    }
})
