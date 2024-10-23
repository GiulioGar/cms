<?php 

require_once('inc_taghead.php');
// Funzione per ottenere il conteggio degli utenti attivi
function getUsersCount($admin) {
  $query_user = "SELECT COUNT(*) as total FROM t_user_info WHERE active='1'";
  $result = mysqli_query($admin, $query_user);

  if (!$result) {
      die('Errore nella query: ' . mysqli_error($admin));
  }

  return mysqli_fetch_assoc($result);
}

$today = new DateTime('-6 hours');
$mesi1 = new DateTime('-1 month -6 hours');
$mesi2 = new DateTime('-2 months -6 hours');
$mesi4 = new DateTime('-4 months -6 hours');
$mesi6 = new DateTime('-6 months -6 hours');
$mesi12 = new DateTime('-1 year -6 hours');

mysqli_select_db($admin, $database_admin);
$query_ricerche = "SELECT * FROM t_panel_control ORDER BY stato, giorni_rimanenti ASC, id DESC";
$tot_ricerche = mysqli_query($admin, $query_ricerche);

$tot_use = getUsersCount($admin);


require_once('inc_tagbody.php'); 

$ir = isset($_REQUEST['ir']) ? intval($_REQUEST['ir']) : 100;
$ag1 = isset($_REQUEST['ag1']) ? intval($_REQUEST['ag1']) : 18;
$ag2 = isset($_REQUEST['ag2']) ? intval($_REQUEST['ag2']) : 65;
?>

<script>
    $(document).ready(function() {
        $("#nav").hide();
        $(".closeMenu").hide();

        $(".startMenu, .closeMenu").click(function() {
            $("#nav").slideToggle("slow");
            $(".startMenu, .closeMenu").toggle();
        });
    });
</script>

<div class="content-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <h5 class="card-header">
                        <span><i class="fas fa-satellite-dish"></i> Progetti in corso</span>
                        <a href='pannello.php'>
                            <button type="button" class="btn btn-primary btn-sm float-right">MOSTRA TUTTI</button>
                        </a>
                    </h5>
                    <div class="card-body text-center recent-users-sec">
                        <?php include 'fieldControl.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">
                        <i class="fas fa-server"></i> Dati Panel
                    </h5>
                    <div class="card-body text-center recent-users-sec">
                        <button type="button" class="btn btn-success" style="background-color:#88d899; margin:5px;">
                            <i class="fas fa-address-card"></i>
                            <b>ISCRITTI:</b>
                            <span class="badge badge-light"><b><?php echo $tot_use['total']; ?></b></span>
                        </button>
                        <?php include 'PanelDat.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <h5 class="card-header">
                        <i class="fas fa-poll"></i> Dati Ricerche
                    </h5>
                    <div class="card-body text-center recent-users-sec">
                        <?php include 'surDat.php'; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="sp">&nbsp;</div>
<div class="sp">&nbsp;</div>

<?php require_once('inc_footer.php'); ?>
