<?php
// Account details
$apiKey = urlencode('pEFUI08LcTw-rdPHn132SySxOFV7559WEIioWL97sU');
// Message details
$numbers = urlencode('9494904886');
$sender = urlencode('FETSFO');
$message = rawurlencode('This is your message');
 
$numbers = implode('','', $numbers);
 
// Prepare data for POST request
$data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
// Send the POST request with cURL
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
// Process your response here
echo $response->status;
?>