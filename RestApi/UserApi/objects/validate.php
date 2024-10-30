<?php
// 'user' object
class Validate{
 
    // database connection and table name
    private $conn;
    private $table_name = "api_key";
 
    // object properties
    public $id;
    public $api_key_id;
    public $status;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
public function getValidate(){
    $sqlQuery = "SELECT * FROM " . $this->table_name . " where `api_key_id` =:api_key";
    $stmt = $this->conn->prepare($sqlQuery);
    
    $this->api_key=htmlspecialchars(strip_tags($this->api_key));

	$stmt->bindParam(":api_key", $this->api_key);
    
    $stmt->execute();
    return $stmt;
}
    
    
}