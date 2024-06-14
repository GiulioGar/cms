<?php

	  /////Target
	  mysqli_select_db($database_admin, $admin);
	  $query_trg = "SELECT * FROM elencotag ORDER BY tag ASC";
	  $tot_targ = mysqli_query($admin,$query_trg); 

$query_surv = "SELECT *  FROM t_panel_control where stato=0 AND panel=1";
$csv_sur = mysqli_query($admin,$query_surv);	


$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1'";
$t_user = mysqli_query($admin,$query_user);
$t_use = mysqli_fetch_assoc($t_user);

$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=1";
$tm_user = mysqli_query($admin,$query_user);
$tm_use = mysqli_fetch_assoc($tm_user);

$queryf_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=2";
$tf_user = mysqli_query($admin,$queryf_user);
$tf_use = mysqli_fetch_assoc($tf_user);

$currentYear=date("Y");

$und18=$currentYear-17;
$f18=$currentYear-18;
$f24=$currentYear-24;
$f25=$currentYear-25;
$f34=$currentYear-34;
$f35=$currentYear-35;
$f44=$currentYear-44;
$f45=$currentYear-45;
$f54=$currentYear-54;
$f55=$currentYear-55;
$f64=$currentYear-64;
$f65=$currentYear-65;



$query17_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)>='$und18'";
$t17_user = mysqli_query($admin,$query17_user);
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f18' and Year(birth_date)>='$f24'";
$t18_user = mysqli_query($admin,$query18_user);
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f25' and Year(birth_date)>='$f34'";
$t25_user = mysqli_query($admin,$query25_user);
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f35' and Year(birth_date)>='$f44'";
$t35_user = mysqli_query($admin,$query35_user);
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f45' and Year(birth_date)>='$f54'";
$t45_user = mysqli_query($admin,$query45_user);
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($admin,$query55_user);
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f65'";
$t65_user = mysqli_query($admin,$query65_user);
$t65_use = mysqli_fetch_assoc($t65_user);

//conta aree
$tNo=0;
$tNe=0;
$tCe=0;
$tSu=0;

$query_new_at = "SELECT * FROM t_user_info where active=1";
$csv_mvf_at = mysqli_query($admin,$query_new_at);

while ($row = mysqli_fetch_assoc($csv_mvf_at)) 
   { 
	$proView=$row['province_id'];
	@include('cod_reg.php');
	if ($arView==1) { $tNo++;}
	if ($arView==2) { $tNe++;}
	if ($arView==3) { $tCe++;}
	if ($arView==4) { $tSu++;}
	if ($reView==1) { $ab++;}
	if ($reView==2) { $ba++;}
	if ($reView==3) { $cl++;}
	if ($reView==4) { $cm++;}
	if ($reView==5) { $em++;}
	if ($reView==6) { $fr++;}
	if ($reView==7) { $la++;}
	if ($reView==8) { $li++;}
	if ($reView==9) { $lo++;}
	if ($reView==10) { $ma++;}
	if ($reView==11) { $mo++;}
	if ($reView==12) { $pi++;}
	if ($reView==13) { $pu++;}
	if ($reView==14) { $sa++;}
	if ($reView==15) { $si++;}
	if ($reView==16) { $to++;}
	if ($reView==17) { $tr++;}
	if ($reView==18) { $um++;}
	if ($reView==19) { $ao++;}
	if ($reView==20) { $ve++;}
   }

if ($azione=="CREA" || $azione=="DISPONIBILI")	
{


////Calculator
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;

$addSex="";
$addArea="";
$numArea=count($aree);
$addReg="";
$numReg=count($codregione);
$addTag="";
$fromTag="";

$contArea=0;

foreach ($aree as $valore) 
	{
	$addArea=$addArea+"area="+$valore+" ";
	if($contArea>0 && $contArea< $numArea) { $addArea=$addArea+" OR "; }
	$contArea++;

	}



if($sex_target !=3) {$addSex="gender=".$sex_target." AND "; }
if($tags !="") {$fromTag=", utenti_target t";   $addTag="target='".$tags."' AND i.user_id=t.uid AND "; }


$query_new_attivi = "SELECT * FROM t_user_info i ".$fromTag."
where  
".$addSex.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";

$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi);

$infoInserita=false;



	
if ($goal=="") {$goal=100000; }

if ($azione=="DISPONIBILI")
{
$query_contaDisp = "SELECT COUNT(*) as total FROM t_user_info i,t_test t where t.uid=i.user_id and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ";
$contaDisp= mysqli_query($admin,$query_contaDisp);
$dataDisp=mysqli_fetch_assoc($contaDisp);

}	


if ($azione=="CREA")
{
$query_crea = "SELECT *  FROM t_user_info i,t_test t where t.uid=i.user_id and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  LIMIT ".$goal." ";
$csv_mvf = mysqli_query($admin,$query_crea);
$total_rows=mysqli_num_rows($csv_mvf);
	
//lettura punteggio da assegnare
$query_cerca_punteggio = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='prize_complete'";
$cerca_punteggio = mysqli_query($admin,$query_cerca_punteggio);
$punteggio = mysqli_fetch_assoc($cerca_punteggio);

//lettura argomento da assegnare
$query_cerca_argo = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='survey_object'";
$cerca_argo = mysqli_query($admin,$query_cerca_argo);
$argomento = mysqli_fetch_assoc($cerca_argo);

//lettura punteggio da assegnare
$query_cerca_loi = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='length_of_interview'";
$cerca_loi = mysqli_query($admin,$query_cerca_loi);
$durata = mysqli_fetch_assoc($cerca_loi);

$bytes=$punteggio['value'];
$argo=$argomento['value'];
$loi=$durata['value'];


    //// ESPORTA CAMPIONE MVF IN CSV ////

    @$csv="uid;email;firstName;genderSuffix;sid;prj;argo;bytes;loi;token";
	$csv .= "\n";

	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
			$uid=$row['user_id'];		
			
	
            $mail=$row['email'];
			$nome=$row['first_name'];
			$nome=str_replace('"', "", $nome);
			$nome=str_replace("'", "", $nome);
            $sesso=$row['gender'];
            $tok=$row['token'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj.";".$argo.";".$bytes.";".$loi.";".$tok; 
			$csv .= "\n";
			
			$query_abilita = "INSERT INTO t_respint VALUES ('".$sid."','".$uid."','0','-1','".$prj."')";
			mysqli_query($admin,$query_abilita);
           
    }
	

}


}	
