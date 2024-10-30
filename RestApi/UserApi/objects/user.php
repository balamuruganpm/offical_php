<?php
class User {
    private $conn;

    public $game_id;
    public $win_color;
    public $win_number;
    public $number;
    public $win_col_num;
    public $spend;
    public $new_wallet;
    public $bz_cus_id;
    public $bz_participent_id;
    public $current_time;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function FetchLastGame() {
        $sqlQuery = "SELECT * FROM `bz_color_prediction` ORDER BY `bz_game_unique_id` DESC LIMIT 1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function WinnerColor() {
        $sqlQuery = "SELECT bz_bet, SUM(bz_spend_amount) AS Total_Sales 
                     FROM bz_participent 
                     WHERE `bz_game_unique_id` = :game_id AND `bz_game_type` = 'Color' 
                     GROUP BY bz_bet 
                     ORDER BY Total_Sales ASC 
                     LIMIT 1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':game_id', $this->game_id);
        $stmt->execute();
        return $stmt;
    }

    public function WinnerNumber() {
        $sqlQuery = "SELECT bz_bet, SUM(bz_spend_amount) AS Total_Sales 
                     FROM bz_participent 
                     WHERE `bz_game_unique_id` = :game_id AND `bz_game_type` = 'Number' 
                     AND `bz_bet` IN($this->number) 
                     GROUP BY bz_bet 
                     ORDER BY Total_Sales ASC 
                     LIMIT 1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':game_id', $this->game_id);
        $stmt->execute();
        return $stmt;
    }

    public function UpdateGame() {
        $query = "UPDATE `bz_color_prediction` 
                  SET `bz_win_color` = :win_color, 
                      `bz_win_number` = :win_number, 
                      `bz_color_status` = '1' 
                  WHERE `bz_game_unique_id` = :game_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':win_color', $this->win_color);
        $stmt->bindParam(':win_number', $this->win_number);
        $stmt->bindParam(':game_id', $this->game_id);
        $stmt->execute();
        return $stmt;
    }

    public function UpdateWinnerAmount() {
        $sqlQuery = "SELECT bz_participent.bz_participent_id, 
                            bz_participent.bz_cus_id, 
                            bz_participent.bz_spend_amount, 
                            bz_customer.bz_cus_wallet 
                     FROM bz_participent 
                     JOIN bz_customer ON bz_customer.bz_cus_id = bz_participent.bz_cus_id 
                     WHERE bz_participent.bz_game_unique_id = :game_id 
                     AND bz_participent.bz_bet IN($this->win_col_num)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(':game_id', $this->game_id);
        $stmt->execute();
        return $stmt;
    }

    public function UpdateUserWallet() {
        $query = "UPDATE `bz_customer` 
                  SET `bz_cus_wallet` = :new_wallet 
                  WHERE `bz_cus_id` = :bz_cus_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':new_wallet', $this->new_wallet);
        $stmt->bindParam(':bz_cus_id', $this->bz_cus_id);
        $stmt->execute();
        return $stmt;
    }

    public function UpdateUserGame() {
        $query = "UPDATE `bz_participent` 
                  SET `bz_participent_status` = '1' 
                  WHERE `bz_participent_id` = :bz_participent_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bz_participent_id', $this->bz_participent_id);
        $stmt->execute();
        return $stmt;
    }

    public function AddPaymentHis() {
        $query = "INSERT INTO `bz_payment_history` 
                  SET `bz_cus_id` = :bz_cus_id, 
                      `bz_amount` = :spend, 
                      `bz_game` = 'Color Prediction', 
                      `payment_type` = 'Credit', 
                      `bz_payment_date` = :current_time";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bz_cus_id', $this->bz_cus_id);
        $stmt->bindParam(':spend', $this->spend);
        $stmt->bindParam(':current_time', $this->current_time);
        $stmt->execute();
        return $stmt;
    }

    public function CreateGame() {
        $query = "INSERT INTO `bz_color_prediction` 
                  SET `bz_game_unique_id` = :game_id, 
                      `bz_color_date` = :current_time";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':game_id', $this->game_id);
        $stmt->bindParam(':current_time', $this->current_time);
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error creating new game: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }
}
?>
