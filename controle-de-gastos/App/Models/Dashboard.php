<?php
    namespace App\Models;
    use CG\Model\Model;

    class Dashboard extends Model{
        public function sumExpenses($fk_user){
            $query = "
                SELECT
                    SUM(value_expense) as totalExpense
                FROM
                    tb_expenses
                WHERE
                    fk_id_user = :id_user;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function sumRent($fk_id){
            $query = " SELECT SUM(value_rent) as totalRent FROM tb_rent WHERE fk_id_user = :fk; ";

            $stmt = $this->db->prepare($query);

            
            $stmt->bindValue(':fk', $fk_id);

            $stmt->execute();


            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getDataExpense($month, $fk_user){
            $query = 'SELECT SUM(value_expense) as total FROM tb_expenses WHERE tb_expenses.date_expense like "_____%' . $month . '___" AND fk_id_user = :id_user;';

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getDataRent($month, $fk_id){
            $query = 'SELECT SUM(value_rent) as total FROM tb_rent WHERE tb_rent.date_rent like "_____%' . $month . '___" AND fk_id_user = :fk;';

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk', $fk_id);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }


?>