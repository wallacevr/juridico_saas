document.addEventListener('DOMContentLoaded', function () {
    let nameInput = document.getElementById('name')
    let slugInput = document.getElementById('slug')
    let imageUploadWrap = document.getElementById('image-upload-wrap')
    let fileUploadImage = document.getElementById('file-upload-image')
    let fileUploadContent = document.getElementById('file-upload-content')
    let imageTitle = document.getElementById('image-title')
    let fileUploadInput = document.getElementById('image_url')
    let removeImageButton = document.getElementById('remove-image')

    /*
     *  String slug converter scripts
     */

    nameInput.addEventListener('input', () => {
        slugInput.value = convertToSlug(nameInput.value)
    })

    function convertToSlug (str) {
        str = str.replace(/^\s+|\s+$/g, '')
        str = str.toLowerCase()

        const from =
            'ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;'
        const to =
            'AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------'

        for (let i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i))
        }

        str = str
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')

        return str
    }

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
