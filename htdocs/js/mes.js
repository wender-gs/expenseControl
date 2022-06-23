class Calendar {
    month = (new Date().getMonth() + 1);
    year = new Date().getFullYear();

    constructor() {
    }

    getMonth() {
        return this.month;
    }
    
    getYear() {
        return this.year;
    }

    getDataByMonth(month = this.month) {
        const xhttp = new XMLHttpRequest();

        if(month === 1) {
            month = '01';
        }else if(month === 2) {
            month = '02';
        }

        xhttp.onreadystatechange = (req, res) => {
            if(xhttp.status === 200 && xhttp.readyState === 4) {
                const dados = JSON.parse(xhttp.responseText)

                document.querySelector('#saldo').innerHTML = `R$ ${(dados.totalRent - dados.totalExpense).toLocaleString('pt-br')}`
                document.querySelector('#rent').innerHTML = `R$ ${dados.totalRent ? dados.totalRent.toLocaleString('pt-br') : (0).toFixed(2)}`
                document.querySelector('#expense').innerHTML = `R$ ${dados.totalExpense ? dados.totalExpense.toLocaleString('pt-br') : (0).toFixed(2)}`
            }
        }
        xhttp.open('GET', `/getDataByMonth?month=${month}`);
        xhttp.send();
    }

    parseMonthToStringName(month) {
        switch(month){
            case 1:
                month = 'Jan';
                return month;
            case 2:
                month = 'Fev';
                return month;
            case 3:
                month = 'Mar';
                return month;
            case 4:
                month = 'Abr';
                return month;
            case 5:
                month = 'Mai';
                return month;
            case 6:
                month = 'Jun';
                return month;
            case 7:
                month = 'Jul';
                return month;
            case 8:
                month = 'Ago';
                return month;
            case 9:
                month = 'Set';
                return month;
            case 10:
                month = 'Out';
                return month;
            case 11:
                month = 'Nov';
                return month;
            case 12:
                month = 'Dez';
                return month;
        }
    }
    
    parseMonthStringToNum(month) {
        switch(month){
            case 'jan':
                month = '01'
                return month;
            case 'fev':
                month = '02'
                return month;
            case 'mar':
                month = '03'
                return month;
            case 'abr':
                month = '04'
                return month;
            case 'mai':
                month = '05'
                return month;
            case 'jun':
                month = '06'
                return month;
            case 'jul':
                month = '07'
                return month;
            case 'ago':
                month = '08'
                return month;
            case 'set':
                month = '09'
                return month;
            case 'out':
                month = '10'
                return month;
            case 'nov':
                month = '11'
                return month;
            case 'dez':
                month = '12'
                return month;
        }
    }
}

const calendario = new Calendar();
const textMonth = document.querySelector('#mes');
const calendarBox = document.querySelector('#calendar');
const calendar = document.querySelector('#show-calendar');
const months = document.querySelectorAll('.m');
const currentMonth = document.querySelector('#currentM');
const btnCancel = document.querySelector('#cancelar');


$(document).ready(() => {
    textMonth.innerHTML = calendario.parseMonthToStringName(calendario.getMonth());
    calendario.getDataByMonth();
});

calendar.addEventListener('click', () => {
    calendarBox.classList.toggle('d-none');
});

months.forEach( m => {
    m.addEventListener('click', () => {
        calendario.getDataByMonth(calendario.parseMonthStringToNum(m.innerHTML));
        textMonth.innerHTML = m.innerHTML;
        calendarBox.classList.toggle('d-none');
    });
});

currentMonth.addEventListener('click', () => {
    textMonth.innerHTML = calendario.parseMonthToStringName(calendario.getMonth());
    calendario.getDataByMonth();
    calendarBox.classList.toggle('d-none');
});

btnCancel.addEventListener('click', () => {
    calendarBox.classList.toggle('d-none');
});