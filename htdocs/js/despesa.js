// carteira da despesa

let walletSelectorDespesa = document.querySelector('#wdSelector')
let walletBoxDespesa = document.querySelector('#carteira')
let walletTextDespesa = document.querySelector('#wdText')
let walletOptions = document.querySelectorAll('.option.wd')

walletSelectorDespesa.addEventListener('click', () => {
    walletBoxDespesa.classList.toggle('active-options')
})

walletOptions.forEach(o => {
    o.addEventListener('click', () => {
        walletTextDespesa.innerHTML = o.querySelector('label').innerHTML
        walletBoxDespesa.classList.remove('active-options')
    })   
})

// categoria despesa

let walletSelector = document.querySelector('#categoria-select')
let walletBox = document.querySelector('#categoria')
let walletText = document.querySelector('#cat-text')
let wallet = document.querySelectorAll('.option.waD')

walletSelector.addEventListener('click', () => {
    walletBox.classList.toggle('active-options')
})

wallet.forEach(o => {
    o.addEventListener('click', () => {
        walletText.innerHTML = o.querySelector('label').innerHTML
        walletBox.classList.remove('active-options')
    })
})