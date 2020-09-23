
<?php

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
$query_part = "SELECT * FROM millebytesdb.t_respint WHERE uid ='$user_id' ORDER BY sid DESC";
$part = mysqli_query($admin,$query_part) ;

$full_total_crm2 = mysqli_num_rows($part);
$todoAct;

		while ($row = mysqli_fetch_assoc($part))
		{
		    if ($row['status']<>0) { $todoAct++;}
		}	


$perAct=($todoAct/$full_total_crm2)*100;

if ($perAct>50) { $levAct="Ottima"; }
if ($perAct<=49 && $perAct>=30) { $levAct="Buona"; }
if ($perAct<=29 && $perAct>=15) { $levAct="Media"; }
if ($perAct<=14 && $perAct>=10) { $levAct="Scarsa"; }
if ($perAct<=9 && $perAct>=1) { $levAct="Molto bassa"; }
if ($perAct<1) { $levAct="Nulla"; }

mysqli_select_db($admin,$database_admin);
$query_crm2 = "SELECT * FROM millebytesdb.t_user_history WHERE user_id ='$user_id' ORDER BY event_date DESC";
$crm2 = mysqli_query($admin,$query_crm2) ;
$complSur=0;
$premiRic=0;

$infoStory = []; //create array

		while ($row = mysqli_fetch_assoc($crm2))
		{
			if ($row['event_type']=="interview_complete" || $row['event_type']=="interview_complete_cint") { $complSur++;}
			if ($row['event_type']=="withdraw") { $premiRic++;}

			$infoStory[] = $row;
		}	


mysqli_select_db($admin,$database_admin);
$query_story = "SELECT * FROM millebytesdb.t_history_copia WHERE  user_id='$user_id' ORDER BY event_date DESC";
$story2 = mysqli_query($admin,$query_story) ;
$conta_story = mysqli_num_rows($story2);

$prePag=0;
$preNoPag=0;

$infoPremi = []; //create array

while ($row = mysqli_fetch_assoc($story2))
{
    if ($row['pagato']==1) { $prePag++;}
    if ($row['pagato']==0) { $preNoPag++;}

    $infoPremi[] = $row;

}	


//lettura respint
mysqli_select_db($admin,$database_admin);
$query_resp = "SELECT * FROM millebytesdb.t_respint WHERE uid ='$user_id' ORDER BY sid DESC";
$resp= mysqli_query($admin,$query_resp);
$full_total_resp = mysqli_num_rows($resp);

$staInv=$full_total_resp;

$staSosp=0;
$staNone=0;
$staComp=0;
$staFil=0;
$staQuot=0;

while ($row = mysqli_fetch_assoc($resp))
{

	if ($row['status']==0) { $staNone++;}
	if ($row['status']==1) { $staSosp++;}
	if ($row['status']==3) { $staComp++; }
	if ($row['status']==4) { $staFil++;}
	if ($row['status']==5) { $staQuot++;}

}


	
	?>