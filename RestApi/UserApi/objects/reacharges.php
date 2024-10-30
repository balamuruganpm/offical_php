<?php
class Reacharge {
    private $conn;
    private $table_name = "bz_recharge_history";

    public $bz_recharge_id;
    public $bz_transection_id;
    public $bz_amount;
    public $bz_cus_id;
    public $bz_date;
    public $bz_time;

    // Constructor to set the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function Recharge() {
        $query = "INSERT INTO " . $this->table_name . " SET `bz_transection_id` = '$this->bz_transection_id',
                                                       `bz_amount` = '$this->bz_amount',
                                                       `bz_cus_id` = '$this->bz_cus_id',
                                                       `bz_date` = '$this->bz_date',
                                                       `bz_time` = '$this->bz_time'
                                                       ";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}
?>
