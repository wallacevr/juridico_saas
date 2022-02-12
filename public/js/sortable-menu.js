$(document).ready(function () {
    // Define o HTML dos botões que gerenciam as linhas de categorias
    // const buttonElement = '<div class="float-right border"><button class="bg-white hover:bg-gray-100 py-0 px-3 text-black">Edit</button><button type="button" class="bg-white hover:bg-gray-100 py-0 px-3 text-black delete-menu">Delete</button></div>'
    const editAction =
        '<div class="float-right"><a href="#" class="underline text-blue-900 py-0 px-3 remove-button">Remove</a></div>'
    let removedItems = []

    // Define o menu aninhado de categorias
    $('.menu-items').sortable({
        items: 'li',
        nested: true,
        vertical: true,
        placeholderClass: 'test-class',
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

    // Adiciona uma nova categoria no final da lista de categorias
    $('.add-menu').click(function (e) {
        e.preventDefault()
        let subcategoryName = $('#subcategoryTitle').val()
        let subcategoryUrl = $('#subcategoryUrl').val()

        if (subcategoryName === '' || subcategoryUrl === '') {
            // Exibir no front que é pra preencher tudo
            return false
        } else {
            // Esconder no front que é pra preencher tudo
            $('#subcategoryTitle').val('')
            $('#subcategoryUrl').val('')
        }

        $('.menu-items').append(
            `<li data-name='${subcategoryName}' data-url='${subcategoryUrl}'>
                ${subcategoryName}
                ${editAction}
                <ol></ol>
            </li>`
        )

        updateMenuItemsInput()
    })

    // Deleta a categoria da linha ao clicar no botão de DELETE
    $(document).on('click', '.remove-button', function (e) {
        const currentLi = $(this).closest('li')

        removedItems.push($(currentLi).data('id'))

        $('#menu-items-delete').val(removedItems)

        currentLi.remove()
    })

    // Atualiza o input contendo os dados da lista de menus
    function updateMenuItemsInput () {
        let data = $('ol.menu-items')
            .sortable('serialize')
            .get()

        $('#menu-items-input').val(JSON.stringify(data, null))
    }
})
