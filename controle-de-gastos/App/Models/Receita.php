<?php
    namespace App\Models;

    use CG\Model\Model;

    class Receita extends Model{
        public function cadRent($fk_id ,$date, $payer, $value, $isPaid, $category, $wallet){
            $query = "
                INSERT INTO 
                    tb_rent(
                        fk_id_user,
                        date_rent, 
                        payer, 
                        value_rent,
                        isPaid, 
                        category, 
                        wallet)
                VALUES (
                    :fk_id,
                    :d,
                    :p,
                    :v,
                    :iP,
                    :c,
                    :wa
                );";

            $stmt = $this->db->prepare($query);
            
            $stmt->bindValue(':fk_id', $fk_id);
            $stmt->bindValue(':d', $date);
            $stmt->bindValue(':v', $value);
            $stmt->bindValue(':iP', $isPaid);
            $stmt->bindValue(':p', $payer);
            $stmt->bindValue(':c', $category);
            $stmt->bindValue(':wa', $wallet);

            return $stmt->execute();
        }

        public function consultRent($fk_id){
            $query = "
                SELECT
                    id,
                    fk_id_user,
                    date_rent,
                    payer,
                    value_rent,
                    isPaid,
                    category,
                    wallet
                FROM 
                    tb_rent
                WHERE
                    fk_id_user = :fk_id
                ORDER BY
                    date_rent DESC;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_id);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getTotalRents($fk_id){
            $query = "
                SELECT
                    COUNT(*) AS total
                FROM 
                    tb_rent
                WHERE
                    fk_id_user = :fk_id
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_id);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }


        public function limitRent($fk_user, $limit, $offset){
            $query = "
                SELECT
                    id,
                    fk_id_user,
                    date_rent,
                    payer,
                    value_rent,
                    isPaid,
                    category,
                    wallet
                FROM 
                    tb_rent
                WHERE
                    fk_id_user = :fk_id
                ORDER BY
                    date_rent DESC
                LIMIT
                    $limit
                OFFSET
                    $offset;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_user);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getValueTotalRent($fk_id){
            $query = "
                SELECT
                    SUM(value_rent) as total
                FROM
                    tb_rent
                WHERE
                    fk_id_user = :fk_id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_id);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            
        }

        public function getRentNoPaid($fk_id){
            $query = "
                SELECT
                    SUM(value_rent) as noPaid
                FROM
                    tb_rent
                WHERE isPaid = 'pendente' AND fk_id_user = :fk_id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_id);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getRentIsPaid($fk_id){
            $query = "
                SELECT
                    SUM(value_rent) as paid
                FROM
                    tb_rent
                WHERE isPaid = 'liquidado' AND fk_id_user = :fk_id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':fk_id', $fk_id);

            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function updatePaymentRent($id, $hr){
            $query = "
                UPDATE 
                    tb_rent 
                SET 
                    isPaid = 'liquidado', 
                    date_rent = :h 
                WHERE 
                    id = :id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':h', $hr);

            $stmt->execute();
        }

        public function exludeRent($id){
            $query = "
                DELETE FROM
                    tb_rent
                WHERE
                    id = :id;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        }

        public function getRentById($id){
            $query = "
                SELECT 
                    id, 
                    date_rent, 
                    payer, 
                    value_rent, 
                    isPaid, 
                    category, 
                    wallet 
                FROM 
                    tb_rent
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function saveRent($id, $date_rent, $payer, $value_rent, $iP, $category, $wallet){
            $query = "UPDATE tb_rent SET date_rent = :d, payer = :recipient, value_rent = :vExpense, isPaid = :iP, category = :cat,  wallet = :wa WHERE tb_rent.id = :id;";

            $stmt = $this->db->prepare($query);
            
            $stmt->bindValue(':d', $date_rent);            
            $stmt->bindValue(':recipient', $payer);
            $stmt->bindValue(':vExpense', $value_rent);
            $stmt->bindValue(':iP', $iP);
            $stmt->bindValue(':cat', $category);
            $stmt->bindValue(':wa', $wallet);
            $stmt->bindValue(':id', $id);


            return $stmt->execute();
        }
    }
    
?>