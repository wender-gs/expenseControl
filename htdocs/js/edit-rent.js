//////// edit receita

let editCatRent = document.getElementById('cat-selector-receita-edit')
let catEditRentOptions = document.querySelector('#categoria-receita-edit')
let optionsRentEdit = document.querySelectorAll('.option.rent')

let textCatRent = document.querySelector('#text-receita-edit')



editCatRent.addEventListener('click', () => {
    catEditRentOptions.classList.toggle('active-options')
})

optionsRentEdit.forEach(e => {
    e.addEventListener('click', () => {
        textCatRent.innerHTML = e.querySelector('label').innerHTML
        catEditRentOptions.classList.remove('active-options')
    })
})


////edit wallet

let editWalletRent = document.querySelector('#wallet-selector-receita-edit')
let editWalletOptions = document.querySelector('#carteira-receita-edit')
let editOptionsWallet = document.querySelectorAll('.option.wallet')

let txtEditWallet = document.querySelector('#wallet-text-edit')


editWalletRent.addEventListener('click', () => {
    editWalletOptions.classList.toggle('active-options')
})

editOptionsWallet.forEach(c => {
    c.addEventListener('click', () => {
        txtEditWallet.innerHTML = c.querySelector('label').innerHTML
        editWalletOptions.classList.remove('active-options')
    })
})