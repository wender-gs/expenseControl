<?php
    namespace App;
    use CG\Init\Bootstrap;

    class Route extends Bootstrap{
    
        protected function initRoutes(){

            // paginas

            $route['index'] = array(
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'
            );
        

            $route['home'] = array(
                'route' => '/dashboard',
                'controller' => 'dashController',
                'action' => 'dashboard'
            );

            $route['despesas'] = array(
                'route' => '/registrarDespesa', // trocar dps para /despesas
                'controller' => 'despesaController',
                'action' => 'despesas'
            );

            $route['consultar'] = array(
                'route' => '/despesa',
                'controller' => 'despesaController',
                'action' => 'consultar'
            );

            $route['receitas'] = array(
                'route' => '/receitas',
                'controller' => 'receitaController',
                'action' => 'receitas'
            );

            $route['cad_receitas'] = array(
                'route' => '/cadReceitas',
                'controller' => 'receitaController',
                'action' => 'cadReceitas'
            );

            $route['editReceitas'] = array(
                'route' => '/edit',
                'controller' => 'despesaController',
                'action' => 'saveEdit'
            );

            $route['getDataByMonth'] = array(
                'route' => '/getDataByMonth',
                'controller' => 'dashController',
                'action' => 'dataRecovery'
            );




            //interação

            $route['validadeUser'] = array(
                'route' => '/validateUser',
                'controller' => 'indexController',
                'action' => 'validateUser'
            );

            $route['register'] = array(
                'route' => '/register',
                'controller' => 'despesaController',
                'action' => 'register'
            );

            $route['registerReceita'] = array(
                'route' => '/registerReceita',
                'controller' => 'receitaController',
                'action' => 'registerReceita'
            );

            $route['backup'] = array(
                'route' => '/backup',
                'controller' => 'BackupController',
                'action' => 'backup'
            );

            $route['novaDespesa'] = array(
                'route' => '/novaDespesa',
                'controller' => 'despesaController',
                'action' => 'novaDespesa'
            );

            $route['payExpense'] = array(
                'route' => '/payExpense',
                'controller' => 'despesaController',
                'action' => 'payExpense'
            );

            $route['excludeExpense'] = array(
                'route' => '/excludeExpense',
                'controller' => 'despesaController',
                'action' => 'excludeExpense'
            );

            $route['editExpense'] = array(
                'route' => '/editExpense',
                'controller' => 'despesaController',
                'action' => 'editExpense'
            );

            $route['novaReceita'] = array(
                'route' => '/novaReceita',
                'controller' => 'receitaController',
                'action' => 'novaReceita'
            );

            $route['payRent'] = array(
                'route' => '/payRent',
                'controller' => 'receitaController',
                'action' => 'payRent'
            );

            $route['excludeRent'] = array(
                'route' => '/excludeRent',
                'controller' => 'receitaController',
                'action' => 'excludeRent'
            );

            $route['editRent'] = array(
                'route' => '/editRent',
                'controller' => 'receitaController',
                'action' => 'editRent'
            );

            $route['saveEditRent'] = array(
                'route' => '/saveEditRent',
                'controller' => 'receitaController',
                'action' => 'saveEditRent'
            );

            $route['logout'] = array(
                'route' => '/logout',
                'controller' => 'dashController',
                'action' => 'logout'
            );

            $route['loginGoogle'] = array(
                'route' => '/loginGoogle',
                'controller' => 'indexController',
                'action' => 'loginGoogle'
            );

            $route['dataExpenseReturn'] = array(
                'route' => '/dataExpenseReturn',
                'controller' => 'despesaController',
                'action' => 'dataExpenseReturn'
            );




            

            

            $this->setRoute($route);
        }
    }


?>