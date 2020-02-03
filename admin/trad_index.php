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
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$currentYear=date("Y");

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$query_surv = "SELECT *  FROM trad_user_info where active=1";
$csv_sur = mysqli_query($query_surv, $admin) or die(mysql_error());	


$query_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1'";
$t_user = mysqli_query($query_user, $admin) or die(mysql_error());
$t_use = mysqli_fetch_assoc($t_user);

$query_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and gender=0";
$tm_user = mysqli_query($query_user, $admin) or die(mysql_error());
$tm_use = mysqli_fetch_assoc($tm_user);

$queryf_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and gender=1";
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



$query17_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=17";
$t17_user = mysqli_query($query17_user, $admin) or die(mysql_error());
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=24 and age>=18";
$t18_user = mysqli_query($query18_user, $admin) or die(mysql_error());
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=34 and age>=25";
$t25_user = mysqli_query($query25_user, $admin) or die(mysql_error());
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=44 and age>=35";
$t35_user = mysqli_query($query35_user, $admin) or die(mysql_error());
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=54 and age>=45";
$t45_user = mysqli_query($query45_user, $admin) or die(mysql_error());
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age<=64 and age>=55";
$t55_user = mysqli_query($query55_user, $admin) or die(mysql_error());
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM trad_user_info where active='1' and age>=65";
$t65_user = mysqli_query($query65_user, $admin) or die(mysql_error());
$t65_use = mysqli_fetch_assoc($t65_user);

//conta aree
$tNo=0;
$tNe=0;
$tCe=0;
$tSu=0;

$query_new_at = "SELECT * FROM trad_user_info where active=1";
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
AND active=1 and age<'$year1' and age>'$year2'";
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
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
            $csv .= "\n";
    } 
	
}	


?>
  <div class="content-wrapper">
       <div class="container">
	   
 <div class="row">

 
   <div class="col-md-4 col-sm-4 col-xs-12">
   <div class="panel panel-default">
   <div class="panel-heading">
   <div style="font-size:18px; color:#42A0DA"><b>Crea Campione: <?php echo $sid;?></b></div>
     </div>
	 
<div class="panel-body  recent-users-sec">

 <form role="form"  action="conta_aree2.php" method="get">

<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>">

 <div class="form-group">
  <label>Ricerca:</label>
<select class="form-control" name="sid">
<option value="">No select</option>
<?php
    while ($row = mysqli_fetch_assoc($csv_sur)) 
    {
	 echo "<option value='".$row['sur_id']."'>".$row['sur_id']."</option>";
	}
?>
</select>
</div>

<hr/>

 <div class="form-group">
     <label>Radio Button Examples</label>
  <div class="radio">
   <label>
 <input type = 'radio' name ='selezione' value= 'area' onclick="$('#bloccoregione').hide(),$('#bloccoarea').show()">Area
 </label>
 </div>
 
  <div class="radio">
     <label>
 <input type = 'radio' name ='selezione' value= 'regione'  onclick="$('#bloccoarea').hide(),$('#bloccoregione').show()">Regione
    </label>
 </div>
 
</div>
<hr/>

<div class="form-group" id='bloccoarea' style='display:none' >
<label>Area:</label>
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="aree[]" value="1"/>Nord-Ovest
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="aree[]" value="2"/>Nord-Est
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="aree[]" value="3"/>Centro
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="aree[]" value="4"/>Sud
                     </label>
                </div>
</div>

<div class="form-group" id='bloccoregione' style='display:none' >
<label>Regione:</label>
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="reg[]" value="1"/>ABRUZZO
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                    <input type="checkbox" name="reg[]" value="2"/>BASILICATA
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                     <input type="checkbox" name="reg[]" value="3"/>CALABRIA
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                    <input type="checkbox" name="reg[]" value="4"/>CAMPANIA
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                    <input type="checkbox" name="reg[]" value="5"/>EMILIA-ROMAGNA
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="6"/>FRIULI-VENEZIA GIULIA
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="7"/>LAZIO
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="8"/>LIGURIA
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                    <input type="checkbox" name="reg[]" value="9"/>LOMBARDIA
                     </label>
                </div>
                <div class="checkbox">
                     <label>
                    <input type="checkbox" name="reg[]" value="10"/>MARCHE
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="12"/>PIEMONTE
                     </label>
                </div>				
                <div class="checkbox">
                     <label>
                  <input type="checkbox" name="reg[]" value="13"/>PUGLIA
                     </label>
                </div>					
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="14"/>SARDEGNA
                     </label>
                </div>					
                <div class="checkbox">
                     <label>
                   <input type="checkbox" name="reg[]" value="15"/>SICILIA
                     </label>
                </div>					
                <div class="checkbox">
                     <label>
                  <input type="checkbox" name="reg[]" value="16"/>TOSCANA
                     </label>
                </div>	
                <div class="checkbox">
                     <label>
                 <input type="checkbox" name="reg[]" value="17"/>TRENTINO-ALTO ADIGE
                     </label>
                </div>	
                <div class="checkbox">
                     <label>
                 <input type="checkbox" name="reg[]" value="18"/>UMBRIA
                     </label>
                </div>	
                <div class="checkbox">
                     <label>
                 <input type="checkbox" name="reg[]" value="19"/>VALLE D'AOSTA
                     </label>
                </div>	
                <div class="checkbox">
                     <label>
            <input type="checkbox" name="reg[]" value="20"/>VENETO
                     </label>
                </div>				
</div>
<hr />

 <div class="form-group">
  <label>Target Sesso</label>
<select class="form-control" name="sex_target">
<option value="">No select</option>
<option value="3">Uomo/Donna</option>
<option value="1">Uomo</option>
<option value="2">Donna</option>
</select>

</div>

<hr/>

<div class="form-group">
       <label>Target Età:</label>
	   <input class="form-control" type="text" maxlength="2" style="width:90px" value=""  name="age1_target"> anni
	  <input class="form-control" type="text" maxlength="2" value="" style="width:90px" name="age2_target"> anni
</div>

<hr/>
<div class="form-group">
       <label>N° Utenti:</label>
	 <input class="form-control" type="text" maxlength="4" value="" style="width:80px"  name="goal">
</div>

<input class="btn btn-danger" type="submit" name="creaCamp" value="CREA">
 
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

</div>
</div>



<div class="col-md-8 col-sm-8 col-xs-12">

<div class="col-md-4 col-sm-4 col-xs-12">

<div class="panel panel-primary">
	<div class="panel-heading">INFO PANEL </div>
	<div class="panel-body">

				<table class="table table-striped">
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

	</div>
			<div class="panel-footer">
			&nbsp;	
			</div>	

</div>
</div>


<div class="col-md-4 col-sm-4 col-xs-12">

<div class="panel panel-success">
	<div class="panel-heading">REGIONI </div>
	<div class="panel-body">

		<table class="table table-striped">
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

	</div>


</div>
</div>



<!--fine div8-->
</div>

<!--fine row-->
</div>




 


</div>
</div>


<?php
mysql_close();
?>
