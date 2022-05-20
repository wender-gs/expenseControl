<?php
    namespace App\Controllers;
    session_start();
    use CG\Controller\Action;
    use CG\Model\Container;

    class ReceitaController extends Action{

        public function receitas(){
            
            $receita = Container::getModel('Receita');

            $fk_id = $_SESSION['id'];

            // variaveis de paginação
            $this->view->totalDeRceitas = $receita->getTotalRents($fk_id);
            

            $this->view->totalRent = $receita->getValueTotalRent($fk_id);
            $this->view->rentPaid = $receita->getRentIsPaid($fk_id);
            $this->view->rentNp = $receita->getRentNoPaid($fk_id);
            $this->view->dados = $receita->consultRent($fk_id);
            $this->render('receitas');
        }


        public function dataRentReturn(){
            $receita = Container::getModel('Receita');
            $fk_id = $_SESSION['id'];

            // variaveis de paginação
            $pagina = isset($_REQUEST['pg']) ? $_REQUEST['pg'] : 1;
            $total_registros_pagina = $_REQUEST['limit'];
            $deslocamento = ($pagina - 1) * $total_registros_pagina;

            try{
                if($this->view->dados = $receita->limitRent($fk_id, $total_registros_pagina, $deslocamento)){
                    $this->render('return-rent-table');
                }
            }catch(\PDOException $e){
            
            }
        }

        public function novaReceita(){

            $newRent = Container::getModel('Receita');

            $fk_id = $_SESSION['id'];

            $date = empty($_REQUEST['data']) ? null : $_REQUEST['data'];
            $value = empty($_REQUEST['valor']) ? null : str_replace(',', '.', $_REQUEST['valor']);
            $isPaid = isset($_REQUEST['isPaid']) ? $_REQUEST['isPaid'] : 'pendente';
            $payer = empty($_REQUEST['payer']) ? null : $_REQUEST['payer'];
            $category = empty($_REQUEST['categoria']) ? null : $_REQUEST['categoria'];
            $wallet = empty($_REQUEST['carteira-receita']) ? null : $_REQUEST['carteira-receita'];

            try{
                if($newRent->cadRent($fk_id, $date, $payer, $value, $isPaid, $category, $wallet)){
                    header('Location: /dashboard?register=receitaRegisterSuccess');
                }
            }catch(\PDOException $e){

                if($e->getMessage()){
                    header('Location: /dashboard?register=receitaRegisterError');
                } 
            }


            echo '<pre>';
            print_r($_REQUEST);
            echo '</pre>';
        }

        public function payRent(){
            $id = $_REQUEST['id_rent'];

            $timezone = new \DateTimeZone('America/Sao_Paulo');
            $agora = new \DateTime('now', $timezone);    

            $hr = $agora->format('Y-m-d');

            $rent = Container::getModel('Receita');

            try{
                $rent->updatePaymentRent($id, $hr);
                header('Location: /receitas?payment=Success');  
            }catch(\PDOException $e){
                if($e->getMessage()){
                    header('Location: /receitas?payment=Error');
                  }
            }


        }

        public function excludeRent(){
            $rent = Container::getModel('Receita');

            $id = isset($_REQUEST['id_rent']) ? $_REQUEST['id_rent'] : null;

            try{
                $rent->exludeRent($id);
                header('Location: /receitas?exclude=Success');
              }catch(\PDOException $e){
                if($e->getMessage()){
                  header('Location: /receitas?exclude=Error');
                }
            }
        }

        public function editRent(){
            $rent = Container::getModel('Receita');

            $receita = $rent->getRentById($_REQUEST['id_rent']);

            $nd = array();

            foreach($receita as $d){
                $nd[] = array(
                    "id" => $d['id'],
                    "date_rent" => $d['date_rent'],
                    "payer" => $d['payer'],
                    "value_rent" => $d['value_rent'],
                    "isPaid" => $d['isPaid'],
                    "category" => $d['category'],
                    "wallet" => $d['wallet']
                );
            }

            echo json_encode($nd);
        }

        public function saveEditRent(){
            $rent = Container::getModel('Receita');

            $id = $_REQUEST['id'];
            $payer = $_REQUEST['payer'];
            $date_rent = $_REQUEST['date'];
            $value_rent = $_REQUEST['value'];
            $isPaid = $_REQUEST['isPaid'];
            $cat = $_REQUEST['category'];
            $wallet = $_REQUEST['wallet'];



            if($rent->saveRent($id, $date_rent, $payer, $value_rent, $isPaid, $cat, $wallet)){
                header('Location: /receitas?update=rentUpdateSuccess');
              }else{
                header('Location: /receitas?update=rentUpdateError');
              }
        }
    }

?>