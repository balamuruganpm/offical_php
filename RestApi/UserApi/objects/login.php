<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "bz_customer";
 
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
    function phoneExists(){
        // query to check if email exists
        $query = "SELECT * FROM " . $this->table_name . " WHERE `bz_cus_phone` = :phone LIMIT 0,1";
        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->phone=htmlspecialchars(strip_tags($this->phone));
        // bind given email value
        $stmt->bindParam(":phone", $this->phone);

        $stmt->execute();
        return $stmt;
    }
    
        function EmailExists(){
        // query to check if email exists
        $query = "SELECT * FROM " . $this->table_name . " WHERE `bz_cus_email` = :email LIMIT 0,1";
        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        // bind given email value
        $stmt->bindParam(":email", $this->email);

        $stmt->execute();
        return $stmt;
    }

     function login(){
        // query to check if email exists
        $query = "SELECT * FROM " . $this->table_name . " WHERE `bz_cus_email` = :email and `bz_cus_password` = :password LIMIT 0,1";
        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        // bind given email value
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();
        return $stmt;
    }

    
   
    

    public function register(){
        
	  $query = "INSERT INTO " . $this->table_name . " SET `bz_cus_phone` = '$this->phone',
                                        `bz_cus_password` = '$this->password',
                                        `bz_cus_email` = '$this->email',
                                        `bz_cus_date` = '$this->mytime',
                                        `bz_cus_time` = '$this->mydate'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    } 
    
    public function change_password(){
        
	  $query = "UPDATE " . $this->table_name . " SET `bz_cus_password` = '$this->password' WHERE `bz_cus_id` = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    } 
    

}