<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi3=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-3,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$conta_giorno=0;
$panel_esterno=0;
$loi=0;
$sumDiff=0;
$contaCompl=0;
$redemption_panel=0;

$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");
//echo "la ricerca è:".$sid." ".$prj;

require_once('function_conta_locale.php');   
?>

<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card border-success shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center " style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-success text-uppercase mb-1">Ricerca</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $sid; ?> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $lu['description']; ?> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #94d872;">
		  <i class="fas fa-poll-h"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card border-primary shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center" style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-primary text-uppercase mb-1">Target</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Interviste: </b><?php echo $lu['goal']; ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Sesso: </b><?php echo $sex; ?> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Età: </b><?php echo $lu['age1_target']."-".$lu['age2_target']." anni" ?> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #007BFF;">
		  <i class="fas fa-bullseye"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card border-warning  shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center" style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-warning  text-uppercase mb-1">Tempistiche</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Inizio Field:</b> <?php echo $newDateStart;  ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Fine Field:</b> <?php echo $newDate;  ?> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #F7BB07;">
		  <i class="fas fa-business-time"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card border-danger shadow h-100 py-2 rounded-top" style="min-height: 100px;">                        
<div class="card body">
<div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-danger text-uppercase mb-1">Info</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Stato Field:</b> <?php echo $stato; ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Durata intervista:</b> <span style="color:red"><?php echo substr($loi,0,4); ?> minuti</span> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #D53343;">
		  <i class="fas fa-info-circle"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>




</div>


<div class="row">

			<?php if ($contaPan>1) 		
			{ ?>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            TOTALE
                        </div>
                        <div class="card-body">

								<table class="table table-striped table-bordered" >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati; ?></b> </td> </tr>
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_totali['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field."%"; ?></b> </td> </tr> 
								</table> 
	
		
                            
                        </div>
                        <div class="card-footer">
					
                            
                        </div>
                    </div>
                </div>
		<?php 
			$contaIns++;  }
			
		?>
			

				
				 <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            PANEL MILLEBYTES
                        </div>
                        <div class="card-body">
					<?php if ($panel_in==1 || $panel_in==2) 		
						{ ?>

					
								<table class="table table-striped table-bordered"  >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_panel; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_panel; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_panel; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_panel; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti_panel; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_panel."%"; ?></b> </td> </tr>
								</table>
							<?php 
							$contaIns++;  }
			else  { echo "<h3>Non utilizzato</h3>"; } ?>
								
                            
                        </div>
                        <div class="card-footer">

 <form name="modulo" action="crea_target.php" target="_blank" method="GET">
 <input type="hidden" name="sid" value="<?php echo $sid;?>" />
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button class="btn btn-outline-secondary" value="TAG" type="submit">TAG</button>
  </div>
  <select class="custom-select" name="Tag" id="inputGroupSelect03">
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


</form>

<div class="campioni">
		<div style='color:red'><b>DOWNLOAD SOLLECITO</b></div>		
			<table>
			<tr>
			<td>
			<form style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input class="form-control" type="image" value="submit" src="img/CSV.gif" />
				Random
				</form>
		</td>
		<td width="30">&nbsp;</td>
		<td>
				<form  style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv_attivi ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input class="form-control" type="image" value="submit" src="img/CSV.gif" />
				Attivi
				</form>		
		</td>
		</tr>	
		</table>
		</div>
                        </div>
                    </div>
                </div>

				

				
					<div class="col-md-4 col-sm-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                           PANEL ESTERNO
                        </div>
                        <div class="panel-body">
						
					<?php if ($panel_esterno>0) 		
						{ ?>
					
								<table class="table table-striped table-bordered">
								<tr class="intesta"><th colspan='2'>Panel esterno</th></tr> 
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_ssi; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_ssi; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_ssi; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_ssi; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo   $panel_esterno; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_ssi['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_ssi."%"; ?></b> </td> </tr>
								</table>
						
								
					<?php 
							$contaIns++;  }
			else  { echo "<h3>Non utilizzato</h3>"; } ?>
                            
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>
			


</div>


 <div class="row">
 
 			<?php if ($panel_in==1 || $panel_in==2)
			{
						$daFare=$lu['goal']-$conta_complete;	
						$totalRed=$conta_complete/$tot_use_abilitati_totali['total']*100;
						$totalRed=number_format($totalRed, 2);
						$inviaUtenti=$daFare*$tot_use_abilitati_totali['total']/$conta_complete;
						$inviaUtenti=number_format($inviaUtenti, 0);
						?>
						
						
             <div class="col-md-4 col-sm-4">
				
				    <div class="panel panel-info">
                        <div class="panel-heading">
                            Calcolo stima
                        </div>
                        <div class="panel-body">

						<div class="tabGen"  <?php if ($contaIns<3) { echo "style='float:left;'"; }?> >
						<table class="table table-striped table-bordered">
						<tr> <td>Utenti disponibili </td> <td> <b><?php echo  $contatti_disponibili; ?></b> </td> </tr>
						<tr> <td>% Media Panel </td> <td> <b><?php echo  $media_redemption_panel."%"; ?></b> </td> </tr>
						<tr> <td>% Panel Field </td> <td> <b><?php echo  $redemption_panel."%"; ?> </b></td> </tr>
						<tr> <td>% Total: </td> <td> <b><?php echo  $totalRed."%"; ?> </b></td> </tr>
						<tr> <td> Casi possibili </td> <td> <b><?php echo  $previsione ?></b> </td> </tr>
						<tr> <td> Da Fare: </td> <td> <b><?php echo  $daFare ?></b> </td> </tr>
						<tr> <td>Utenti da inviare: </td> <td> <b><?php echo  $inviaUtenti ?></b> </td> </tr>
						</table>
						<div id="chart_div"></div>
						</div>
					
					  
					  
					  
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>
		<?php
				$contaIns++; 
			}
			?>
				
				
		<div class="col-md-4 col-sm-4">
			<div class="panel panel-danger">
                        <div class="panel-heading">
                           Traccia filtrate
                        </div>
						
                <div class="panel-body">
                      
		<table class="table table-striped table-bordered">
		<tr><td>Domanda</td><td>Cod.</td><td>Num.</td><td>%</td></tr>
		<?php
		$contaImm==0;
		arsort($filtri);
		foreach ( $filtri as $chiave => $valore) 
				{
				$contaImm++;
				if ($contaImm<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
				$ricerca=', '.trim($chiave).');'; 
				$ricerca2='new question'; 
				$txtdom="";
				$txtread="";
				$txtcompleto="";
				$code="";
				$codiceStampa="n/d";
				foreach ($sdlb as $r) 
					{
						$contaRiga++;
						$domain = strstr($r, $ricerca);
						$domain2 = strstr($r, $ricerca2);
						if ($domain !=false && $domain2 !=false) 
							{  
							$code=$sdlb[$contaRiga+1];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
												  
							
							
							$code=$sdlb[$contaRiga+2];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
							
							$code=$sdlb[$contaRiga+3];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }
							
							$txtdom=$sdlb[$contaRiga]; 
							$txtread = explode('"',$txtdom);
							$contaT=0;
							foreach ($txtread as $t) 
								{
								$contaT++;
								if ($contaT>2)
									{
										$txtread[$contaT]=str_replace('+"', ' ', $txtread[$contaT]);
										$txtread[$contaT]=str_replace('"+', ' ', $txtread[$contaT]);
										$txtcompleto=$txtcompleto.$txtread[$contaT];
										
									}
								}
							
							}
						if($txtcompleto=="") { $txtstamp="Testo non disponibile";}
						else { $txtstamp=$txtcompleto;}
						$txtstamp=strip_tags($txtstamp);
						$txtstamp=str_replace(");","",$txtstamp);
					}
				
				if ($contaImm<10)
					{
					$perfDam=$valore/$contaFiltri*100;
					echo "<tr style='background:".$coltr."'>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/> q".$chiave."</a></td>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/>".$codiceStampa."</a></td>
					<td><b>".$valore."</b></td>
					<td><b>".round($perfDam)."%</b></td></tr>";
					}	
					
				}
		$contaIns++;		
		?>
		</table>
			</div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
            </div>
			
			
<div class="col-md-4 col-sm-4">
			<div class="panel panel-warning">
                        <div class="panel-heading">
                           Traccia sospese
                        </div>
                        <div class="panel-body">
                      
			<table class="table table-striped table-bordered">
		<tr><td>Domanda</td><td>Cod.</td><td>Num.</td><td>%</td></tr>
		<?php
		$contaImm2==0;
		
		arsort($sospese);
		foreach ( $sospese as $chiave => $valore) 
				{
				$contaImm2++;
				if ($contaImm2<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
						
				$ricerca=', '.trim($chiave).');'; 
				$ricerca2='new question'; 
				$txtdom="";
				$txtread="";
				$txtcompleto="";
				$code="";
				$codiceStampa="n/d";
				
				foreach ($sdlb as $r) 
					{
						$contaRiga++;
						$domain = strstr($r, $ricerca);
						$domain2 = strstr($r, $ricerca2);
						if ($domain !=false && $domain2 !=false) 
							{  
							$code=$sdlb[$contaRiga+1];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
												  
							
							
							$code=$sdlb[$contaRiga+2];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
							
							$code=$sdlb[$contaRiga+3];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }
							
							
							$txtdom=$sdlb[$contaRiga]; 
							$txtread = explode('"',$txtdom);
							$contaT=0;
							foreach ($txtread as $t) 
								{
								$contaT++;
								if ($contaT>2)
									{
										$txtread[$contaT]=str_replace('+"', ' ', $txtread[$contaT]);
										$txtread[$contaT]=str_replace('"+', ' ', $txtread[$contaT]);
										$txtcompleto=$txtcompleto.$txtread[$contaT];
									}
								}
							
							}
						if($txtcompleto=="") { $txtstamp="Testo non disponibile";}
						else { $txtstamp=$txtcompleto;}
						$txtstamp=strip_tags($txtstamp);
						$txtstamp=str_replace(");","",$txtstamp);
						
						
						
					}
				if ($contaImm2<10)
					{
					$perDam=$valore/$contaSospeso*100;
					echo "<tr style='background:".$coltr."'>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/> q".$chiave."</a></td>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/>".$codiceStampa."</a></td>
					<td><b>".$valore."</b></td>
					<td><b>".round($perDam)."%</b></td></tr>";
					}	
					
				}
		$contaIns++;	
		?>
		</table>
					  
					  
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
             </div>
            </div>			
 
 

</div> 


<div class="row">

            <div class="col-md-4 col-sm-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                           Controllo quote
                        </div>
                        <div class="panel-body">
                           <?php
			$query_quo = "SELECT * FROM millebytesdb.t_quota_status where survey_id='$sid' and project_name='$prj' order by target_name ASC";
			$tot_quo = mysqli_query($admin,$query_quo) or die(mysql_error());
			$num_righe = mysqli_num_rows($tot_quo);
			
		if ($num_righe>0)
		{	
		?>
	
		
					<table class="table table-striped table-bordered">
				<tr class="intesta"><th colspan='4'><span style="color:red"><b>QUOTE</b></span></th></tr>
				<?php

				
				echo "<tr><td><b>Target</b></td><td><b>Totale</b></td><td><b>Svolte</b></td><td><b>Da fare</b></td></tr>";
				$sfondo="";
				
				
				while ($row = mysqli_fetch_assoc($tot_quo))
					{
					$diffQuo=$row['current_value']-$row['target_value'];
					if ($diffQuo>=0) { $sfondo="style='background-color:red; font-weight:bold;'";}
					else  { $sfondo="";}
					
					
					
					  echo "<tr><td><b>".$row['target_name']."</b></td><td>".$row['target_value']."</td><td>".$row['current_value']."</td><td ".$sfondo.">".$diffQuo."</td></tr>";
					}

				?>
				</table>
					<?php } 
					else  {echo "<h3>Nessuna quota impostata</h3>";}
					?>	
					
					
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>



                <div class="col-md-8 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DIARIO RICERCA
                        </div>
                        <div class="panel-body">
						
						<?php if ($contaPan>1) 
							{ ?>
								
							<div id="diarioTot">
							<table class="table table-striped table-bordered" style="font-size:11px;"  >
							<col>
							<col span="2">
							<col span="2">
							<col span="2">
							<col span="2">
							<col>
							<thead>
							<th class="titleDia" colspan="11">GENERALE</th>
							<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
							<th><b>Contatti</b></th><th><b>Incidenza</b></th></tr>
							</thead>
							<?php

							asort($diario);


							foreach ( $diario as $chiave => $valore) 
							{ 
							if ($diario_complete[$chiave]==""){$diario_complete[$chiave]=0;}
							if ($diario_filtrati[$chiave]==""){$diario_filtrati[$chiave]=0;}
							if ($diario_quotafull[$chiave]==""){$diario_quotafull[$chiave]=0;}
							if ($diario_incomplete[$chiave]==""){$diario_incomplete[$chiave]=0;}

							$redemption_field_giornaliero=($diario_complete[$chiave]/($diario_complete[$chiave]+$diario_filtrati[$chiave]))*100;
							$redemption_field_giornaliero=number_format($redemption_field_giornaliero, 2);
							$sumDiaComp=$sumDiaComp+$diario_complete[$chiave];
							$sumDiaFilt=$sumDiaFilt+$diario_filtrati[$chiave];
							$sumDiaQf=$sumDiaQf+$diario_quotafull[$chiave];
							$sumDiaInc=$sumDiaInc+$diario_incomplete[$chiave];
							$sumDiaCont=$diario_complete[$chiave]+$diario_filtrati[$chiave]+$diario_quotafull[$chiave]+$diario_incomplete[$chiave];
							if ($diario_complete[$chiave]==0) { $redemption_field_giornaliero="N.D.";}
							else { $redemption_field_giornaliero=$redemption_field_giornaliero."%"; }

							echo "<tr><td>".$chiave."</td>
							<td>".$diario_complete[$chiave]."</td>
							<td><span>".$sumDiaComp."</span></td>
							<td>".$diario_filtrati[$chiave]."</td>
							<td><span>".$sumDiaFilt."</span></td>
							<td>".$diario_quotafull[$chiave]."</td>
							<td><span>".$sumDiaQf."</span></td>
							<td>".$diario_incomplete[$chiave]."</td>
							<td><span>".$sumDiaInc."</span></td>
							<td><span>".$sumDiaCont."</span></td>
							<td><b>".$redemption_field_giornaliero."</b></td>
							</tr>";
							}
							?>
							</table>
							</div>
							<?php  } ?>
							
							
							
							
						
<?php if ($panel_in==1 || $panel_in==2)
{
									?>

									<div id="diaPan">
									<table class="table table-striped table-bordered" style="font-size:11px;">
									<col>
									<col span="2">
									<col span="2">
									<col span="2">
									<col span="2">
									<col>
									<thead>
									<th class="titleDia" colspan="13">PANEL MILLEBYTES</th>
									<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
									<th><b>Contatti</b></th><th><b>Incidenza</b></th><th><b>Panel %</b></th><th><b>Abilitati</b></th></tr>
									</thead>

									<?php
									asort($diario);

									$abilitati_totali_sample=0;
									$contatti_totali_sample=0;
									foreach ( $diario as $chiave => $valore) 
									{ 


									$giorno_due_cifre=substr($chiave,0,2);
									$query_user_abilitati_dp = "SELECT count(*) as total FROM t_abilitatipanel where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%')AND (data_abilitazione LIKE '".$giorno_due_cifre."%'))";
									$tot_user_abilitati_dp = mysqli_query($admin,$query_user_abilitati_dp) or die(mysql_error());
									$tot_use_abilitati_dp = mysqli_fetch_assoc($tot_user_abilitati_dp);
									$abilitati_totali_sample=$abilitati_totali_sample+$tot_use_abilitati_dp['total'];

									if ($diario_complete_panel[$chiave]==""){$diario_complete_panel[$chiave]=0;}
									if ($diario_filtrati_panel[$chiave]==""){$diario_filtrati_panel[$chiave]=0;}
									if ($diario_quotafull_panel[$chiave]==""){$diario_quotafull_panel[$chiave]=0;}
									if ($diario_incomplete_panel[$chiave]==""){$diario_incomplete_panel[$chiave]=0;}
									$contatti_totali_sample=$contatti_totali_sample+$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
									$red_panel_sample=($contatti_totali_sample/$abilitati_totali_sample)*100;
									$red_panel_sample=number_format($red_panel_sample, 2);

									$redemption_field_giornalieroMb=($diario_complete_panel[$chiave]/($diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]))*100;
									$redemption_field_giornalieroMb=number_format($redemption_field_giornalieroMb, 2);

									$sumPanDiaComp=$sumPanDiaComp+$diario_complete_panel[$chiave];
									$sumPanDiaFilt=$sumPanDiaFilt+$diario_filtrati_panel[$chiave];
									$sumPanDiaQf=$sumPanDiaQf+$diario_quotafull_panel[$chiave];
									$sumPanDiaInc=$sumPanDiaInc+$diario_incomplete_panel[$chiave];
									$sumPanDiaCont=$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
									if ($diario_complete_panel[$chiave]==0) { $redemption_field_giornalieroMb="N.D.";}
									else { $redemption_field_giornalieroMb=$redemption_field_giornalieroMb."%"; }

									if ($sumPanDiaCont>2 || $sumPanDiaComp>0)
									{
									echo "<tr><td>".$chiave."</td>
									<td>".$diario_complete_panel[$chiave]."</td>
									<td><span>".$sumPanDiaComp."</span></td>
									<td>".$diario_filtrati_panel[$chiave]."</td>
									<td><span>".$sumPanDiaFilt."</span></td>
									<td>".$diario_quotafull_panel[$chiave]."</td>
									<td><span>".$sumPanDiaQf."</span></td>
									<td>".$diario_incomplete_panel[$chiave]."</td>
									<td><span>".$sumPanDiaInc."</span></td>
									<td><span>".$sumPanDiaCont."</span></td>
									<td>".$redemption_field_giornalieroMb."</td>
									<td>".$red_panel_sample."%</td>
									<td>".$abilitati_totali_sample."</td>
									</tr>";
									}

									}
									?>
									</table>
									</div>
									<?php
									}
									?>

									<?php 
									if ( $panel_esterno>0)
									{
									?>

									<div id="diarioExt">
									<table class="table table-striped table-bordered" style="font-size:11px;">
									<col>
									<col span="2">
									<col span="2">
									<col span="2">
									<col span="2">
									<col>
									<thead>
									<th class="titleDia" colspan="11">PANEL ESTERNO</th>
									<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
									<th><b>Contatti</b></th><th><b>Incidenza</b></th></tr>
									</thead>
									<?php

									asort($diario);


									foreach ( $diario as $chiave => $valore) 
									{ 
									if ($diario_complete_ssi[$chiave]==""){$diario_complete_ssi[$chiave]=0;}
									if ($diario_filtrati_ssi[$chiave]==""){$diario_filtrati_ssi[$chiave]=0;}
									if ($diario_quotafull_ssi[$chiave]==""){$diario_quotafull_ssi[$chiave]=0;}
									if ($diario_incomplete_ssi[$chiave]==""){$diario_incomplete_ssi[$chiave]=0;}

									$redemption_field_giornalieroEx=($diario_complete_ssi[$chiave]/($diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]))*100;
									$redemption_field_giornalieroEx=number_format($redemption_field_giornalieroEx, 2);

									$sumExtDiaComp=$sumExtDiaComp+$diario_complete_ssi[$chiave];
									$sumExtDiaFilt=$sumExtDiaFilt+$diario_filtrati_ssi[$chiave];
									$sumExtDiaQf=$sumExtDiaQf+$diario_quotafull_ssi[$chiave];
									$sumExtDiaInc=$sumExtDiaInc+$diario_incomplete_ssi[$chiave];
									$sumExtDiaCont=$diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]+$diario_quotafull_ssi[$chiave]+$diario_incomplete_ssi[$chiave];

									if($sumExtDiaCont>0)
									{
									echo "<tr>
									<td>".$chiave."</td>
									<td>".$diario_complete_ssi[$chiave]."</td>
									<td><span>".$sumExtDiaComp."</span></td>
									<td>".$diario_filtrati_ssi[$chiave]."</td>
									<td><span>".$sumExtDiaFilt."</span></td>
									<td>".$diario_quotafull_ssi[$chiave]."</td>
									<td><span>".$sumExtDiaQf."</span></td>
									<td>".$diario_incomplete_ssi[$chiave]."</td>
									<td><span>".$sumExtDiaInc."</span></td>
									<td><span>".$sumExtDiaCont."</span></td>
									<td>".$redemption_field_giornalieroEx."%</td>
									</tr>";
									}
									}
									?>
									</table>
									<?php
									}

									//AGGIORNA COMPLETE DIVISE PER INTERNO ED ESTERNO
										$loiultima=substr($loi,0,4);
										if ($loiultima==""){$loiultima=0;}
										
										//echo "ciaooo".$loiultima;
										$query_compInt = "UPDATE t_panel_control set complete_int='".$conta_complete_panel."',complete_ext='".$conta_complete_ssi."',durata='".$loiultima."' where sur_id='".$sid."'";
										$aggiorna_compInt = mysqli_query($admin,$query_compInt) or die(mysql_error());
										$aggiorna_compInt_esegui = mysqli_fetch_assoc($query_compInt);

										
				ksort($contatori);

							echo "<table class='table table-striped table-bordered' style='font-size:11px;'><tr><td>Minuti</td><td>Casi</td></tr>";
							foreach ( $contatori as $chiave => $valore) 
							{ 
							echo "<tr><td>".$chiave."</td><td>".$contatori[$chiave]."</td></tr>";
							}										
							echo "</table>";		
									?>
						
                            
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>

			
		
</div>
		

		
		



</div>
</div>

<?php


if (is_numeric($redemption_panel)){ $redemption_panel=number_format( $redemption_panel, 2); }
else  { $redemption_panel=0; }





if ($data==''){$data=date("Y-m-d H:i:s");}



if ($stato_ricerca != 1)
{

$query_aggiorna_statistiche = "UPDATE t_panel_control set abilitati='".$totale_user_abilitati."', contatti='".$contatti_panel."', filtrati='".$conta_filtrati."', quota_full='".$conta_quotafull."',incomplete='".$conta_incomplete."',panel_interno='".$contatti_panel."',contatti_totali='".$contatti."',panel_esterno='".$panel_esterno."', red_panel='".$redemption_panel."', last_update='".$data."', complete='".$conta_complete."', red_surv='".$redemption_field."' where sur_id='".$sid."' AND id <> '' ";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) or die(mysqli_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);


}


if (($stato_ricerca == 1)&&(($panel_in==1)||($panel_in==2))) 
{
$costo=$conta_complete_panel*0.31;


$query_aggiorna_statistiche_costo = "UPDATE t_panel_control set costo='".$costo."' where sur_id='".$sid."'";
$aggiorna_statistiche_costo = mysqli_query($admin,$query_aggiorna_statistiche_costo) or die(mysqli_error());
$aggiorna_statistiche_t_costo = mysqli_fetch_assoc($aggiorna_statistiche_costo);
}
?>

	<script type='text/javascript'>
	$(document).ready(function()
	{
	$('.tooltip_default').tooltip({track:true});
	});
	</script>

<?php

require_once('inc_footer.php'); 

mysql_close();
?>
