$(document).ready(function () {
    // Define o HTML dos botões que gerenciam as linhas de categorias
    const buttonElement =
        '<div class="float-right border"><button class="bg-white hover:bg-gray-100 py-0 px-3 text-black">Edit</button><button type="button" class="bg-white hover:bg-gray-100 py-0 px-3 text-black delete-menu">Delete</button></div>'

    // Define o menu aninhado de categorias
    $('.menu-items').sortable({
        items: 'li',
        nested: true,
        onDrop: function ($item, container, _super) {
            updateMenuItemsInput()
            _super($item, container)
        },
        isValidTarget: function ($item, container) {
            var depth = 1, // Start with a depth of one (the element itself)
                maxDepth = 3,
                children = $item
                    .find('ol')
                    .first()
                    .find('li')

            // Add the amount of parents to the depth
            depth += container.el.parents('ol').length

            // Increment the depth for each time a child
            while (children.length) {
                depth++
                children = children
                    .find('ol')
                    .first()
                    .find('li')
            }

            return depth <= maxDepth
        }
    })

    //  Exibe a modal de inserção de nova categoria
    $('.open-modal').click(function (e) {
        e.preventDefault()
        toggleModal()
    })

    // Adiciona uma nova categoria no final da lista de categorias
    $('.add-menu').click(function (e) {
        e.preventDefault()
        let menuName = $('#name').val()

        $('.menu-items').append(
            `<li data-name='${menuName}'>
                ${menuName}
                ${buttonElement}
                <ol></ol>
            </li>`
        )

        updateMenuItemsInput()
        toggleModal()
    })

    // Deleta a categoria da linha ao clicar no botão de DELETE
    $(document).on('click', '.delete-menu', function (e) {
        $(this)
            .closest('li')
            .remove()
    })

    // Atualiza o input contendo os dados da lista de menus
    function updateMenuItemsInput () {
        let data = $('ol.menu-items')
            .sortable('serialize')
            .get()

        $('#menu-items-input').val(JSON.stringify(data, null))
    }
})
