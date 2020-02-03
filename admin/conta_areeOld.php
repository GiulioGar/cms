<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
@$creaCamp = $_REQUEST['creaCamp'];
$sex_target=$_REQUEST['sex_target'];
$area=$_REQUEST['aree'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$currentYear=date("Y");

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$mesi3=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-3,date("d"),date("Y")));

// ultimi 2 mesi
	$query_conta = "SELECT AVG(red_panel) from t_panel_control where sur_date >'$mesi3' and stato=1 and panel=1";
	$surClo2 = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
$red=$cloSur2['AVG(red_panel)'];


$query_surv = "SELECT *  FROM t_panel_control where stato=0 AND panel<>0";
$csv_sur = mysqli_query($query_surv, $admin) or die(mysql_error());	


$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1'";
$t_user = mysqli_query($query_user, $admin) or die(mysql_error());
$t_use = mysqli_fetch_assoc($t_user);

$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=1";
$tm_user = mysqli_query($query_user, $admin) or die(mysql_error());
$tm_use = mysqli_fetch_assoc($tm_user);

$queryf_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=2";
$tf_user = mysqli_query($queryf_user, $admin) or die(mysql_error());
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
$t17_user = mysqli_query($query17_user, $admin) or die(mysql_error());
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f18' and Year(birth_date)>='$f24'";
$t18_user = mysqli_query($query18_user, $admin) or die(mysql_error());
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f25' and Year(birth_date)>='$f34'";
$t25_user = mysqli_query($query25_user, $admin) or die(mysql_error());
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f35' and Year(birth_date)>='$f44'";
$t35_user = mysqli_query($query35_user, $admin) or die(mysql_error());
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f45' and Year(birth_date)>='$f54'";
$t45_user = mysqli_query($query45_user, $admin) or die(mysql_error());
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($query55_user, $admin) or die(mysql_error());
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f65'";
$t65_user = mysqli_query($query65_user, $admin) or die(mysql_error());
$t65_use = mysqli_fetch_assoc($t65_user);

//conta aree
$tNo=0;
$tNe=0;
$tCe=0;
$tSu=0;

$query_new_at = "SELECT * FROM t_user_info where active=1";
$csv_mvf_at = mysqli_query($query_new_at, $admin) or die(mysql_error());

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
$resA = mysqli_query($del,$admin) or die(mysql_error());

////Calculator
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;


$query_new_attivi = "SELECT * FROM t_user_info where CASE WHEN $sex_target<>3 THEN gender=".$sex_target." ELSE gender !=3 END
AND active=1 and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$csv_mvf_attivi = mysqli_query($query_new_attivi, $admin) or die(mysql_error());



   while ($row = mysqli_fetch_assoc($csv_mvf_attivi)) 
    { 
	$proView=$row['province_id'];
	@include('cod_reg.php'); 
	

	
	if ($arView==$area[0] || $arView==$area[1] || $arView==$area[2] || $arView==$area[3])
	{
		
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($inTab,$admin) or die(mysql_error());
	}	
	
	}


	

$query_new = "SELECT *  FROM t_user_info,t_test where t_user_info.user_id=t_test.uid AND t_user_info.user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  LIMIT ".$goal." ";
$csv_mvf = mysqli_query($query_new, $admin) or die(mysql_error());
	



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
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
            $csv .= "\n";
    } 
	
}	


?>

<div class="menuSinistraCamp" >
<div style="font-size:16px;">
<form  action="conta_aree.php" method="get">
<div style="font-size:22px; color:#42A0DA"><b>Crea Campione: <?php echo $sid;?></b></div>
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>">

<p><div style="float:left;"><b>Ricerca:</b></div> <div style="margin-left:130px;">
<select name="sid">
<option value="">No select</option>
<?php
    while ($row = mysqli_fetch_assoc($csv_sur)) 
    {
	 echo "<option value='".$row['sur_id']."'>".$row['sur_id']."</option>";
	}
?>
</select>
</div></p>

<p><div style="float:left;"><b>Area:</b></div>
<div style="margin-left:130px;">
	<div id=''><input type="checkbox" name="aree[]" value="1"/>Nord-Ovest</div>
<div id=''>	<input type="checkbox" name="aree[]" value="2"/>Nord-Est</div>
	<div id=''><input type="checkbox" name="aree[]" value="3"/>Centro</div>
	<div id=''><input type="checkbox" name="aree[]" value="4"/>Sud</div>
 </div></p>
 
<p><div style="float:left;"><b>Target Sesso:</b></div> <div style="margin-left:130px;">
<select name="sex_target">
<option value="3">Uomo/Donna</option>
<option value="1">Uomo</option>
<option value="2">Donna</option>
</select>
</div></p>


<p><div style="float:left;"><b>Target Età:</b></div><div style="margin-left:130px;">
<input type="text" maxlength="2" style="width:40px" value=""  name="age1_target">
-
<input type="text" maxlength="2" value="" style="width:40px" name="age2_target">
</div></p>

<p><div style="float:left;"><b>N° Utenti:</b></div>
<div style="margin-left:130px;">
<input type="text" maxlength="4" value="" style="width:80px"  name="goal">
</div></p>





<div><input type="submit" name="creaCamp" value="CREA"></div>
</form>
</div>

<?php
if ($creaCamp=="CREA")	
{
?>
			<form  style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input type="image" value="submit" src="img/CSV.gif" />
				Download
				</form>		

<?php
}
?>
	
</div>

<div class="sez2"  style="margin-left:380px; max-width:650px; min-height:350px;">

	<div>
	<table class="tabdat" style="width:95%">
	<tr><th colspan="2"  ><span style="color:#032B51">Utenti disponibili</span></th></tr>
	<tr><td>
	<?php
	$red=$red/100;
	
	   $tm_useR=$tm_use['total']*$red;
	   $tf_useR=$tf_use['total']*$red;
	   $t17_useR=$t17_use['total']*$red;
	   $t18_useR=$t18_use['total']*$red;
	   $t25_useR=$t25_use['total']*$red;
	   $t35_useR=$t35_use['total']*$red;
	   $t45_useR=$t45_use['total']*$red;
	   $t55_useR=$t55_use['total']*$red;
	   $t65_useR=$t65_use['total']*$red;
	   $tNoR=$tNo*$red;
	   $tNeR=$tNe*$red;
	   $tCeR=$tCe*$red;
	   $tSuR=$tSu*$red;
	   $abR=$ab*$red;
	   $baR=$ba*$red;
	   $clR=$cl*$red;
	   $cmR=$cm*$red;
	   $emR=$em*$red;
	   $frR=$fr*$red;
	   $laR=$la*$red;
	   $liR=$li*$red;
	   $loR=$lo*$red;
	   $maR=$ma*$red;
	   $moR=$mo*$red;
	   $piR=$pi*$red;
	   $puR=$pu*$red;
	   $saR=$sa*$red;
	   $siR=$si*$red;
	   $toR=$to*$red;
	   $trR=$tr*$red;
	   $umR=$um*$red;
	   $aoR=$ao*$red;
	   $veR=$ve*$red;
	   
	?>
	
				<table class="tabdat" style="width:250px">
				<tr style="background-color:#E8F8FC"><th>&nbsp;</th><th>Disponibili</th><th>Stima</th> </tr>
				<tr style="background-color:#FCF6DE"><td>Utenti attivi:</td><td><b><?php echo $t_use['total']; ?></b> </td></tr>
				<tr style="background-color:#DEF2FC"><td>Uomini:</td><td><b><?php echo $tm_use['total']; ?></b></td><td><?php echo number_format($tm_useR,0); ?></td> </tr>
				<tr style="background-color:#FCEAF3"><td>Donne:</td><td><b><?php echo $tf_use['total']; ?></b></td><td><?php echo number_format($tf_useR,0); ?></td> </tr>
				<tr style="background-color:#F4FCEF"><td>Under 18 anni:</td><td><b><?php echo $t17_use['total']; ?></b></td><td><?php echo number_format($t17_useR,0); ?></td> </tr>
				<tr style="background-color:#F4FCEF"><td>18-24 anni:</td><td><b><?php echo $t18_use['total']; ?></b></td><td><?php echo number_format($t18_useR,0); ?></td> </tr>
				<tr style="background-color:#F4FCEF"><td>25-34 anni:</td><td><b><?php echo $t25_use['total']; ?></b> </td><td><?php echo number_format($t25_useR,0); ?></td></tr>
				<tr style="background-color:#F4FCEF"><td>35-44 anni:</td><td><b><?php echo $t35_use['total']; ?></b> </td><td><?php echo number_format($t35_useR,0); ?></td></tr>
				<tr style="background-color:#F4FCEF"><td>45-54 anni:</td><td><b><?php echo $t45_use['total']; ?></b> </td><td><?php echo number_format($t45_useR,0); ?></td></tr>
				<tr style="background-color:#F4FCEF"><td>55-64 anni:</td><td><b><?php echo $t55_use['total']; ?></b> </td><td><?php echo number_format($t55_useR,0); ?></td></tr>
				<tr style="background-color:#F4FCEF"><td>65 e Over:</td><td><b><?php echo $t65_use['total']; ?></b> </td><td><?php echo number_format($t65_useR,0); ?></td></tr>
				<tr style="background-color:#EFFFFE"><td>Nord Ovest:</td><td><b><?php echo $tNo; ?></b> </td><td><?php echo number_format($tNoR,0); ?></td></tr>
				<tr style="background-color:#EFFFFE"><td>Nord Est:</td><td><b><?php echo $tNe; ?></b> </td><td><?php echo number_format($tNeR,0); ?></td></tr>
				<tr style="background-color:#EFFFFE"><td>Centro:</td><td><b><?php echo $tCe; ?></b> </td><td><?php echo number_format($tCeR,0); ?></td></tr>
				<tr style="background-color:#EFFFFE"><td>Sud:</td><td><b><?php echo $tSu; ?></b> </td><td><?php echo number_format($tSuR,0); ?></td></tr>
	
				</table>
		</td>		
		<td>
		<table class="tabdat" style="width:290px">
		<tr style="background-color:#E8F8FC"><th>&nbsp;</th><th>Disponibili</th><th style="background-color:#B2DFFF">Stima</th> </tr>
		<tr style="background-color:#E8F8FC"><td>Abruzzo:</td><td><b><?php echo $ab; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($abR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Basilicata:</td><td><b><?php echo $ba; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($baR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Calabria:</td><td><b><?php echo $cl; ?></b></td> <td style="background-color:#B2DFFF"><b><?php echo number_format($clR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Campania:</td><td><b><?php echo $cm; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($cmR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Emilia:</td><td><b><?php echo $em; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($emR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Friuli:</td><td><b><?php echo $fr; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($frR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Lazio:</td><td><b><?php echo $la; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($laR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Liguria:</td><td><b><?php echo $li; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($liR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Lombardia:</td><td><b><?php echo $lo; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($loR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Marche:</td><td><b><?php echo $ma; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($maR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Molise:</td><td><b><?php echo $mo; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($moR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Piemonte:</td><td><b><?php echo $pi; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($piR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Puglia:</td><td><b><?php echo $pu; ?></b></td> <td style="background-color:#B2DFFF"><b><?php echo number_format($puR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Sardegna:</td><td><b><?php echo $sa; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($saR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Sicilia:</td><td><b><?php echo $si; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($siR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Toscana:</td><td><b><?php echo $to; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($toR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Trentino:</td><td><b><?php echo $tr; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($trR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Umbria:</td><td><b><?php echo $um; ?></b></td> <td style="background-color:#B2DFFF"><b><?php echo number_format($umR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>V.Aosta:</td><td><b><?php echo $ao; ?></b></td><td style="background-color:#B2DFFF"><b><?php echo number_format($aoR,0); ?></b></td> </tr>
		<tr style="background-color:#E8F8FC"><td>Veneto:</td><td><b><?php echo $ve; ?></b></td> <td style="background-color:#B2DFFF"><b><?php echo number_format($veR,0); ?></b></td> </tr>
		</table>
		
		</td></tr>
		</table>	
	</div>

 


</div>

<?php
mysql_close();
?>
