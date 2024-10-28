<?php

require_once('inc_taghead.php');
?>
<link href="assets/css/simple-sidebar.css" rel="stylesheet">

<?php
require_once('inc_tagbody.php'); 



@$azione = $_REQUEST['azione'];
$sex_target=$_REQUEST['sex_target'];
$aree=$_REQUEST['aree'];
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$tags=$_REQUEST['tag'];
$iscrizione=$_REQUEST['iscrizione'];
$currentYear=date("Y");

require_once('function_conta_locale.php');  

if($conta_complete>9) { $cpiStima=$arrStime[$matrice2]; }
else { $cpiStima="N.D"; }

?>



<div class="content-wrapper toggled d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"> <i class="fas fa-poll-h"></i> Ricerche in corso </div>
      <div class="list-group list-group-flush">

      <?php
      while ($row = mysqli_fetch_assoc($tot_ricerche))
      {
        if($sid <> $row['sur_id'])
        {
       echo " <a href='controlloField.php?prj=".$row['prj']."&sid=".$row['sur_id']."' class='list-group-item list-group-item-action bg-light'> <img style='position:relative; top:-3px;' width='25px' src='img/live.gif'/>".$row['sur_id']."
       <br/><span style='font-size:12px; margin-left:20px;'><i>".$row['description']."</i></span></a>";
        }
      }  

      ?>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

<div class="container" id="page-content-wrapper">

<div class="row mt-4">
  <!-- Navbar allineata a sinistra -->
  <div class="col d-flex align-items-center">
    <nav class="navbar navlateral navbar-expand-lg">
      <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-list-ul"></i></button>
      <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </div>

  <!-- Menu selezione allineato a destra -->
  <div class="col-auto">
    <div class="menu-selection d-flex justify-content-end">
      <button type="button" class="menu-btn active">
        <i class="fas fa-bullseye"></i> Target/Domande
      </button>
      <button type="button" class="menu-btn">
        <i class="fas fa-check-circle"></i> Qualità
      </button>
      <button type="button" class="menu-btn">
        <i class="fas fa-cog"></i> Impostazioni
      </button>
    </div>
  </div>
</div>


<div class="row">

  <!-- Card Ricerca -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-success">Ricerca</h5>
        <p class="custom-card-text"><?php echo $sid; ?></p>
        <p class="custom-card-text"><?php echo $lu['description']; ?></p>
        <div class="custom-card-icon text-success">
          <i class="fas fa-poll-h"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Target -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-primary">Target</h5>
        <p class="custom-card-text"><strong>Interviste:</strong> <?php echo $lu['goal']; ?></p>
        <p class="custom-card-text"><strong>Sesso:</strong> <?php echo $sex; ?></p>
        <p class="custom-card-text"><strong>Età:</strong> <?php echo $lu['age1_target']."-".$lu['age2_target']." anni"; ?></p>
        <div class="custom-card-icon text-primary">
          <i class="fas fa-bullseye"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Timing e Costi -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-warning">Timing e Costi</h5>
        <p class="custom-card-text"><strong>Inizio Field:</strong> <?php echo $newDateStart; ?></p>
        <p class="custom-card-text"><strong>Fine Field:</strong> <?php echo $newDate; ?></p>
        <p class="custom-card-text text-navy"><strong>CPI stimato:</strong> <?php echo $cpiStima; ?>€</p>
        <div class="custom-card-icon text-warning">
          <i class="fas fa-business-time"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Info -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-danger">Info</h5>
        <p class="custom-card-text"><strong>Stato Field:</strong> <?php echo $stato; ?></p>
        <p class="custom-card-text"><strong>Loi:</strong> <span class="text-danger"><?php echo substr($loi,0,4); ?> minuti</span></p>
        <p class="custom-card-text"><strong>Panel:</strong> <span class="text-primary small"><?php echo $usePanel; ?></span></p>
        <div class="custom-card-icon text-danger">
          <i class="fas fa-info-circle"></i>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row">
<div class="col-md-12 col-sm-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab2" data-toggle="tab" href="#inviti2" role="tab" aria-controls="inviti2" aria-selected="true">Status</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab2" data-toggle="tab" href="#registra2" role="tab" aria-controls="registra2" aria-selected="false">Diario</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="inviti2" role="tabpanel" aria-labelledby="inviti-tab2"> 
  <?php  require_once('conta_locale.php');  ?> 

  </div>


  <div class="tab-pane" id="registra2" role="tabpanel" aria-labelledby="registra-tab2">

  <?php  require_once('diario_locale.php');  ?> 
 
  </div>

</div>




</div>
</div>


</div>
</div>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<?php 

require_once('inc_footer.php');

?>