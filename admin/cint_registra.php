<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

require 'vendor/autoload.php';

use interactivemr\cintapiclient\CintApiClient;

// API settings
const API_URL = "https://api.cint.com";
const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
const API_SECRET = "gRFry5s9UCwqT";

// instantiate API client
$client = new CintApiClient(API_URL, API_KEY, API_SECRET);



$row = 1;
if (($handle = fopen("res/panel.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

        $mioarray= array (
    
            "member_id"=> $data['0'],
            "first_name"=> $data['1'],
            "last_name"=>$data['2'],
            "gender"=> $data['3'],
            "date_of_birth"=> $data['4'],
            "postal_code"=> $data['5'],
            "email_address"=> $data['0']."@interactivemr.com",
            "recruitment_source"=> "panelOld",
        
        );
        $registra = $client-> registerUser($mioarray);
        print_r($registra);
    }
    fclose($handle);
}







/*
$query="SELECT user_id,first_name,second_name,gender,code,birth_date,email FROM t_user_info  WHERE email like '%feliciadamore%' ";
$resC = mysqli_query($admin,$query);
$infoC= mysqli_fetch_array($resC);

while($infoC<>0) 
{

   if ($infoC['gender']==1) {$genderCod="m";} 
   if ($infoC['gender']==2) {$genderCod="f";} 

 
$mioarray= array (
    
    "member_id"=> $infoC['user_id'],
    "first_name"=> $infoC['first_name'],
    "last_name"=>$infoC['second_name'],
    "email_address"=> $infoC['user_id']."@interactivemr.com",
    "gender"=> $genderCod,
    "postal_code"=> $infoC['code'],
    "date_of_birth"=> $infoC['birth_date'],
    "phone_number"=> "5555",
    "street_address"=> "nd.",
    //"payment_method_id"=> "3",
    "recruitment_source"=> "panelOld",
    //"variables"=> [1000,1001],
    "tracking_consent"=> true

);

$registra = $client-> registerUser($mioarray);
print_r($registra);

$infoC = mysqli_fetch_array($resC); 

}

/*
$query_newConta = "SELECT COUNT(user_id) as totalUser FROM t_user_info where active=1";
$csv_mvfCount = mysqli_query($admin,$query_newConta);
$data=mysqli_fetch_assoc($csv_mvfCount);

//print_r( $data['totalUser']);
echo $data['totalUser'];
*/


