<?php
ob_start();
session_start();

date_default_timezone_set("Asia/Kolkata"); 

include 'class.db.php';

// Construct
$db = new DB('mysql', 'cmschamp_petsfolio_leads', 'localhost', 'cmschamp_leads', 'Infasta@9948');


?>