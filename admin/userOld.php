<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione Iscritti';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "iscritti";
$coldx = "no";

@$user_id = $_REQUEST['user_id'];
@$azione = $_REQUEST['azione'];
@$dettagli = $_REQUEST['dettagli'];

        mysqli_select_db($admin,$database_admin);
        $query_user2 ="SELECT * FROM millebytesdb.t_user_history where user_id='$user_id' order by event_date DESC limit 1 ;";
        $user2 = mysqli_query($admin,$query_user2) ;
        $row_user2 = mysqli_fetch_assoc($user2);
        $totalRows_user2 = mysqli_num_rows($user2);
		
		$query_m2 = "SELECT count(*) as total  FROM millebytesdb.t_user_history where user_id='$user_id' and event_type='interview_complete'";
		$m2_close = mysqli_query($admin,$query_m2) ;
		$surComp = mysqli_fetch_assoc($m2_close);


mysqli_select_db($admin,$database_admin);
$query_user = "SELECT * FROM t_user_info WHERE user_id = '$user_id'";
$user = mysqli_query($admin,$query_user) ;
$row_user = mysqli_fetch_assoc($user);
$totalRows_user = mysqli_num_rows($user);
require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

mysqli_select_db($admin,$database_admin);
$query_crm2 = "SELECT * FROM millebytesdb.t_respint WHERE uid ='$user_id' ORDER BY sid DESC";
$crm2 = mysqli_query($admin,$query_crm2) ;
$full_total_crm2 = mysqli_num_rows($crm2);
$complSur;

		while ($row = mysqli_fetch_assoc($crm2))
		{
			if ($row['status']==3) { $complSur++;}
		}	


mysqli_select_db($admin,$database_admin);
$query_story = "SELECT * FROM millebytesdb.t_user_history WHERE  user_id='$user_id' ORDER BY event_date DESC";
$story2 = mysqli_query($admin,$query_story) ;
$conta_story = mysqli_num_rows($story2);
$livelliContati=0;
$checkpoint=0;
$levRic=0;
$levRicNew=0;

 
		while ($row = mysqli_fetch_assoc($story2))
		{
			$verDate=$row['event_date'];
			$verDate = strtotime($verDate); 
			$datelimit="16-02-25";
			$datelimit_new = strtotime($datelimit); 
			
			/*echo $verDate."<br/>".$datelimit_new."<br/>";*/
			
			if($verDate>$datelimit_new)
			{
			if ($row['event_info']=="Interview complete") { $livelliContati++;  }
			if (strstr($row['event_info'],"2 Euro")) { $checkpoint=$checkpoint+8;}
			if (strstr($row['event_info'],"5 Euro")) { $checkpoint=$checkpoint+18;}
			if (strstr($row['event_info'],"9 Euro")) { $checkpoint=$checkpoint+30;}
			if (strstr($row['event_info'],"10 Euro")) { $checkpoint=$checkpoint+28;}
			if (strstr($row['event_info'],"15 Euro")) { $checkpoint=$checkpoint+40;}
			if (strstr($row['event_info'],"20 Euro")) { $checkpoint=$checkpoint+40;}
			}
			
			else 
			{
			if ($row['event_info']=="Interview complete") { $livelliContati++;  }
			if (strstr($row['event_info'],"2 Euro")) { $checkpoint=$checkpoint+10;}
			if (strstr($row['event_info'],"5 Euro")) { $checkpoint=$checkpoint+20;}
			if (strstr($row['event_info'],"9 Euro")) { $checkpoint=$checkpoint+30;}
			if (strstr($row['event_info'],"15 Euro")) { $checkpoint=$checkpoint+40;}
			}
			
			$levRicNew=$row['new_level'];
			
		
		}	
		
	$ricPagate=$checkpoint;
	$ricNonPagate=$livelliContati-$ricPagate;
	
	?>



<script type='text/javascript'>
$(document).ready(function() {
	var alta=0;
	var altRes=$('.ric').height();
	alta=altRes+320;
	$(".scheda").css("min-height",alta);
});
</script>

<div class="content-wrapper">
<div class="container">

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="panel panel-warning">	
	                        <div class="panel-heading">
                        UTENTE
                        </div>

		<div class="panel-body text-center recent-users-sec">	 
<?php if ($totalRows_user > 0) { ?>

        <div class="nam">
        <?php echo strtoupper(htmlspecialchars($row_user['first_name'])) ?> 
		<?php echo strtoupper(htmlspecialchars($row_user['second_name'])) ?> 
        <?php 
		
		if ($row_user['active'] <> 1) 
		{ echo "<span style='color:red'>  (UTENTE CANCELLATO) </span>";}
		
		?> 
        </div>
        
        <div class="subnam">
        ID: <?php echo $row_user['user_id'] ?> &nbsp;&nbsp;CITT&Agrave;: <?php echo strtoupper(htmlspecialchars($row_user['city'])) ?>
        </div>
</div>
</div>
</div>


</div>


<div class="row">


<div class="col-md-8 col-sm-8 col-xs-8">

    <div class="panel panel-primary">	
	                        <div class="panel-heading">
                        ANAGRAFICA E CONTATTI
                        </div>
 <div class="panel-body text-center recent-users-sec">	       
        <table class='table table-striped table-bordered table-hover' cellspacing="1" width="100%" >
        <tr>
        <td class="etic" align="left">Data di nascita:</td><td align="left"><?php echo htmlspecialchars(@read_time($row_user['birth_date'])) ?></td>
        <td class="etic" align="left">Registrazione:</td><td align="left"><?php echo htmlspecialchars(@read_time($row_user['reg_date'])) ?></td>
        </tr>
        <tr>
        <td class="etic" align="left">Genere:</td><td align="left"><?php echo convert_array($gender,$row_user['gender']) ?></td>
        <td class="etic" align="left">Istruzione:</td><td align="left"><?php echo convert_array($instr_level_id,$row_user['instr_level_id']) ?></td>
        </tr>
        
        <tr>
        <td class="etic" align="left">Lavoro:</td><td align="left"><?php echo convert_array($work_id,$row_user['work_id']) ?></td>
        <td class="etic" align="left">Stato Civile:</td><td align="left"><?php echo convert_array($mar_status_id,$row_user['mar_status_id']) ?></td>
        </tr>
        
        <tr>
        <td class="etic" align="left">Nazione:</td><td align="left"><?php echo $row_user['country'] ?></td>
        <td class="etic" align="left">Provincia:</td><td align="left"><?php echo convert_array($province_id,$row_user['province_id']) ?></td>
        </tr>
        
        <tr>
        <td class="etic" align="left">Indirizzo:</td><td align="left"><?php 
        
        echo $row_user['address'] ?></td>
        
        <td class="etic" align="left">Cap:</td><td align="left"><?php 
        echo $row_user['code'] ?>
        </td>
        </tr>
        
        <tr>
        <td class="etic" align="left">Tel:</td><td align="left"><?php 
        echo $row_user['home_phone'] ?>
        </td>
        
        <td class="etic" align="left">Mobile:</td><td align="left"><?php 
        echo $row_user['mobile_phone'] ?>
        </td>
        </tr>
        
        <tr>
        <td class="etic" align="left">Email:</td><td align="left"><?php 
        
        echo $row_user['email'] ?>
        </td>
        <td class="etic" align="left">Password:</td><td align="left"><?php 
        echo $row_user['pwd'] ?>
        </td>
        </tr>
        
        
        <tr>
        <td>
        
        <?php 

		$em=$row_user['email'];
		$noem="^".$em."^";
		
		
		?>

        </td>
        </tr>
        </table>
        
      </div>     
     </div>     
    </div>     
   

   
   <div class="col-md-4 col-sm-4 col-xs-4">

    <div class="panel panel-primary">	
	                        <div class="panel-heading">
                        INFO CLUB
                        </div>
 <div class="panel-body text-center recent-users-sec">	  
  
        
        <?php 

		
		$livelliNonContati=$surComp['total']-$livelliContati;
		
        ?>
            <table class='table table-striped table-bordered table-hover' cellspacing="1" width="100%" >
            <tr>
            <td class="etic" align="left">Ultima attivit&agrave;:</td><td align="left"><?php echo $row_user2['event_date'] ?></td>
            </tr>
            <tr>
            <td class="etic" align="left">Livello:</td><td align="left"><?php echo $row_user2['new_level'] ?></td>
            </tr>
            <tr>
            <td class="etic" align="left">Ricerche svolte:</td><td align="left"><?php echo $complSur ?></td>
            </tr>
            <tr>
            <td class="etic" align="left">Livelli totali:</td><td align="left"><?php echo $livelliContati ?></td>
            </tr>
            <tr>
            <td class="etic" align="left">Ric. Pagate:</td><td align="left"><?php echo $ricPagate ?></td>
            </tr>            
			<tr>
            <td class="etic" align="left">Ric. non Pagate:</td><td align="left"><?php echo $ricNonPagate ?></td>
            </tr>
            </table>

      </div>     
     </div>     
    </div>  




</div>



<div class="row">

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-default">	
	<div class="panel-heading">
     RICERCHE SVOLTE
    </div>
 <div class="panel-body text-center recent-users-sec">	  
            
<?php require_once('user_surveys_history_box.php'); ?>
</div>

</div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-default">	
	<div class="panel-heading">
     ATTIVITA' SVOLTE:    
	 </div>
 <div class="panel-body text-center recent-users-sec">	  
<?php require_once('user_club_history_box.php');

} else {
?>
Utente non trovato
<?php } ?>

</div>
</div>
</div>


</div>

 </div>     
 </div>     




<?php 

require_once('inc_footer.php'); 
?>