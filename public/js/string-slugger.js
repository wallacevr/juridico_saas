document.addEventListener('DOMContentLoaded', function () {
    let nameInput = document.getElementById('name')
    let slugInput = document.getElementById('slug')

    nameInput.addEventListener('input', () => {
        slugInput.value = convertToSlug(nameInput.value)
    })

    /**
     * String slug converter scripts
     *
     */

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
})
