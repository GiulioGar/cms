<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi3=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-3,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$conta_giorno=0;
$panel_esterno=0;
$loi=0;
$sumDiff=0;
$contaCompl=0;
$redemption_panel=0;

$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");
//echo "la ricerca è:".$sid." ".$prj;

      
	$query_m2 = "SELECT * FROM unsub";
	$m2_close = mysqli_query( $admin,$query_m2) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($m2_close))
		{
		if ($row['uid']!=""){echo $row['uid']."<br>";}
		 
		}
		
require_once('inc_footer.php'); 

mysql_close();
?>
