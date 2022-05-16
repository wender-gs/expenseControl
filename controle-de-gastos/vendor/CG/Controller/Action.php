<?php
    namespace CG\Controller;
    use stdClass;

    abstract class Action{
        protected $view;

        public function __construct(){
            $this->view = new stdClass();
        }

        public function render($view, $layout = ""){

            $this->view->page = $view;

            if(file_exists("../controle-de-gastos/App/Views/$layout.phtml")){
                require_once "../controle-de-gastos/App/Views/$layout.phtml";
            }else{
                $this->content();
            }
            
        }

        public function content(){
            $dir = get_class($this);

            $dir = str_replace('App\\Controllers\\', '', $dir);

            $dir = strtolower(str_replace('Controller', '', $dir));

            require_once '../controle-de-gastos/App/Views/' . $dir . '/' . $this->view->page . '.phtml';
        }

    }

?>