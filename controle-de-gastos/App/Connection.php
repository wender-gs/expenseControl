<?php
    namespace App;
    use PDO;
    use PDOException;

    class Connection{

        public static function getDb(){
            try{

                $dsn = 'mysql:host=localhost;dbname=db_cg;charset=utf8';
                $user = 'wendergs@localhost';
                $pass = '62446812';

                $conn = new PDO($dsn, $user, $pass);

                return $conn;

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

    }

?>