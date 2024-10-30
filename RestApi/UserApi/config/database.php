<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "u541379268_colorcash";
    private $username = "u541379268_colorcash";
    private $password = "Colorcash@123";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}

$base_url = "https://teckzy.co.in/rmcadmin/upload/";
$keyId = 'rzp_test_QApmgDSbYnvqLS';
$keySecret = 'HnUsx1lOoa1FV9hg1DrH7rJs';
$displayCurrency = 'INR';
?>