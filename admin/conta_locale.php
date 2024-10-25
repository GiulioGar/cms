
<?php
// Disabilita la visualizzazione degli errori non fatali
ini_set('display_errors', 0);

// Abilita la visualizzazione degli errori durante l'avvio (utile per il debug)
ini_set('display_startup_errors', 1);

// Imposta il livello di error_reporting per visualizzare solo errori fatali
error_reporting(E_ERROR);

?>

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

				

				<!-- pannello esterno -->

				<div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> 
							 PANEL ESTERNO <br/>
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

						<div class="tab-content">

						<div class="tab-pane active" id="filtot" role="tabpanel" aria-labelledby="filtot-tab"> 	
						<table class="table table-striped table-bordered">
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_T; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_T; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_T; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_T; ?></b> </td> </tr>
								<tr> <td> Bloccate: </td> <td> <b><?php echo  $conta_block_T; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo   $panel_esterno; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_Cint['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_Ext."%"; ?></b> </td> </tr>
						</table>

								<!-- DOWNOLAD STATUS -->
									<div>

									<?php if ($panel_esterno>0) 		
											{ ?>		

												<div class="row">
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

				<?php if($nPanelExt>1)
				{
					foreach ($panels as $value) 
					{
					?>
						<div class="tab-pane" id="filPanel<?php echo $value; ?>" role="tabpanel" aria-labelledby="fil<?php echo $value; ?>-tab"> 	
							<table class="table table-striped table-bordered">
								<tr> <td> Complete: </td> <td> <b><?php echo ${'conta_complete_'.$value}; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  ${'conta_filtrati_'.$value}; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  ${'conta_quotafull_'.$value}; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  ${'conta_incomplete_'.$value}; ?></b> </td> </tr>
								<tr> <td> Bloccate: </td> <td> <b><?php echo  ${'conta_block_'.$value}; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  ${'panel_esterno'.$value}; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_Cint['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  ${'redemption_field_Ext'.$value}."%"; ?></b> </td> </tr>
						</table>

						<!-- DOWNOLAD STATUS -->
							<div>

							<?php if ($panel_esterno>0) 	
									{ 
										switch ($value) 
										{
											case 0: $tPanel="MILLE"; break;	
											case 1: $tPanel="CINT"; break;
											case 2: $tPanel="DYNATA"; break;
											case 3: $tPanel="BILENDI"; break;
											case 4: $tPanel="NORSTAT"; break;	
											case 5: $tPanel="TOLUNA"; break;	
											case 6: $tPanel="NETQUEST"; break;		
											case 7: $tPanel="CATI"; break;		
											case 8: $tPanel="ALTRO"; break;														
										}	
									?>		

										<div class="row">
										<div class="form-check form-check-inline ">
										<form action="csv.php" method="post" target="_blank">
											<input type="hidden" name="csv" value="<?php echo ${'csv_sta'.$value} ?>" />
											<input type="hidden" name="filename" value="list<?php echo $sid."_".$tPanel ?>" />
											<input type="hidden" name="filetype" value="status" />
											<label style="font-size:12px;" class="form-check-label text-center" for="inlineCheckbox1">Status Uid <?php echo $tPanel ?></label>
											<input style="height:45px; width:auto;" class="form-control" type="image" value="submit" src="img/csv.png" />
											</form>
										</div>
									</div>

									<?php 
									}			
									?>
									
							</div>
					</div>

			<?php	
					}	
				}	
				?>



					</div>
								
					<?php 
					$contaIns++;  
					}

					else  { echo "<div class='alert alert-danger' role='alert'> Non utilizzato</div>"; } ?>
                
				
                </div>

				
                        <div class="card-footer">

						<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">

						<li class="nav-item" style="font-size:11px; margin-right:2%">
						<a class="nav-link active" id="filtot-tab" data-toggle="tab" href="#filtot" role="tab" aria-controls="filtot" aria-selected="true"><i class="fas fa-users"></i>TOT</a>
						</li>


						<?php 
						if($nPanelExt>1)
						{
						foreach ($panels as $value) 
						{

						if($value !=0)
						{


							switch ($value) {
								case 0:
									$tPanel="MILLE";
									break;
								case 1:
									$tPanel="CINT";
									break;
								case 2:
									$tPanel="DYNATA";
									break;
								case 3:
									$tPanel="BILENDI";
									break;
								case 4:
									$tPanel="NORSTAT";
									break;	
								case 5:
									$tPanel="TOLUNA";
									break;	
								case 6:
									$tPanel="NETQUEST";
										break;		
								case 7:
									$tPanel="CATI";
										break;	
								case 8:
									$tPanel="ALTRO";
										break;																	
							}
						?>

						<li class="nav-item" style="font-size:11px; margin-right:2%">
						<a class="nav-link" id="fil<?php echo $value; ?>-tab" data-toggle="tab" href="#filPanel<?php echo $value; ?>" role="tab" aria-controls="fil<?php echo $value; ?>-tab" aria-selected="false"><i class="fas fa-users"></i> <?php echo $tPanel; ?></a>
						</li>

						<?php 
						}
						}
						}	
						?>
						</ul>

                 		</div>

                    </div>

                </div>
			<!-- fine pannello esterno  -->

<!-- fine prima riga  -->
</div>


 <div class="row">
 
 			<?php if ($panel_in==1 || $panel_in==2)
			{
				$daFare = $lu['goal'] - $conta_complete;

				$totalRed = 0; // Impostiamo un valore predefinito per evitare l'errore in caso di divisione per zero
				$inviaUtenti = 0; // Lo stesso per inviaUtenti
				
				if ($tot_use_abilitati_totali['total'] > 0) {
					$totalRed = ($conta_complete / $tot_use_abilitati_totali['total']) * 100;
					$totalRed = number_format($totalRed, 2);
				}
				
				if ($conta_complete > 0) {
					$inviaUtenti = $daFare * $tot_use_abilitati_totali['total'] / $conta_complete;
					$inviaUtenti = number_format($inviaUtenti, 0);
				}
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

					<div class="tab-pane active" id="fistatTot" role="tabpanel" aria-labelledby="fistat-tab"> 
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

					<?php
					if($nPanel>1)
					{
						foreach ($panels as $value) 
						{
						?>		
						<div class="tab-pane" id="filpan<?php echo $value; ?>" role="tabpanel" aria-labelledby="fil<?php echo $value; ?>-tab"> 
				
						<?php
						
						if(${'contaFiltri'.$value}>0)
						{
						?>
						<canvas id="bar-chart-filtrati<?php echo $value?>" ></canvas>
						<?php
						}

						else { 
							echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste filtrate. </div>";  
							}
						?>

					</div>			

					<?php 
					}
				}	
				
				?>
		
					<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">
					<li class="nav-item" style="font-size:11px; margin-right:2%">
						<a class="nav-link active" id="fistatTot-tab" data-toggle="tab" href="#fistatTot" role="tab" aria-controls="fistatTot" aria-selected="true"><i class="fas fa-users"></i>TOT</a>
					</li>

					<?php 
				if($nPanel>1)
				{
					foreach ($panels as $value) 
					{
						switch ($value) {
							case 0:
								$tPanel="MILLE";
								break;
							case 1:
								$tPanel="CINT";
								break;
							case 2:
								$tPanel="DYNATA";
								break;
							case 3:
								$tPanel="BILENDI";
								break;
							case 4:
								$tPanel="NORSTAT";
								break;	
							case 5:
								$tPanel="TOLUNA";
								break;	
							case 6:
								$tPanel="NETQUEST";
									break;		
							case 7:
								$tPanel="CATI";
									break;	
							case 8:
								$tPanel="ALTRO";
									break;												
						}
					?>

					<li class="nav-item" style="font-size:11px; margin-right:2%">
						<a class="nav-link" id="fil<?php echo $value; ?>-tab" data-toggle="tab" href="#filpan<?php echo $value; ?>" role="tab" aria-controls="filpan<?php echo $value; ?>" aria-selected="true"><i class="fas fa-users"></i> <?php echo $tPanel; ?></a>
					</li>

				<?php 
					}
				}	
				?>
					
					</ul>

					</div>
					
					</div>


					<!-- SOSPESE TOTALI  -->
					<div class="tab-pane" id="registra" role="tabpanel" aria-labelledby="registra-tab">

					<div class="tab-content">
					<div class="tab-pane active" id="sostatTot" role="tabpanel" aria-labelledby="sostat-tab"> 
					<div>&nbsp;</div>

					<?php
					if($conta_incomplete>0)
					{
					?>
					<canvas id="bar-chart-sospese" ></canvas>
					<?php
					}

					else { echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste sospese </div> TOTALE";}

					?>
					</div>


					<?php
					if($nPanel>1)
					{
						foreach ($panels as $value) 
						{
						?>		
						<div class="tab-pane" id="sospan<?php echo $value; ?>" role="tabpanel" aria-labelledby="sos<?php echo $value; ?>-tab"> 
				
						<?php
						
						if(${'contaSos'.$value}>0)
						{
						?>
						<canvas id="bar-chart-sospese<?php echo $value; ?>" ></canvas>
						<?php
						}

						else { 
							echo "<br/><div class='alert alert-danger' role='alert'> Non sono presenti interviste sospese. </div>"; 
							}
						?>
					
						</div>


					<?php 
					}
				}	
				?>
					<!-- //menu// -->
					<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">
					<li class="nav-item"  style="font-size:11px; margin-right:2%">
						<a class="nav-link active" id="sostat-tab" data-toggle="tab" href="#sostatTot" role="tab" aria-controls="sostatTot" aria-selected="true"><i class="fas fa-users"></i> TOT</a>
					</li>

					<?php 
					if ($nPanel>1) 		
					{ ?>

					<?php 
				if($nPanel>1)
				{
					foreach ($panels as $value) 
					{
						switch ($value) {
							case 0:
								$tPanel="MILLE";
								break;
							case 1:
								$tPanel="CINT";
								break;
							case 2:
								$tPanel="DYNATA";
								break;
							case 3:
								$tPanel="BILENDI";
								break;
							case 4:
								$tPanel="NORSTAT";
								break;	
							case 5:
								$tPanel="TOLUNA";
								break;	
							case 6:
								$tPanel="NETQUEST";
									break;		
							case 7:
								$tPanel="CATI";
									break;	
							case 8:
								$tPanel="ALTRO";
									break;											
						}
					?>

					<li class="nav-item" style="font-size:11px; margin-right:2%">
						<a class="nav-link" id="sos<?php echo $value; ?>-tab" data-toggle="tab" href="#sospan<?php echo $value; ?>" role="tab" aria-controls="sospan<?php echo $value; ?>" aria-selected="true"><i class="fas fa-users"></i> <?php echo $tPanel; ?></a>
					</li>

				<?php 
					}
				}	
				?>
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
		// Assicurati che $filtri sia definito come array
			if (isset($filtri) && is_array($filtri)) {
				arsort($filtri);
			} else {
				// Gestione del caso in cui $filtri non è definito o non è un array
				$filtri = [];
				// Puoi decidere di loggare un messaggio di errore o gestire questo caso come preferisci
			}
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
										if (isset($txtread[$contaT]) && $txtread[$contaT] !== null) {
    $txtread[$contaT] = str_replace('+"', ' ', $txtread[$contaT]);
} else {
    // Gestione del caso in cui $txtread[$contaT] è null
    $txtread[$contaT] = '';}
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

//fine php array da passare alla chart filtrate totali
		
//Altre chart filrtate

foreach ($panels as $value) 
{
${'labelArr'.$value}=array();
${'valArr'.$value}=array();

$contaImm=0;

// Nome della variabile dinamica
$filtriP_var = 'filtriP' . $value;

// Verifica che la variabile dinamica sia definita e sia un array
if (isset(${$filtriP_var}) && is_array(${$filtriP_var})) {
    arsort(${$filtriP_var});
} else {
    // Gestione del caso in cui la variabile dinamica non è definita o non è un array
    ${$filtriP_var} = []; // O qualsiasi altro valore di default appropriato

}
foreach ( ${'filtriP'.$value} as ${'chiave'.$value} => ${'valore'.$value}) 
		{
		$contaImm++;
		if ($contaImm<4) { $coltr="#F7C3C3";}
		else { $coltr="#FFF";}
		$contaRiga=0;
		//cerca testo domanda
		$ricerca=', '.trim(${"chiave".$value}).');'; 
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
								if (isset($txtread[$contaT]) && $txtread[$contaT] !== null) {
    $txtread[$contaT] = str_replace('+"', ' ', $txtread[$contaT]);
} else {
    // Gestione del caso in cui $txtread[$contaT] è null
    $txtread[$contaT] = '';}
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
				
			$perfDam=${'valore'.$value}/${'contaFiltri'.$value}*100;
			array_push(${'labelArr'.$value},$codiceStampa );
			array_push(${'valArr'.$value},${'valore'.$value});
			}	
			
		}


}

// fine altre chart filtrate


//creo php array da passare alla chart sospese

$labelsArr=array();
$valsArr=array();

$contaImm2==0;
		
		// Assicurati che $sospese sia definito come array
if (isset($sospese) && is_array($sospese)) {
    arsort($sospese);
} else {
    // Gestione del caso in cui $sospese non è definito o non è un array
    $sospese = [];
    // Puoi decidere di loggare un messaggio di errore o gestire questo caso come preferisci

}
		foreach ($sospese as $chiave => $valore) 
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
										if (isset($txtread[$contaT]) && $txtread[$contaT] !== null) {
    $txtread[$contaT] = str_replace('+"', ' ', $txtread[$contaT]);
} else {
    // Gestione del caso in cui $txtread[$contaT] è null
    $txtread[$contaT] = '';}
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

//fine totale chart

//altre chart sospese
foreach ($panels as $value) 
{
	${'labelsArr'.$value}=array();
	${'valsArr'.$value}=array();
	
	$contaImm2=0;
			
	arsort(${'sosP'.$value});
		foreach (${'sosP'.$value} as $chiave => $valore) 
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
					
					//echo "Cod".$ricerca."<br/>";
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
											if (isset($txtread[$contaT]) && $txtread[$contaT] !== null) {
    $txtread[$contaT] = str_replace('+"', ' ', $txtread[$contaT]);
} else {
    // Gestione del caso in cui $txtread[$contaT] è null
    $txtread[$contaT] = '';}
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
				
						$perDam=$valore/${'contaSos'.$value}*100;
						array_push(${'labelsArr'.$value},$codiceStampa);
						array_push(${'valsArr'.$value},$valore);
						}	
						
					}
			$contaIns++;	

}




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

 //chart filtrate 0
<?php 
if ($contaFiltri0>0) { ?>
ctx0 = document.getElementById("bar-chart-filtrati0");
ctx0.height = 300;

new Chart(document.getElementById("bar-chart-filtrati0"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr0 as $lab0){ echo "'".$lab0."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr0 as $val0){ echo "'".$val0."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Millebytes Filtrate'
      }
    }
});

<?php } ?>

 //chart filtrate 1
<?php if ($contaFiltri1>0) { ?>

ctx1 = document.getElementById("bar-chart-filtrati1");
ctx1.height = 300;

new Chart(document.getElementById("bar-chart-filtrati1"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr1 as $lab1){ echo "'".$lab1."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr1 as $val1){ echo "'".$val1."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Cint Filtrate'
      }
    }
});
<?php } ?>


//chart filtrate 2
<?php if ($contaFiltri2>0) { ?>

ctx2 = document.getElementById("bar-chart-filtrati2");
ctx2.height = 300;

new Chart(document.getElementById("bar-chart-filtrati2"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr2 as $lab2){ echo "'".$lab2."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr2 as $val2){ echo "'".$val2."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Dynata Filtrate'
      }
    }
});

<?php } ?>

//chart filtrate 3
<?php if ($contaFiltri3>0) { ?>

ctx3 = document.getElementById("bar-chart-filtrati3");
ctx3.height = 300;

new Chart(document.getElementById("bar-chart-filtrati3"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr3 as $lab3){ echo "'".$lab3."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr3 as $val3){ echo "'".$val3."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Bilendi Filtrate'
      }
    }
});

<?php } ?>

//chart filtrate 4
<?php if ($contaFiltri4>0) { ?>

ctx3 = document.getElementById("bar-chart-filtrati4");
ctx3.height = 300;

new Chart(document.getElementById("bar-chart-filtrati4"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr4 as $lab4){ echo "'".$lab4."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr4 as $val4){ echo "'".$val4."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Norstat Filtrate'
      }
    }
});

<?php } ?>


//chart filtrate 5
<?php if ($contaFiltri5>0) { ?>

ctx3 = document.getElementById("bar-chart-filtrati5");
ctx3.height = 300;

new Chart(document.getElementById("bar-chart-filtrati5"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr5 as $lab5){ echo "'".$lab5."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr5 as $val5){ echo "'".$val5."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Toluna Filtrate'
      }
    }
});

<?php } ?>

//chart filtrate 6
<?php if ($contaFiltri6>0) { ?>

ctx3 = document.getElementById("bar-chart-filtrati6");
ctx3.height = 300;

new Chart(document.getElementById("bar-chart-filtrati6"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr6 as $lab6){ echo "'".$lab6."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr6 as $val6){ echo "'".$val6."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Netquest Filtrate'
      }
    }
});

<?php } ?>

//chart filtrate 7
<?php if ($contaFiltri7>0) { ?>

ctx3 = document.getElementById("bar-chart-filtrati7");
ctx3.height = 300;

new Chart(document.getElementById("bar-chart-filtrati7"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelArr7 as $lab7){ echo "'".$lab7."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valArr7 as $val7){ echo "'".$val7."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Cato panel Filtrate'
      }
    }
});

<?php } ?>


 //chart sospese totali
ctxs = document.getElementById("bar-chart-sospese");
ctxs.height = 300;

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

<?php if ($contaSos0>0) { ?>
 //chart sospese 0
ctxs0 = document.getElementById("bar-chart-sospese0");
ctxs0.height = 300;

new Chart(document.getElementById("bar-chart-sospese0"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr0 as $labs0){ echo "'".$labs0."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr0 as $vals0){ echo "'".$vals0."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Millebytes'
      }
    }
});

<?php } ?>

<?php if ($contaSos1>0) { ?>
 //chart sospese 1
ctxs1 = document.getElementById("bar-chart-sospese1");
ctxs1.height = 300;

new Chart(document.getElementById("bar-chart-sospese1"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr1 as $labs1){ echo "'".$labs1."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr1 as $vals1){ echo "'".$vals1."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Cint'
      }
    }
});
<?php } ?>

<?php if ($contaSos2>0) { ?>
 //chart sospese 2
ctxs2 = document.getElementById("bar-chart-sospese2");
ctxs2.height = 300;

new Chart(document.getElementById("bar-chart-sospese2"), {
    type: 'horizontalBar',
    data: {
      labels: [ <?php foreach ($labelsArr2 as $labs2){ echo "'".$labs2."',"; } ?>  ],
      datasets: [
        {
          label: "Interviste ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php foreach ($valsArr2 as $vals2){ echo "'".$vals2."',"; } ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Interviste Sospese Dynata'
      }
    }
});
<?php } ?>


</script>







	<script type='text/javascript'>
	$(document).ready(function()
	{
	$('.tooltip_default').tooltip({track:true});
	});
	</script>

</div>
