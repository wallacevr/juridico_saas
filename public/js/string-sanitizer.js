document.addEventListener('DOMContentLoaded', function () {
    let shortcodeInput = document.getElementById('short_code')
    let shortcodePreview = document.getElementById('shortcode-preview')

    shortcodeInput.addEventListener('input', () => {
        shortcodePreview.textContent = stringSanitizer(
            shortcodeInput.value,
            '_'
        )
    })

    function stringSanitizer (str, separator) {
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
            .replace(/\s+/g, separator)
            .replace(/-+/g, separator)

        return str
    }
})
