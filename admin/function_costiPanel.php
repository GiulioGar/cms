
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
	
        ";

        

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
        $tot_ricerche = mysqli_query($admin,$query_ricerche_aggiornate);
        
        
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
	 