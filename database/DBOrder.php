<?php
    require_once "DB.php";
    class DBOrder
    {
        private $table = "orders";
        public function saveOrder($userId,$userName,$totalProduct,$totalCost,$delivery,$payment,$date)
        {
            $sql="INSERT into $this->table(userId,userName,totalProduct,totalCost,delivery,payment,date)
                  values (:userId,:userName,:totalProduct,:totalCost,:delivery,:payment,:date)";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':userId',$userId);
            $stmt->bindParam(':userName',$userName);
            $stmt->bindParam(':totalProduct',$totalProduct);
            $stmt->bindParam(':totalCost',$totalCost);
            $stmt->bindParam(':delivery',$delivery);
            $stmt->bindParam(':payment',$payment);
            $stmt->bindParam(':date',$date);
            return $stmt->execute();
        }
        public function getOrders()
        {
            $sql="SELECT * FROM $this->table";
            $stmt=DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getOrderById($userId)
        {
            $sql="SELECT * FROM $this->table where userId=:userId";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':userId',$userId);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>