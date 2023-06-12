<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// RICHIESTA GET API PRIMIS
$urlPrimis = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/5000/answers";


$headers = array(
    "Content-Type: application/json; charset=utf-8",
    "Authorization: Bearer U3lMWWFBcktGZmM1MjdQRzpTUnV3dzROU1FtM2JGZTJZQndDdlF2TkNERXc4MmdiSzdhelkyQldYZjZSYVZWc3VHY3hLTVk1QjVZakF0YnAz"
);



$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $urlPrimis);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch,CURLOPT_POST, true);
//curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);


curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch);
echo $result;



/*

//ENDPOINT RICHIESTA POST
$url = "https://apps.primisoft.com/putRegistrationUnic/index.php";


//The data you want to send via POST
$fields = [
    'email'      => "abc@a.it",
    'second_name'      => "test",
    'first_name'      => "test",
    'gender'      => "2", //1 MASCHIO 2 DONNA
    'birth_date'      => "1987-06-02", //ESEMPIO DATA DI NASCITA
    'province_id'      => "15", //CODIFICARE LA PROVINCIA
    'password'      => "millebytes" //inviare la password già criptata in md5
];


$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);


curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch);
echo $result;
*/
?>
