<?php
    namespace App\Controllers;
    session_start();

    // miniframework
    use CG\Controller\Action;
    use CG\Model\Container;

    class IndexController extends Action{

        public function index(){

            $this->render('index');
        }

        public function validateUser(){
            $users = Container::getModel('Index');
            $logged = false;

            $users_array = $users->getUsers();

            $user = $_REQUEST['user'];
            $pass = md5($_REQUEST['pass']);
            $email = $_REQUEST['user'];

            foreach($users_array as $key => $onUser){

                if($user === $onUser['username'] && $pass === $onUser['passwd'] || $onUser['email'] === $email && $pass === $onUser['passwd']){
                    $logged = true;
                    $_SESSION['logged'] = 'LOGGED';
                    $_SESSION['id'] = $onUser['id_user'];
                    $_SESSION['image'] = $onUser['image'];
                    $_SESSION['user'] = $onUser['name'];
                }else{
                    $logged = false;
                }
            }

            if($logged){
                header('Location: /dashboard');
            }else{
                header('Location: /?login=Error');
            }
            
        }

        public function loginGoogle(){
            $logged = null;

            $googleUsers = Container::getModel('Index');

            $usuarios = $googleUsers->getUsers();

            $email = $_REQUEST['email'];
            $name = $_REQUEST['givenName'];

            foreach($usuarios as $key => $onUser){

                if($email === $onUser['email'] && $name === $onUser['name']){
                    $logged = true;
                    $_SESSION['logged'] = 'LOGGED';
                    $_SESSION['user'] = $name;
                    $_SESSION['image'] = $_REQUEST['image'];
                    $_SESSION['id'] = $onUser['id_user'];
                }else{
                    $logged = false;
                }
            }

            if($logged){
                header('Location: /dashboard');
            }else{
                header('Location: /?login=Error');
            }


        }

        
    }

?>