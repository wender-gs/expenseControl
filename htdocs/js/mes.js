// mês

let data = new Date()
let monthBruto = (data.getMonth()+1)

switch(monthBruto){
    case 1:
        month = '01'
        break
    case 2:
        month = '02'
        break
    case 3:
        month = '03'
        break
    case 4:
        month = '04'
        break
    case 5:
        month = '05'
        break
    case 6:
        month = '06'
        break
    case 7:
        month = '07'
        break
    case 8:
        month = '08'
        break
    case 9:
        month = '09'
        break
}

console.log(month)

$(document).ready(() => {
    

    let textMonth = document.querySelector('#mes')

    switch(month){
        case '01':
            textMonth.innerHTML = 'Jan'
            break
        case '02':
            textMonth.innerHTML = 'Fev'
            break
        case '03':
            textMonth.innerHTML = 'Mar'
            break
        case '04':
            textMonth.innerHTML = 'Abr'
            break
        case '05':
            textMonth.innerHTML = 'Mai'
            break
        case '06':
            textMonth.innerHTML = 'Jun'
            break
        case '07':
            textMonth.innerHTML = 'Jul'
            break
        case '08':
            textMonth.innerHTML = 'Ago'
            break
        case '09':
            textMonth.innerHTML = 'Set'
            break
        case 10:
            textMonth.innerHTML = 'Out'
            break
        case 11:
            textMonth.innerHTML = 'Nov'
            break
        case 12:
            textMonth.innerHTML = 'Dez'
            break
    }

    getDataByMonth()

})

function getDataByMonth(m = month){
    const xhttpDate = new XMLHttpRequest()


    xhttpDate.onreadystatechange = () => {
        if(xhttpDate.status == 200 && xhttpDate.readyState == 4){
            console.log(JSON.parse(xhttpDate.responseText))

            let dados = JSON.parse(xhttpDate.responseText)

            document.querySelector('#saldo').innerHTML = `R$ ${(dados.totalRent - dados.totalExpense).toFixed(2)}`
            document.querySelector('#rent').innerHTML = `R$ ${dados.totalRent ? dados.totalRent.toFixed(2) : (0).toFixed(2)}`
            document.querySelector('#expense').innerHTML = `R$ ${dados.totalExpense ? dados.totalExpense.toFixed(2) : (0).toFixed(2)}`
        }
    }

    xhttpDate.open("GET", `/getDataByMonth?month=${m}`)
    xhttpDate.send()
}


const selected = document.querySelector('.selected')
const optionsContainer = document.querySelector('.options-container')
const optionList = document.querySelectorAll('.option')

optionList.forEach(o => {
    o.addEventListener('click', () => {
        selected.innerHTML = o.querySelector('label').innerHTML
        optionsContainer.classList.remove('active-select')
        getDataByMonth(o.querySelector('input').value)
        //console.log()
    })
})

selected.addEventListener('click', () => {
    optionsContainer.classList.toggle('active-select')
})