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

 <form role="form" class="needs-validation" novalidate  action="conta_aree.php" method="post">
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>">

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

  <input class="form-control" type="text" maxlength="10" style="width:130px" value=""  name="prj">
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

 <div class="form-group">
  <label>Target Sesso</label>
<select class="form-control" name="sex_target">
<option value="">No select</option>
<option value="3">Uomo/Donna</option>
<option value="1">Uomo</option>
<option value="2">Donna</option>
</select>

</div>

<hr/>

<div class="form-group">
       <label>Target Età:</label>
	   <input class="form-control" type="text" maxlength="2" style="width:90px" value=""  name="age1_target"> anni
	  <input class="form-control" type="text" maxlength="2" value="" style="width:90px" name="age2_target"> anni
</div>

<hr/>

<div class="form-group">
       <label>Iscritto dal:</label>
	   <input class="form-control" type="text" maxlength="4" style="width:90px" value="2000"  name="iscrizione">
</div>

<hr/>

<div class="form-group">
       <label>N° Utenti:</label>
	 <input class="form-control" type="text" maxlength="4" value="" style="width:80px"  name="goal">
</div>

<input class="btn btn-danger" type="submit" name="creaCamp" value="CREA">
</form>
 
 <?php
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
?>
 
 
</div>

</div>
</div>



<div class="col-md-8 col-sm-8 col-xs-12">

<div class="col-md-4 col-sm-4 col-xs-12">

<div class="panel panel-primary">
	<div class="panel-heading">INFO PANEL </div>
	<div class="panel-body">

				<table class="table table-striped">
				<tr style="background-color:#FCF6DE"><td>Utenti attivi:</td><td><b><?php echo $t_use['total']; ?></b></td>  <td><b><?php echo round(($t_use['total']/100)*21); ?></b></td> </tr>
				<tr style="background-color:#DEF2FC"><td>Uomini:</td><td><b><?php echo $tm_use['total']; ?></b> </td>  <td><b><?php echo round(($tm_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#FCEAF3"><td>Donne:</td><td><b><?php echo $tf_use['total']; ?></b> </td>  <td><b><?php echo round(($tf_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>Under 18 anni:</td><td><b><?php echo $t17_use['total']; ?></b> </td>  <td><b><?php echo round(($t17_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>18-24 anni:</td><td><b><?php echo $t18_use['total']; ?></b> </td>  <td><b><?php echo round(($t18_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>25-34 anni:</td><td><b><?php echo $t25_use['total']; ?></b> </td>  <td><b><?php echo round(($t25_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>35-44 anni:</td><td><b><?php echo $t35_use['total']; ?></b> </td>  <td><b><?php echo round(($t35_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>45-54 anni:</td><td><b><?php echo $t45_use['total']; ?></b> </td>  <td><b><?php echo round(($t45_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>55-64 anni:</td><td><b><?php echo $t55_use['total']; ?></b> </td>  <td><b><?php echo round(($t55_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#F4FCEF"><td>65 e Over:</td><td><b><?php echo $t65_use['total']; ?></b> </td>  <td><b><?php echo round(($t65_use['total']/100)*21); ?></b></td></tr>
				<tr style="background-color:#EFFFFE"><td>Nord Ovest:</td><td><b><?php echo $tNo; ?></b> </td>  <td><b><?php echo round(($tNo/100)*21); ?></b></td></tr>
				<tr style="background-color:#EFFFFE"><td>Nord Est:</td><td><b><?php echo $tNe; ?></b> </td>  <td><b><?php echo round(($tNe/100)*21); ?></b></td></tr>
				<tr style="background-color:#EFFFFE"><td>Centro:</td><td><b><?php echo $tCe; ?></b> </td>  <td><b><?php echo round(($tCe/100)*21); ?></b></td></tr>
				<tr style="background-color:#EFFFFE"><td>Sud:</td><td><b><?php echo $tSu; ?></b> </td>  <td><b><?php echo round(($tSu/100)*21); ?></b></td></tr>
	
				</table>

	</div>
			<div class="panel-footer">
			&nbsp;	
			</div>	

</div>
</div>


<div class="col-md-4 col-sm-4 col-xs-12">

<div class="panel panel-success">
	<div class="panel-heading">REGIONI </div>
	<div class="panel-body">

		<table class="table table-striped">
		<tr style="background-color:#E8F8FC"><td>Abruzzo:</td><td><b><?php echo $ab; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Basilicata:</td><td><b><?php echo $ba; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Calabria:</td><td><b><?php echo $cl; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Campania:</td><td><b><?php echo $cm; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Emilia:</td><td><b><?php echo $em; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Friuli:</td><td><b><?php echo $fr; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Lazio:</td><td><b><?php echo $la; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Liguria:</td><td><b><?php echo $li; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Lombardia:</td><td><b><?php echo $lo; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Marche:</td><td><b><?php echo $ma; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Molise:</td><td><b><?php echo $mo; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Piemonte:</td><td><b><?php echo $pi; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Puglia:</td><td><b><?php echo $pu; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Sardegna:</td><td><b><?php echo $sa; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Sicilia:</td><td><b><?php echo $si; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Toscana:</td><td><b><?php echo $to; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Trentino:</td><td><b><?php echo $tr; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Umbria:</td><td><b><?php echo $um; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>V.Aosta:</td><td><b><?php echo $ao; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Veneto:</td><td><b><?php echo $ve; ?></b> </tr>
		</table>

	</div>


</div>
</div>



<!--fine div8-->
</div>

<!--fine row-->
</div>




 


</div>
</div>


<?php

require_once('inc_footer.php'); 

?>