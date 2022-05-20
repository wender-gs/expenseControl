let q = document.querySelector('#sLPP')
let ops = document.querySelectorAll('.optlpp')
let textPerPage = document.querySelector('#nOL')
let qbox = document.querySelector('#lPPM')

//variaveis de paginação
let pagina = 1

q.addEventListener('click', () => {
    qbox.classList.toggle('d-block')
})

window.onload = () => {
    getDataExpense()
}

ops.forEach(i => {
    i.addEventListener('click', () => {
        let optValue = i.querySelector('input').value
        qbox.classList.remove('d-block')
        getDataExpense(optValue)
    })
})

function getDataExpense(limit = 5, offset = 0, pg = 1){
    const xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = () => {
        if(xhttp.readyState === 4 && xhttp.status === 200){
            document.querySelector('#tbody-data').innerHTML = xhttp.responseText
            textPerPage.innerHTML = limit
        }
    }
    xhttp.open('GET', `https://controledegastos.com/dataRentReturn?limit=${limit}&offset=${offset}&pg=${pg}`)
    xhttp.send()
}

function previusPage(total){
    let limit = parseInt(textPerPage.innerHTML)

    let breakPoint = Math.ceil(total / limit)

    pagina -= 1  

    if(pagina <= 1){
        pagina = 1
    }
    getDataExpense(limit, 0, pagina)
}

function nextPage(total){
    let limit = parseInt(textPerPage.innerHTML)

    let breakPoint = Math.ceil(total / limit)

    pagina += 1  
    
    if(pagina >= breakPoint){
        pagina = breakPoint
    }
    getDataExpense(limit, 0, pagina)
}

function lastPage(total){
    let limit = parseInt(textPerPage.innerHTML)
    
    let last = Math.ceil(total / limit);

    pagina = last
    getDataExpense(limit, 0, last)
}