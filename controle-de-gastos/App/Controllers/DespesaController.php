<?php
    namespace App\Controllers;
    session_start();

    // framework
    use CG\Controller\Action;
    use CG\Model\Container;

    class DespesaController extends Action{

      // Back-end interaction with data base
      public function consultar(){
          $despesas = Container::getModel('Despesas');
          $fk_id = $_SESSION['id'];

          // Variaveis de  paginação
          $this->view->totalDeDespesas = $despesas->getTotalExpense($fk_id);

          $this->view->dados = $despesas->consultarDespesas($fk_id);         

          $this->view->totalExpenses = $despesas->getValueTotalExpenses($fk_id);

          $this->view->expensesNp = $despesas->getExpensesNoPaid($fk_id);
          $this->view->expensesPaid = $despesas->getExpensesIsPaid($fk_id); 
          $this->render('despesas');
      }

      public function novaDespesa(){      
          $newExpense = Container::getModel('Despesas');
          
          $fk_user = $_SESSION['id'];
          $value = empty($_REQUEST['valor']) ? null : str_replace(',', '.', $_REQUEST['valor']);
          $isPaid = isset($_REQUEST['isPaid']) ? $_REQUEST['isPaid'] : 'n/p';
          $date = $_REQUEST['data'] == '' ? null : $_REQUEST['data'];
          $recipient = $_REQUEST['bene'] == '' ? null : $_REQUEST['bene'];
          $category = $_REQUEST['categoria'] == '' ? null : $_REQUEST['categoria'];
          $wallet = $_REQUEST['carteira'] == '' ? null : $_REQUEST['carteira'];

          
        
          try{
            if($newExpense->registerExpense($fk_user, $value, $isPaid, $date, $recipient, $category, $wallet)){
              header('Location: /dashboard?register=despesaRegisterSuccess');
            }
          }catch(\PDOException $e){
            if($e->getMessage()){
              header('Location: /dashboard?register=despesaRegisterError');
            }
          }
      }

      public function dataExpenseReturn(){
        $despesas = Container::getModel('Despesas');
        $fk_id = $_SESSION['id'];

        // variaveis de paginação
        $pagina = isset($_REQUEST['pg']) ? $_REQUEST['pg'] : 1;
        $total_registros_pagina = $_REQUEST['limit'];
        $deslocamento = ($pagina - 1) * $total_registros_pagina;

        try{
          if($this->view->dados = $despesas->limitExpenses($fk_id, $total_registros_pagina, $deslocamento)){
            $this->render('return-data-expense');
          }
        }catch(\PDOException $e){
          
        }

        
      }

      // manipulation of data using the view
      public function payExpense(){
        $despesas = Container::getModel('Despesas');

        $id = isset($_REQUEST['id_expense']) ? $_REQUEST['id_expense'] : null;

        $timezone = new \DateTimeZone('America/Sao_Paulo');
        $agora = new \DateTime('now', $timezone);    

        $agora->format('Y-m-d');

        try{
          $despesas->updatePyment($id, $agora->format('Y-m-d'));
          header('Location: /despesa?payment=Success');
            
        }catch(\PDOException $e){
          if($e->getMessage()){
            header('Location: /despesa?payment=Error');
          }
        }
      }

      public function excludeExpense(){

        $despesas = Container::getModel('Despesas');

        $id = isset($_REQUEST['id_expense']) ? $_REQUEST['id_expense'] : null;

        try{
          $despesas->excludeExpense($id);
          header('Location: /despesa?exclude=Success');
        }catch(\PDOException $e){
          if($e->getMessage()){
            header('Location: /despesa?exclude=Error');
          }
        }
      }

      public function editExpense(){

        $despesas = Container::getModel('Despesas');

        $despesa = $despesas->getExpenseForId($_REQUEST['id_expense']);

        $nd = array();

        foreach($despesa as $d){
          $nd[] = array(
            "id" => $d['id'],
            "date_expense" => $d['date_expense'],
            "recipient" => $d['recipient'],
            "value_expense" => $d['value_expense'],
            "isPaid" => $d['isPaid'],
            "category" => $d['category'],
            "wallet" => $d['wallet']
          );
        }

        echo json_encode($nd);
      }

      public function saveEdit(){
        $despesas = Container::getModel('Despesas');

        $id = $_REQUEST['id'];
        $pay = $_REQUEST['pay'];
        $date = $_REQUEST['date'];
        $value = $_REQUEST['value'];
        $isPaid = $_REQUEST['isPaid'];
        $cat = $_REQUEST['cat'];
        $wallet = $_REQUEST['wallet'];

        
        if($despesas->editExpense($id, $date, $pay, $value, $isPaid, $cat, $wallet)){
          header('Location: /despesa?update=expenseUpdateSuccess');
        }else{
          header('Location: /despesa?update=expenseUpdateError');
        }
      }
    }

?>