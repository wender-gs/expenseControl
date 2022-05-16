// modal edit

let walEdit = document.getElementById('wallet-edit')
let waBoxEdit = document.getElementById('carteira-edit')
let editWaList = document.querySelectorAll('.option.wde')

let waEditText = document.getElementById('wa-edit')

walEdit.addEventListener('click', () => {
    waBoxEdit.classList.toggle('active-options')
})

editWaList.forEach(w => {
    w.addEventListener('click', () => {
        waEditText.innerHTML = w.querySelector('label').innerHTML
        waBoxEdit.classList.remove('active-options')
    })
})

function editPaid(){
    let editCheck = document.getElementById('switch-edit')
    let id_eC= document.getElementById('text-switch-edit')

    if(editCheck.checked){
        id_eC.innerHTML = 'Foi Paga'
    }else{
        id_eC.innerHTML = 'Não Foi Paga'
    }
}

document.getElementById('switch-edit').addEventListener('click', () => {
    editPaid()
})

let catEdit = document.getElementById('selected-cat-edit')
let catBoxEdit = document.getElementById('categoria-edit')
let editCatList = document.querySelectorAll('.option.edit')

let catEditText = document.getElementById('text-edit')

catEdit.addEventListener('click', () => {
    catBoxEdit.classList.toggle('active-options')
})

editCatList.forEach(e => {
    e.addEventListener('click', () => {
        catEditText.innerHTML = e.querySelector('label').innerHTML
        catBoxEdit.classList.remove('active-options')
    })
})