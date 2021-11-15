// Armazenando o botão e o aviso de erro caso a consulta tenha dado erro
const postalcodeInput = document.getElementById('postalcode')
const zipWarning = document.getElementById('zip-warning')

// Adicionando o evento de clique ao botão para realizar a consulta na API VIACEP
postalcodeInput.addEventListener('input', () => {
    // Armazenando o valor do CEP no formulário
    let zipCode = postalcodeInput.value

    // Antes da formatação o CEP deve conter 9 dígitos e não ser nulo, caso seja, será exibido um aviso de erro na página
    if (zipCode == '' || zipCode.length != 9) {
        zipWarning.style.display = 'block'
        return false
    }

    // Regex para remover todos os não dígitos do CEP
    zipCode = zipCode.replace(/\D+/g, '')

    // Requisição na API VIACEP e substituição dos dados do form pelo da API
    axios
        .get('https://viacep.com.br/ws/' + zipCode + '/json/')
        .then(response => {
            if (response.status == 200 && !response.data.erro) {
                let zipRequestData = response.data

                document.getElementById('address').value =
                    zipRequestData.logradouro

                document.getElementById('neighborhood').value =
                    zipRequestData.bairro

                document.getElementById('complement').value =
                    zipRequestData.complemento

                document.getElementById('state').value = zipRequestData.uf

                document.getElementById('city').value =
                    zipRequestData.localidade

                zipWarning.style.display = 'none'
            } else {
                zipWarning.style.display = 'block'
            }
        })
})
