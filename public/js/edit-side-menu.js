$(document).ready(function () {
    // Abre o menu lateral para edição da menu
    $('.edit-button').click(function (e) {
        e.preventDefault()

        $('#mySidenav').addClass('px-4')

        let submenuName = $(this)
            .closest('li')
            .attr('data-name')
        let submenuUrl = $(this)
            .closest('li')
            .attr('data-url')
        let submenuId = $(this)
            .closest('li')
            .attr('id')

        $('#submenuNameEdit').val(submenuName)
        $('#submenuUrlEdit').val(submenuUrl)
        $('#submenuIdEdit').val(submenuId)

        document.getElementById('mySidenav').style.width = '350px'
    })

    // Salva as alterações da menu e o novo
    $('.save-button').click(function (e) {
        e.preventDefault()

        let submenuName = $('#submenuNameEdit').val()
        let submenuUrl = $('#submenuUrlEdit').val()
        let submenuId = '#' + $('#submenuIdEdit').val()

        $(submenuId).data('name', submenuName).sortable('refresh')
        $(submenuId).data('url', submenuUrl).sortable('refresh')
        $(submenuId).data('label', submenuName).sortable('refresh')
        $(submenuId)
            .children('span')
            .text(submenuName)
        let data = $('ol.menu-items')
            .sortable('serialize')
            .get()

        $('#menu-items-input').val(JSON.stringify(data, null))

        closeSideMenu()
    })

    // Fecha o menu lateral
    function closeSideMenu () {
        $('#mySidenav').removeClass('px-4')

        $('#submenuNameEdit').val('')
        $('#submenuUrlEdit').val('')
        $('#submenuIdEdit').val('')

        document.getElementById('mySidenav').style.width = '0'
    }

    $('.close-button').click(function (e) {
        e.preventDefault()

        closeSideMenu()
    })
})
