<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  
$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Info utenti';
$areapagina = "iscritti";
$coldx = "no";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL | E_STRICT);

require_once('inc_taghead.php');

@$cLdat=$_REQUEST["dat"];
@$nome=$_REQUEST["idval"];
@$azione = $_REQUEST['azione'];
mysqli_select_db($admin,$database_admin);


if ($azione == "ricerca")
{




	
}

require_once('inc_tagbody.php'); 
?>

<div class="content-wrapper">
 <div class="container">
 
<div class="row">

 <div class="col-md-6">
 <div class="card shadow mb-6">

 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> INSERIRE UID </h6></span>
 </div>
 <div class="card-body recent-users-sec">


<form action="user_info.php" method="POST">

 <div class="form-group">
<textarea class="form-control" name="idval" cols="15" rows="20"></textarea>
</div>

</div>
</div>
</div>

 <div class="col-md-6 col-sm-6 col-xs-6">
  <div class="card card-primary shadow mb-6">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> Selezionare i dati da visualizzare:</h6></span>
 </div>

 <div class="card-body recent-users-sec">
	 
 
    <div class="form-check">
                <label>
                <input class="form-check-input" name="dat[0]" value="v1" type="checkbox" />&nbsp;Nome
                </label>
                 </div>
 
   <div class="checkbox">
                <label>
<input name="dat[1]" value="v2" type="checkbox" />&nbsp;E Mail
                </label>
                 </div>

   <div class="checkbox">
                <label>
<input name="dat[2]" value="v3" type="checkbox" />&nbsp;Sesso
                </label>
                 </div>
				 
   <div class="checkbox">
                <label>				 
<input name="dat[3]" value="v4" type="checkbox" />&nbsp;Et&agrave;
                </label>
                 </div>
				 
   <div class="checkbox">
                <label>
<input name="dat[4]" value="v5" type="checkbox" />&nbsp;Provincia
                </label>
                 </div>
				 
   <div class="checkbox">
                <label>				 
<input name="dat[8]" value="v9" type="checkbox" />&nbsp;Regione
                </label>
                 </div>
				 
   <div class="checkbox">
                <label>				 
<input name="dat[9]" value="v10" type="checkbox" />&nbsp;Area
                </label>
				 </div>
				 
<div class="checkbox">
<label>				 
<input name="dat[5]" value="v6" type="checkbox" />&nbsp;Lavoro
</label>
</div>

<div class="checkbox">
<label>				 
<input name="dat[11]" value="v11" type="checkbox" />&nbsp;CAP
</label>
</div>

   <div class="checkbox">
                <label>
<input name="dat[6]" value="v7" type="checkbox" />&nbsp;Istruzione
                </label>
                 </div>
   <div class="checkbox">
                <label>
<input name="dat[7]" value="v8" type="checkbox" />&nbsp;Status
                </label>
                 </div>

<input type="hidden" name="azione" value="ricerca"  /> 
<button class="btn btn-primary" name="submit" type="submit" value="CERCA" >CERCA</div></td>


</form>
</div>
</div>

</div>

<?php 
if ($azione =="ricerca")
{

	if ($nome<>"")
	{
	$array=explode("\n",$nome);
	$Carr=count($array);
	}



if ($Carr>0)
{ 
		?>

<div class="row">

 <div class="col-md-12">
  <div class="card card-primary">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> Utenti trovati:</h6></span>
 </div>
 <div class="panel-body recent-users-sec">

<table class="table table-striped table-bordered" style="font-size:12px;" >
				<?php

				$csv="uid";

				echo "<tr>";
				echo "<td>ID</td>";
				if ($cLdat[0]=="v1"){echo "<td>NOME</td>"; $csv .=";NOME";}
				if ($cLdat[1]=="v2"){echo "<td>EMAIL</td>"; $csv .=";EMAIL";}
				if ($cLdat[2]=="v3"){echo "<td>SESSO</td>";  $csv .=";SESSO";}
				if ($cLdat[3]=="v4"){echo "<td>ET&Agrave;</td>";  $csv .=";ET&Agrave;";}
				if ($cLdat[4]=="v5"){echo "<td>PROVINCIA</td>";  $csv .=";PROVINCIA";}
				if ($cLdat[8]=="v9"){echo "<td>REGIONE</td>";  $csv .=";REGIONE";}
				if ($cLdat[9]=="v10"){echo "<td>AREA</td>";  $csv .=";AREA";}
				if ($cLdat[5]=="v6"){echo "<td>LAVORO</td>"; $csv .=";LAVORO";}
				if ($cLdat[6]=="v7"){echo "<td>TITOLO</td>"; $csv .=";TITOLO";}
				if ($cLdat[7]=="v8"){echo "<td>STATUS</td>";  $csv .=";STATUS";}
				if ($cLdat[11]=="v11"){echo "<td>CAP</td>";  $csv .=";CAP";}
				echo "<td>&nbsp;</td>";
				echo "</tr>";
				
				$i=0;

foreach ($array as $row) 
{

	$query="SELECT user_id,first_name,second_name,gender,birth_date,(extract(year from now()) - extract(year from (birth_date))) as age, work_id,instr_level_id,province_id,mar_status_id,email,code,area,reg FROM t_user_info where user_id='$row' ORDER by user_id";
	$resC = mysqli_query($admin,$query) ;
	$infoC= mysqli_fetch_array($resC);

	//echo $query;

		
						$idView=$infoC['user_id'];
						$nameView=$infoC['first_name'];
						$nameView2=$infoC['second_name'];
						$sexView=$infoC['gender'];
						$mailView=$infoC['email'];
						$ageView=$infoC['age'];
						$yearView=$infoC['birth_date'];
						$proView=$infoC['province_id'];
						$reView=$infoC['reg'];
						$arView=$infoC['area'];
						$worView=$infoC['work_id'];
						$insView=$infoC['instr_level_id'];
						$stView=$infoC['mar_status_id'];
						$capView=$infoC['code'];

						switch ($reView) 
						{
							case 1:	$reStamp="Abruzzo"; $arStamp="Sud"; break;
							case 2:	$reStamp="Basilicata"; $arStamp="Sud"; break;
							case 3:	$reStamp="Calabria"; $arStamp="Sud"; break;
							case 4:	$reStamp="Campania"; $arStamp="Sud"; break;
							case 5:	$reStamp="Emila Romagna"; $arStamp="Nord Est"; break;
							case 6:	$reStamp="Friuli"; $arStamp="Nord Est"; break;
							case 7:	$reStamp="Lazio"; $arStamp="Centro"; break;
							case 8:	$reStamp="Liguria"; $arStamp="Nord Ovest"; break;
							case 9:	$reStamp="Lombardia"; $arStamp="Nord Ovest"; break;
							case 10:$reStamp="Marche"; $arStamp="Centro"; break;
							case 11:$reStamp="Molise"; $arStamp="Sud"; break;
							case 12:$reStamp="Piemonte"; $arStamp="Nord Ovest"; break;
							case 13:$reStamp="Puglia"; $arStamp="Sud"; break;
							case 14:$reStamp="Sardegna"; $arStamp="Sud"; break;
							case 15:$reStamp="Sicilia"; $arStamp="Sud"; break;
							case 16:$reStamp="Toscana"; $arStamp="Centro"; break;
							case 17:$reStamp="Trentino"; $arStamp="Nord Est"; break;
							case 18:$reStamp="Umbria"; $arStamp="Centro"; break;
							case 19:$reStamp="Valle d'Aosta"; $arStamp="Nord Ovest"; break;
							case 20:$reStamp="Veneto"; $arStamp="Nord Est"; break;
						}
		
						$csv .= "\n";
						
						echo "<tr>";
						echo "<td>".$idView."</td>"; $csv .=$idView;
						if ($cLdat[0]=="v1"){echo "<td>".$nameView." ".$nameView2."</td>"; $csv .=";".$nameView."-".$nameView2;}
						if ($cLdat[1]=="v2"){echo "<td>".$mailView."</td>"; $csv .=";".$mailView;}
						if ($cLdat[2]=="v3"){echo "<td>".$sexView."</td>"; $csv .=";".$sexView; }
						if ($cLdat[3]=="v4"){echo "<td>".$ageView."</td><td>".$yearView."</td>"; $csv .=";".$yearView; }
						if ($cLdat[4]=="v5"){echo "<td>".$proView."</td>";  $csv .=";".$proView;}
						if ($cLdat[8]=="v9"){echo "<td>".$reView."</td><td>".$reStamp."</td>";  $csv .=";".$reStamp;}
						if ($cLdat[9]=="v10"){echo "<td>".$arView."</td><td>".$arStamp."</td>";  $csv .=";".$arStamp;}
						if ($cLdat[5]=="v6"){echo "<td>".$worView."</td>";  $csv .=";".$worView;}
						if ($cLdat[6]=="v7"){echo "<td>".$insView."</td>";  $csv .=";".$insView;}
						if ($cLdat[7]=="v8"){echo "<td>".$stView."</td>"; $csv .=";".$stView; }
						if ($cLdat[11]=="v11"){echo "<td>".$capView."</td>";  $csv .=";".$capView;}
						echo "<td><form action=\"user.php\" method=\"get\" target=\"_blank\">";
						echo "<input type=\"hidden\" name=\"user_id\" value=\"".$idView."\" />";
						echo "<input type=\"submit\" value=\"VAI\" style=\"width:100%\" />";
						echo "</form></td>";

						$i++;
						
			}
		}


	else 
	{
	echo "<td>Nessuna corrispondenza trovata</td>";
	}?>
	
	</tr>
	</table>
	
	</div>
	</div>
	</div>
</div>	
<?php } ?>




<?php
if ($azione =="ricerca")
{?>
	  <tr><td colspan="9" align="center">
	  <form action="csv.php" method="post" target="_blank">
	<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
	<input type="hidden" name="filename" value="user_list" />
	<input type="hidden" name="filetype" value="user" />
	<input type="image" value="submit" src="img/CSV.gif" />
	</form>
	</td>
	</tr>

<?php
}
?>

</div>
</div>


<?php 

require_once('inc_footer.php'); 
?>
