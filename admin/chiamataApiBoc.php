<head>


<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://millebytes.com/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/flaticon.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/animate.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/boxicons.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/nice-select.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/fancybox.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/odometer.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/magnific-popup.min.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/style.css">
        <link rel="stylesheet" href="https://millebytes.com/assets/css/responsive.css">
        <title>Club Millebytes</title>
        <link rel="icon" type="image/png" href="https://millebytes.com/assets/img/favicon.png">


    

</head>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$iid=$_REQUEST['iid'];
$getQuestions = array();

$gender=1;
$year=1;
$provId=1;
$mail="";
$name="";
$surname="";
$birth="";


// RICHIESTA GET API PRIMIS
$getSex = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/25/answers/".$iid;
$getAge = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/20/answers/".$iid;
$getProv = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/28/answers/".$iid;
$getMail = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/5000/answers/".$iid;
$getFirst = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/5010/answers/".$iid;
$getSecond = "https://www.primisoft.com/primis/api/v1/projects/BOC/surveys/R2301015T/questions/5020/answers/".$iid;
array_push($getQuestions, $getSex,$getAge,$getProv,$getMail,$getFirst,$getSecond); 



$headers = array(
    "Content-Type: application/json; charset=utf-8",
    "Authorization: Bearer U3lMWWFBcktGZmM1MjdQRzpTUnV3dzROU1FtM2JGZTJZQndDdlF2TkNERXc4MmdiSzdhelkyQldYZjZSYVZWc3VHY3hLTVk1QjVZakF0YnAz"
);

$conta=0;

foreach ($getQuestions as $valore) 
{
    $conta++;

    $ch1 = curl_init($valore);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch1);
    curl_close($ch1);
    //echo $response . PHP_EOL;
    $responseData = json_decode($response);

  if($conta==1)  
  {
    $query=$responseData->answer->selection;
    $gender=$query+1;

    echo "<p>Sesso:".$gender."</p>";
    
  } 
if($conta==2)  
{
    $query=$responseData->answer->text;
    $year=date("Y");
    $year=$year-$query;
    $birth=$year."-01-01";


    echo "<p>Birth:".$birth."</p>";
} 

if($conta==3)  
{
    $query=$responseData->answer->selection;
    $provId=$query+1;

    echo "<p>Province:".$provId."</p>";
} 

if($conta==4)  
{
    $query=$responseData->answer->text;
    $mail=$query;
    echo "<p>Mail:".$mail."</p>";
} 


if($conta==5)  
{
    $query=$responseData->answer->text;
    $name=$query;
    echo "<p>First Name:".$name."</p>";
} 


if($conta==6)  
{
    $query=$responseData->answer->text;
    $surname=$query;
    echo "<p>Second Name:".$surname."</p>";

} 
}




//ENDPOINT RICHIESTA POST
$url = "https://apps.primisoft.com/putRegistrationUnic/index.php";
$pwd="millebytes";
$pwd=md5($pwd);

//The data you want to send via POST
$fields = [
    'email'      => $mail,
    'second_name'      => $name,
    'first_name'      => $surname,
    'gender'      => $gender,
    'birth_date'      => $birth, //ESEMPIO DATA DI NASCITA
    'province_id'      => $provId, //CODIFICARE LA PROVINCIA
    'password'      => $pwd, //inviare la password già criptata in md5
    'referal' => "ref7"
];


$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);


curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$result = curl_exec($ch);
echo $result;


?>


            <div class="row" style="background-color:#fff; box-shadow: 15px 15px 15px 0 rgba(0, 0, 0, 0.3); ">

            <div class="col-lg-3 col-md-12">
            </div>
            
            <div class="col-lg-6 col-md-12">
            
            <div class="container" style="background-color:#FE9F1C; height:100%; color:#fff;padding: 50px;">
            
                <div style="width: 100%; padding: 20px 10px; text-align: left;">
                <div class="col-md-12 hideme">
						<h2>Benvenuto nel Club Millebytes! </h2>
                        <br>
						<h4 style="color:#6D6D6D">Ti abbiamo assegnato un bonus di 1000 punti del valore di 1 &euro; !</h4>
						<h5 style="color:red">Puoi accedere con la stessa email con cui hai partecipato a questo sondaggio, la password che ti &egrave; stata assegnata &egrave; : millebytes</h5>
						<br>
						<center>
                        <img style="border-radius:10%;" src="https://millebytes.com/assets/img/reprize.png" alt="image">
						</center>
					</div>

                </div>
					
				


            </div>

            <div class="col-lg-3 col-md-12">
            </div>

            </div>

            </div>
        
