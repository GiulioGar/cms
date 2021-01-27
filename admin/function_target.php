
<?php

error_reporting(E_ALL);

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 



$action=$_REQUEST['azione'];
$tag=$_REQUEST['tag'];

//aggiungi tag
$trg=$_REQUEST['Tag'];
$nome=$_REQUEST["idval"];
 

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
	$inserisciUid=trim($arrV);

	$sql_verificaUser="SELECT uid FROM utenti_target WHERE uid='".$inserisciUid."' AND target='".$trg."'";
	$tot_ver = mysqli_query($admin,$sql_verificaUser) ;
	$esiste = mysqli_num_rows($tot_ver);


	if($esiste==0)
	{	
	 $query_inserisci_utente_target="INSERT INTO utenti_target (uid,target) VALUES('".$inserisciUid."','".$trg."')";
	 $query_inserisci_utente_target_q = mysqli_query($admin,$query_inserisci_utente_target) ;
	 $query_inserisci_utente_target_q_t = mysqli_fetch_assoc($query_inserisci_utente_target_q);
	}

	}
}

}

$query_user = "SELECT COUNT(*) as total FROM utenti_target where target='$trg'";
$tot_user = mysqli_query($admin,$query_user) ;
$tot_use = mysqli_fetch_assoc($tot_user);

$tagClass=trim($trg);
$tagClass= str_replace(' ', '', $tagClass);

$stimate=ceil(($tot_use['total']/100)*55);
?>

<div class="tot<?php echo $tagClass; ?>" id="newVal"><?php echo $tot_use['total']; ?></div>
<div class="sti<?php echo $tagClass; ?>" id="newSti"><b><?php echo $stimate; ?></b></div>

