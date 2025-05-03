<?php
class Sms_ctr extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('Crud_model', 'crud_model'); 
    }

    
    
    public function get_sms()
    {
        $requestParams = array(
            'user'=>'Wehubfoundation',
            'password'=>'Wehub@0308',
            'mobile'=>'9491651755',
            'message'=>'Dear mahesh, Your grievance with the ticket number 20351 is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB',
            'sender'=>'TWEHUB',
            'type'=>'3',
            'template_id'=>'1507166418766838662'
        );
 
        $apiUrl = 'https://api.bulksmsgateway.in/sendmessage.php?';
        foreach($requestParams as $key => $val){
            $apiUrl .= $key.'='.urlencode($val).'&';
        }
        $apiUrl = rtrim($apiUrl, "&");
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        //print_r($response);
        return true;
    }

}