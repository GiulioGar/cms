<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");
//echo "la ricerca è:".$sid." ".$prj;

    //Media redemption Panel//
	//anno 2014
	mysqli_select_db($database_admin, $admin);
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where stato=1 and sur_date like '2014%'";
	$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur = mysqli_fetch_assoc($surClo);
	
	mysqli_select_db($database_admin, $admin);
	$query_ric = "SELECT * FROM t_panel_control where stato=1 and sur_date like '2014%' ";
	$tot_close = mysqli_query($query_ric, $admin) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($tot_close))
		{
		  $totRed=$row['red_panel']+$totRed;
		}
		$medRed=$totRed/$cloSur['tot'];
	
    // ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	mysqli_select_db($database_admin, $admin);
	$query_m2 = "SELECT * FROM t_panel_control where stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($query_m2, $admin) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($m2_close))
		{
		  $totRed2=$row['red_panel']+$totRed2;
		}
		$medRed2=$totRed2/$cloSur2['tot'];

//ABILITATI PANEL INTERNO
mysqli_select_db($database_admin, $admin);
$query_user_abilitati = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%'))";
$tot_user_abilitati = mysqli_query($query_user_abilitati, $admin) or die(mysql_error());
$tot_use_abilitati = mysqli_fetch_assoc($tot_user_abilitati);


//ABILITATI PANEL ESTERNO
mysqli_select_db($database_admin, $admin);
$query_user_abilitati_ssi = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid LIKE 'IDEX%'))";
$tot_user_abilitati_ssi = mysqli_query($query_user_abilitati_ssi, $admin) or die(mysql_error());
$tot_use_abilitati_ssi = mysqli_fetch_assoc($tot_user_abilitati_ssi);


//ABILITATI TOTALE
mysqli_select_db($database_admin, $admin);
$query_user_abilitati_totali = "SELECT count(*) as total FROM t_respint where (sid='".$sid."')";
$tot_user_abilitati_totali = mysqli_query($query_user_abilitati_totali, $admin) or die(mysql_error());
$tot_use_abilitati_totali = mysqli_fetch_assoc($tot_user_abilitati_totali);



mysqli_select_db($database_admin, $admin);
$query_last_update = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$last_update = mysqli_query($query_last_update, $admin) or die(mysql_error());
$lu = mysqli_fetch_assoc($last_update);
$data_odierna=date("Y-m-d H:i:s");
$ultimo_aggiornamento=$lu['last_update'];
$salva_abilitati=$lu['abilitati'];
$stato_ricerca=$lu['stato'];
$leggi_abilitati_aggiornati=$lu['abilitati_aggiornati'];
$target_sesso=$lu['sex_target'];
$target_age_1=$lu['age1_target'];
$target_age_2=$lu['age2_target'];

if ($stato_ricerca != 1)
{
if ($lu['abilitati'] != 0)
{
if (($lu['abilitati'] != $tot_use_abilitati['total'])) 
{
// se già siamo a conoscenza dell'aggiornamento 
if ($leggi_abilitati_aggiornati==$tot_use_abilitati['total']) 
{
$data=$lu['last_update'];
}
else
{
$aggiorna_abilitati=$tot_use_abilitati['total'];
$data=date("Y-m-d H:i:s");
mysqli_select_db($database_admin, $admin);
$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
$aggiorna_abilitati_query = mysqli_query($query_aggiorna_abilitati_aggiornati, $admin) or die(mysql_error());
$aggiorna_abilitati_query_esegui = mysqli_fetch_assoc($aggiorna_abilitati_query);
}
//echo "<br>Numero abilitati modificato";
$aggiornamento=true;
}
else
{
$data=$lu['last_update'];
//echo "<br>Numero abilitati non modificato";
$aggiornamento=false;
}
}
else
{
$aggiorna_abilitati=$tot_use_abilitati['total'];
mysqli_select_db($database_admin, $admin);
$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."', abilitati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
$aggiorna_abilitati_query = mysqli_query($query_aggiorna_abilitati_aggiornati, $admin) or die(mysql_error());
$aggiorna_abilitati_query_esegui = mysqli_fetch_assoc($aggiorna_abilitati_query);
}

//echo "<br>Ultimo aggiornamento:".$ultimo_aggiornamento;
//echo "<br>Data odierna:".$data;
$confrontodata=(strtotime($data_odierna))-(strtotime($data));
$ore_differenza=($confrontodata/60)/60;
//echo "<br>Differenza:".(($confrontodata/60)/60)." ore";

//recupero tutti i file sre dalla cartella e li conto
$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
$contatti=count($fl);


if ($aggiornamento==true)
{
echo "<br>In aggiornamento tra ".$ore_differenza." ore";
}
/*
$ftp_server="46.37.21.33";
$ftp_user_name="primis";
$ftp_user_pass="Imr_PrimiFields13";
// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$contents = ftp_nlist($conn_id, "/".$prj."/".$sid."/results/");


$contatti=count($contents);
*/


//CALCOLO QUERY IN BASE AI TARGET
$query_base="SELECT count(*) as total FROM t_user_info WHERE t_user_info.active=1 AND t_user_info.user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')";


if ($target_sesso==1){$query_base=$query_base." and gender=1";}
if ($target_sesso==2){$query_base=$query_base." and gender=2";}


if ($target_age_1 <> NULL)
{
$anno_corrente = date("Y");
$anno_nascita= $anno_corrente-$target_age_1;
$query_base=$query_base." AND birth_date <= ".$anno_nascita;
}



if ($target_age_2 <> NULL)
{
$anno_corrente = date("Y")+"<br>";
$anno_nascita= $anno_corrente-$target_age_2;
$query_base=$query_base." AND birth_date >= ".$anno_nascita;
}

//echo $query_base;

/////////////////////////////////


//$qq=$_GET['txtquery'];
$qq=$query_base;

if ($qq <>'')
{
mysqli_select_db($database_admin, $admin);
$query_user_disponibili =$qq ;
$tot_user_disponibili = mysqli_query($query_user_disponibili, $admin) or die(mysql_error());
$tot_use_disponibili = mysqli_fetch_assoc($tot_user_disponibili);
}





$conta_incomplete=0;
$conta_complete=0;
$conta_filtrati=0;
$conta_quotafull=0;
$conta_incomplete_ssi=0;
$conta_complete_ssi=0;
$conta_filtrati_ssi=0;
$conta_quotafull_ssi=0;
$conta_incomplete_panel=0;
$conta_complete_panel=0;
$conta_filtrati_panel=0;
$conta_quotafull_panel=0;
for ($i = 0; $i < $contatti; $i++) {  

//trasformo la i nel formato 0001
//$nfile = sprintf('%04d', $i);

//apro il file e leggo la prima riga 
//$riga = file("ftp://primis:Imr_PrimiFields13@46.37.21.33".$contents[$i]);
//echo $fl[$i];
$riga = file($fl[$i]);
$prima_riga=$riga[0]; 
//echo $contents[$i]."<br>";


//divido il testo in array stabilendo come separatore il punto e virgola
$elementi = explode(";", $prima_riga);

//CONTA STATISTICHE TOTALI
if ($elementi[6]==0){$conta_incomplete=$conta_incomplete+1;}
if ($elementi[6]==3){$conta_complete=$conta_complete+1;}
if ($elementi[6]==4){$conta_filtrati=$conta_filtrati+1;}
if ($elementi[6]==5){$conta_quotafull=$conta_quotafull+1;}

$leggi_id=$elementi[3];
$leggi_id_parziale=substr($leggi_id,0,4);

//CONTA STATISTICHE SSI
if (($elementi[6]==0)&&($leggi_id_parziale=="IDEX")){$conta_incomplete_ssi=$conta_incomplete_ssi+1;}
if (($elementi[6]==3)&&($leggi_id_parziale=="IDEX")){$conta_complete_ssi=$conta_complete_ssi+1;}
if (($elementi[6]==4)&&($leggi_id_parziale=="IDEX")){$conta_filtrati_ssi=$conta_filtrati_ssi+1;}
if (($elementi[6]==5)&&($leggi_id_parziale=="IDEX")){$conta_quotafull_ssi=$conta_quotafull_ssi+1;}




//CONTA STATISTICHE PANEL
if (($elementi[6]==0)&&($leggi_id_parziale<>"IDEX")){$conta_incomplete_panel=$conta_incomplete_panel+1;}
if (($elementi[6]==3)&&($leggi_id_parziale<>"IDEX")){$conta_complete_panel=$conta_complete_panel+1;}
if (($elementi[6]==4)&&($leggi_id_parziale<>"IDEX")){$conta_filtrati_panel=$conta_filtrati_panel+1;}
if (($elementi[6]==5)&&($leggi_id_parziale<>"IDEX")){$conta_quotafull_panel=$conta_quotafull_panel+1;}


if ($leggi_id_parziale=="IDEX"){$panel_esterno=$panel_esterno+1;}
}



$contatti_disponibili=$tot_use_disponibili['total'];


$media_redemption_panel=($medRed+$medRed2)/2;
$media_redemption_panel=number_format($media_redemption_panel, 2);


//Calcolo redemption field totale
$redemption_field=($conta_complete/($conta_complete+$conta_filtrati))*100;
$redemption_field=number_format($redemption_field, 2);


//Calcolo redemption field ssi
$redemption_field_ssi=($conta_complete_ssi/($conta_complete_ssi+$conta_filtrati_ssi))*100;
$redemption_field_ssi=number_format($redemption_field_ssi, 2);

//Calcolo redemption field panel
$redemption_field_panel=($conta_complete_panel/($conta_complete_panel+$conta_filtrati_panel))*100;
$redemption_field_panel=number_format($redemption_field_panel, 2);


$contatti_panel=$contatti-$panel_esterno;
//REDEMPTION PANEL
if ($lu['abilitati'] != 0)
{

if (($ore_differenza>24)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/$tot_use_abilitati['total'])*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$tot_use_abilitati['total'];
}
else
{
$redemption_panel=($contatti_panel/$salva_abilitati)*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
}
}
else
{
$redemption_panel=($contatti_panel/$tot_use_abilitati['total'])*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$tot_use_abilitati['total'];
}
//Calcolo previsione
$previsione=($contatti_disponibili/100)*$media_redemption_panel;
$previsione=($previsione/100)*$redemption_field;
$previsione=number_format($previsione, 0);




 





?>
<script type="text/javascript">
<!--
function CompilaQuery()
{
var data = new Date();
var anno_corrente = data.getFullYear();

var eta;
var op;
if (document.getElementById('campo').value != 'birth_date')
{document.getElementById('query').value+=document.getElementById('logica').value+' '+document.getElementById('campo').value+document.getElementById('operatore').value+document.getElementById('valore').value+' ';}
else
{
if (document.getElementById('operatore').value=='>'){op='<';}
if (document.getElementById('operatore').value=='<'){op='>';}
if (document.getElementById('operatore').value=='>='){op='<=';}
if (document.getElementById('operatore').value=='<='){op='>=';}
if (document.getElementById('operatore').value=='='){op='=';}
eta=anno_corrente-document.getElementById('valore').value;
document.getElementById('query').value+=document.getElementById('logica').value+' '+document.getElementById('campo').value+op+eta+' ';
}
}
-->

var regiondb = new Object()
regiondb["gender"] = [{value:"1", text:"Maschio"},
                      {value:"2", text:"Femmina"},
                     ];
					  
					  
regiondb["birth_date"] = [
{value:"1", text:"1"},
{value:"2", text:"2"},
{value:"3", text:"3"},
{value:"4", text:"4"},
{value:"5", text:"5"},
{value:"6", text:"6"},
{value:"7", text:"7"},
{value:"8", text:"8"},
{value:"9", text:"9"},
{value:"10", text:"10"},
{value:"11", text:"11"},
{value:"12", text:"12"},
{value:"13", text:"13"},
{value:"14", text:"14"},
{value:"15", text:"15"},
{value:"16", text:"16"},
{value:"17", text:"17"},
{value:"18", text:"18"},
{value:"19", text:"19"},
{value:"20", text:"20"},
{value:"21", text:"21"},
{value:"22", text:"22"},
{value:"23", text:"23"},
{value:"24", text:"24"},
{value:"25", text:"25"},
{value:"26", text:"26"},
{value:"27", text:"27"},
{value:"28", text:"28"},
{value:"29", text:"29"},
{value:"30", text:"30"},
{value:"31", text:"31"},
{value:"32", text:"32"},
{value:"33", text:"33"},
{value:"34", text:"34"},
{value:"35", text:"35"},
{value:"36", text:"36"},
{value:"37", text:"37"},
{value:"38", text:"38"},
{value:"39", text:"39"},
{value:"40", text:"40"},
{value:"41", text:"41"},
{value:"42", text:"42"},
{value:"43", text:"43"},
{value:"44", text:"44"},
{value:"45", text:"45"},
{value:"46", text:"46"},
{value:"47", text:"47"},
{value:"48", text:"48"},
{value:"49", text:"49"},
{value:"50", text:"50"},
{value:"51", text:"51"},
{value:"52", text:"52"},
{value:"53", text:"53"},
{value:"54", text:"54"},
{value:"55", text:"55"},
{value:"56", text:"56"},
{value:"57", text:"57"},
{value:"58", text:"58"},
{value:"59", text:"59"},
{value:"60", text:"60"},
{value:"61", text:"61"},
{value:"62", text:"62"},
{value:"63", text:"63"},
{value:"64", text:"64"},
{value:"65", text:"65"},
{value:"66", text:"66"},
{value:"67", text:"67"},
{value:"68", text:"68"},
{value:"69", text:"69"},
{value:"70", text:"70"},
{value:"71", text:"71"},
{value:"72", text:"72"},
{value:"73", text:"73"},
{value:"74", text:"74"},
{value:"75", text:"75"},
{value:"76", text:"76"},
{value:"77", text:"77"},
{value:"78", text:"78"},
{value:"79", text:"79"},
{value:"80", text:"80"},
{value:"81", text:"81"},
{value:"82", text:"82"},
{value:"83", text:"83"},
{value:"84", text:"84"},
{value:"85", text:"85"},
{value:"86", text:"86"},
{value:"87", text:"87"},
{value:"88", text:"88"},
{value:"89", text:"89"},
{value:"90", text:"90"},
{value:"91", text:"91"},
{value:"92", text:"92"},
{value:"93", text:"93"},
{value:"94", text:"94"},
{value:"95", text:"95"},
{value:"96", text:"96"},
{value:"97", text:"97"},
{value:"98", text:"98"},
{value:"99", text:"99"}
					];
					
					



function setCities(chooser) {
    var newElem;
    var where = (navigator.appName == "Microsoft Internet Explorer") ? -1 : null;
    var cityChooser = chooser.form.elements["argomento"];
    while (cityChooser.options.length) {
        cityChooser.remove(0);
    }
    var choice = chooser.options[chooser.selectedIndex].value;
    var db = regiondb[choice];
    newElem = document.createElement("option");
    newElem.text = "Seleziona un argomento:";
    newElem.value = "";
    cityChooser.add(newElem, where);
    if (choice != "") {
        for (var i = 0; i < db.length; i++) {
            newElem = document.createElement("option");
            newElem.text = db[i].text;
            newElem.value = db[i].value;
            cityChooser.add(newElem, where);
        }
    }
}




</script>

<div style="float:left;">
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<div style="float:left;">
<table border="1" cellpadding="4" >
<tr>
<td>
COMPLETI:
</td>
<td>
<?php echo  $conta_complete; ?>
</td>
</tr>

<tr>
<td>
FILTRATI:
</td>
<td>
<?php echo  $conta_filtrati; ?>
</td>
</tr>

<tr>
<td>
QUOTAFULL:
</td>
<td>
<?php echo  $conta_quotafull; ?>
</td>
</tr>


<tr>
<td>
INCOMPLETE:
</td>
<td>
<?php echo  $conta_incomplete; ?>
</td>
</tr>


<tr>
<td>
CONTATTI:
</td>
<td>
<?php echo  $contatti; ?>
</td>



<tr>
<td>
ABILITATI:
</td>
<td>
<?php echo  $tot_use_abilitati_totali['total']; ?>
</td>
</tr>



<tr>
<td>
REDEMPTION FIELD:
</td>
<td>
<?php echo  $redemption_field."%"; ?>
</td>
</tr>
</table>
</div>


<div style="float:left;">
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>



<div style="float:left;">
<table border="1" cellpadding="4">
<tr>
<td>
COMPLETI SSI:
</td>
<td>
<?php echo  $conta_complete_ssi; ?>
</td>
</tr>

<tr>
<td>
FILTRATI SSI:
</td>
<td>
<?php echo  $conta_filtrati_ssi; ?>
</td>
</tr>

<tr>
<td>
QUOTAFULL SSI:
</td>
<td>
<?php echo  $conta_quotafull_ssi; ?>
</td>
</tr>


<tr>
<td>
INCOMPLETE SSI:
</td>
<td>
<?php echo  $conta_incomplete_ssi; ?>
</td>
</tr>


<tr>
<td>
CONTATTI SSI:
</td>
<td>
<?php echo  $panel_esterno; ?>
</td>



<tr>
<td>
ABILITATI SSI:
</td>
<td>
<?php echo  $tot_use_abilitati_ssi['total']; ?>
</td>
</tr>



<tr>
<td>
REDEMPTION FIELD SSI:
</td>
<td>
<?php echo  $redemption_field_ssi."%"; ?>
</td>
</tr>
</table>
</div>



<div style="float:left;">
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>


<div style="float:left;">
<table border="1" cellpadding="4">
<tr>
<td>
COMPLETI PANEL:
</td>
<td>
<?php echo  $conta_complete_panel; ?>
</td>
</tr>

<tr>
<td>
FILTRATI PANEL:
</td>
<td>
<?php echo  $conta_filtrati_panel; ?>
</td>
</tr>

<tr>
<td>
QUOTAFULL PANEL:
</td>
<td>
<?php echo  $conta_quotafull_panel; ?>
</td>
</tr>


<tr>
<td>
INCOMPLETE PANEL:
</td>
<td>
<?php echo  $conta_incomplete_panel; ?>
</td>
</tr>


<tr>
<td>
CONTATTI PANEL:
</td>
<td>
<?php echo  $contatti_panel; ?>
</td>



<tr>
<td>
ABILITATI PANEL:
</td>
<td>
<?php echo  $tot_use_abilitati['total']; ?>
</td>
</tr>



<tr>
<td>
REDEMPTION FIELD PANEL:
</td>
<td>
<?php echo  $redemption_field_panel."%"; ?>
</td>
</tr>
</table>
</div>



<div style="float:left;">
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<div style="float:left;">
<table border="1" cellpadding="4">
<tr>
<td>
CONTATTI DISPONIBILI:
</td>
<td>
<?php echo  $contatti_disponibili; ?>
</td>
</tr>

<tr>
<td>
MEDIA REDEMPTION PANEL:
</td>
<td>
<?php echo  $media_redemption_panel."%"; ?>
</td>
</tr>



<tr>
<td>
REDEMPTION PANEL:
</td>
<td>
<?php echo  $redemption_panel."%"; ?>
</td>
</tr>



<tr>
<td>
PREVISIONE:
</td>
<td>
<?php echo  $previsione ?>
</td>
</tr>



</table>
</div>

<br><br>

<?php

mysqli_select_db($database_admin, $admin);
$query_aggiorna_statistiche = "UPDATE t_panel_control set abilitati='".$totale_user_abilitati."', contatti='".$contatti_panel."', filtrati='".$conta_filtrati."', quota_full='".$conta_quotafull."',incomplete='".$conta_incomplete."',panel_interno='".$contatti_panel."',contatti_totali='".$contatti."',panel_esterno='".$panel_esterno."', red_panel='".$redemption_panel."', last_update='".$data."', complete='".$conta_complete."', red_surv='".$redemption_field."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($query_aggiorna_statistiche, $admin) or die(mysql_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
?>

<!--
<form id="form1" name="form1" action="conta_locale.php" method="GET">
<input type="hidden" name="prj" value="<?php echo $prj?>">
<input type="hidden" name="sid" value="<?php echo $sid?>">
<select id='logica'>
    <option value="AND">AND</option>
    <option value="OR">OR</option>
</select> 

          <select name="menù" onchange="setCities(this)" id='campo'>
          <option value="" selected="selected">Seleziona una categoria:</option>
		  <option value="gender">Genere:</option>
		  <option value="birth_date">Eta:</option>
           
		  </select>

		  
<select name="operatore" id="operatore">
<option value="" selected="selected">Seleziona un operatore:</option>
 <option value="=">=</option>
 <option value="<"><</option>
 <option value="<="><=</option>
 <option value=">">></option>
 <option value=">=">>=</option>
</select> 		  
		  
<select name="argomento" id="valore">
<option value="" selected="selected">Seleziona un argomento:</option>
</select> 

<button type="button" onclick="javascript:CompilaQuery()">Aggiungi</button> 
<br>
        
 
<textarea id="query" name="txtquery" rows="4" cols="50">
SELECT count(*) as total FROM t_user_info WHERE t_user_info.active=1 AND t_user_info.user_id NOT IN (SELECT uid FROM t_respint where sid='<?php echo $sid?>')
</textarea> 
<button type="submit">Verifica</button> 
 </form>
 -->
<?php
}
else
{
echo "<br>La ricerca è chiusa!!!";
}
?>

