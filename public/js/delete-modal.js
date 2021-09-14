document.addEventListener('DOMContentLoaded', function () {
    let modal = document.getElementById('delete-modal')
    let outsideModal = document.getElementById('outside-modal')

    let confirmButton = document.getElementById('confirm-delete')
    let cancelButton = document.getElementById('cancel-button')

    document.querySelectorAll('.delete-resource-button').forEach(element =>
        element.addEventListener('click', e => {
            e.preventDefault()

            openModal()

            confirmButton.onclick = () => {
                e.target.closest('form').submit()
                closeModal()
            }
        })
    )

    cancelButton.onclick = () => {
        closeModal()
    }

    window.onclick = e => {
        if (e.target === outsideModal) {
            closeModal()
        }
    }

    function closeModal () {
        return (modal.style.display = 'none')
    }

    function openModal () {
        return (modal.style.display = 'block')
    }
})
