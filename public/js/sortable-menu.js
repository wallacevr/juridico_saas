$(document).ready(function () {
    
    // Define o HTML dos botões que gerenciam as linhas de categorias
    // const buttonElement = '<div class="float-right border"><button class="bg-white hover:bg-gray-100 py-0 px-3 text-black">Edit</button><button type="button" class="bg-white hover:bg-gray-100 py-0 px-3 text-black delete-menu">Delete</button></div>'
    const editAction =
        '<div class="float-right"><a href="#" class="underline text-blue-900 py-0 px-3 remove-button inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg></a></div>'
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
        let submenuName = $('#submenuTitle').val()
        let submenuUrl = $('#submenuUrl').select2("val")

        if (submenuName === '' || submenuUrl === '') {
            // Exibir no front que é pra preencher tudo
            return false
        } else {
            // Esconder no front que é pra preencher tudo
            $('#submenuTitle').val('')
            $('#submenuUrl').val('').trigger('change');
        }

        $('.menu-items').append(
            `<li data-name='${submenuName}' data-url='${submenuUrl}'>
                ${submenuName}
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

    function isValidHttpUrl(string) {
        let res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        return (res !== null)
    }
    function initializeSelect2(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#submenuUrl').select2({
            selectOnClose: true,
            tags: true,
            createTag: function(params) {
                if (!isValidHttpUrl(params.term)) {
                    return null;
                }
    
                return {
                    id: params.term,
                    text: params.term
                }
            },
            language: "pt-BR",
            ajax: {
                url:searchPost,
                dataType: 'json',
                type: "post",
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term 
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                }
            }
        });
    }

    initializeSelect2()

    
})
