
<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

$tag=$_REQUEST['tag'];
@$openSearch = $_REQUEST['openSearch'];

if($openSearch=="Aggiungi")
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

	else{	  
	$query_user = "INSERT INTO elencotag (tag) 
	VALUES ('".$tag."')";
	mysqli_query($admin,$query_user) ;
	}
}


	
?>