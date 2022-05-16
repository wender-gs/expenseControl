<?php
    namespace CG\Model;
    use App\Connection;

    class Container{
        public static function getModel($model){

            $class = "App\\Models\\" . ucfirst($model);

            $conn = Connection::getDb();

            return new $class($conn);
        }
    }

?>