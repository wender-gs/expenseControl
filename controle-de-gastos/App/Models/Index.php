<?php
    namespace App\Models;

    use CG\Model\Model;

    class Index extends Model{

        public function getUsers(){
            $query = "SELECT id_user, username, passwd, name, image, email FROM tb_users;";

            $stmt = $this->db->prepare($query);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

    }


?>