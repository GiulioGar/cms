<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";



$today=date("Y-m-d H:i:s", mktime(date("H")-6,date("i,s,m,d,Y") ));
$mesi1=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-1,date("d"),date("Y")));
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi4=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-4,date("d"),date("Y")));
$mesi6=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-6,date("d"),date("Y")));
$mesi12=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m"),date("d"),date("Y")-1));

mysqli_select_db($admin,$database_admin);
$query_ricerche = "SELECT * FROM t_panel_control order by stato,giorni_rimanenti ASC,id DESC";
$tot_ricerche = mysqli_query($admin,$query_ricerche);

/*
$sur_date=substr($today,0,10);
$end_date=substr($tot_ricerche['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($row['sur_date'], $row['end_field'], "g"); }
else { $daysField="n.d.";}
*/


require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 


// Carica incidenza
@$ir = $_REQUEST['ir']; 
if (empty($ir)) { $ir=100;}
//Carica età calculator
@$ag1 = $_REQUEST['ag1']; 
if (empty($ag1)) { $ag1=18;}
@$ag2 = $_REQUEST['ag2']; 
if (empty($ag2)) { $ag2=65;}
?>

<script>
        $(document).ready(function() 
		{
		$("#nav").hide();
		$(".closeMenu").hide();
		$( ".startMenu" ).click(function() {
			$( "#nav" ).slideDown( "slow", function() {
			// Animation complete.
				});
				$(".startMenu").hide();
				$(".closeMenu").show();
			});
			
		$( ".closeMenu" ).click(function() {
			$( "#nav" ).slideUp( "slow", function() {
			// Animation complete.
				});
				$(".startMenu").show();
				$(".closeMenu").hide();
			});	
        });
		
		
		</script>


  <div class="content-wrapper">
       <div class="container">
 
		
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="card card-default">
   <div class="card-heading">
   <span style="float:left;">Progetti in corso</span><span style="float:right;"><a href='pannello.php'>MOSTRA TUTTI</a></span>
   <span style="clear: both;">&nbsp;</span>
   </div>
   <div class="card-body text-center recent-users-sec">
   <?php include 'fieldControl.php'; ?>
   </div>
   
   </div>
  </div>
 
 </div>

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="card card-primary">
   <div class="card-heading">
   Dati Panel
   </div>
   <div class="card-body text-center recent-users-sec">
  <?php include 'PanelDat.php'; ?> 
   </div>
   
   </div>
  </div>
 
 </div>

</div>
</div>


<div class="sp">&nbsp;</div>
<div class="sp">&nbsp;</div>
<?php 

require_once('inc_footer.php');

?>