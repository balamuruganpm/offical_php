
<?php

class ConnectionDB
{
    private $server = 'localhost';
    // private $userName = 'root';
    // private $userPassword = '';
    // private $dataBase = 'colorcash';
    private $userName = "u541379268_colorcash";
    private $userPassword = "Colorcash@123";
    private $dataBase = "u541379268_colorcash";

    public  $conn ;

   

   
    public function getConnection()
    {
        $this->conn = null;
        try{
            $this->conn = new mysqli($this->server,$this->userName,$this->userPassword,$this->dataBase );
        }
        catch(Exception $e)
        {
            echo 'connection error : '. $e->getMessage();
        }

        return $this->conn;
       
    }
}
?>




