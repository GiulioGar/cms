<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  
	  $sid=$_GET['sid'];
	  $trg=$_GET['Tag'];
	  
	  
	  
	  mysqli_select_db($admin,$database_admin);
	  $query_prendicompleti = "SELECT * FROM t_respint where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%') AND (status='3'))";
	  $tot_completi = mysqli_query($admin,$query_prendicompleti) ;
	

	  
	  while ($row = mysqli_fetch_assoc($tot_completi))
		{
		 $uid=$row['uid'];

		 $sql_verificaUser="SELECT uid FROM utenti_target WHERE uid='".$uid."' AND target='".$trg."'";
		 $tot_ver = mysqli_query($admin,$sql_verificaUser) ;
		 $esiste = mysqli_num_rows($tot_ver);

		 if($esiste==0)
		 {	
		  $query_inserisci_utente_target="INSERT INTO utenti_target (uid,target) VALUES('".$uid."','".$trg."')";
		  $query_inserisci_utente_target_q = mysqli_query($admin,$query_inserisci_utente_target) ;
		  $query_inserisci_utente_target_q_t = mysqli_fetch_assoc($query_inserisci_utente_target_q);
		 }

		}
	  
	  echo "Campione Creato!!!";
	  
	  ?>
	  
