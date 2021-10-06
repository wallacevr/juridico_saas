document.addEventListener('DOMContentLoaded', function () {
    let imageUploadWrap = document.getElementById('image-upload-wrap')
    let fileUploadImage = document.getElementById('file-upload-image')
    let fileUploadContent = document.getElementById('file-upload-content')
    let imageTitle = document.getElementById('image-title')
    let fileUploadInput = document.getElementById('image_url')
    let removeImageButton = document.getElementById('remove-image')

    /*
     *  Image Upload Scripts
     */

    fileUploadInput.addEventListener('change', e => {
        readURL(e.target)
    })

    removeImageButton.addEventListener('click', () => {
        removeUpload()
    })

    function readURL (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader()

            reader.onload = function (e) {
                imageUploadWrap.style.display = 'none'

                fileUploadImage.src = e.target.result

                fileUploadContent.style.display = 'block'

                imageTitle.innerHTML = input.files[0].name
            }

            reader.readAsDataURL(input.files[0])
        } else {
            removeUpload()
        }
    }

    function removeUpload () {
        fileUploadContent.style.display = 'none'
        imageUploadWrap.style.display = 'block'
    }
})
