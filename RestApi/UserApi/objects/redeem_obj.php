<?php
class ReddemAmount
{
    private $conn;
    private $table_name = "transection";

    public $customer_id;
    public $amount;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function availablePoint()
    {
        // $sqlQuery = "SELECT transection_type, SUM(CASE WHEN transection_type = 'credit' THEN amount ELSE -amount END) as balance FROM " . $this->table_name . " WHERE customer_id = :customer_id GROUP BY transection_type";
        // $stmt = $this->conn->prepare($sqlQuery);
        // $stmt->bindParam(':customer_id', $this->customer_id);
        // $stmt->execute();
        $checkbalance = 0;

        $sqlQuery = "SELECT wallet as balance FROM customer WHERE wallet >= :checkbalance AND customer_id = :customer_id";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':checkbalance', $checkbalance);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->execute();

        // $creditAmount = 0;
        // $debitAmount = 0;

        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     if ($row['transection_type'] === 'credit') {
        //         $creditAmount = $row['balance'];
        //     } elseif ($row['transection_type'] === 'debit') {
        //         $debitAmount = $row['balance'];
        //     }
        // }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           
                $balance = $row['balance'];
            
        }

        // $balance = $creditAmount - $debitAmount;

        return $balance;
    }

    public function Redeem()
    {
        $balance = $this->availablePoint();
        

        if ($balance !== false && $balance >= $this->amount) {
            // $sqlUpdate = "UPDATE customer SET wallet = wallet - :amount WHERE customer_id = :customer_id";
            // $stmtUpdate = $this->conn->prepare($sqlUpdate);
            // $stmtUpdate->bindParam(':amount', $this->amount);
            // $stmtUpdate->bindParam(':customer_id', $this->customer_id);
            // $stmtUpdate->execute();

            $type = "debit";
            $transection_status = "1";
            $transection_date = date("Y-m-d");

            $sqlTransection = "INSERT INTO " . $this->table_name . " (amount, transection_type, customer_id, transection_date, transection_status) VALUES (:amount, :transection_type, :customer_id, :transection_date, :transection_status)";
            $stmtTransection = $this->conn->prepare($sqlTransection);
            $stmtTransection->bindParam(':amount', $this->amount);
            $stmtTransection->bindParam(':transection_type', $type);
            $stmtTransection->bindParam(':customer_id', $this->customer_id);
            $stmtTransection->bindParam(':transection_date', $transection_date);
            $stmtTransection->bindParam(':transection_status', $transection_status);
            $stmtTransection->execute();

            return true;
        } else {
            return false;
        }
    }
}
