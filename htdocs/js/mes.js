// mês

let data = new Date()
let monthBruto = (data.getMonth()+1)

let month = null

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



let calendar = document.querySelector('#show-calendar')
let calendarBox = document.querySelector('#calendar')
let months = document.querySelectorAll('.m')

let left = document.querySelector('#left')
let right = document.querySelector('#right')
let year = document.querySelector('#year')

let date = new Date()
let month2 = (date.getMonth() + 1)
let fullYear = date.getFullYear()
let monthDefault = (date.getMonth() + 1)

switch(monthDefault){
    case 1:
        month2 = '01'
        break
    case 2:
        month2 = '02'
        break
    case 3:
        month2 = '03'
        break
    case 4:
        month2 = '04'
        break
    case 5:
        month2 = '05'
        break
    case 6:
        month2 = '06'
        break
    case 7:
        month2 = '07'
        break
    case 8:
        month2 = '08'
        break
    case 9:
        month2 = '09'
        break
}


switch(month){
    case '01':
        mes.innerHTML = 'Jan'
        break
    case '02':
        mes.innerHTML = 'Fev'
        break
    case '03':
        mes.innerHTML = 'Mar'
        break
    case '04':
        mes.innerHTML = 'Abr'
        break
    case '05':
        mes.innerHTML = 'Mai'
        break
    case '06':
        mes.innerHTML = 'Jun'
        break
    case '07':
        mes.innerHTML = 'Jul'
        break
    case '08':
        mes.innerHTML = 'Ago'
        break
    case '09':
        mes.innerHTML = 'Set'
        break
    case 10:
        mes.innerHTML = 'Out'
        break
    case 11:
        mes.innerHTML = 'Nov'
        break
    case 12:
        mes.innerHTML = 'Dez'
        break
}

year.innerHTML = fullYear

left.addEventListener('click', () => {
    year.innerHTML -= 1
})

right.addEventListener('click', () => {
    year.innerHTML = parseInt(year.innerHTML)+1
})

months.forEach(m => {
    

    m.addEventListener('click', () => {
        mes.innerHTML = m.innerHTML
        calendarBox.classList.toggle('d-none')
        getDataForDash(m.innerHTML)
        
    })
})

calendar.addEventListener('click', () => {
    calendarBox.classList.toggle('d-none')
})


function getDataForDash(month = monthDefault){
    let newMonth = null
    const xhttp = new XMLHttpRequest()
    switch(month){
        case 'jan':
                newMonth = '01'
            break
        case 'fev':
            newMonth = '02'
            break
        case 'mar':
            newMonth = '03'
            break
        case 'abr':
            newMonth = '04'
            break
        case 'mai':
            newMonth = '05'
            break
        case 'jun':
            newMonth = '06'
            break
        case 'jul':
            newMonth = '07'
            break
        case 'ago':
            newMonth = '08'
            break
        case 'set':
            newMonth = '09'
            break
        case 'out':
            newMonth = '10'
            break
        case 'nov':
            newMonth = '11'
            break
        case 'dez':
            newMonth = '12'
            break
    }

    xhttp.onreadystatechange = () => {
        if(xhttp.status === 200 && xhttp.readyState === 4){
            let dados = JSON.parse(xhttp.responseText)

            document.querySelector('#saldo').innerHTML = `R$ ${(dados.totalRent - dados.totalExpense).toFixed(2)}`
            document.querySelector('#rent').innerHTML = `R$ ${dados.totalRent ? dados.totalRent.toFixed(2) : (0).toFixed(2)}`
            document.querySelector('#expense').innerHTML = `R$ ${dados.totalExpense ? dados.totalExpense.toFixed(2) : (0).toFixed(2)}`



        }
    }
    xhttp.open('GET', `/getDataByMonth?month=${newMonth}`)
    xhttp.send()

}   