

<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	
	
$query_new = "SELECT count('nid') as tot FROM millebytesdb.support_ticket where state='1';";
$new_crm = mysqli_query($admin,$query_new) or die(mysql_error());
$crm_new = mysqli_fetch_assoc($new_crm);

$query_new = "SELECT count('nid') as tot FROM millebytesdb.support_ticket where state='2' or state='3';";
$sosp_crm = mysqli_query($admin,$query_new) or die(mysql_error());
$crm_sosp = mysqli_fetch_assoc($sosp_crm);

$query_cerca1 = "SELECT COUNT('user_id') as tot1 FROM t_user_history where event_type='withdraw'";
$cerca1 = mysqli_query($admin,$query_cerca1) or die(mysql_error());
$crm_cerca1 = mysqli_fetch_assoc($cerca1);

$query_cerca = "SELECT COUNT('user_id') as tot FROM t_history_copia where pagato=1 order by event_date desc";
$cerca = mysqli_query($admin,$query_cerca) or die(mysql_error());
$crm_cerca = mysqli_fetch_assoc($cerca);

?>

<body cz-shortcut-listen="true">



    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d2ffbc;">
  <a class="navbar-brand" href="#"><img width="150px" src="img/logo.png"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="homegest.php"> <i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pannello.php"><i class="fas fa-poll-h"></i>Ricerche</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="campioni.php"><i class="fas fa-users"></i> Campioni</a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-tools"></i> Tools
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="tools_link.php">Generatore Link</a>
          <a class="dropdown-item" href="tools_test.php">Auto test</a>
          <a class="dropdown-item" href="rtr_gen.php">Rtr Converter</a>
          <a class="dropdown-item" href="tool_focuspoint.php">Focus Point</a>
          <div class="dropdown-divider"></div>
          <a target="_blank" class="dropdown-item" href="http://mailer.primisoft.com/admin/compila_mail_gest.php">Mailer</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-history"></i> Storico
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="storicoPanel.php">Attività</a>
          <a class="dropdown-item" href="infoSur.php">Panel</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="costiPanel.php">
        <i class="fas fa-search-dollar"></i> Costi Panel</a>
      </li>

      <?php
							if ($_SESSION['MM_Username']=="g_garofalo"){
              ?>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-award"></i> Premi 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="RichiestePremio.php">Assegna Premi</a>
          <a class="dropdown-item" href="assegnalivello.php">Assegna Livelli</a>
      </li>       
      <?php
								};
              ?>
      <li class="nav-item">
        <a class="nav-link" href="costiPanel.php"><i class="fas fa-info-circle"></i>Info Utenti</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fas fa-bullhorn"></i> Reclutamento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="MvfDettaglioIscritti.php.php">Conteggi</a>
          <a class="dropdown-item" href="conta_campagna.php">Statistiche</a>
      </li>  

      <li class="nav-item">
     <a class="nav-link" href="cint_index.php"><i class="fas fa-street-view"></i> Panel Cint</a>
      </li>

        
              
    </ul>
    <div class="">
              	<?php 
					$total_crm=$crm_new['tot'];
					$sosp_crm=$crm_sosp['tot'];
					$cer=$crm_cerca1['tot1']-$crm_cerca['tot'];
					$sum=$total_crm+$sosp_crm+$cer;

					if ( $sum > 0 && $_SESSION['MM_Username']=="g_garofalo") 
					{
							 if ( $total_crm == 1) {$ric="richiesta";}
							 else { $ric="richieste";}
					?>
            <?php if ($total_crm>0){?> 
              <div>
              <span class="badge badge-pill badge-light">Hai <b><a href="http://www.millebytes.com/it/support/test_millebytes/new"><?php echo $total_crm." ".$ric; ?></a>
            </b> da leggere </span></div> 
            <?php } ?>

            <?php if ($sosp_crm>0){?>
              <div>
              <span class="badge badge-pill badge-light">Hai <b><a href="http://www.millebytes.com/it/support/test_millebytes"><?php echo $sosp_crm." ".$ric; ?></a></b> in sospeso </span>
            </div> 
              <?php } ?>


					<?php   if ($cer>0) { if ( $cer == 1) {$ric="richiesta";} 	else { $ric="richieste";} 	?>
						
						<div>
            <span class="badge badge-pill badge-light"> Hai <b><a href="http://stats.primisoft.com/cms/admin/RichiestePremio.php"><?php echo $cer." ".$ric; ?></a></b> premio in sospeso </span>
            </div>
						

					<?php } 

					} 

					else {?><div><span class="badge badge-pill badge-light">Light</span> Nessuna nuova richiesta da leggere </span></div><?php } ?>
					</div>
  </div>
</nav>



	
