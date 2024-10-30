<?php

require 'firebase_vendor/autoload.php';
use Kreait\Firebase\Factory;


$factory = (new Factory())->withProjectId('blazebet-2eaf1')->withDatabaseUri('https://blazebet-2eaf1-default-rtdb.asia-southeast1.firebasedatabase.app/');
$database = $factory->createDatabase();

$uid = '4';
$postData = [
    'UserID' => '1',
    'GameID' => '1',
    'Amount' => '300',
    'number_color' => '1',
    'game_type' => 'Number',
];

// Create a key for a new post
//$newPostKey = $database->getReference('posts')->push()->getKey();

$updates = [
    'game/'.$uid => $postData,
];

$database->getReference() // this is the root reference
   ->update($updates);