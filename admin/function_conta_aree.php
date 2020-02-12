<?php

$query_surv = "SELECT *  FROM t_panel_control where stato=0 AND panel<>0";
$csv_sur = mysqli_query($admin,$query_surv) or die(mysql_error());	


$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1'";
$t_user = mysqli_query($admin,$query_user) or die(mysql_error());
$t_use = mysqli_fetch_assoc($t_user);

$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=1";
$tm_user = mysqli_query($admin,$query_user) or die(mysql_error());
$tm_use = mysqli_fetch_assoc($tm_user);

$queryf_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=2";
$tf_user = mysqli_query($admin,$queryf_user) or die(mysql_error());
$tf_use = mysqli_fetch_assoc($tf_user);

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
$t17_user = mysqli_query($admin,$query17_user) or die(mysql_error());
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f18' and Year(birth_date)>='$f24'";
$t18_user = mysqli_query($admin,$query18_user) or die(mysql_error());
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f25' and Year(birth_date)>='$f34'";
$t25_user = mysqli_query($admin,$query25_user) or die(mysql_error());
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f35' and Year(birth_date)>='$f44'";
$t35_user = mysqli_query($admin,$query35_user) or die(mysql_error());
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f45' and Year(birth_date)>='$f54'";
$t45_user = mysqli_query($admin,$query45_user) or die(mysql_error());
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($admin,$query55_user) or die(mysql_error());
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f65'";
$t65_user = mysqli_query($admin,$query65_user) or die(mysql_error());
$t65_use = mysqli_fetch_assoc($t65_user);

//conta aree
$tNo=0;
$tNe=0;
$tCe=0;
$tSu=0;

$query_new_at = "SELECT * FROM t_user_info where active=1";
$csv_mvf_at = mysqli_query($admin,$query_new_at) or die(mysql_error());

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

if ($creaCamp=="CREA")	
{

//echo "la ricerca è:".$sid." ".$prj;

$del="DELETE FROM t_test";
$resA = mysqli_query($admin,$del) or die(mysql_error());

////Calculator
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;


$query_new_attivi = "SELECT * FROM t_user_info where CASE WHEN $sex_target<>3 THEN gender=".$sex_target." ELSE gender !=3 END
AND active=1 and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi) or die(mysql_error());



   while ($row = mysqli_fetch_assoc($csv_mvf_attivi)) 
    { 
	$proView=$row['province_id'];
	@include('cod_reg.php'); 
	

	
	if ($arView==$area[0] || $arView==$area[1] || $arView==$area[2] || $arView==$area[3])
	{
		
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($admin,$inTab) or die(mysql_error());
	}	
	
	
	
	if ($reView==$codregione[0] || $reView==$codregione[1] || $reView==$codregione[2] || $reView==$codregione[3] || $reView==$codregione[4] || $reView==$codregione[5] || $reView==$codregione[6] || $reView==$codregione[7] || $reView==$codregione[8] || $reView==$codregione[9] || $reView==$codregione[10] || $reView==$codregione[11] || $reView==$codregione[12] || $reView==$codregione[13] || $reView==$codregione[14] || $reView==$codregione[15] || $reView==$codregione[16] || $reView==$codregione[17] || $reView==$codregione[18] || $reView==$codregione[19])
	{
		
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($admin,$inTab) or die(mysql_error());
	}
	
	
	
	}


	

$query_new = "SELECT *  FROM t_user_info i,t_test t where t.uid=i.user_id and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  LIMIT ".$goal." ";
$csv_mvf = mysqli_query($admin,$query_new);
	



    //// ESPORTA CAMPIONE MVF IN CSV ////


    @$csv="uid;email;firstName;genderSuffix";
    $csv .= "\n";
	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
            $uid=$row['user_id'];		
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj; 
            $csv .= "\n";
           
    }
	
}	


