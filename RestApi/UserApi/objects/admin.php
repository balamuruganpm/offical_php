<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "bz_customer";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function loginCheck()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_phone = '$this->bz_cus_phone' AND bz_cus_password = '$this->bz_cus_password' AND bz_cus_status = 1 LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function aboutUs()
    {

        $query = "SELECT about_us FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    public function privacyPolicy()
    {
 
        $query = "SELECT privacy_policy FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function termCondition()
    {

        $query = "SELECT terms_cons FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function agreement()
    {

        $query = "SELECT agreement_risk FROM `info` WHERE info_id = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
 
    public function phoneCheck()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_phone = $this->bz_cus_phone";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function emailCheck()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_email = '$this->bz_cus_email'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    public function passwordCheck()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_password = '$this->bz_cus_password'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

public function updateUsername()
    {
        $query = "UPDATE " . $this->table_name . " SET `bz_cus_name` = '$this->name' WHERE bz_cus_id = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    public function checkUser()
    {
        $query = "SELECT bz_cus_id FROM " . $this->table_name . " WHERE bz_cus_id = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
    public function checkAccount()
    {
        $query = "SELECT cus_id FROM bank_details WHERE cus_id = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    
    public function getAccount()
    {
        $query = "SELECT * FROM bank_details WHERE cus_id = :cus_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cus_id", $this->cus_id);
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array
    }
    
    
    public function insertAccount()
    {
        $query = "INSERT INTO `bank_details` SET `cus_id`='$this->cus_id',
                                           `bank_holder_name` = '$this->holder_name',
                                           `bank_name` = '$this->bank_name',
                                           `bank_ac_no` = '$this->ac_no',
                                           `bank_branch_name` = '$this->branch_name',
                                           `bank_ifsc` = '$this->bank_ifsc',
                                           `account_type` = '$this->account_type'";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
   public function updateAccount()
{
    $query = "UPDATE `bank_details` 
              SET `bank_holder_name` = :holder_name, 
                  `bank_name` = :bank_name, 
                  `bank_ac_no` = :ac_no, 
                  `bank_branch_name` = :branch_name, 
                  `bank_ifsc` = :bank_ifsc, 
                  `swift_code` = :swift_code, 
                  `account_type` = :account_type 
              WHERE  `cus_id` = :cus_id";

    // Prepare the query
    $stmt = $this->conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':holder_name', $this->holder_name);
    $stmt->bindParam(':bank_name', $this->bank_name);
    $stmt->bindParam(':ac_no', $this->ac_no);
    $stmt->bindParam(':branch_name', $this->branch_name);
    $stmt->bindParam(':bank_ifsc', $this->bank_ifsc);
    $stmt->bindParam(':swift_code', $this->swift_code);
    $stmt->bindParam(':account_type', $this->account_type);
    // $stmt->bindParam(':bank_id', $this->bank_id);  // Ensure that bank_id is passed
    $stmt->bindParam(':cus_id', $this->cus_id);

    // Execute the query
    if ($stmt->execute()) {
        return true;
    } else {
        return false;  // Return false if the update fails
    }
}

    
     public function insertComplaints()
    {
        $query = "INSERT INTO complaints SET `cus_id`='$this->cus_id',
                                           `comps_and_suggs` = '$this->comps_and_sug'";
                                          
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
     public function insertUpi()
    {
        $query = "INSERT INTO upi_details SET `cus_id`='$this->cus_id',
                                           `upi_details` = '$this->upi_details'";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    public function updateUpi()
    {
        $query = "UPDATE upi_details SET `cus_id`='$this->cus_id',
                                           `upi_details` = '$this->upi_details' WHERE upi_id =$this->upi_id";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    public function checkUpi()
    {
        $query = "SELECT cus_id FROM upi_details WHERE cus_id = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        return $stmt;
    }
    
     public function getComplaints()
    {
        $query = "SELECT * FROM complaints WHERE cus_id = :cus_id ORDER BY comp_id DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":cus_id", $this->cus_id);
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array
    }
    
    
    public function Register()
{
    $referralCode = substr(md5(uniqid(rand(), true)), 0, 8); // Example referral code generation

    // Set referral code to the user object
    $this->referral_code = $referralCode;

    date_default_timezone_set("Asia/Kolkata");
    $join_date = date("Y-m-d");
    $join_time = date("H:i:s");

    $query = "INSERT INTO " . $this->table_name . " SET `bz_cus_name` = :bz_cus_name,
                                                    `bz_cus_email` = :bz_cus_email,
                                                    `bz_cus_phone` = :bz_cus_phone,
                                                    `bz_cus_password` = :bz_cus_password,
                                                    `w_password` = :w_password,
                                                    `bz_cus_date` = :bz_cus_date,
                                                    `bz_cus_time` = :bz_cus_time,
                                                    `referral_code` = :referral_code";
    
    $stmt = $this->conn->prepare($query);

    // Bind values
    $stmt->bindParam(':bz_cus_name', $this->bz_cus_name);
    $stmt->bindParam(':bz_cus_email', $this->bz_cus_email);
    $stmt->bindParam(':bz_cus_phone', $this->bz_cus_phone);
    $stmt->bindParam(':bz_cus_password', $this->bz_cus_password);
    $stmt->bindParam(':w_password', $this->w_password);
    $stmt->bindParam(':bz_cus_date', $join_date);
    $stmt->bindParam(':bz_cus_time', $join_time);
    $stmt->bindParam(':referral_code', $referralCode);

    if ($stmt->execute()) {
        // Optionally, you can return the last inserted ID
        $this->id = $this->conn->lastInsertId();
        return true;
    }
    return false;
}
public function getUserByEmail($email) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_email = :bz_cus_email LIMIT 0,1";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':bz_cus_email', $email);
    
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}



    public function sendOTP($email, $otp)
{
    require "Mail/phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'robinson.developerphp@gmail.com';
    $mail->Password = 'ntmqodqvmnochxie';

    $mail->setFrom('antonyrobinson8410@gmail.com', 'OTP Verification');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Color Cash";
    $mail->Body = "<p>Dear user,</p><h3>Register OTP: $otp</h3>";

    // $mail->SMTPDebug = 2; // Enable debugging

    if (!$mail->send()) {
        // error_log('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        return false;
    } else {
        return true;
    }
}

     // forgot password cc
     public function resetPassOTP($email)
     {
         $otp = rand(100000, 999999);
        //  $_SESSION['otp'] = $otp;
        //  $_SESSION['email'] = $email;
 
         require "Mail/phpmailer/PHPMailerAutoload.php";
         $mail = new PHPMailer;
 
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->Port = 587;
         $mail->SMTPAuth = true;
         $mail->SMTPSecure = 'tls';
 
         $mail->Username = 'antonyrobinson8410@gmail.com';
         $mail->Password = 'pmogxxkzgnswsogp';
 
         $mail->setFrom('antonyrobinson8410@gmail.com', 'OTP Verification');
         $mail->addAddress($email);
 
         $mail->isHTML(true);
         $mail->Subject = "Color Cash";
         $mail->Body = "<p>Dear user,</p><h3> OTP for Reset your Password: $otp</h3>";
 
         if (!$mail->send()) {
             error_log('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
             return false;
         } else {
             return true;
         }
     }

    // get banners 
    public function getBanners()
    {
        $sliderSql = "SELECT * FROM `slider` WHERE slider_status = 0 ";
        $slider_stmt = $this->conn->prepare($sliderSql);
        $slider_stmt->execute();
        return $slider_stmt;
    }
  public function getCustomerData($bz_cus_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE bz_cus_id = :bz_cus_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":bz_cus_id", $bz_cus_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     public function update($data) {
            $query = "UPDATE " . $this->table_name . " 
                      SET bz_cus_profile = :bz_cus_profile
                      WHERE bz_cus_id = :bz_cus_id";
    
            $stmt = $this->conn->prepare($query);
    
            // Bind the data
            $stmt->bindParam(':bz_cus_profile', $data['bz_cus_profile']);
            $stmt->bindParam(':bz_cus_id', $data['bz_cus_id']);
    
            // Execute the query
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
  
public function userDetail(){
    $sqlQuery = "SELECT * FROM `bz_customer` where `bz_cus_id` = '$this->cus_id'";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 

public function FetchLastGame(){
    $sqlQuery = "SELECT * FROM `bz_color_prediction` ORDER BY `bz_game_unique_id` DESC LIMIT 0,1";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 

    
public function CreateGame(){
    $query = "INSERT INTO `bz_color_prediction` SET `bz_game_unique_id` = '$this->game_id',
                                        `bz_color_date` = '$this->current_time'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}

    public function Recharge() {
        // Calculate bonus amount
        $bonusAmount = $this->amount * ($this->bonusPercent / 100);
        $totalAmount = $this->amount + $bonusAmount;

        // Query to insert recharge history into the database
        $query = "INSERT INTO `bz_recharge_history` SET `bz_transection_id` = :t_id,
                                                        `bz_amount` = :amount,
                                                        `bz_cus_id` = :cus_id,
                                                        `bz_date` = :date,
                                                        `bz_time` = :time,
                                                        `bonus_code` = :bonus_code,
                                                        `bonus_amt` = :bonus_amount,
                                                        `total_amt` = :total_amount";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':t_id', $this->t_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':cus_id', $this->cus_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':bonus_code', $this->bonus_code);
        $stmt->bindParam(':bonus_amount', $bonusAmount);
        $stmt->bindParam(':total_amount', $totalAmount);

        // Execute the query
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
public function MyWithPayment(){
     $query = "SELECT * FROM `bz_withdrwal` WHERE `bz_cus_id` = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
public function Withdrawal(){
     $query = "INSERT INTO `bz_withdrwal` SET `bz_amount` = '$this->amount',
                                              `bz_cus_id` = '$this->cus_id',
                                              `bz_date` = '$this->date',
                                              `bz_time` = '$this->time'
                                              ";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
public function UpdateRecharge(){
     $query = "UPDATE `bz_recharge_history` SET `bz_status` = '$this->status' WHERE `bz_transection_id` = '$this->t_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}

public function GetPayment(){
     $query = "SELECT * FROM `bz_recharge_history` WHERE `bz_transection_id` = '$this->t_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}

public function AddGame(){
     $query = "INSERT INTO `bz_participent` SET `bz_cus_id` = '$this->cus_id',
                                        `bz_game_unique_id` = '$this->game_id',
                                        `bz_bet` = '$this->no_or_color',
                                        `bz_spend_date` = '$this->adddate',
                                        `bz_game_type` = '$this->game_type',
                                        `join_color` = '$this->color',
                                        `bz_spend_amount` = '$this->amount'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}

public function updateWallet(){
     $query = "UPDATE `bz_customer` SET `bz_cus_wallet` = '$this->updated_wallet' WHERE
                                        `bz_cus_id` = '$this->cus_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
    
public function UpdateUserWallet(){
     $query = "UPDATE `bz_customer` SET `bz_cus_wallet` = '$this->new_wallet' WHERE
                                        `bz_cus_id` = '$this->bz_cus_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
    
public function UpdateUserGame(){
     $query = "UPDATE `bz_participent` SET `bz_participent_status` = '1' WHERE `bz_participent_id` = '$this->bz_participent_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
    
public function AddPaymentHis(){
     $query = "INSERT INTO `bz_payment_history` SET `bz_cus_id` = '$this->bz_cus_id', `bz_amount` = '$this->spend', `bz_game` = 'Color Prediction', `payment_type` = 'Credit', `bz_payment_date` = '$this->current_time'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}
    
public function AddHistory(){
     $query = "INSERT INTO `bz_payment_history` SET `bz_cus_id` = '$this->cus_id',
                                                    `bz_amount` = '$this->amount',
                                                    `bz_game` = '$this->game_name',
                                                    `bz_payment_date` = '$this->adddate',
                                                    `payment_type` = '$this->payment_type'
                                                    ";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
}

public function WinnerColor(){
      $sqlQuery = "SELECT bz_bet, SUM(bz_spend_amount) AS Total_Sales FROM bz_participent where `bz_game_unique_id` = '$this->game_id' and `bz_game_type` = 'Color' GROUP BY bz_bet ORDER by Total_Sales ASC limit 0,1";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
    
public function WinnerNumber(){
    $sqlQuery = "SELECT bz_bet, SUM(bz_spend_amount) AS Total_Sales FROM bz_participent where `bz_game_unique_id` = '$this->game_id' and `bz_game_type` = 'Number' and `bz_bet` IN($this->number) GROUP BY bz_bet ORDER by Total_Sales ASC limit 0,1";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
    
public function MyBet(){
    $sqlQuery = "SELECT * FROM bz_participent where `bz_game_unique_id` = '$this->game_id' and `bz_cus_id` = '$this->cus_id' ORDER by bz_participent_id";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
    
public function MyPayment(){
     $sqlQuery = "SELECT * FROM bz_payment_history where `bz_cus_id` = '$this->cus_id' ORDER by bz_payment_id DESC";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
public function FetchWinnerList(){
     $sqlQuery = "SELECT * FROM bz_color_prediction order by bz_game_id DESC limit 0,20";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
    
public function UpdateWinnerAmount(){
      $sqlQuery = "SELECT bz_participent.bz_participent_id, bz_participent.bz_cus_id, bz_participent.bz_spend_amount, bz_customer.bz_cus_wallet FROM bz_participent JOIN bz_customer ON bz_customer.bz_cus_id = bz_participent.bz_cus_id WHERE bz_participent.bz_game_unique_id = '$this->game_id' AND bz_participent.bz_bet IN($this->win_col_num)";
    $stmt = $this->conn->prepare($sqlQuery);
    $stmt->execute();
    return $stmt;
} 
    
public function UpdateGame(){
      $query = "UPDATE `bz_color_prediction` SET `bz_win_color` = '$this->win_color', `bz_win_number` = '$this->win_number', `bz_color_status` = '1' WHERE `bz_game_unique_id` = '$this->game_id'";
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
} 
    
    public function getRechargeCount($cus_id) {
       
        $query = "SELECT COUNT(*) as recharge_count FROM bz_recharge_history WHERE bz_cus_id = :cus_id";

        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the parameter
        $stmt->bindParam(':cus_id', $cus_id);

        // Execute the query
        if($stmt->execute()) {
            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the recharge count
            return $row['recharge_count'];
        } else {
            // Return false in case of query execution error
            return false;
        }
    }
   public function getBonuspercent($bonusCode) {
        // Query to retrieve bonus percentage from the database based on the bonus code
        $query = "SELECT b_disc FROM bonus WHERE b_code = :bonus_code";
        
        // Prepare the query
        $stmt = $this->conn->prepare($query);

        // Bind the parameter
        $stmt->bindParam(':bonus_code', $bonusCode);

        // Execute the query
        if($stmt->execute()) {
            // Fetch the result
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Return the bonus percentage
            return $row['b_disc'];
        } else {
            // Return false in case of query execution error
            return false;
        }
    }
    public function getBonus()
{
   $query = "SELECT bz_cus_id, bz_amount, bonus_code, bonus_amt, total_amt, bz_date FROM bz_recharge_history WHERE bz_cus_id = :cus_id AND bonus_code IS NOT NULL AND bonus_code != ''";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":cus_id", $this->cus_id);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as an associative array
}

}