<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

$prj=$_POST["prj"];
$sid=$_POST["sid"];
$code=$_POST["code"];
$codici=$_POST["codici"];
$tipo=$_POST["tipo"];



$vettoreCodici=[];


?>

<div class="content-wrapper">
      <div class="container">

<div class="row"> 
<div class="col-xl-6 col-lg-6">
<div class="card shadow mb-6">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<h6 class="m-0 font-weight-bold text-primary"> CREA CONCETTO </h6></span>
</div>
<div class="card-body">

<form action="toResponsive.php" method="POST">

     <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Tipo</label>
      <select class="form-control" id="tipo" name="tipo">
          <option value="0">Evaluator</option>
          <option value="1">Zoom</option>
        </select> 
    </div>
    </div>
    
    <div class="form-row">
    <div class="form-group col-md-10">
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">PRJ</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"> PRJ</div>
        </div>
        <input type="text" name="prj" class="form-control" id="prj" placeholder="Codice progetto">
      </div>
    </div>
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">SID</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"> SID</div>
        </div>
        <input type="text" name="sid" class="form-control" id="sid" placeholder="Codice Ricerca">
      </div>
    </div>
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">CODICI</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text"> CODICI</div>
        </div>
        <input type="text" name="codici" class="form-control" id="codici" placeholder="Codice Selezionabili">
      </div>
    </div>
    </div>

    </div>

    <div class="form-row">
    <div class="form-group col-md-12">
        <textarea name="code" id="code" rows="20" cols="50">

        </textarea>

        
    </div>
    </div>

    <div class="form-row">
    <div class="form-group col-md-10">
    </div>

    <div class="form-group col-md-2">
    <input type="submit" value="INVIA">
    </div>

    </div>


   


    </form>

    </div>

</div>

</div>


<div class="col-xl-6 col-lg-6">
<div class="card shadow mb-6">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<h6 class="m-0 font-weight-bold text-primary"> RISULTATO </h6></span>
</div>
<div class="card-body">

<?php

if (!empty($prj) && !empty($sid) && !empty($code))
{
  $riga=0;
  $contaImg=0;

  $righe=explode("\n",$code);
  
  if (!empty($codici))
  {
  $vettoreCodici=explode(",",$codici);
  }

  //$fn = fopen("iti1_0NTsm.html","r");
  echo "<xmp>";

  //while(! feof($fn))  {

  foreach ($righe as $key => $result) {
    # code...
  
    $riga++;
    
    //$result = fgets($fn);

    $findTable = strpos($result, "<table");
    $findWidth = strpos($result, "width");
    $findSpacer = strpos($result, "spacer.gif");
    



    if ($findSpacer!==false){


      preg_match('/width="(.*?)"/s', $result, $match);
      if (count($match)>0){
        $width=$match[1];
      }
      else{
        $width=-1;
      }

      preg_match('/height="(.*?)"/s', $result, $match);
      if (count($match)>0){
        $height=$match[1];
      }
      else{
        $height=-1;
      }
      
      if ($width>=0 && $height>=0)
      {
      

      // Create the size of image or blank image
      $image = imagecreate($width, $height);
    
      // Set the background color of image
      $background_color = imagecolorallocate($image, 255, 255, 255);
    
      $time=time();

      
      

      $nomeImmagine=$time."_".$riga.".gif";
      $save = "/var/imr/fields/$prj/$sid/resources/".strtolower($nomeImmagine);
      imagepng($image, $save);
      imagedestroy($image);
      $result=str_replace("spacer.gif",$nomeImmagine,$result);
      }
      



    }
    
    
    
    if ($findTable===false){
      $rep='class="img-responsive"';
    }
    else{
      $rep='';
    }

    $reg = '#width="[0-9]+" height="[0-9]+"#i';
    $result=preg_replace($reg,$rep,$result);  

    $result=str_replace('"',"'",$result);
    $result=str_replace('"',"'",$result);

    $result=str_replace('images/',"https://www.primisoft.com/fields/$prj/$sid/resources/",$result);
    
    foreach ($vettoreCodici as $key => $value) {
      $value = str_pad($value, 2, '0', STR_PAD_LEFT);
      $stringa="_$value.png";
      $stringa2="_$value.jpg";
      $findCode = strpos($result, $stringa);
      $findCode2 = strpos($result, $stringa2);
      if ($tipo=="0")
        {
        if ($findCode!==false || $findCode2!==false){
          $result=str_replace('<img',"#as<img",$result);
          $result=str_replace("alt=''>","alt=''>#ae",$result);
        }
      }
      if ($tipo=="1")
      {
        if ($findCode!==false || $findCode2!==false){
          $contaImg++;
          $result=str_replace('<img',"<a class='fancybox' rel='group' href='https://www.primisoft.com/fields/$prj/$sid/resources/b$contaImg.jpg'><img",$result);
          $result=str_replace("alt=''>","alt=''></a>",$result);
        }
      }      
    }    
      
    echo $result;
  }
  echo "</xmp>";
  //fclose($fn);
}
else
{
  echo "<div>Dati non validi</div>";
}
?>
</div>
</div>
</div>



</div>
</div>

<?php require_once('inc_footer.php'); ?>
</body>
</html>