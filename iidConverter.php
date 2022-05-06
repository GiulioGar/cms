<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IID converter</title>

<?php
if ($_GET["sid"]){
    $sid=$_GET["sid"];
}

if ($_GET["prj"]){
    $prj=$_GET["prj"];
}

if ($_GET["uid"]){
    $uid=$_GET["uid"];
}

if ($_GET["sid"] && $_GET["prj"] && $_GET["uid"])
{
    $authorization = "Authorization: Bearer U3lMWWFBcktGZmM1MjdQRzpTUnV3dzROU1FtM2JGZTJZQndDdlF2TkNERXc4MmdiSzdhelkyQldYZjZSYVZWc3VHY3hLTVk1QjVZakF0YnAz";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.primisoft.com/primis/api/v1/projects/$prj/surveys/$sid/questions/20/answers/user/$uid");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($ch);
    echo $result;
    if(!$result){echo "Nessun risultato trovato";}
    else{
        $oggetto=json_decode($result);
        if (!empty($oggetto->answer->interview_id)){
            echo "L'IID è: ".$oggetto->answer->interview_id."<br><br>";
        }else{
            echo "Nessuna corrispondenza trovata<br><br>";
        }
    }
    curl_close($ch);
}
?>

</head>
<body>
    <form action="iidConverter.php" method="GET">
        <input type="hidden" name="sid" value="<?=$sid;?>">
        <input type="hidden" name="prj" value="<?=$prj;?>">
        <label for="inputid">UID</label>
        <input id="inputid" type="text" name="uid">
        <button type="submit">INVIA</button>
    </form>
</body>
</html>



