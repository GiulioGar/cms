

<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	
	

$query_cerca1 = "SELECT COUNT('user_id') as tot1 FROM t_user_history where event_type='withdraw' and pagato=0";
$cerca1 = mysqli_query($admin,$query_cerca1);
$crm_cerca1 = mysqli_fetch_assoc($cerca1);


?>

<body cz-shortcut-listen="true">



  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #9DCE6B;">

  <a class="navbar-brand" href="#"><img width="150px" src="img/logo.png"/></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<?php

if ($_SESSION['MM_Username']!=""){

?>


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
          <a class="dropdown-item" href="toResponsive.php">Concept Tool</a>
          <a class="dropdown-item" href="tool_focuspoint.php">Focus Point</a>
          <a class="dropdown-item" href="tools_convertiPunti.php">Converti Punti</a>
          <div class="dropdown-divider"></div>
          <a target="_blank" class="dropdown-item" href="http://mailer.interactive-mr.com/admin/compila_mail_gest.php">Mailer</a>
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

  
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-award"></i> Premi 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
			if ($_SESSION['MM_Username']=="g_garofalo"){?>   <a class="dropdown-item" href="RichiestePremio.php">Assegna Premi Amazon</a>       <?php }; ?>
          <a class="dropdown-item" href="RichiestePaypal.php">Assegna Premi Paypal</a>
          <?php   if ($_SESSION['MM_Username']=="g_garofalo"){?>    <a class="dropdown-item" href="assegnalivello.php">Assegna Livelli</a>  <?php }; ?>
      </li>       

      <li class="nav-item">
        <a class="nav-link" href="user_info.php"><i class="fas fa-info-circle"></i>Info Utenti</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fas fa-bullhorn"></i> Reclutamento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="nuoviscritti.php">Conteggi</a>
          <a class="dropdown-item" href="conteggioIscritti.php">Dettagli</a>
          <a class="dropdown-item" href="conta_campagna.php">Statistiche</a>
          <a class="dropdown-item" href="pa_richieste.php">Porta Amico - Email</a>
          <a class="dropdown-item" href="pa_bonus.php">Porta Amico - Bonus</a>
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
?>


					<?php   if ($cer>0) { if ( $cer == 1) {$ric="richiesta";} 	else { $ric="richieste";} 	?>
						
						<div>
            <span class="badge badge-pill badge-light"> Hai <b><a href="http://stats.primisoft.com/cms/admin/RichiestePremio.php"><?php echo $cer." ".$ric; ?></a></b> premio in sospeso </span>
            </div>
						

					<?php } 

					} 

					else {
            if ($_SESSION['MM_Username']=="g_garofalo") 
            {
            ?><div><span class="badge badge-pill badge-light">Light</span> Nessuna nuova richiesta da leggere </span></div>
            
            <?php }} ?>
          </div>
          
        <?php } ?>
  </div>
</nav>

     
	
