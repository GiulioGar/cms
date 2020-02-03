<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione Iscritti';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "iscritti";
$coldx = "no";

@$temp_userId = $_REQUEST['temp_userId'];
@$temp_code = $_REQUEST['temp_code'];
@$np = $_REQUEST['np'];
@$ct = $_REQUEST['ct'];
@$azione = $_REQUEST['azione'];
@$sub_azione = $_REQUEST['sub_azione'];
@$dettagli = $_REQUEST['dettagli'];
@$searchtxt = mysql_real_escape_string($_REQUEST['searchtxt']);

// Leggi concorso

mysqli_select_db($database_admin, $admin);
$query_con = "SELECT * FROM t_concorso as t  WHERE t.status_v=1";
$con = mysqli_query($query_con, $admin) or die(mysql_error());
$row_con = mysqli_fetch_assoc($con);
$inizio=$row_con['start_date'];
$final=$row_con['end_date'];


//Date concorso
$data_inizio=date_create($inizio);
$data_finale=date_create($final);


//Concorso attuale//
$cc=$row_con['id'];


/////// AZIONI /////////


if ($sub_azione=="conferma")
{

mysqli_select_db($database_admin, $admin);

//Annulla tutti i ticket del concorso 

$query_null="
UPDATE t_virtual_tickets AS t
SET t.valid=0
WHERE received_on <= '$final' AND t.valid=1
";
$con0=mysqli_query($query_null, $admin) or die(mysql_error());


// Chiudi concorso attuale
$query_con="UPDATE t_concorso SET status_v=2  WHERE id=$cc";
$con=mysqli_query($query_con, $admin) or die(mysql_error());

// Cambia concorso
$cc++;

// Apri nuovo concorso
$query_con2="UPDATE t_concorso SET status_v=1  WHERE id=$cc";
$con2=mysqli_query($query_con2, $admin) or die(mysql_error());
?>


<script language="javascript" type="text/javascript">
location.href="admin_ticket.php";
</script>


<?php


}




if ($sub_azione=="ripeti" )
{

mysqli_select_db($database_admin, $admin);

// Cancella utenti estratti
$query_con="DELETE FROM t_user_win WHERE concorso=$cc";
$con=mysqli_query($query_con, $admin) or die(mysql_error());

?>


<script language="javascript" type="text/javascript">
location.href="admin_ticket.php";
</script>


<?php


}




if ($azione=="invalid_row" )
{

		$updateSQL = sprintf("UPDATE t_virtual_tickets SET valid=%s  WHERE id=%s ",
        GetSQLValueString($_POST['valid'], "int"),
		GetSQLValueString($_POST['id'], "int"));
		mysqli_select_db($database_admin, $admin);
  		$Result1 = mysqli_query($updateSQL, $admin) or die(mysql_error());

}



if ($azione=="invalid_all")
{
mysqli_select_db($database_admin, $admin);
$query_ann=
"
UPDATE t_virtual_tickets AS t
INNER JOIN t_user_info as u
INNER JOIN t_concorso as c
ON  (u.email LIKE '%$searchtxt%')
SET t.valid=0
WHERE received_on <= c.end_date AND u.user_id=t.user_id AND t.valid='1'
";
mysqli_select_db($database_admin, $admin);
$Result1 = mysqli_query($query_ann, $admin) or die(mysql_error());
}



require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 
?>

<div class="scheda">

<div id="intest" align="left">

        <div class="nam">
     	Gestione ticket
        </div>


    
        <div class="subnam">
        Concorso attuale: n&deg;<?php echo $row_con['id'] ?> 
        <div style="font-size:12px;"> 
        Aperto il: <?php echo date_format($data_inizio, 'd/m/Y');  ?> - Termina il <?php echo date_format($data_finale, 'd/m/Y'); ?>
        </div>
		</div>

</div>

<div class="sp">&nbsp;</div>


<?php 

if (empty($dettagli))
{
require_once('search_tic_box.php'); 
require_once('total_tic_box.php'); 
require_once('tic_estrai.php'); 
}

else 
{
			switch($dettagli)
			{
			case "view":
			require_once('total_tic_box_det.php'); 
			break;
			
			case "search":
			require_once('search_tic_box.php');
			if (!empty($searchtxt)) { require_once('tic_search.php'); }
			break;
		
			case "ver":
			require_once('total_tic_box_ver.php'); 
			break;

			 
			break;
			}
}

?>





</div>


<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>