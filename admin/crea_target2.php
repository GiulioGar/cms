<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  
	  $trg=$_GET['Tag'];
	  @$nome=$_REQUEST["idval"];
	  
	  
	 if ($nome<>"")
	{
	@$array=explode("\n",$nome);
	@$Carr=count($array);
	}

	if ($Carr<> 0)
	{	
	  
		foreach($array as $arrV)  
		{
		  mysqli_select_db($database_admin, $admin);	
		 $query_inserisci_utente_target="INSERT INTO utenti_target (uid,target) SELECT '".$arrV."','".$trg."' FROM DUAL WHERE NOT EXISTS (SELECT uid FROM utenti_target WHERE uid='".$arrV."' AND target='".$trg."');";
		 $query_inserisci_utente_target_q = mysqli_query($query_inserisci_utente_target, $admin) or die(mysql_error());
		 $query_inserisci_utente_target_q_t = mysqli_fetch_assoc($query_inserisci_utente_target_q);
		}
	}
	  echo "Campione Creato!!!";
	  
	  ?>
	  
