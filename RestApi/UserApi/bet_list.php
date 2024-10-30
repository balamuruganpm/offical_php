<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';
require 'libs/firebase_vendor/autoload.php';
use Kreait\Firebase\Factory;


$factory = (new Factory())->withProjectId('blazebet-2eaf1')->withDatabaseUri('https://blazebet-2eaf1-default-rtdb.asia-southeast1.firebasedatabase.app/');
$database = $factory->createDatabase();


//$data = $database->getReference('user-posts')->getValue();

$reference = $database->getReference('game');
$snapshot = $reference->getSnapshot();
$value = $snapshot->getValue();
// $chatPatientName = $chatDoctorName = "";
if($value != NULL){
    foreach($value as $key => $val){
        $data[] = array("key"=>$key, "GameID"=>$val['GameID'], "Amount"=>$val['Amount'], "Join_color"=>$val['join_color']);
        $datas = array_reverse($data);
    } 

} else{
    $datas = array();
}
echo json_encode(array("status"=>true, "game"=>$datas));