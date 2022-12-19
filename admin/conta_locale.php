
<div class="jumbotron jumbotron-fluid">

<div class="row ">

			<?php if ($contaPan>1) 		
			{ ?>
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> TOTALE </h6> <span style="color:gray"><i class="far fa-flag fa-2x text-gray-300"></i></span>
                        </div>
                        <div class="card-body">

						<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" 
  aria-valuenow="<?php echo $progressTot ?>" aria-valuemin="0" aria-valuemax="100" style="width:0%">
  <?php echo $progressTot ?>%
  </div>
</div>

								<table class="table table-striped table-bordered" >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati; ?></b> </td> </tr>
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete; ?></b> </td> </tr>
								<tr> <td> Bloccate: </td> <td> <b><?php echo  $conta_bloccate; ?></b> </td> </tr>
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
						<h6 class="m-0 font-weight-bold text-primary">PANEL MILLEBYTES </h6><span style="color:gray"><i class="fas fa-users fa-2x text-gray-300"></i></span>
                        </div>
                        <div class="card-body">
					<?php if ($panel_in==1 || $panel_in==2) 		
						{ ?>

<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" 
  aria-valuenow="<?php echo $progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:0%">
  <?php echo $progress ?>%
  </div>
</div>
								<table class="table table-striped table-bordered"  >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_panel; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_panel; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_panel; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_panel; ?></b> </td> </tr>
								<tr> <td> Bloccate: </td> <td> <b><?php echo  $conta_bloccate_panel; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti_panel; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_panel."%"; ?></b> </td> </tr>
								</table>
							<?php 
							$contaIns++;  }
			else  { echo "<div class='alert alert-danger' role='alert'> Non utilizzato</div>"; } ?>
								
                            
                        </div>
                        <div class="card-footer">

					<?php if ($panel_in==1 || $panel_in==2) 		
						{ ?>
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

<div class="form-check form-check-inline">

		<div class="form-check form-check-inline ">
			<form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<label class="form-check-label text-center" style="font-size:12px;" for="inlineCheckbox1">Follow Up</label>
				<input style="height:45px; width:auto;" class="form-control" type="image" value="submit" src="img/csv.png" />
				</form>
			</div>

</div>	

		<?php } ?>
		
                        </div>
                    </div>
                </div>

				

				
				<div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> 
							 PANEL ESTERNO <br/>
							<b> <span style="font-size:14px; color:gray">(<?php echo $usePanelext;  ?>)</span></b>

						</h6>
					
						<span style="color:gray"><i class="fas fa-external-link-alt fa-2x text-gray-300"></i></span>
                        </div>
                        <div class="card-body">
						
					<?php if ($panel_esterno>0) 		
						{ ?>

						<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?php echo $progressExt ?>" aria-valuemin="0" aria-valuemax="100" style="width:0%">
						<?php echo $progressExt ?>%
						</div>
						</div>
					
								<table class="table table-striped table-bordered">
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_ssi; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_ssi; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_ssi; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_ssi; ?></b> </td> </tr>
								<tr> <td> Bloccate: </td> <td> <b><?php echo  $conta_bloccate_ssi; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo   $panel_esterno; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_ssi['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_ssi."%"; ?></b> </td> </tr>
								</table>
						
								
					<?php 
							$contaIns++;  }
			else  { echo "<div class='alert alert-danger' role='alert'> Non utilizzato</div>"; } ?>
                            
                        </div>
                        <div class="card-footer">

						<?php if ($panel_esterno>0) 		
						{ ?>						

						<div class="form-check form-check-inline">

						<div class="form-check form-check-inline ">
							
							<form action="csv.php" method="post" target="_blank">
								<input type="hidden" name="csv" value="<?php echo $csv_sta ?>" />
								<input type="hidden" name="filename" value="status_list<?php echo $sid ?>" />
								<input type="hidden" name="filetype" value="status" />
								<label style="font-size:12px;" class="form-check-label text-center" for="inlineCheckbox1">Status Uid</label>
								<input style="height:45px; width:auto;" class="form-control" type="image" value="submit" src="img/csv.png" />
								</form>
							</div>


						</div>	
						<?php 
						}			
						?>

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
						
						
						<div class="col-xl-4 col-lg-5">
                   		 <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-success">  STIMA FILED </h6> <span style="color:gray"> <i class="fas fa-calculator fa-2x text-gray-300"></i></span>
                        </div>
                        <div class="card-body">
						<?php 
						if ($alsuccess==1 && $contatti>50) {
						?>		
						<h6 class="align-items-center justify-content-between text-center"><button id="alert1" class="btn btn-alert btn-success alcasi" type="button">Utenti sufficienti per chiudere il field.</button></h6>
						<?php 
						}
						if ($alsuccess==0 && $contatti>50) {
						?>	
						<h6 class="align-items-center justify-content-between text-center"><button id="alert4" class="btn btn-alert btn-danger alcasi" type="button">Utenti insufficienti per chiudere il field.</button></h6>
						<?php 
						}
						?>	

						<div class="tabGen" >
						<table class="table table-striped table-bordered">
						<tr> <td>Utenti disponibili </td> <td> <b><?php echo  $contatti_disponibili; ?></b> </td> </tr>
						<tr> <td> Casi possibili </td> <td> <b><?php echo  $previsione ?></b> </td> </tr>
						<tr> <td> Da Fare: </td> <td> <b><?php echo  $daFare ?></b> </td> </tr>
						<tr> <td>Utenti da inviare: </td> <td> <b><?php echo  $inviaUtenti ?></b> </td> </tr>
						<tr> <td>% Media Panel </td> <td> <b><?php echo  $media_redemption_panel."%"; ?></b> </td> </tr>
						<tr> <td>% Panel Field </td> <td> <b><?php echo  $redemption_panel."%"; ?> </b></td> </tr>
						<tr> <td>% Total: </td> <td> <b><?php echo  $totalRed."%"; ?> </b></td> </tr>
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
				
				
<div class="col-xl-4 col-lg-5">
                   		 <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success"> CONTROLLO INTERVISTE </h6> <span style="color:gray"> <i class="fas fa-cut fa-2x text-gray-300"></i></span>
                        </div>
 <div style="min-height:415px;" class="card-body">


						<ul class="nav nav-tabs" id="mytab" role="tablist">

						<!-- totali -->
						<li class="nav-item">
							<a class="nav-link active" id="inviti-tab" data-toggle="tab" href="#inviti" role="tab" aria-controls="inviti" aria-selected="true">Filtrate</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="registra-tab" data-toggle="tab" href="#registra" role="tab" aria-controls="registra" aria-selected="false">Sospese</a>
						</li>
					

						</ul>
					<!-- Tab panes -->

					<div class="tab-content">

					<!-- FILTRATE TOTALI  -->
					<div class="tab-pane active" id="inviti" role="tabpanel" aria-labelledby="inviti-tab"> 


					
					<div class="tab-content">
					<div class="tab-pane active" id="filtot" role="tabpanel" aria-labelledby="filtot-tab"> 
					<div>&nbsp;</div>

					<?php
					
					if($conta_filtrati>0)
					{
					?>
					<canvas id="bar-chart-filtrati" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste filtrate </div>";}
					?>
					</div>

					<div class="tab-pane" id="filint" role="tabpanel" aria-labelledby="filint-tab"> 
					<div>&nbsp;</div>
					<?php
					
					if($conta_filtrati_panel>0)
					{
					?>
					<canvas id="bar-chart-filtrati2" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste filtrate interne </div>";}
					?>

					</div>

					<div class="tab-pane" id="filest" role="tabpanel" aria-labelledby="filest-tab"> 
					<div>&nbsp;</div>
					<?php
					
					if($conta_filtrati_ssi>0)
					{
					?>
					<canvas id="bar-chart-filtrati3" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste filtrate esterne</div>";}
					?>

					</div>
		

					<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="filtot-tab" data-toggle="tab" href="#filtot" role="tab" aria-controls="filtot" aria-selected="true"><i class="fas fa-users"></i> TOT</a>
					</li>

					<?php if ($contaPan>1) 		
					{ ?>

					<li class="nav-item">
						<a class="nav-link" id="filint-tab" data-toggle="tab" href="#filint" role="tab" aria-controls="filint" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i> INT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="filest-tab" data-toggle="tab" href="#filest" role="tab" aria-controls="filest" aria-selected="false"><i class="fas fa-external-link-alt"></i> EST</a>
					</li>

					<?php } ?>

					</ul>


					</div>




					</div>

					<!-- SOSPESE TOTALI  -->
					<div class="tab-pane" id="registra" role="tabpanel" aria-labelledby="registra-tab">

					<div class="tab-content">
					<div class="tab-pane active" id="sostot" role="tabpanel" aria-labelledby="sostot-tab"> 
					<div>&nbsp;</div>

					<?php
					if($conta_incomplete>0)
					{
					?>
					<canvas id="bar-chart-sospese" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste sospese </div>";}

					?>
					</div>

					<div class="tab-pane" id="sosint" role="tabpanel" aria-labelledby="sosint-tab"> 
					<div>&nbsp;</div>

					<?php
					if($conta_incomplete_panel>0)
					{
					?>
					<canvas id="bar-chart-sospese2" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste sospese </div>";}

					?>
					</div>

					<div class="tab-pane" id="sosest" role="tabpanel" aria-labelledby="sosest-tab"> 
					<div>&nbsp;</div>

					<?php
					if($conta_incomplete_ssi>0)
					{
					?>
					<canvas id="bar-chart-sospese3" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste sospese </div>";}

					?>
					</div>

					<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="sostot-tab" data-toggle="tab" href="#sostot" role="tab" aria-controls="sostot" aria-selected="true"><i class="fas fa-users"></i> TOT</a>
					</li>

					<?php if ($contaPan>1) 		
					{ ?>

					<li class="nav-item">
						<a class="nav-link" id="sosint-tab" data-toggle="tab" href="#sosint" role="tab" aria-controls="sosint" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i> INT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="sosest-tab" data-toggle="tab" href="#sosest" role="tab" aria-controls="sosest" aria-selected="false"><i class="fas fa-external-link-alt"></i> EST</a>
					</li>

					<?php } ?>

					</ul>

					
					</div>
					</div>
				

	</div>

	
                      
</div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
</div>
			
<div class="col-xl-4 col-lg-5">
                   		 <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-danger"> CONTROLLO QUOTE IMPOSTATE </h6> <span style="color:gray"><i class="fas fa-user-check fa-2x text-gray-300"></i></span>
                        </div>
                        <div class="card-body">
                           <?php
			$query_quo = "SELECT * FROM millebytesdb.t_quota_status where survey_id='$sid' and project_name='$prj' order by target_name ASC";
			$tot_quo = mysqli_query($admin,$query_quo) ;
			$num_righe = mysqli_num_rows($tot_quo);
			
		if ($num_righe>0)
		{	
		?>
	
		
				<table class="table table-striped table-bordered">
				<thead>
				<tr>
				<th colspan='4'><span style="color:red"><b>QUOTE</b></span></th>
				</tr>
				</thead>

				<tbody>
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
				</tbody>
				</table>
					<?php } 
					else  {echo "<div class='alert alert-danger' role='alert'> Nessuna quota impostata! </div>";}
					?>	
					
					
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>		
		
 

 

</div> 


<?php





if ($data==''){$data=date("Y-m-d H:i:s");}



if ($stato_ricerca != 1)
{

$query_aggiorna_statistiche = "UPDATE t_panel_control set abilitati='".$totale_user_abilitati."', contatti='".$contatti_panel."', filtrati='".$conta_filtrati."', quota_full='".$conta_quotafull."',incomplete='".$conta_incomplete."',panel_interno='".$contatti_panel."',contatti_totali='".$contatti."',panel_esterno='".$panel_esterno."', red_panel='".$redemption_panel."', last_update='".$data."', complete='".$conta_complete."', red_surv='".$redemption_field."' where sur_id='".$sid."' AND id <> '' ";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) ;
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);


}


// if (($stato_ricerca == 1)&&(($panel_in==1)||($panel_in==2))) 
// {

// $costo=$conta_complete_panel*0.31;


// $query_aggiorna_statistiche_costo = "UPDATE t_panel_control set costo='".$costo."' where sur_id='".$sid."'";
// $aggiorna_statistiche_costo = mysqli_query($admin,$query_aggiorna_statistiche_costo) ;
// $aggiorna_statistiche_t_costo = mysqli_fetch_assoc($aggiorna_statistiche_costo);

// }
?>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php

//creo php array da passare alla chart filtrate totali

$labelArr=array();
$valArr=array();

$contaImm=0;
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

							$code=$sdlb[$contaRiga+4];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }	
												  
							$code=$sdlb[$contaRiga+5];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }	
							$code=$sdlb[$contaRiga+6];
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
					array_push($labelArr,$codiceStampa );
					array_push($valArr,$valore);
					}	
					
				}

//creo php array da passare alla chart filtrate interne

$labelArr2=array();
$valArr2=array();


$contaImm=0;
		arsort($filtri2);
		foreach ( $filtri2 as $chiave2 => $valore2) 
				{
				$contaImm++;
				if ($contaImm<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
				$ricerca=', '.trim($chiave2).');'; 
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

							$code=$sdlb[$contaRiga+4];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }	
												  
							$code=$sdlb[$contaRiga+5];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }

							$code=$sdlb[$contaRiga+6];
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

					$perfDam=$valore2/$contaFiltri2*100;
					array_push($labelArr2,$codiceStampa );
					array_push($valArr2,$valore2);
					}	
					
				}

//creo php array da passare alla chart filtrate esterne

$labelArr3=array();
$valArr3=array();


$contaImm=0;
		arsort($filtri3);
		foreach ( $filtri3 as $chiave3 => $valore3) 
				{
				$contaImm++;
				if ($contaImm<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
				$ricerca=', '.trim($chiave3).');'; 
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

							$code=$sdlb[$contaRiga+4];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }	
												  
							$code=$sdlb[$contaRiga+5];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }
							$code=$sdlb[$contaRiga+6];
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

					$perfDam=$valore3/$contaFiltri3*100;
					array_push($labelArr3,$codiceStampa );
					array_push($valArr3,$valore3);
					}	
					
				}				


//creo php array da passare alla chart sospese

$labelsArr=array();
$valsArr=array();

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
							
							$code=$sdlb[$contaRiga+4];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }

							$code=$sdlb[$contaRiga+5];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }	
												  
							$code=$sdlb[$contaRiga+6];
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
					array_push($labelsArr,$codiceStampa);
					array_push($valsArr,$valore);
					}	
					
				}
		$contaIns++;	


//creo php array da passare alla chart sospese

$labelsArr2=array();
$valsArr2=array();

$contaImm2=0;
		
		arsort($sospese2);
		foreach ( $sospese2 as $chiave => $valore) 
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
					$perDam=$valore/$contaSospeso2*100;
					array_push($labelsArr2,$codiceStampa);
					array_push($valsArr2,$valore);
					}	
					
				}
		$contaIns++;
		
		
//creo php array da passare alla chart sospese

$labelsArr3=array();
$valsArr3=array();

$contaImm2=0;
		
		arsort($sospese3);
		foreach ( $sospese3 as $chiave => $valore) 
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
					$perDam=$valore/$contaSospeso3*100;
					array_push($labelsArr3,$codiceStampa);
					array_push($valsArr3,$valore);
					}	
					
				}
		$contaIns++;			


?>



<script>

 //chart filtrate totali

ctx = document.getElementById("bar-chart-filtrati");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-filtrati"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr as $lab){ echo "'".$lab."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr as $val){ echo "'".$val."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Totali Filtrate'
      }
    }
});

 //chart filtrate intenre

 ctx = document.getElementById("bar-chart-filtrati2");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-filtrati2"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr2 as $lab){ echo "'".$lab."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr2 as $val){ echo "'".$val."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Interactive Filtrate'
      }
    }
});


 //chart filtrate esterne

 ctx = document.getElementById("bar-chart-filtrati3");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-filtrati3"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr3 as $lab){ echo "'".$lab."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr3 as $val){ echo "'".$val."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Esterne Filtrate'
      }
    }
});


 //chart sospese

ctx = document.getElementById("bar-chart-sospese");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-sospese"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr as $labs){ echo "'".$labs."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr as $vals){ echo "'".$vals."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Totali'
      }
    }
});


 //chart sospese interne

 ctx = document.getElementById("bar-chart-sospese2");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-sospese2"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr2 as $labs){ echo "'".$labs."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr2 as $vals){ echo "'".$vals."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Interactive'
      }
    }
});


 //chart sospese

 ctx = document.getElementById("bar-chart-sospese3");
ctx.height = 300;

new Chart(document.getElementById("bar-chart-sospese3"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr3 as $labs){ echo "'".$labs."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr3 as $vals){ echo "'".$vals."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Esterne'
      }
    }
});

</script>







	<script type='text/javascript'>
	$(document).ready(function()
	{
	$('.tooltip_default').tooltip({track:true});
	});
	</script>

</div>
