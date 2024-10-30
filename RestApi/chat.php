<?php

require 'firebase_vendor/autoload.php';
use Kreait\Firebase\Factory;


$factory = (new Factory())->withProjectId('eezaa-for-doctor')->withDatabaseUri('https://eezaa-for-doctor-default-rtdb.firebaseio.com/');
			$database = $factory->createDatabase();
			
			 $reference = $database->getReference('users');
				$snapshot = $reference->getSnapshot();
				$value = $snapshot->getValue();
				// $chatPatientName = $chatDoctorName = "";
				if($value != NULL){
					foreach($value as $key => $val){
						$data[] = array("key"=>$key, "name"=>$val['name']);
					} 
					
				}
echo json_encode($data);