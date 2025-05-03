<?php
include("config.php");


$ids = array('1160', '23', '24','25', '26','27','1122','126' );

foreach($ids as $id){

			if($id==126){

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id"),true);
				$i = 0;
				foreach($json_data as $row){

					$fields = array('name' => $row['fname'],
									'city' => $row['location'],
									'mobile' => $row['mobile'],
									'service' => $row['service'],
									'ip_address' => $row['submit_ip']);

					if($db->check_duplicate($fields) == 0){

							$fields = array('name' => $row['fname'],
											'city' => $row['location'],
											'mobile' => $row['mobile'],
											'msg' => $row['message'],
											'service' => $row['service'],
											'created_at' => $row['submit_time'],
											'updated_at' => date("Y-m-d H:i:s"),
											'ip_address' => $row['submit_ip'],
											'status' => 'New',
											'source' => 'Web Enquiry');

							$db->insert('leads', $fields);

							$i++;

					}
				}


			} else {

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id"),true);
				$i = 0;
				foreach($json_data as $row){

					$services = array('23' => 'Training',
									'24' => 'Walking',
									'25' => 'Grooming',
									'26' => 'Pets Hostel',
									'27' => 'Vet on Wheels',
									'1122' => 'Dog Obedience',
									'1160' => 'Dog Potection');

					$fields = array('name' => $row['yname'],
									'city' => $row['ycity'],
									'mobile' => $row['ymobile'],
									'service' => $services[$id],
									'ip_address' => $row['submit_ip']);

					if($db->check_duplicate($fields) == 0){

							$fields = array('name' => $row['yname'],
											'city' => $row['ycity'],
											'mobile' => $row['ymobile'],
											'msg' => $row['msg'],
											'service' => $services[$id],
											'created_at' => $row['submit_time'],
											'updated_at' => date("Y-m-d H:i:s"),
											'ip_address' => $row['submit_ip'],
											'status' => 'New',
											'source' => 'Web Enquiry');

							$db->insert('leads', $fields);

							$i++;

					}
				}
}
?>