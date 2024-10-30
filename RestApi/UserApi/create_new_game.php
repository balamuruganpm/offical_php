<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Files needed to connect to database
include_once 'config/database.php';
include_once 'objects/admin.php'; // Assuming 'admin.php' was changed to 'user.php'
include_once 'objects/validate.php';

// Set timezone
date_default_timezone_set("Asia/Calcutta");

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Instantiate user object
$user = new User($db);
$validate = new Validate($db);

// Main loop
while (true) {
    // Fetch last game
    $stmt = $user->FetchLastGame();
    $itemCount = $stmt->rowCount();
    
    if ($itemCount > 0) {
        // Game is in progress
        // Fetch game details
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $game_id = $row['bz_game_unique_id'];
        $date = $row['bz_color_date'];
        $newDate = date("Y-m-d H:i:s", strtotime($date . " +3 minutes"));
        $current_time = date('Y-m-d H:i:s');
        
        if ($current_time < $newDate) {
            // Game is still ongoing
            $msg = 'Game is going on';
            $time = strtotime($newDate) - strtotime($current_time); // Time remaining in seconds
            $game = $game_id;
            error_log("Game ongoing: $game_id, Time left: $time seconds");
        } else {
            // Game has ended, calculate winner and start a new game
            error_log("Game ended: $game_id, Starting new game process...");

            $user->game_id = $game_id;
            $stmt = $user->WinnerColor();
            $itemCount = $stmt->rowCount();
            if ($itemCount > 0) {
                $data = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $color = $row['bz_bet'];
                    if ($color == 'Red') {
                        $user->number = "2,4,6,8,0";
                    } else if ($color == 'Green') {
                        $user->number = "1,3,7,9,5";
                    } else {
                        $user->number = "0,5";
                    }
                }
            } else {
                $color = '';
                $user->number = "0,1,2,3,4,5,6,7,8,9";
            }

            $stmt = $user->WinnerNumber();
            $itemCount = $stmt->rowCount();
            if ($itemCount > 0) {
                $data = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $number = $row['bz_bet'];
                }
            } else {
                $number = '';
            }

            $user->win_number = $number;
            $user->win_color = $color;

            if ($color == 'Green') {
                if ($number == '5') {
                    $per = 1.5;
                } else if ($number == '1') {
                    $per = 2;
                } else if ($number == '3') {
                    $per = 2;
                } else if ($number == '7') {
                    $per = 2;
                } else if ($number == '9') {
                    $per = 2;
                } else {
                    $per = 1.5;
                }
            } else if ($color == 'Red') {
                if ($number == '2') {
                    $per = 2;
                } else if ($number == '4') {
                    $per = 2;
                } else if ($number == '6') {
                    $per = 2;
                } else if ($number == '8') {
                    $per = 2;
                } else if ($number == '0') {
                    $per = 1.5;
                } else {
                    $per = 1.5;
                }
            } else if ($color == 'Violet') {
                if ($number == '0' || $number == '5') {
                    $per = 4.5;
                }
            } else if ($color == '') {
                $per = 9;
            }

            $user->UpdateGame();

            $user->win_col_num = "'$number','$color'";

            $stmts = $user->UpdateWinnerAmount();
            $itemCounts = $stmts->rowCount();
            if ($itemCounts > 0) {
                while ($rows = $stmts->fetch(PDO::FETCH_ASSOC)) {
                    $user->bz_participent_id = $rows['bz_participent_id'];
                    $user->bz_cus_id = $rows['bz_cus_id'];
                    $bz_spend_amount = $rows['bz_spend_amount'];
                    $bz_cus_wallet = $rows['bz_cus_wallet'];

                    $user->spend = ($bz_spend_amount - $bz_spend_amount * 2 / 100) * $per;
                    $user->new_wallet = ($bz_cus_wallet + $user->spend);

                    $user->UpdateUserWallet();
                    $user->UpdateUserGame();
                    $user->AddPaymentHis();
                }
            }

            $user->game_id = $game_id + 1;
            $user->current_time = $current_time;
            if ($user->CreateGame()) {
                $msg = 'New Game Created';
                $time = 0;
                $game = $game_id + 1;
                error_log("New game created successfully with game_id: $game");
            } else {
                error_log("Failed to create a new game");
            }
        }
    }

    // Send SSE update
    echo "data: " . json_encode(array("status" => true, "msg" => $msg, "game_id" => $game)) . "\n\n";
    ob_flush();
    flush();

    // Sleep for 5 seconds before checking again
    sleep(5);
}
?>
