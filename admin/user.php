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

  
<hr>
<div class="content-wrapper">
<div class="container bootstrap snippet">

<div class="col-sm-10"><h1><?php echo strtoupper(htmlspecialchars($row_user['first_name'])) ?> 
<?php echo strtoupper(htmlspecialchars($row_user['second_name'])) ?> </h1></div>

 <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

               
          <div class="card card-default">
            <div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="card-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>
          <hr>
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
          </ul> 

          <hr>
               
          <div class="card panel-default">
            <div class="card-header">Social Media</div>
            <div class="card-body">
                
            
            </div>
          </div>
          
        </div><!--/col-3-->

 <div class="col-sm-9">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab" data-toggle="tab" href="#inviti" role="tab" aria-controls="inviti" aria-selected="true">Dati Panel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab" data-toggle="tab" href="#registra" role="tab" aria-controls="registra" aria-selected="false">Crea Campione</a>
  </li>
</ul>

 <div class="tab-content">
            <div class="tab-pane active" id="inviti">
            <hr>
                   TESTO 1
            <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="registra">
               
               <h2></h2>
               
               <hr>

               TESTO 2
             </div><!--/tab-pane-->
             
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->             


</div><!--/col-12-->

</div>






</div>
<?php 

require_once('inc_footer.php'); 
?>