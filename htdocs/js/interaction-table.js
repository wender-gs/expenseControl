function edit(id){

    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () =>{
        if(xhttp.status == 200 && xhttp.readyState == 4){
            let despesas = xhttp.responseText
            let pg;
            let txt;
            let iP = document.getElementById('switch-edit')
            let c = document.getElementById('text-edit')
            let wal = document.getElementById('wa-edit')

            let despesa = JSON.parse(despesas)


            if(despesa[0].isPaid == 'pago'){
                pg = true
                txt = 'Foi Paga'
                iP.value = 'pago'
                
                
            }else{
                pg = false
                txt = 'Não Foi Paga'
                iP.value = 'n/p'
            }

            document.getElementById('valor-edit').value = despesa[0].value_expense
            iP.checked=pg
            document.getElementById('text-switch-edit').innerHTML = txt
            document.getElementById('dt-edit').value = despesa[0].date_expense
            document.getElementById('bene-edit').value = despesa[0].recipient
            document.getElementById('text-edit').innerHTML = despesa[0].category
            document.getElementById('wa-edit').innerHTML = despesa[0].wallet

            let b = document.getElementById('bene-edit')
            let d = document.getElementById('dt-edit')
            let t = document.getElementById('valor-edit')
            let btnSave = document.getElementById('btn-save-edit')
            let toggle = document.getElementById('toggle')

            toggle.addEventListener('click', () => {
                if(iP.value == 'pago'){
                    iP.value = 'n/p'
                }else{
                    iP.value = 'pago'
                }
            })

            btnSave.addEventListener('click', () => {
                window.location.href=`/edit?id=${despesa[0].id}&pay=${b.value}&date=${d.value}&value=${t.value}&isPaid=${iP.value}&cat=${c.innerHTML}&wallet=${wal.innerHTML}`
            })

            
            modal('modal-edit-despesa')
        }
    }
    xhttp.open("GET", `/editExpense?id_expense=${id}`)
    xhttp.send()
}


function exclude(id){
    window.location.href=`/excludeExpense?id_expense=${id}`
}

function pay(id){
    window.location.href=`/payExpense?id_expense=${id}`
}

function recive(id){
    window.location.href=`/payRent?id_rent=${id}`
}

function excludeRent(id){
    window.location.href=`/excludeRent?id_rent=${id}`
}

function editRent(id){

    const xhttp = new XMLHttpRequest()

    xhttp.onreadystatechange = () => {
        if(xhttp.readyState == 4 && xhttp.status == 200){
            let data = JSON.parse(xhttp.responseText)
            console.log(data)

            let pg
            let txt
            let value = document.querySelector('#valor-receita-edit')
            let isPaid = document.querySelector('#switch-receita-edit')
            let textPaid = document.querySelector('#text-switch-receita-edit')
            let date = document.querySelector('#dt-receita-edit')
            let payer = document.querySelector('#pagador-receita-edit')
            let txtCategory = document.querySelector('#text-receita-edit')
            let txtWallet = document.querySelector('#wallet-text-edit')
            let toggleRent = document.querySelector('#toggle-rent')
            let sendEditRent = document.getElementById('send-edit-rent')


            if(data[0].isPaid == 'liquidado'){
                pg = true
                txt = 'Liquidado'
                isPaid.value = 'liquidado'
            }else{
                pg = false
                txt = 'Pendente'
                isPaid.value = 'pendente'
            }

            value.value = data[0].value_rent
            textPaid.innerHTML = txt
            isPaid.checked = pg
            date.value = data[0].date_rent
            payer.value = data[0].payer
            txtCategory.innerHTML = data[0].category
            txtWallet.innerHTML = data[0].wallet
            toggleRent.addEventListener('click', () => {

                if(isPaid.value == 'liquidado'){
                    isPaid.value = 'pendente'
                    textPaid.innerHTML = 'pendente' 
                    
                }else{
                    isPaid.value = 'liquidado'
                    textPaid.innerHTML = 'liquidado' 
                }
            })

            sendEditRent.addEventListener('click', () => {
                window.location.href=`/saveEditRent?id=${data[0].id}&value=${value.value}&isPaid=${isPaid.value}&date=${date.value}&payer=${payer.value}&category=${txtCategory.innerHTML}&wallet=${txtWallet.innerHTML}`
            })


            modal('modal-edit-receita')
        }
    }

    xhttp.open('GET', `/editRent?id_rent=${id}`)
    xhttp.send()
}