// Armazenando o botão e o aviso de erro caso a consulta tenha dado erro
const postalcodeInput = document.getElementById('postalcode')
const zipWarning = document.getElementById('zip-warning')

const addressInput = document.getElementById('address')
const neighborhoodInput = document.getElementById('neighborhood')
const complementInput = document.getElementById('complement')
const stateInput = document.getElementById('state')
const cityInput = document.getElementById('city')

// Adicionando o evento de clique ao botão para realizar a consulta na API VIACEP
postalcodeInput.addEventListener('input', () => {
    // Armazenando o valor do CEP no formulário
    let zipCode = postalcodeInput.value

    // Antes da formatação o CEP deve conter 9 dígitos e não ser nulo, caso seja, será exibido um aviso de erro na página
    if (zipCode == '' || zipCode.length != 9) {
        if (zipWarning) zipWarning.style.display = 'block'
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

                if (addressInput) addressInput.value = zipRequestData.logradouro

                if (neighborhoodInput)
                    neighborhoodInput.value = zipRequestData.bairro

                if (complementInput)
                    complementInput.value = zipRequestData.complemento

                if (stateInput) stateInput.value = zipRequestData.uf

                if (cityInput) cityInput.value = zipRequestData.localidade

                if (zipWarning) zipWarning.style.display = 'none'
            } else {
                if (zipWarning) zipWarning.style.display = 'block'
            }
        })
})
