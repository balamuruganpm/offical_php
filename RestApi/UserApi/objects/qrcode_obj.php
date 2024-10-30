<?php
class CouponCode
{
    private $conn;
    private $table_name = "qr_code";

    public $customer_id;
    // public $pro_id;
    public $coupon_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function couponCheck()
    {
      

        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE coupon_id = :coupon_id";
        $couponCheck = $this->conn->prepare($sqlQuery);
        $couponCheck->bindParam(':coupon_id', $this->coupon_id);
        $couponCheck->execute();

        if ($couponCheck->rowCount() > 0) {
            return $couponCheck;
        }else{
            return $couponCheck;
        }
    }
    public function scanQR()
    {
      

        $sqlQuery = "SELECT * FROM " . $this->table_name . " WHERE coupon_id = :coupon_id AND valid_status = 0";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':coupon_id', $this->coupon_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $coupon_amount = $row['amount'];

            $sqlUpdate = "UPDATE customer SET wallet = wallet + :coupon_amount WHERE customer_id = :customer_id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':coupon_amount', $coupon_amount);
            $stmtUpdate->bindParam(':customer_id', $this->customer_id);
            $stmtUpdate->execute();
            
            $type = "credit";

            $transection_date = date("Y-m-d");

            $sqlTransection = "INSERT INTO transection (amount, transection_type, customer_id, transection_date) VALUES (:amount, :transection_type, :customer_id, :transection_date)";
            $stmtTransection = $this->conn->prepare($sqlTransection);
            $stmtTransection->bindParam(':amount', $coupon_amount);
            $stmtTransection->bindParam(':transection_type', $type);
            $stmtTransection->bindParam(':customer_id', $this->customer_id);
            $stmtTransection->bindParam(':transection_date', $transection_date);
            
           
            if ($stmtTransection->execute()) {
                $sqlMarkRedeemed = "UPDATE " . $this->table_name . " SET valid_status = 1, amount = 0 WHERE qr_id = :qr_id";
                $stmtMarkRedeemed = $this->conn->prepare($sqlMarkRedeemed);
                $stmtMarkRedeemed->bindParam(':qr_id', $row['qr_id']);
                $stmtMarkRedeemed->execute();


                return $stmt;
            } else {
                return false;
            }
        } else {
            return $stmt;
        }
    }
}
