


<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);	

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	
$arrStime = array(1.35, 1.55, 2.05, 2.80, 3.75, 5.25, 8.00, 11.70, 14.65, 19.85, 1.60, 1.85, 2.35, 3.10, 4.05, 5.55, 8.25, 11.95, 14.95, 20.10, 1.90, 2.15, 2.65, 3.40, 4.35, 5.85, 8.60, 12.30, 15.25, 20.40, 2.20, 2.45, 2.95, 3.70, 4.65, 6.15, 8.90, 12.60, 15.55, 20.75, 2.55, 2.75, 3.25, 4.00, 4.95, 6.45, 9.20, 12.90, 15.85, 21.05, 2.85, 3.05, 3.60, 4.30, 5.30, 6.75, 9.50, 13.20, 16.15, 21.35, 3.50, 3.70, 4.20, 4.95, 5.90, 7.40, 10.15, 13.85, 16.80, 22.00, 4.05, 4.25, 4.80, 5.55, 6.50, 7.95, 10.70, 14.40, 17.35, 22.55, 4.70, 4.90, 5.40, 6.15, 7.10, 8.60, 11.35, 15.05, 18.00, 23.20, 5.10, 5.35, 5.85, 6.60, 7.55, 9.05, 11.75, 15.45, 18.45, 23.60, 5.55, 5.75, 6.30, 7.00, 8.00, 9.45, 12.20, 15.90, 18.85, 24.05, 5.95, 6.20, 6.70, 7.45, 8.40, 9.90, 12.65, 16.35, 19.30, 24.50, 6.40, 6.65, 7.15, 7.90, 8.85, 10.35, 13.05, 16.75, 19.75, 24.90 );


$cerca_progetto=$_REQUEST['prj'];
if ($cerca_progetto==""){$cerca_progetto="%";}

$cy=date("Y");

echo $cerca_panel_originale;
$cerca_panel=$_REQUEST['Cpanel'];
if ($cerca_panel==""){$cerca_panel="%";}

$cerca_anno_originale=$_REQUEST['Canno'];
$cerca_anno=$_REQUEST['Canno'];
if ($cerca_anno==""){$cerca_anno=$cy."%";}
					else
					{$cerca_anno=$cerca_anno."%";}
					
					
	


$data=date("Y-m-d");


mysqli_select_db($database_admin, $admin);
$query_ricerche = "SELECT * FROM t_panel_control where prj like '$cerca_progetto' and panel=1  and sur_date like '$cerca_anno' AND stato=1 order by id asc";
$query_ricerche_aggiornate = "SELECT * FROM t_panel_control where prj like '$cerca_progetto' and panel =1 and sur_date like '$cerca_anno' AND stato=1 order by id ASC";
$tot_ricerche = mysqli_query($admin,$query_ricerche) or die(mysql_error());

//echo $query_ricerche;

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 



?>




<div class="content-wrapper">
 <div class="container">

	
<div class="row">


<div class="col-md-6 col-md-offset-1">
<div class="card shadow mb-6">	
						<div class="card-heading">
						<form role="form" name="modulo_cerca_prj" action="costiPanel.php" method="get">
							<select class="form-control dropdown-primary Canno" name="Canno">
								<option value="<?php echo '2020' ?>"><?php echo '2020' ?></option>
								<option value="2019" <?php if ($cerca_anno_originale=="2019") {echo 'selected="selected"';} ?>>2019</option>
								<option value="2018" <?php if ($cerca_anno_originale=="2018") {echo 'selected="selected"';} ?>>2018</option>
								<option value="2017" <?php if ($cerca_anno_originale=="2017") {echo 'selected="selected"';} ?>>2017</option>
							</select>
						</form>
						</div>


<div class="card-body text-center recent-users-sec">
	 <?php

while ($row = mysqli_fetch_assoc($tot_ricerche))
{
	$loi=number_format($row['durata'], 0);
	$redx=number_format($row['red_surv'], 0);
	$costo=$row['costo'];
	$riga;
	$colonna;
	$matrice;


	if ($loi<3) {$riga=0;}
	if ($loi>=4 && $loi<=6) {$riga=1;}
	if ($loi>=7 && $loi<=10) {$riga=2;}
	if ($loi>=11 && $loi<=15) {$riga=3;}
	if ($loi>=16 && $loi<=20) {$riga=4;}
	if ($loi>=21 && $loi<=25) {$riga=5;}
	if ($loi>=26 && $loi<=30) {$riga=6;}
	if ($loi>=31 && $loi<=35) {$riga=7;}
	if ($loi>=36 && $loi<=40) {$riga=8;}
	if ($loi>=41 && $loi<=45) {$riga=9;}
	if ($loi>=51 && $loi<=55) {$riga=10;}
	if ($loi>55) {$riga=11;}

	if ($redx>=75) {$colonna=0;}
	if ($redx>=50  && $redx<=74) {$colonna=1;}
	if ($redx>=30 && $redx<=49) {$colonna=2;}
	if ($redx>=20 && $redx<=29) {$colonna=3;}
	if ($redx>=15 && $redx<=19) {$colonna=4;}
	if ($redx>=10 && $redx<=14) {$colonna=5;}
	if ($redx>=7 && $redx<=9) {$colonna=6;}
	if ($redx>=5 && $redx<=6) {$colonna=7;}
	if ($redx>=3 && $redx<=4) {$colonna=8;}
	if ($redx<3) {$colonna=9;}


	$cpi=$arrStime[$matrice];
	$complete=$row['complete_int'];

	$matrice=($riga*10) +$colonna;
	$costoX=$complete*$cpi;
	$saved=$costoX-$costo;

	//totali
		
	$costoTot=$costo+$costoTot;
	$costoXTot=$costoX+$costoXTot;
	$savedTot=$saved+$savedTot;

}	
setlocale(LC_MONETARY, 'it_IT');

		echo 
		"
		<table id='tabTotal' style='font-size:16px' class='table table-striped table-bordered table-hover'>
		<tr>
		<td style='font-weight:bold;'>Costi effettivi:</td>
		<td style='font-weight:bold;'>".number_format($costoTot, 0, ',', '.')."€</td>
		</tr>
		<tr>
		<td style='font-weight:bold'>Costi stimati:</td>
		<td style='font-weight:bold; color:red;'>".number_format($costoXTot, 0, ',', '.')."€</td>
		</tr>
		<tr>
		<td style='font-weight:bold'>Risparmiati:</td>
		<td style='font-weight:bold; color:green;'>".number_format($savedTot, 0, ',', '.')."€</td>
		</tr>
		</table>
	
		"
	 ?>

	</div>

</div>
</div>


<div class="col-md-6 col-md-offset-1">
<div class="card shadow mb-12">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> CALCOLO COSTO INTERVISTE </h6></span>
 </div>


<div class="card-body">      

<form class="form">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Numero Interviste:</span>
  </div>
  <input name="nint" type="number"/> 
</div>



  <div class="form-row">
    <div class="col">
      <input style="width:220px" name="loi" type="number" class="form-control" placeholder="Loi stimata minuti:">
    </div>
    <div class="col">
      <input style="width:220px" name="ir" type="number" class="form-control" placeholder="IR stimata %:">
    </div>
</div>

<p>
<ul class="list-group">
  <li class="list-group-item d-flex justify-content-between align-items-center">
  Costo per Intervista:
    <span class="badge badge-primary badge-pill" style="font-size:14px;"><span class="cpi"></span>€</span>
  </li>
  <li class="list-group-item d-flex justify-content-between align-items-center">
  Costo Totale:
    <span class="badge badge-success badge-pill" style="font-size:15px;"><span class="tot"></span>€</span>
  </li>
</ul>
</p>


</div>

</div>
</div>


</div>



 <div class="row">
  <div class="col-xl-12 col-lg-12">
   <div class="card shadow mb-12">
   
   <div class="card-body text-center recent-users-sec">
    <div class="table-responsive">
<?php
echo "<table id='tabField' style='font-size:11px' class='table table-striped table-bordered table-hover'>";
echo "<tr class='intesta'>";
echo "<td style='font-weight:bold'>Ricerca</td>";
echo "<td style='font-weight:bold'>Descrizione</td>";
echo "<td style='font-weight:bold'>Complete</td>";
echo "<td style='font-weight:bold'>% Ricerca</td>";
echo "<td style='font-weight:bold'>LOI</td>";
echo "<td style='font-weight:bold'>Costo Panel</td>";;
echo "<td style='font-weight:bold'>CPI</td>";
echo "<td style='font-weight:bold'>Stima Costi Esterni</td>";
echo "<td style='font-weight:bold'>Risparmio</td>";
echo "</tr>";

//AGGIORNO INFO GIORNI RIMANENTI IN DB
while ($row = mysqli_fetch_assoc($tot_ricerche))
{
$today=substr($data,0,10);
$sur_date=substr($row['sur_date'],0,10);
$end_date=substr($row['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($today, $row['end_field'], "g"); }
else { $daysField="n.d.";}
if ($daysField<0) {$daysField=0;}
$sid=$row['sur_id'];
$query_aggiorna_statistiche = "UPDATE t_panel_control set giorni_rimanenti='".$daysField."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) or die(mysql_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);


}


//STAMPO LE RICERCHE DOPO AGGIORNAMENTO DEI GIORNI RIMANENTI
$tot_ricerche = mysqli_query($admin,$query_ricerche_aggiornate) or die(mysql_error());


while ($row = mysqli_fetch_assoc($tot_ricerche))
{

	// calcolo costo stimato esterno //
	$loi=number_format($row['durata'], 0);
	$redx=number_format($row['red_surv'], 0);
	$costo=$row['costo'];
	$riga2;
	$colonna2;
	$matrice2;

	if ($loi<3) {$riga2=0;}
	if ($loi>=4 && $loi<=6) {$riga2=1;}
	if ($loi>=7 && $loi<=10) {$riga2=2;}
	if ($loi>=11 && $loi<=15) {$riga2=3;}
	if ($loi>=16 && $loi<=20) {$riga2=4;}
	if ($loi>=21 && $loi<=25) {$riga2=5;}
	if ($loi>=26 && $loi<=30) {$riga2=6;}
	if ($loi>=31 && $loi<=35) {$riga2=7;}
	if ($loi>=36 && $loi<=40) {$riga2=8;}
	if ($loi>=41 && $loi<=45) {$riga2=9;}
	if ($loi>=51 && $loi<=55) {$riga2=10;}
	if ($loi>55) {$riga2=11;}

	if ($redx>=75) {$colonna2=0;}
	if ($redx>=50  && $redx<=74) {$colonna2=1;}
	if ($redx>=30 && $redx<=49) {$colonna2=2;}
	if ($redx>=20 && $redx<=29) {$colonna2=3;}
	if ($redx>=15 && $redx<=19) {$colonna2=4;}
	if ($redx>=10 && $redx<=14) {$colonna2=5;}
	if ($redx>=7 && $redx<=9) {$colonna2=6;}
	if ($redx>=5 && $redx<=6) {$colonna2=7;}
	if ($redx>=3 && $redx<=4) {$colonna2=8;}
	if ($redx<3) {$colonna2=9;} 

	$matrice2=($riga2*10) +$colonna2;
	$costoX2=$row['complete_int']*$arrStime[$matrice2];
	$saved2=$costoX2-$costo;
	


echo "<tr class='rowSur' style='background:".$colRow."'>";
echo "<td><a href='conta_locale.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$row['complete_int']."</td>";
echo "<td>".$row['red_surv']."%</td>";
echo "<td>".$row['durata']." min.</td>";
if ($costo==""){$costo=0;}
echo "<td>€".$costo."</td>";
echo "<td>€".$arrStime[$matrice2]."</td>";
echo "<td>€".number_format($costoX2, 0, ',', '.')."</td>";
echo "<td><span style='color:green; font-weight:bold'>€".number_format($saved2, 0, ',', '.')."</span></td>";
echo "</tr>";
echo "<script> console.log('Ir ". $colonna2. " ')</script>";



 ?>



</div>


<?php
}


echo "</table>";
?>
</div>

</div>

</div>
</div>
</div>


</div>
</div>


 <script>
$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
});


const arrStima99 = [1.40,1.60,2.15,2.90,3.90,5.45,8.30,12.15,15.20,20.60, 1.65,1.90,2.45,3.20,4.20,5.75,8.60,12.40,15.50,20.85,2.00,2.20,2.75,3.50,4.50,6.05,8.90,12.75,15.80,21.20,2.30,2.55,3.05,3.85,4.85,6.35,9.20,13.05,16.15,21.50, 2.60,2.85,3.40,4.15,5.15,6.70,9.55,13.40,16.45,21.80,2.95,3.15,3.70,4.50,5.50,7.00,9.85,13.70,16.75,22.15 ,3.60,3.85,4.40,5.15,6.15,7.70,10.50,14.35,17.45,22.80, 4.20,4.45,4.95,5.75,6.75,8.25,11.10,14.95,18.00,23.40 ,4.85,5.10,5.60,6.40,7.40,8.90,11.75,15.60,18.70,24.05, 5.30,5.55,6.05,6.85,7.85,9.35,12.20,16.05,19.10,24.50, 5.75,6.00,6.50,7.30,8.30,9.80,12.65,16.50,19.55,24.95, 6.20,6.45,6.95,7.75,8.75,10.25,13.10,16.95,20.00,25.40 ,6.65,6.85,7.40,8.20,9.20,10.70,13.55,17.40,20.45,25.85 ]
const arrStima100 = [1.35, 1.55, 2.05, 2.80, 3.75, 5.25, 8.00, 11.70, 14.65, 19.85, 1.60, 1.85, 2.35, 3.10, 4.05, 5.55, 8.25, 11.95, 14.95, 20.10, 1.90, 2.15, 2.65, 3.40, 4.35, 5.85, 8.60, 12.30, 15.25, 20.40, 2.20, 2.45, 2.95, 3.70, 4.65, 6.15, 8.90, 12.60, 15.55, 20.75, 2.55, 2.75, 3.25, 4.00, 4.95, 6.45, 9.20, 12.90, 15.85, 21.05, 2.85, 3.05, 3.60, 4.30, 5.30, 6.75, 9.50, 13.20, 16.15, 21.35, 3.50, 3.70, 4.20, 4.95, 5.90, 7.40, 10.15, 13.85, 16.80, 22.00, 4.05, 4.25, 4.80, 5.55, 6.50, 7.95, 10.70, 14.40, 17.35, 22.55, 4.70, 4.90, 5.40, 6.15, 7.10, 8.60, 11.35, 15.05, 18.00, 23.20, 5.10, 5.35, 5.85, 6.60, 7.55, 9.05, 11.75, 15.45, 18.45, 23.60, 5.55, 5.75, 6.30, 7.00, 8.00, 9.45, 12.20, 15.90, 18.85, 24.05, 5.95, 6.20, 6.70, 7.45, 8.40, 9.90, 12.65, 16.35, 19.30, 24.50, 6.40, 6.65, 7.15, 7.90, 8.85, 10.35, 13.05, 16.75, 19.75, 24.90 ]
const arrStima200 = [1.30,1.50,2.00,2.75,3.65,5.10,7.75,11.35,14.25,19.30, 1.55,1.80,2.30,3.00,3.95,5.35,8.05,11.65,14.50,19.55 ,1.85,2.05,2.60,3.30,4.25,5.65,8.35,11.95,14.80,19.85, 2.15,2.35,2.90,3.60,4.55,5.95,8.65,12.25,15.10,20.15, 2.45,2.65,3.20,3.90,4.85,6.25,8.95,12.55,15.40,20.45, 2.75,2.95,3.50,4.20,5.15,6.55,9.25,12.85,15.70,20.75, 3.40,3.60,4.10,4.80,5.75,7.20,9.85,13.45,16.35,21.35, 3.95,4.15,4.65,5.35,6.30,7.75,10.40,14.00,16.90,21.90, 4.55,4.75,5.25,6.00,6.90,8.35,11.00,14.60,17.50,22.55, 4.95,5.20,5.70,6.40,7.35,8.80,11.45,15.05,17.90,22.95, 5.40,5.60,6.10,6.80,7.75,9.20,11.85,15.45,18.35,23.40, 5.80,6.00,6.50,7.25,8.20,9.60,12.30,15.90,18.75,23.80, 6.20,6.45,6.95,7.65,8.60,10.05,12.70,16.30,19.20,24.20]
const arrStima300 = [1.25,1.45,1.95,2.65,3.55,4.95,7.55,11.05,13.85,18.70, 1.50,1.70,2.20,2.90,3.80,5.20,7.80,11.30,14.10,19.00 ,1.80,2.00,2.50,3.20,4.10,5.50,8.10,11.60,14.40,19.30, 2.10,2.30,2.80,3.50,4.40,5.80,8.40,11.90,14.70,19.55, 2.40,2.60,3.10,3.80,4.70,6.10,8.70,12.15,14.95,19.85, 2.70,2.90,3.40,4.10,5.00,6.40,8.95,12.45,15.25,20.15, 3.30,3.50,4.00,4.70,5.60,7.00,9.55,13.05,15.85,20.75, 3.80,4.05,4.50,5.20,6.15,7.50,10.10,13.60,16.40,21.30, 4.40,4.60,5.10,5.80,6.70,8.10,10.70,14.20,17.00,21.90, 4.80,5.05,5.50,6.20,7.15,8.55,11.10,14.60,17.40,22.30, 5.25,5.45,5.95,6.65,7.55,8.95,11.50,15.00,17.80,22.70, 5.65,5.85,6.35,7.05,7.95,9.35,11.95,15.40,18.20,23.10, 6.05,6.25,6.75,7.45,8.35,9.75,12.35,15.85,18.65,23.50]
const arrStima400 = [1.20,1.45,1.90,2.60,3.45,4.85,7.35,10.75,13.50,18.25, 1.50,1.70,2.15,2.85,3.75,5.10,7.60,11.05,13.75,18.55 ,1.75,1.95,2.45,3.15,4.00,5.40,7.90,11.30,14.05,18.80, 2.05,2.25,2.75,3.40,4.30,5.65,8.20,11.60,14.30,19.10, 2.35,2.55,3.00,3.70,4.60,5.95,8.45,11.90,14.60,19.40, 2.60,2.80,3.30,4.00,4.85,6.25,8.75,12.15,14.90,19.65, 3.20,3.40,3.90,4.55,5.45,6.80,9.35,12.75,15.50,20.25, 3.75,3.95,4.40,5.10,6.00,7.35,9.85,13.30,16.00,20.80, 4.30,4.50,5.00,5.65,6.55,7.90,10.45,13.85,16.60,21.35, 4.70,4.90,5.40,6.05,6.95,8.30,10.85,14.25,17.00,21.75, 5.10,5.30,5.80,6.45,7.35,8.70,11.25,14.65,17.40,22.15, 5.50,5.70,6.20,6.85,7.75,9.10,11.65,15.05,17.80,22.55, 5.90,6.10,6.60,7.25,8.15,9.50,12.05,15.45,18.15,22.95]
const arrStima500 = [1.20,1.40,1.85,2.50,3.40,4.70,7.15,10.50,13.15,17.80, 1.45,1.65,2.10,2.75,3.65,4.95,7.40,10.75,13.40,18.05 ,1.70,1.90,2.40,3.05,3.90,5.25,7.70,11.00,13.65,18.30, 2.00,2.20,2.65,3.30,4.20,5.50,7.95,11.30,13.95,18.60, 2.25,2.45,2.95,3.60,4.45,5.80,8.25,11.55,14.25,18.90, 2.55,2.75,3.20,3.90,4.75,6.05,8.55,11.85,14.50,19.15, 3.10,3.30,3.80,4.45,5.30,6.65,9.10,12.40,15.10,19.75, 3.65,3.85,4.30,4.95,5.80,7.15,9.60,12.95,15.60,20.25, 4.20,4.40,4.85,5.50,6.40,7.70,10.20,13.50,16.15,20.80, 4.60,4.80,5.25,5.90,6.80,8.10,10.55,13.90,16.55,21.20, 4.95,5.15,5.65,6.30,7.15,8.50,10.95,14.25,16.95,21.60, 5.35,5.55,6.00,6.70,7.55,8.90,11.35,14.65,17.30,21.95, 5.75,5.95,6.40,7.10,7.95,9.25,11.75,15.05,17.70,22.35]
const arrStima600 = [1.15,1.35,1.85,2.50,3.35,4.65,7.05,10.35,12.95,17.55, 1.40,1.60,2.05,2.75,3.60,4.90,7.30,10.60,13.20,17.80 ,1.70,1.90,2.35,3.00,3.85,5.15,7.60,10.85,13.45,18.05, 1.95,2.15,2.60,3.25,4.10,5.45,7.85,11.10,13.75,18.30, 2.25,2.45,2.90,3.55,4.40,5.70,8.10,11.40,14.00,18.60, 2.50,2.70,3.15,3.80,4.65,6.00,8.40,11.65,14.30,18.85, 3.10,3.25,3.75,4.40,5.25,6.55,8.95,12.25,14.85,19.45, 3.60,3.75,4.25,4.90,5.75,7.05,9.45,12.75,15.35,19.95, 4.15,4.35,4.80,5.45,6.30,7.60,10.00,13.30,15.90,20.50, 4.50,4.70,5.15,5.80,6.65,8.00,10.40,13.70,16.30,20.85, 4.90,5.10,5.55,6.20,7.05,8.35,10.80,14.05,16.65,21.25, 5.30,5.45,5.95,6.60,7.45,8.75,11.15,14.45,17.05,21.65, 5.65,5.85,6.30,6.95,7.80,9.15,11.55,14.80,17.45,22.00]
const arrStima700 = [1.15,1.35,1.80,2.45,3.30,4.60,6.95,10.20,12.80,17.30, 1.40,1.60,2.05,2.70,3.55,4.80,7.20,10.45,13.05,17.55 ,1.65,1.85,2.30,2.95,3.80,5.10,7.50,10.70,13.30,17.80, 1.95,2.15,2.60,3.25,4.05,5.35,7.75,11.00,13.55,18.10, 2.20,2.40,2.85,3.50,4.35,5.65,8.00,11.25,13.85,18.35, 2.50,2.65,3.10,3.75,4.60,5.90,8.30,11.50,14.10,18.60, 3.05,3.25,3.70,4.35,5.15,6.45,8.85,12.10,14.65,19.20, 3.55,3.70,4.20,4.80,5.65,6.95,9.35,12.55,15.15,19.70, 4.10,4.25,4.75,5.35,6.20,7.50,9.90,13.10,15.70,20.25, 4.45,4.65,5.10,5.75,6.60,7.90,10.25,13.50,16.10,20.60, 4.85,5.05,5.50,6.15,6.95,8.25,10.65,13.90,16.45,21.00, 5.20,5.40,5.85,6.50,7.35,8.65,11.00,14.25,16.85,21.35, 5.60,5.80,6.25,6.90,7.70,9.00,11.40,14.65,17.20,21.75]
const arrStima800 = [1.15,1.35,1.80,2.40,3.25,4.55,6.90,10.10,12.65,17.10, 1.40,1.60,2.00,2.65,3.50,4.75,7.15,10.35,12.90,17.35 ,1.65,1.85,2.30,2.95,3.75,5.05,7.40,10.60,13.15,17.65, 1.90,2.10,2.55,3.20,4.05,5.30,7.65,10.85,13.40,17.90, 2.20,2.35,2.80,3.45,4.30,5.55,7.95,11.15,13.70,18.15, 2.45,2.65,3.10,3.75,4.55,5.85,8.20,11.40,13.95,18.40, 3.00,3.20,3.65,4.30,5.10,6.40,8.75,11.95,14.50,19.00, 3.50,3.70,4.15,4.75,5.60,6.90,9.25,12.45,15.00,19.45, 4.05,4.25,4.70,5.30,6.15,7.40,9.80,13.00,15.55,20.00, 4.40,4.60,5.05,5.70,6.50,7.80,10.15,13.35,15.90,20.40, 4.80,4.95,5.40,6.05,6.90,8.15,10.55,13.75,16.30,20.75, 5.15,5.35,5.80,6.45,7.25,8.55,10.90,14.10,16.65,21.15, 5.55,5.70,6.15,6.80,7.65,8.90,11.30,14.45,17.05,21.50]
const arrStima900 = [1.15,1.35,1.75,2.40,3.25,4.50,6.85,10.00,12.55,17.00, 1.35,1.55,2.00,2.65,3.45,4.75,7.10,10.25,12.80,17.20 ,1.65,1.85,2.25,2.90,3.75,5.00,7.35,10.50,13.05,17.50, 1.90,2.10,2.55,3.15,4.00,5.25,7.60,10.75,13.30,17.75, 2.15,2.35,2.80,3.45,4.25,5.50,7.85,11.05,13.55,18.00, 2.45,2.60,3.05,3.70,4.50,5.80,8.15,11.30,13.85,18.25, 3.00,3.15,3.60,4.25,5.05,6.35,8.70,11.85,14.40,18.80, 3.45,3.65,4.10,4.75,5.55,6.80,9.15,12.35,14.85,19.30, 4.00,4.20,4.65,5.25,6.10,7.35,9.70,12.85,15.40,19.85, 4.35,4.55,5.00,5.65,6.45,7.75,10.05,13.25,15.80,20.20, 4.75,4.95,5.40,6.00,6.85,8.10,10.45,13.60,16.15,20.60, 5.10,5.30,5.75,6.40,7.20,8.45,10.80,14.00,16.50,20.95, 5.50,5.65,6.10,6.75,7.55,8.85,11.20,14.35,16.90,21.30]
const arrStima1000 = [1.15,1.30,1.75,2.40,3.20,4.45,6.80,9.95,12.45,16.85, 1.35,1.55,2.00,2.60,3.45,4.70,7.05,10.20,12.70,17.10 ,1.65,1.80,2.25,2.90,3.70,4.95,7.30,10.45,12.95,17.35, 1.90,2.10,2.50,3.15,3.95,5.25,7.55,10.70,13.20,17.65, 2.15,2.35,2.80,3.40,4.25,5.50,7.80,10.95,13.50,17.90, 2.40,2.60,3.05,3.65,4.50,5.75,8.10,11.25,13.75,18.15, 2.95,3.15,3.60,4.20,5.05,6.30,8.65,11.80,14.30,18.70, 3.45,3.65,4.05,4.70,5.50,6.80,9.10,12.25,14.80,19.20, 4.00,4.15,4.60,5.25,6.05,7.30,9.65,12.80,15.30,19.70, 4.35,4.55,5.00,5.60,6.40,7.70,10.00,13.15,15.70,20.10, 4.70,4.90,5.35,5.95,6.80,8.05,10.40,13.55,16.05,20.45, 5.10,5.25,5.70,6.35,7.15,8.40,10.75,13.90,16.40,20.80, 5.45,5.65,6.10,6.70,7.55,8.80,11.10,14.25,16.80,21.20]
const arrStima1200 = [1.10,1.30,1.75,2.40,3.20,4.45,6.75,9.90,12.40,16.80, 1.35,1.55,2.00,2.60,3.45,4.70,7.00,10.15,12.65,17.05 ,1.60,1.80,2.25,2.85,3.70,4.95,7.25,10.40,12.90,17.30, 1.90,2.05,2.50,3.15,3.95,5.20,7.50,10.65,13.15,17.55, 2.15,2.35,2.75,3.40,4.20,5.45,7.80,10.90,13.40,17.80, 2.40,2.60,3.05,3.65,4.45,5.70,8.05,11.20,13.70,18.05, 2.95,3.15,3.55,4.20,5.00,6.25,8.60,11.70,14.25,18.60, 3.45,3.60,4.05,4.70,5.50,6.75,9.05,12.20,14.70,19.10, 3.95,4.15,4.60,5.20,6.05,7.30,9.60,12.75,15.25,19.65, 4.30,4.50,4.95,5.60,6.40,7.65,9.95,13.10,15.60,20.00, 4.70,4.90,5.30,5.95,6.75,8.00,10.35,13.45,15.95,20.35, 5.05,5.25,5.70,6.30,7.10,8.40,10.70,13.85,16.35,20.70, 5.40,5.60,6.05,6.65,7.50,8.75,11.05,14.20,16.70,21.10 ]
const arrStima1500 = [1.10,1.30,1.75,2.35,3.15,4.40,6.70,9.80,12.30,16.65, 1.35,1.55,1.95,2.60,3.40,4.65,6.95,10.05,12.55,16.90 ,1.60,1.80,2.25,2.85,3.65,4.90,7.20,10.30,12.80,17.15, 1.85,2.05,2.50,3.10,3.90,5.15,7.45,10.55,13.05,17.40, 2.10,2.30,2.75,3.35,4.15,5.40,7.70,10.80,13.30,17.65, 2.40,2.55,3.00,3.60,4.45,5.65,7.95,11.10,13.55,17.90, 2.90,3.10,3.55,4.15,4.95,6.20,8.50,11.60,14.10,18.45, 3.40,3.60,4.00,4.65,5.45,6.70,9.00,12.10,14.60,18.95, 3.90,4.10,4.55,5.15,5.95,7.20,9.50,12.60,15.10,19.45, 4.30,4.45,4.90,5.55,6.35,7.60,9.90,13.00,15.45,19.80, 4.65,4.85,5.25,5.90,6.70,7.95,10.25,13.35,15.85,20.20, 5.00,5.20,5.65,6.25,7.05,8.30,10.60,13.70,16.20,20.55, 5.35,5.55,6.00,6.60,7.40,8.65,10.95,14.05,16.55,20.90]
const arrStima2000 = [1.10,1.30,1.70,2.30,3.10,4.35,6.60,9.70,12.15,16.40, 1.35,1.50,1.95,2.55,3.35,4.60,6.85,9.90,12.35,16.65, 1.60,1.75,2.20,2.80,3.60,4.85,7.10,10.15,12.60,16.90, 1.85,2.00,2.45,3.05,3.85,5.10,7.35,10.40,12.85,17.15, 2.10,2.30,2.70,3.30,4.10,5.35,7.60,10.65,13.15,17.40, 2.35,2.55,2.95,3.60,4.35,5.60,7.85,10.95,13.40,17.65, 2.90,3.05,3.50,4.10,4.90,6.15,8.40,11.45,13.90,18.20, 3.35,3.55,3.95,4.60,5.35,6.60,8.85,11.95,14.40,18.65, 3.85,4.05,4.50,5.10,5.90,7.10,9.40,12.45,14.90,19.20, 4.25,4.40,4.85,5.45,6.25,7.50,9.75,12.80,15.25,19.55, 4.60,4.75,5.20,5.80,6.60,7.85,10.10,13.15,15.60,19.90, 4.95,5.15,5.55,6.15,6.95,8.20,10.45,13.50,16.00,20.25, 5.30,5.50,5.90,6.55,7.30,8.55,10.80,13.90,16.35,20.60]

let cols;
let rows;
let matrice;


$("input").change(function () {

let varInt =$("input[name=nint]").val();
if (varInt=="") { varInt=1;}


let varLoi =$("input[name=loi]").val();
if (varLoi=="") { varLoi=3;}

let varIr =$("input[name=ir]").val();
if (varIr=="") { varIr=99;}


if (varLoi<3) {rows=0;}
	if (varLoi>=4 && varLoi<=6) {rows=1;}
	if (varLoi>=7 && varLoi<=10) {rows=2;}
	if (varLoi>=11 && varLoi<=15) {rows=3;}
	if (varLoi>=16 && varLoi<=20) {rows=4;}
	if (varLoi>=21 && varLoi<=25) {rows=5;}
	if (varLoi>=26 && varLoi<=30) {rows=6;}
	if (varLoi>=31 && varLoi<=35) {rows=7;}
	if (varLoi>=36 && varLoi<=40) {rows=8;}
	if (varLoi>=41 && varLoi<=45) {rows=9;}
	if (varLoi>=51 && varLoi<=55) {rows=10;}
	if (varLoi>55) {rows=11;}

	if (varIr>=75) {cols=0;}
	if (varIr>=50  && varIr<=74) {cols=1;}
	if (varIr>=30 && varIr<=49) {cols=2;}
	if (varIr>=20 && varIr<=29) {cols=3;}
	if (varIr>=15 && varIr<=19) {cols=4;}
	if (varIr>=10 && varIr<=14) {cols=5;}
	if (varIr>=7 && varIr<=9) {cols=6;}
	if (varIr>=5 && varIr<=6) {cols=7;}
	if (varIr>=3 && varIr<=4) {cols=8;}
	if (varIr<3) {cols=9;}

	matrice=(rows*10) +cols;
	let cpi;
	
	if (varInt<100){cpi=arrStima99[matrice]; }
	if (varInt>=100 && varInt<=199){cpi=arrStima100[matrice]; }
	if (varInt>=200 && varInt<=299){cpi=arrStima200[matrice]; }
	if (varInt>=300 && varInt<=399){cpi=arrStima300[matrice]; }
	if (varInt>=400 && varInt<=499){cpi=arrStima400[matrice]; }
	if (varInt>=500 && varInt<=599){cpi=arrStima500[matrice]; }
	if (varInt>=600 && varInt<=699){cpi=arrStima600[matrice]; }
	if (varInt>=700 && varInt<=799){cpi=arrStima700[matrice]; }
	if (varInt>=800 && varInt<=899){cpi=arrStima800[matrice]; }
	if (varInt>=900 && varInt<=999){cpi=arrStima900[matrice]; }
	if (varInt>=1000 && varInt<=1199){cpi=arrStima1000[matrice]; }
	if (varInt>=1200 && varInt<=1499){cpi=arrStima1200[matrice]; }
	if (varInt>=1500 && varInt<=1999){cpi=arrStima1500[matrice]; }
	if (varInt>=20){cpi=arrStima2000[matrice]; }
	

	//console.log("Intervista "+varInt)
	//console.log("Costo Totale"+costoTot)
	let costoTot=cpi*varInt;

	$(".cpi").html(cpi);
	$(".tot").html(costoTot.toFixed(0));

	//console.log("riga:"+rows+"\n colonna:"+cols+"\n matrice:"+matrice);





});


</script>


<script>

//al click dei disponibili
  $("select.Canno").on('change', function() {


let can= $("select.Canno").val();
let tabtot;
let tabField;

$('.mess2').fadeIn();

  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "function_costiPanel.php",

      //Quali dati devo inviare?
      data: "Canno="+can, 
      dataType: "html",
	  success: function(data) 
	  					{ 
							$('.mess2').fadeOut(); 
							tabField=$(data).filter("#tabField");
							$("#tabField").html(tabField);
							tabtot=$(data).filter("#tabTotal");
							$("#tabTotal").html(tabtot);

						}

    });
  });

</script>



<?php

require_once('inc_footer.php'); 

?>
