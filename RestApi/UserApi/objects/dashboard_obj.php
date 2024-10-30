<?php
// 'user' object

class Dashboard
{
    // database connection and table name
    private $conn;
    private $transection = "transection";

    public $customer_id;


    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function earning_point()
    {
        $transection_type = 'credit'; 
        $sqlQuery = "SELECT SUM(amount) as total_amount FROM " . $this->transection . " WHERE customer_id = :customer_id and transection_type = :transection_type";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':transection_type', $transection_type);
        $stmt->execute();
        return $stmt;
    }
    public function reedmed_point()
    {
        $transection_type = 'debit'; 
        // $transection_status = '0'; 
        $sqlQuery = "SELECT SUM(amount) as total_amount FROM " . $this->transection . " WHERE customer_id = :customer_id and transection_type = :transection_type";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':transection_type', $transection_type);
        // $stmt->bindParam(':transection_status', $transection_status);
        $stmt->execute();
        return $stmt;
    }
    public function avaliable_point()
    {
        // $transection_status = '0';

        $sqlQuery = "SELECT transection_type, SUM(CASE WHEN transection_type = 'credit' THEN amount ELSE 0 END) -
        SUM(CASE WHEN transection_type = 'debit' THEN amount ELSE 0 END) as balance FROM " . $this->transection . " WHERE customer_id = :customer_id";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':customer_id', $this->customer_id);
        // $stmt->bindParam(':transection_status', $transection_status);
        $stmt->execute();
        return $stmt;
    }
    
    public function transection_history()
    { 
        // $transection_status = '0';

        $sqlQuery = "SELECT * FROM " . $this->transection . " WHERE customer_id = :customer_id";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':customer_id', $this->customer_id);
        // $stmt->bindParam(':transection_status', $transection_status);
        $stmt->execute();
        return $stmt;
    }
    
   
}
