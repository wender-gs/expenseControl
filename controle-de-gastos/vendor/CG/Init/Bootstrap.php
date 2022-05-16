<?php
    namespace CG\Init;

    abstract class Bootstrap{
        private $route;

        abstract protected function initRoutes();

        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl());
        }

        protected function setRoute(array $route){
            $this->route = $route;
        }

        protected function getRoute(){
            return $this->route;
        }

        protected function run($url){
            foreach($this->getRoute() as $key => $route){
                if($url === $route['route']){
                    $class = 'App\\Controllers\\' . ucfirst($route['controller']);

                    $controller = new $class;

                    $action = $route['action'];

                    $controller->$action();
                }
            }
        }

        protected function getUrl(){
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
    }


?>