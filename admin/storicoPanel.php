

<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	


$data=date("Y-m-d");

$saveY0=date("Y");
$saveY1=date("Y")-1;
$saveY2=date("Y")-2;
$saveY3=date("Y")-3;
$saveY4=date("Y")-4;

/*default value */
$default_anno=date("Y");

$cerca_anno_originale=$_REQUEST['Canno'];
$cerca_anno=$_REQUEST['Canno'];
if ($cerca_anno==""){$cerca_anno=$default_anno;}
					else
					{$cerca_anno=$cerca_anno;}
					
$data=date("Y-m-d");



require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

?>

<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-1 col-md-offset-1"></div>
      <div class="col-md-10 col-md-offset-1">
        <div class="card-body">
          <div class="table-responsive tabIns">
            <!-- Il contenuto caricato via AJAX andrà qui -->
          </div>
        </div>
      </div>
      <div class="col-md-1 col-md-offset-1"></div>
    </div>
  </div>
</div>



<script>
$(document).ready(function() {
    // Funzione per caricare i dati via AJAX
    function caricaPagina() {
        let can = $("select.Canno").val();

        $('.mess2').fadeIn();

        // Chiamata AJAX
        $.ajax({
            // Imposto il tipo di invio dati (GET O POST)
            type: "GET",
            // Dove devo inviare i dati recuperati dal form?
            url: "function_storicoPanel.php",
            // Quali dati devo inviare?
            data: { Canno: can },
            dataType: "html",
            success: function(data) {
                $('.mess2').fadeOut();
                $(".table-responsive.tabIns").html(data);
            }
        });
    }

    // Chiamata della funzione al cambio del select
    $(document).on('change', "select.Canno", function() {
        caricaPagina();
    });

    // Esegui la funzione al caricamento della pagina
    caricaPagina();
});
</script>

<?php
require_once('inc_footer.php'); 
?>
