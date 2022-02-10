$(document).ready(function () {
    // Abre o menu lateral para edição da categoria
    $('.edit-button').click(function (e) {
        e.preventDefault()

        $('#mySidenav').addClass('px-4')

        let subcategoryName = $(this)
            .closest('li')
            .attr('data-name')
        let subcategoryUrl = $(this)
            .closest('li')
            .attr('data-url')
        let subcategoryId = $(this)
            .closest('li')
            .attr('id')

        $('#subcategoryNameEdit').val(subcategoryName)
        $('#subcategoryUrlEdit').val(subcategoryUrl)
        $('#subcategoryIdEdit').val(subcategoryId)

        document.getElementById('mySidenav').style.width = '350px'
    })

    // Salva as alterações da categoria e o novo
    $('.save-button').click(function (e) {
        e.preventDefault()

        let subcategoryName = $('#subcategoryNameEdit').val()
        let subcategoryUrl = $('#subcategoryUrlEdit').val()
        let subcategoryId = '#' + $('#subcategoryIdEdit').val()

        $(subcategoryId).data('name', subcategoryName).sortable('refresh')
        $(subcategoryId).data('url', subcategoryUrl).sortable('refresh')
        $(subcategoryId).data('label', subcategoryName).sortable('refresh')
        $(subcategoryId)
            .children('span')
            .text(subcategoryName)
        let data = $('ol.menu-items')
            .sortable('serialize')
            .get()

        $('#menu-items-input').val(JSON.stringify(data, null))

        closeSideMenu()
    })

    // Fecha o menu lateral
    function closeSideMenu () {
        $('#mySidenav').removeClass('px-4')

        $('#subcategoryNameEdit').val('')
        $('#subcategoryUrlEdit').val('')
        $('#subcategoryIdEdit').val('')

        document.getElementById('mySidenav').style.width = '0'
    }

    $('.close-button').click(function (e) {
        e.preventDefault()

        closeSideMenu()
    })
})
