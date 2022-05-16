// carteira da receita

let walletSelectorReceita = document.getElementById('wallet-selector-receita')
let walletBoxReceita = document.getElementById('carteira-receita')
let textWalletReceita = document.getElementById('wallet-text')
let walletoptReceita = document.querySelectorAll('.option.w')

walletSelectorReceita.addEventListener('click', () => {
    walletBoxReceita.classList.toggle('active-options')
})

walletoptReceita.forEach(o => {
    o.addEventListener('click', () => {
        textWalletReceita.innerHTML = o.querySelector('label').innerHTML
        walletBoxReceita.classList.remove('active-options')
    })
})




// categorias das receita

let catSelectorReceita = document.getElementById('cat-selector-receita')
let catBoxReceita = document.getElementById('categoria-receita')
let textCatReceita = document.getElementById('text-receita')
let optReceita = document.querySelectorAll('.option.r')

catSelectorReceita.addEventListener('click', () => {
    catBoxReceita.classList.toggle('active-options')
})

optReceita.forEach(o => {
    o.addEventListener('click', () => {
        textCatReceita.innerHTML = o.querySelector('label').innerHTML
        catBoxReceita.classList.remove('active-options')
    })
})