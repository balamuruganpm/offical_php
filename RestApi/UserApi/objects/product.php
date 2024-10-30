<?php
class Product
{
    private $conn;
    private $table_name = "products";

    public $pro_id;
    public $pro_name;
    public $pro_image;
    public $pro_desc;
    public $pro_price;
    public $brand;
    public $collection;
    public $stone;
    public $item_width;
    public $item_length;
    public $material;
    public $metal;
    public $size;
    public $modal_no;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllproducts()
    {
        $pro_sql = "SELECT pro_id, pro_name, pro_image, pro_desc, pro_price FROM " . $this->table_name;
        $pro_stmt = $this->conn->prepare($pro_sql);
        $pro_stmt->execute();
        return $pro_stmt;
    }
    public function getProductsById($pro_id)
    {
        $pro_sql = "SELECT * FROM " . $this->table_name." WHERE pro_id = :pro_id";
        $pro_stmt = $this->conn->prepare($pro_sql);
        $pro_stmt->bindParam("pro_id",$pro_id);
        $pro_stmt->execute();
        return $pro_stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getProductsByname($pro_name){
        $pro_sql = "SELECT pro_name FROM " . $this->table_name . " WHERE pro_name LIKE :pro_name";
        $pro_stmt = $this->conn->prepare($pro_sql);
        $pro_stmt->bindParam(":pro_name", $pro_name);
        $pro_stmt->execute();
        return $pro_stmt->fetch(PDO::FETCH_ASSOC);
    }
    // public function getProductsByPartialName($partial_name){
    //     $pro_sql = "SELECT pro_name FROM " . $this->table_name . " WHERE pro_name LIKE :partial_name LIMIT 10"; // Limit results to 10
    //     $pro_stmt = $this->conn->prepare($pro_sql);
    //     $pro_stmt->bindValue(":partial_name", '%' . $partial_name . '%', PDO::PARAM_STR);
    //     $pro_stmt->execute();
    //     return $pro_stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}
