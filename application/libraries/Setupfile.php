<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setupfile {

  function send($number, $message)
  {
    $ci = & get_instance();
    $data=array("username"=>'accounts@petsfolio.com',"hash"=>'pEFUI08LcTw-rdPHn132SySxOFV7559WEIioWL97sU','apikey'=>false);
    $sender  = "PETSFO";
    $numbers = array($number);
    $ci->load->library('textlocal',$data);

    $response = $ci->textlocal->sendSms($numbers, $message, $sender);
  return $response;
  }
  
}
