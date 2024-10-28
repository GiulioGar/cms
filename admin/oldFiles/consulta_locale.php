<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";


$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];

echo "la ricerca è:".$sid." ".$prj;



mysqli_select_db($database_admin, $admin);
$query_ricerca = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$tot_ricerca = mysqli_query($query_ricerca, $admin) or die(mysql_error());
$row = mysqli_fetch_assoc($tot_ricerca);





$qq=$_GET['txtquery'];
if ($qq <>'')
{
mysqli_select_db($database_admin, $admin);
$query_user_disponibili =$qq ;
$tot_user_disponibili = mysqli_query($query_user_disponibili, $admin) or die(mysql_error());
$tot_use_disponibili = mysqli_fetch_assoc($tot_user_disponibili);
}

$contatti_disponibili=$tot_use_disponibili['total'];
$media_redemption_panel=4.5;


//Calcolo redemption field
$redemption_field=$row['red_surv'];
$redemption_field=number_format($redemption_field, 2);


$contatti_panel=$contatti-$panel_esterno;
//REDEMPTION PANEL


$redemption_panel=$row['red_panel'];
$redemption_panel=number_format($redemption_panel,2);


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
<div>
<table border="1" cellpadding="4">
<tr>
<td>
COMPLETI:
</td>
<td>
<?php echo  $row['complete']; ?>
</td>
</tr>

<tr>
<td>
FILTRATI:
</td>
<td>
<?php echo  $row['filtrati']; ?>
</td>
</tr>

<tr>
<td>
QUOTAFULL:
</td>
<td>
<?php echo  $row['quota_full']; ?>
</td>
</tr>


<tr>
<td>
INCOMPLETE:
</td>
<td>
<?php echo  $row['incomplete']; ?>
</td>
</tr>


<tr>
<td>
CONTATTI:
</td>
<td>
<?php echo  $row['contatti_totali']; ?>
</td>



<tr>
<td>
ABILITATI:
</td>
<td>
<?php echo  $row['abilitati']; ?>
</td>
</tr>



<tr>
<td>
PANEL INTERNO:
</td>
<td>
<?php echo  $row['panel_interno']; ?>
</td>
</tr>



<tr>
<td>
PANEL ESTERNO:
</td>
<td>
<?php echo  $row['panel_esterno']; ?>
</td>
</tr>
</table>
</div>

<br><br>

<div>
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
<?php echo  $row['red_panel']."%"; ?>
</td>
</tr>


<tr>
<td>
REDEMPTION FIELD:
</td>
<td>
<?php echo  $row['red_surv']."%"; ?>
</td>
</tr>


<tr>
<td>
PREVISIONE:
</td>
<td>
<?php echo  $previsione; ?>
</td>
</tr>



</table>
</div>

<br><br>



<form id="form1" name="form1" action="consulta_locale.php" method="GET">
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


