<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione Iscritti';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "iscritti";
$coldx = "no";

@$user_id = $_REQUEST['user_id'];
@$azione = $_REQUEST['azione'];
@$dettagli = $_REQUEST['dettagli'];

require_once('function_user.php');

?>

<hr/>
<div class="content-wrapper">
<div class="container bootstrap snippet">

<div class="col-sm-10 "><h1><i class="far fa-user"></i> 
<?php echo strtoupper(htmlspecialchars($row_user['first_name'])) ?> 
<?php echo strtoupper(htmlspecialchars($row_user['second_name'])) ?> 



</h1>


</div>

 <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

               
          <div class="card card-default">
            <div class="card-header">STATUS</div>
            <div class="card-body">
           <p> <i class="far fa-id-card"></i> <?php echo $row_user['user_id'] ?></p>
			
		 <p>
		 	  <?php 
			
					if ($row_user['active'] <> 1) 
					{ echo "<div style='color:red; font-weight:bold;'><i class='fas fa-user-minus'></i> CANCELLATO </div>";}
					else {echo "<div style='color:#8ac46d; font-weight:bold;'><i class='fas fa-user-plus'></i> ATTIVO </div>";  }
							
					?> 
		 </p>
    
			</div>
          </div>

          <hr>
          
          <ul class="list-group">
            <li class="list-group-item text-muted">ATTIVITA' <i class="far fa-list-alt"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Bytes:</strong></span> <?php echo $row_user['points'] ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Ricerche completate:</strong></span> <?php echo $complSur; ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Premi richiesti:</strong></span> <?php echo $premiRic; ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Partecipazione:</strong></span>  <?php echo $levAct; ?> </li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Ultima attività:</strong></span>  <?php echo $row_user2['event_date'] ?> </li>
          </ul> 

          <hr>
               
          <div class="card panel-default">
            <div class="card-header">PREMI <i class="fas fa-trophy"></i></div>
            <div class="card-body">
              <table class="table table-striped table-bordered table-hover">
                <tr><td>Pagati:</td><td><?php echo $prePag; ?></td></tr>
                <tr><td>In Sospeso:</td> <td><?php echo $preNoPag; ?></td> </tr>
              </table>
            
            </div>
          </div>
          
        </div><!--/col-3-->

 <div class="col-sm-9">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab" data-toggle="tab" href="#inviti" role="tab" aria-controls="inviti" aria-selected="true">ANAGRAFICA</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab" data-toggle="tab" href="#registra" role="tab" aria-controls="registra" aria-selected="false">STORICO</a>
  </li>
</ul>

 <div class="tab-content">
            <div class="tab-pane active" id="inviti">
			<hr>
			
		<table class='table table-striped table-bordered table-hover' cellspacing="1" width="100%" >
		<tr><td class="etic" align="left">Email:</td><td align="left"><?php echo $row_user['email'] ?> </td></tr>
		<tr><td class="etic" align="left">Password:</td><td align="left"><?php echo $row_user['pwd'] ?> </td></tr>
        <tr><td class="etic" align="left">Data di nascita:</td><td align="left"><?php echo htmlspecialchars(@read_time($row_user['birth_date'])) ?></td></tr>
		<tr><td class="etic" align="left">Registrazione:</td><td align="left"><?php echo htmlspecialchars(@read_time($row_user['reg_date'])) ?></td></tr>
		<tr><td class="etic" align="left">Genere:</td><td align="left"><?php echo convert_array($gender,$row_user['gender']) ?></td></tr>
		<tr><td class="etic" align="left">Istruzione:</td><td align="left"><?php echo convert_array($instr_level_id,$row_user['instr_level_id']) ?></td></tr>
		<tr><td class="etic" align="left">Lavoro:</td><td align="left"><?php echo convert_array($work_id,$row_user['work_id']) ?></td></tr>
		<tr><td class="etic" align="left">Stato Civile:</td><td align="left"><?php echo convert_array($mar_status_id,$row_user['mar_status_id']) ?></td></tr>
		<tr><td class="etic" align="left">Nazione:</td><td align="left"><?php echo $row_user['country'] ?></td></tr>
		<tr><td class="etic" align="left">Provincia:</td><td align="left"><?php echo convert_array($province_id,$row_user['province_id']) ?></td></tr>
		<tr><td class="etic" align="left">Cap:</td><td align="left"><?php echo $row_user['code'] ?> </td></tr>
		<tr><td class="etic" align="left">Indirizzo:</td><td align="left"><?php echo $row_user['address'] ?></td></tr>
		<tr><td class="etic" align="left">Tel:</td><td align="left"><?php echo $row_user['home_phone'] ?> </td></tr>
		<tr><td class="etic" align="left">Mobile:</td><td align="left"><?php echo $row_user['mobile_phone'] ?> </td></tr>

       
   
        
        <?php 
		$em=$row_user['email'];
		$noem="^".$em."^";
		
		?>

        </table>
                   
            <hr>
              
			 </div><!--/tab-pane-->
			 


             <div class="tab-pane" id="registra">
               
               <h2></h2>
            <!-- PREMI -->

            <div class="card panel-default">
            <div class="card-header"><i class="fas fa-trophy"></i> PREMI ASSEGNATI</div>
            <div class="card-body">
               
               <table class='table table-striped table-bordered' cellspacing="1" width="100%" >
                <thead><th>Premio</th><th>Codice</th><th>Richiesto</th><th>Evaso</th><th>Status</th></thead>

                <?php
                foreach($infoPremi as $row2)
                {
                  if ($row2['pagato']==0) { $pagaScritto="Non pagato";}
                  if ($row2['pagato']==1) { $pagaScritto="Pagato";}
                 ?>

              <tr>
                <td><?php echo $row2['event_info'] ?></td>
                <td><?php echo $row2['codice2'] ?></td>
                <td><?php echo $row2['event_date'] ?></td>
                <td><?php echo $row2['giorno_paga'] ?></td>
                <td><?php echo $pagaScritto; ?></td>
              </tr>
                
                <?php  
                }  
                ?>

               </table>

              </div>
              </div>
              
              <h2></h2>
             <!-- STORICO RICERCHE -->
             <div class="row">
             <div class="col-sm-4"><!--left col-->

             <div class="card">
            <div style="color:aliceblue" class="card-header bg-success"><i class="fas fa-history"></i> STORICO UTENTE</div>
            <div class="card-body">
               
            <table class="table table-striped table-bordered table-hover">
                <tr><td>Inviti:</td><td><?php echo $staInv; ?></td></tr>
                <tr><td>Complete:</td> <td><?php echo $staComp; ?></td> </tr>
                <tr><td>Filtrate:</td> <td><?php echo $staFil; ?></td> </tr>
                <tr><td>Quotafull:</td> <td><?php echo $staQuot; ?></td> </tr>
                <tr><td>Sospesa:</td> <td><?php echo $staSosp; ?></td> </tr>
                <tr><td>Nessuna azione:</td> <td><?php echo $staNone; ?></td> </tr>
              </table>

              </div>
              </div>
            </div><!--  left -->

            <div class="col-sm-8"><!--right col-->

            <div class="card">
            <div style="color:aliceblue" class="card-header bg-primary"><i class="fab fa-searchengin"></i> STORICO ATTIVITA'</div>
            <div class="card-body">
              
              <table id="storyTable" class='table table-striped table-bordered' cellspacing="1" width="100%" >
              <thead><th>GIORNO</th><th>EVENTO</th><th>LIVELLO</th></thead>

              <?php

              $contaInseriti=0;
              foreach($infoStory as $row)
              {
                $contaInseriti++;

                if ($row['event_info']=="User has been canceled") { $event="CANCELLAZIONE";}
                if (strstr($row['event_info'],"Buono")) { $event="<b>Buono Amazon</b>";}
                if (strstr($row['event_info'],"Ricarica")) { $event="<b>Ricarica Paypal</b>";}
                if ($row['event_info']=="Interview complete") { $event="RICERCA COMPLETATA"; }
                if ($row['event_info']=="Interview Complete Cint") { 

                  if (!empty($row['codice_cint'])) {
                    $event = $row['codice_cint'];
                } else {
                    $event = "RICERCA CINT";
                }

                 }
                if ($row['event_info']=="New user has been created") { $event="NUOVO CONCORSO";}
                if ($row['event_info']=="bonus") { $event="BONUS";}
                if (strpos($row['event_info'], 'livelli') !== false)  { $event=$row['event_info'];}

                $surEvent;

                if (strpos($row['event_info'], '(') !== false) { $surEvent=$row['event_info']; 

                $surEvent=str_replace("(", "" ,$surEvent);
                $surEvent=str_replace(")", "" ,$surEvent);
                $eventArray = explode(',', $surEvent);
                $iid=$eventArray[0];
                $surv=$eventArray[1];
                $proj=$eventArray[2];
                
                $event=$surv." - ". $proj;
                }
                ?>

            <tr  <?php if($contaInseriti>7) { echo "id=addRows class=collapse"; } ?>  >
              <td><?php echo $row['event_date']; ?></td>
              <td><?php echo $event; ?></td>
              <td><?php echo $row['new_level'] ?></td>
            </tr>

           <?php  
                if($contaInseriti==7)
                {
                ?>
               <tr data-toggle="collapse" data-target="#addRows" data-parent="#storyTable"> 
                 <td style="text-align:center;" colspan="3"  class="hiddenRow"> <span style="font-size:13px!important; cursor: pointer;" class="badge badge-info"> MOSTRA ALTRO <i class="fas fa-arrow-circle-down"></i> </span> </td>
                </tr>
            <?php 
                }

              }  
              ?>

              </table>

            </div>
            </div>
            </div><!--  right -->
            </div><!--  fine row -->

             </div><!--/tab-pane-->
             
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->             


</div><!--/col-12-->

</div>






</div>
<?php 

require_once('inc_footer.php'); 
?>