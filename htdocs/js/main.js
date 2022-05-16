// sidebar
let div_btn = document.getElementById("btn-add")
let btn = document.getElementById('btn')
let btn_icon = document.getElementById('btn-icon')

div_btn.addEventListener('click', () => {
    let menu = document.getElementById('menu')
    menu.className = 'menu'   
})

document.documentElement.onclick = function(event){
    if(event.target != div_btn && event.target != btn && event.target != btn_icon){
        menu.className = 'd-none'
    }
}

// modal
function modal(mn){
    let modal = document.getElementById(mn)
    document.documentElement.style.overflow='hidden'
    modal.classList.remove('d-none')
}

function paid(){
    let c = document.getElementById('switch')
    let id_t = document.getElementById('text-switch')

    if(c.checked){
        id_t.innerHTML = 'Foi Paga'
    }else{
        id_t.innerHTML = 'Não Foi Paga'
    }
}

function paid_receita(){
    let c = document.getElementById('switch-receita')
    let id_t = document.getElementById('text-switch-receita')

    if(c.checked){
        id_t.innerHTML = 'Liquidado'
    }else{
        id_t.innerHTML = 'Pendente'
    }
}

function fechar(mn){
    document.getElementById(mn).classList.toggle('d-none')
    document.documentElement.style.overflow = 'auto'
}

document.getElementById('switch').addEventListener('click', () => {
    paid()
})

document.getElementById('switch-receita').addEventListener('click', () => {
    paid_receita()
})

// botão de seleção entre despesa e receitas
function show(id){
    document.getElementById(id).classList.toggle('d-none')
}
