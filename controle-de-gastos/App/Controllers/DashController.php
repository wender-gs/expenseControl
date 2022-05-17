<?php
  namespace App\Controllers;
  session_start();

  use CG\Controller\Action;
  use CG\Model\Container;

  class DashController extends Action{

    public function dashboard(){

      $totals = Container::getModel('Dashboard');
      $fk_id = $_SESSION['id'];
      $this->view->totalRent = $totals->sumRent($fk_id);
      $this->view->totalExpenses = $totals->sumExpenses($fk_id);
      $this->render('dashboard');
    }

    public function dataRecovery(){

      $data = Container::getModel('Dashboard');
      
      $month = $_REQUEST['month'];
      $fk_id = $_SESSION['id'];

      $totalExpense = $data->getDataExpense($month, $fk_id);
      $totalRent = $data->getDataRent($month, $fk_id);
      

      $value = array(
        "totalExpense" => $totalExpense['total'],
        "totalRent" => $totalRent['total']
      );

      echo json_encode($value);

    }

    public function logout(){
      session_start();
      session_destroy();
      header('Location: /');
    }
  }
?>