<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($admin,$database_admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
@$creaCamp = $_REQUEST['creaCamp'];
$sex_target=$_REQUEST['sex_target'];
$area=$_REQUEST['aree'];
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$currentYear=date("Y");

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$query_surv = "SELECT *  FROM t_panel_control where stato=0 AND panel=1";
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
		$resTab = mysqli_query($inTab,$admin) or die(mysql_error());
	}	
	
	
	
	if ($reView==$codregione[0] || $reView==$codregione[1] || $reView==$codregione[2] || $reView==$codregione[3] || $reView==$codregione[4] || $reView==$codregione[5] || $reView==$codregione[6] || $reView==$codregione[7] || $reView==$codregione[8] || $reView==$codregione[9] || $reView==$codregione[10] || $reView==$codregione[11] || $reView==$codregione[12] || $reView==$codregione[13] || $reView==$codregione[14] || $reView==$codregione[15] || $reView==$codregione[16] || $reView==$codregione[17] || $reView==$codregione[18] || $reView==$codregione[19])
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
            
			$uid=htmlspecialchars($uid);
			$mail=htmlspecialchars($mail);
			$nome=htmlspecialchars($nome);
			$sesso=htmlspecialchars($sesso);
			$genderTransform=htmlspecialchars($genderTransform);
			
			if (!empty($uid) && !empty($mail) && !empty($nome) && !empty($genderTransform))
			{
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
            $csv .= "\n";
			}
    } 
	
}	


?>

<div class="menuSinistraCamp" >
<div style="font-size:16px;">
<form  action="conta_aree2.php" method="get">
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

<div>
Area <Input type = 'Radio' Name ='selezione' value= 'area' onclick="$('#bloccoregione').hide(),$('#bloccoarea').show()">
Regione <Input type = 'Radio' Name ='selezione' value= 'regione'  onclick="$('#bloccoarea').hide(),$('#bloccoregione').show()">
</div>

<div id='bloccoarea' style='display:none'>
<p><div id='bloccoarea' style="float:left;"><b>Area:</b></div>
<div style="margin-left:130px;">
	<div id=''><input type="checkbox" name="aree[]" value="1"/>Nord-Ovest</div>
<div id=''>	<input type="checkbox" name="aree[]" value="2"/>Nord-Est</div>
	<div id=''><input type="checkbox" name="aree[]" value="3"/>Centro</div>
	<div id=''><input type="checkbox" name="aree[]" value="4"/>Sud</div>
 </div></p>
 </div>
 
 
<div id='bloccoregione'  style='display:none'>
<p><div style="float:left;"><b>Regione:</b></div>
<div style="margin-left:130px;">
<div id=''><input type="checkbox" name="reg[]" value="1"/>ABRUZZO</div>
<div id=''>	<input type="checkbox" name="reg[]" value="2"/>BASILICATA</div>
<div id=''><input type="checkbox" name="reg[]" value="3"/>CALABRIA</div>
<div id=''><input type="checkbox" name="reg[]" value="4"/>CAMPANIA</div>
<div id=''><input type="checkbox" name="reg[]" value="5"/>EMILIA-ROMAGNA</div>
<div id=''><input type="checkbox" name="reg[]" value="6"/>FRIULI-VENEZIA GIULIA</div>
<div id=''><input type="checkbox" name="reg[]" value="7"/>LAZIO</div>
<div id=''><input type="checkbox" name="reg[]" value="8"/>LIGURIA</div>
<div id=''><input type="checkbox" name="reg[]" value="9"/>LOMBARDIA</div>
<div id=''><input type="checkbox" name="reg[]" value="10"/>MARCHE</div>
<div id=''><input type="checkbox" name="reg[]" value="11"/>MOLISE</div>
<div id=''><input type="checkbox" name="reg[]" value="12"/>PIEMONTE</div>
<div id=''><input type="checkbox" name="reg[]" value="13"/>PUGLIA</div>
<div id=''><input type="checkbox" name="reg[]" value="14"/>SARDEGNA</div>
<div id=''><input type="checkbox" name="reg[]" value="15"/>SICILIA</div>
<div id=''><input type="checkbox" name="reg[]" value="16"/>TOSCANA</div>
<div id=''><input type="checkbox" name="reg[]" value="17"/>TRENTINO-ALTO ADIGE</div>
<div id=''><input type="checkbox" name="reg[]" value="18"/>UMBRIA</div>
<div id=''><input type="checkbox" name="reg[]" value="19"/>VALLE D'AOSTA</div>
<div id=''><input type="checkbox" name="reg[]" value="20"/>VENETO</div>
 </div></p>
</div>
 
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
	<table class="tabdat" style="width:550px">
	<tr><th colspan="2"  ><span style="color:#032B51">Utenti disponibili</span></th></tr>
	<tr><td>
				<table class="tabdat" style="width:250px">
				<tr style="background-color:#FCF6DE"><td>Utenti attivi:</td><td><b><?php echo $t_use['total']; ?></b> </tr>
				<tr style="background-color:#DEF2FC"><td>Uomini:</td><td><b><?php echo $tm_use['total']; ?></b> </tr>
				<tr style="background-color:#FCEAF3"><td>Donne:</td><td><b><?php echo $tf_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>Under 18 anni:</td><td><b><?php echo $t17_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>18-24 anni:</td><td><b><?php echo $t18_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>25-34 anni:</td><td><b><?php echo $t25_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>35-44 anni:</td><td><b><?php echo $t35_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>45-54 anni:</td><td><b><?php echo $t45_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>55-64 anni:</td><td><b><?php echo $t55_use['total']; ?></b> </tr>
				<tr style="background-color:#F4FCEF"><td>65 e Over:</td><td><b><?php echo $t65_use['total']; ?></b> </tr>
				<tr style="background-color:#EFFFFE"><td>Nord Ovest:</td><td><b><?php echo $tNo; ?></b> </tr>
				<tr style="background-color:#EFFFFE"><td>Nord Est:</td><td><b><?php echo $tNe; ?></b> </tr>
				<tr style="background-color:#EFFFFE"><td>Centro:</td><td><b><?php echo $tCe; ?></b> </tr>
				<tr style="background-color:#EFFFFE"><td>Sud:</td><td><b><?php echo $tSu; ?></b> </tr>
	
				</table>
		</td>		
		<td>
		<table class="tabdat" style="width:250px">
		<tr style="background-color:#E8F8FC"><td>Abruzzo:</td><td><b><?php echo $ab; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Basilicata:</td><td><b><?php echo $ba; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Calabria:</td><td><b><?php echo $cl; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Campania:</td><td><b><?php echo $cm; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Emilia:</td><td><b><?php echo $em; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Friuli:</td><td><b><?php echo $fr; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Lazio:</td><td><b><?php echo $la; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Liguria:</td><td><b><?php echo $li; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Lombardia:</td><td><b><?php echo $lo; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Marche:</td><td><b><?php echo $ma; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Molise:</td><td><b><?php echo $mo; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Piemonte:</td><td><b><?php echo $pi; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Puglia:</td><td><b><?php echo $pu; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Sardegna:</td><td><b><?php echo $sa; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Sicilia:</td><td><b><?php echo $si; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Toscana:</td><td><b><?php echo $to; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Trentino:</td><td><b><?php echo $tr; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Umbria:</td><td><b><?php echo $um; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>V.Aosta:</td><td><b><?php echo $ao; ?></b> </tr>
		<tr style="background-color:#E8F8FC"><td>Veneto:</td><td><b><?php echo $ve; ?></b> </tr>
		</table>
		
		</td></tr>
		</table>	
	</div>

 


</div>

<?php
mysql_close();
?>
