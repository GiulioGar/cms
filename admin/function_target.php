
<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

$action=$_REQUEST['azione'];
$tag=$_REQUEST['tag'];

//aggiungi uids
$trg=$_GET['Tag'];
@$nome=$_REQUEST["idval"];

if($action=="aggiungiTag")
{

$query_surv = "SELECT tag  FROM elencotag";
$controlSur = mysqli_query($admin,$query_surv) ;

$duplicate=0;
while ($row = mysqli_fetch_assoc($controlSur))
{
	$verId=$row['tag'];
	if ($verId==$tag) { $duplicate=$duplicate+1;}
}
if($duplicate>0) { ?> 

<div title="Attenzione!" class="dialog-message">Attenzione questo tag &egrave; gi&agrave; stato inserito!</div>

 <?php  }

	else
	{	  
	$query_user = "INSERT INTO elencotag (tag) 
	VALUES ('".$tag."')";
	mysqli_query($admin,$query_user) ;
	}

}

if($action=="aggiungiUser")
{
///aggiungi uids


if ($nome<>"")
{
@$array=explode("\n",$nome);
@$Carr=count($array);
}



if ($Carr<> 0)
{	
  
	foreach($array as $arrV)  
	{
	 $query_inserisci_utente_target="INSERT INTO utenti_target (uid,target) SELECT '".$arrV."','".$trg."' FROM DUAL WHERE NOT EXISTS (SELECT uid FROM utenti_target WHERE uid='".$arrV."' AND target='".$trg."');";
	 $query_inserisci_utente_target_q = mysqli_query($admin,$query_inserisci_utente_target) ;
	 $query_inserisci_utente_target_q_t = mysqli_fetch_assoc($query_inserisci_utente_target_q);
	}
}

}

$query_user = "SELECT COUNT(*) as total FROM utenti_target where target='$trg'";
$tot_user = mysqli_query($admin,$query_user) ;
$tot_use = mysqli_fetch_assoc($tot_user);

	
?>

<div id="newVal"><?php echo $tot_use['total']; ?></div>