<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 





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
       echo " <a href='controlloField.php?prj=".$row['prj']."&sid=".$row['sur_id']."' class='list-group-item list-group-item-action bg-light'> <img style='position:relative; top:-3px;' width='25px' src='img/live.gif'/>".$row['sur_id']."</a>";
        }
      }  

      ?>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

<div class="container" id="page-content-wrapper">

<nav class="navbar navlateral navbar-expand-lg">
        <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-list-ul"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
</nav>

<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card  shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center " style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-success text-uppercase mb-1">Ricerca</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $sid; ?> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $lu['description']; ?> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #94d872; opacity: 0.5;">
		  <i class="fas fa-poll-h"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center" style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-primary text-uppercase mb-1">Target</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Interviste: </b><?php echo $lu['goal']; ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Sesso: </b><?php echo $sex; ?> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Età: </b><?php echo $lu['age1_target']."-".$lu['age2_target']." anni" ?> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #007BFF; opacity: 0.5;">
		  <i class="fas fa-bullseye"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card shadow h-100 py-2 rounded-top">                        
<div class="card body">
<div class="row no-gutters align-items-center" style="min-height: 100px;">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-warning  text-uppercase mb-1">Timing e Costi</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Inizio Field:</b> <?php echo $newDateStart;  ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Fine Field:</b> <?php echo $newDate;  ?> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><span style="color:navy"><b>CPI stimato:</b> <?php echo $arrStime[$matrice2];  ?>€</i></span> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #F7BB07; opacity: 0.5;">
		  <i class="fas fa-business-time"></i>
		  </span>

          </div>
        </div>        

</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
<div style="padding:5px;" class="card shadow h-100 py-2 rounded-top" style="min-height: 100px;">                        
<div class="card body">
<div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 text-xs font-weight-bold text-danger text-uppercase mb-1">Info</div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Stato Field:</b> <?php echo $stato; ?></div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>Loi:</b> <span style="color:red"><?php echo substr($loi,0,4); ?> minuti</span> </div>
            <div class="h6 mb-0 font-weight-bold text-gray-800"><b>RTR:</b><a target="_blank" href="http://tools.primisoft.com/rtr/<?php echo $sid; ?>/3"> <i class="fas fa-external-link-alt"></i>Collegati </a> </div>
          </div>
          <div class="col-auto">
		  <span style="font-size: 28px; color: #D53343; opacity: 0.5;">
		  <i class="fas fa-info-circle"></i>
		  </span>

          </div>
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