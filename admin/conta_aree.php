<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
@$creaCamp = $_REQUEST['creaCamp'];
$sex_target=$_REQUEST['sex_target'];
$area=$_REQUEST['aree'];
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$iscrizione=$_REQUEST['iscrizione'];
$currentYear=date("Y");

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
*/

require_once('inc_taghead.php');
require_once('inc_tagbody.php');
require_once('function_conta_aree.php');

?>

  <div class="content-wrapper">
       <div class="container">
	   
 <div class="row">

 
   <div class="col-xl-6 col-lg-5">
   <div class="card shadow mb-6">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> CREA CAMPIONE </h6></span>
                        </div>
                        <div class="card-body">

 <form class="needs-validation"  action="conta_aree.php" method="get">
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>" />

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Ricerca:</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01 " name="sid">
  <option value="">No select</option>
<?php
    while ($row = mysqli_fetch_assoc($csv_sur)) 
    {
	 echo "<option value='".$row['sur_id']."'>".$row['sur_id']."</option>";
	}
?>
</select>
</div>
</div>

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Progetto:</label>
  </div>

  <input class="form-control" type="text" maxlength="10" style="width:130px" value=""  name="prj" />
</div>
</div>

</div>

<hr/>
<div class="form-row">

<div class="col-xl-6 col-lg-5">
<label><h6 class="m-0 font-weight-bold text-primary">Regione:</h6></label>
<select name="reg" class="selectpicker show-tick"  multiple title="Scegli la regione...">
  <option value="1">ABRUZZO</option>
  <option value="2">BASILICATA</option>
  <option value="3">CALABRIA</option>
  <option value="4">CAMPANIA</option>
  <option value="5">EMILIA-ROMAGNA</option>
  <option value="6">FRIULI-VENEZIA GIULIA</option>
  <option value="7">LAZIO</option>
  <option value="8">LIGURIA</option>
  <option value="9">LOMBARDIA</option>
  <option value="10">MARCHE</option>
  <option value="11">MOLISE</option>
  <option value="12">PIEMONTE</option>
  <option value="13">PUGLIA</option>
  <option value="14">SARDEGNA</option>
  <option value="15">SICILIA</option>
  <option value="16">TOSCANA</option>
  <option value="17">TRENTINO-ALTO ADIGE</option>
  <option value="18">UMBRIA</option>
  <option value="19">VALLE D'AOSTA</option>
  <option value="20">VENETO</option>
</select>
</div>

<div class="col-xl-6 col-lg-5">
<label><h6 class="m-0 font-weight-bold text-primary">Area:</h6></label>
<select name="aree" class="selectpicker show-tick"  multiple title="Scegli l'area...">
  <option value="1">Nord-Ovest</option>
  <option value="2">Nord-Est</option>
  <option value="3">Centro</option>
  <option value="4">Sud</option>
</select>
</div>

</div>


<hr />

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Sesso:</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01 " name="sex_target">
<option value="3">Uomo/Donna</option>
<option value="1">Uomo</option>
<option value="2">Donna</option>
</select>
</div>
</div>



<div class="form-group col-md-6">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Età da:</label>
  </div>
        <input   class="form-control" type="number" maxlength="2" style="width:90px" value="18"  name="age1_target" required />  
</div>
<div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Età a&nbsp;&nbsp;:</label>
  </div> 

	  <input   class="form-control" type="number" maxlength="2" value="65" style="width:90px" name="age2_target" required /> 
  </div>

     </div>
</div>
</div>

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Iscritto dal:</label>
  </div>
	   <input required class="form-control" type="text" maxlength="4"  value="1990"  name="iscrizione" />
</div>
</div>


<div class="form-group col-md-6">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">N° Utenti:</label>
  </div>
	 <input class="form-control" type="text" maxlength="4" value=""  name="goal" />
</div>
</div>

</div>

<div class="form-row">

<div class="form-group col-md-12">
<div class="input-group mb-6">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Target:</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01 " name="tag">
  <option value="">No select</option>
  <?php
			while ($row = mysqli_fetch_assoc($tot_targ))
			{
			?>
		    <option value="<?php echo $row['tag'];?>"><?php echo $row['tag'];?></option>
			<?php
			}
			?>
</select>
</div>
</div>
<div class="input-group mb-6"></div>
</div>

</hr></hr>

<div class="form-row">
<div class="form-group col-md-12"  style="text-align:right; padding:20px;" >

<input class="btn btn-primary" type="submit" name="contaDisp" value="DISPONIBILI" />
<input class="btn btn-primary" type="submit" name="creaCamp" value="CREA" />


</div>
 </div>


 </form>

 <?php
 /*
if ($creaCamp=="CREA")	
{
?>
			<form  style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input type="image" value="submit" src="img/CSV.gif" />
				Download
				</form>		

<?php
}
*/
?>
 
 
</div>

</div>



<div class="col-xl-6 col-lg-5">
   <div class="card shadow mb-6">



<?php echo "<br/>Utenti disponibili: ".$dataDisp['total']; ?>


<!--fine div8-->
</div>

<!--fine row-->
</div>




 


</div>
</div>


<?php

require_once('inc_footer.php'); 

?>