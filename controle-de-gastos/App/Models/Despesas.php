<?php
    namespace App\Models;

    use CG\Model\Model;

    class Despesas extends Model{
        // re-factoring
        public function registerExpense($fk_user, $value, $isPaid, $date, $rece, $category, $wallet){

            $query = "
                INSERT INTO
                    tb_expenses(
                        fk_id_user,
                        date_expense,
                        recipient,
                        value_expense,
                        isPaid,
                        category,
                        wallet
                    )
                VALUES (
                    :fk_user,
                    :d,
                    :r,
                    :ve,
                    :iP,
                    :c,
                    :w
                );
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_user', $fk_user);
            $stmt->bindValue(':d', $date);
            $stmt->bindValue(':r', $rece);
            $stmt->bindValue(':ve', $value);
            $stmt->bindValue(':iP', $isPaid);
            $stmt->bindValue(':c', $category);
            $stmt->bindValue(':w', $wallet);
            
            return $stmt->execute();
        }

        public function consultarDespesas($fk_user){
            $query = "
                SELECT 
                    id, 
                    date_expense, 
                    recipient, 
                    value_expense, 
                    isPaid, 
                    category, 
                    wallet 
                FROM 
                    tb_expenses
                WHERE
                    fk_id_user = :id_user
                
                ORDER BY
                    date_expense DESC;";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function limitExpenses($fk_user, $limit, $offset){
            $query = "
                SELECT 
                    id, 
                    date_expense, 
                    recipient, 
                    value_expense, 
                    isPaid, 
                    category, 
                    wallet 
                FROM 
                    tb_expenses
                WHERE
                    fk_id_user = :id_user
                
                ORDER BY
                    date_expense DESC
                LIMIT 
                    $limit
                OFFSET
                    $offset
                ;";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        public function getTotalExpense($fk_user){
            $query = "
            SELECT 
                count(*) as total 
            FROM 
                tb_expenses
            WHERE
                fk_id_user = :id_user;";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getValueTotalExpenses($fk_user){
            $query = "
                SELECT
                    SUM(value_expense) as total
                FROM
                    tb_expenses
                WHERE
                    fk_id_user = :id_user
                ;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        }

        public function getExpensesNoPaid($fk_user){
            $query = "
                SELECT
                    SUM(value_expense) as noPaid
                FROM
                    tb_expenses
                WHERE 
                    isPaid = 'n/p' AND fk_id_user = :id_user;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getExpensesIsPaid($fk_user){
            $query = "
                SELECT
                    SUM(value_expense) as paid
                FROM
                    tb_expenses
                WHERE isPaid = 'pago' AND fk_id_user = :id_user;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id_user', $fk_user);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        
        public function updatePyment($id, $hora){
            $query = "
                UPDATE 
                    tb_expenses
                SET
                    isPaid = 'pago',
                    date_expense = :h 
                WHERE id = :id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':h', $hora);

            $stmt->execute();
        }

        public function excludeExpense($id){
            $query = "
                DELETE FROM
                    tb_expenses
                WHERE
                    id = :id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);

            return $stmt->execute();
            
        }

        public function getExpenseForId($id){
            $query = "
                SELECT 
                    id, 
                    date_expense, 
                    recipient, 
                    value_expense, 
                    isPaid, 
                    category, 
                    wallet 
                FROM 
                    tb_expenses
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function editExpense($id, $date_expense, $recipient, $value_expense, $iP, $category, $wallet){

            $query = 'UPDATE tb_expenses SET date_expense = :d, recipient = :recipient, value_expense = :vExpense, isPaid = :iP, category = :cat,  wallet = :wa WHERE tb_expenses.id = :id ';

            $stmt = $this->db->prepare($query);
            
            $stmt->bindValue(':d', $date_expense);            
            $stmt->bindValue(':recipient', $recipient);
            $stmt->bindValue(':vExpense', $value_expense);
            $stmt->bindValue(':iP', $iP);
            $stmt->bindValue(':cat', $category);
            $stmt->bindValue(':wa', $wallet);
            $stmt->bindValue(':id', $id);


            return $stmt->execute();
        }

        public function filterExpenses($id, $value = '%'){
            $query = "SELECT * FROM tb_expenses WHERE fk_id_user = :id AND wallet LIKE '%$value%';";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }


    }

?>