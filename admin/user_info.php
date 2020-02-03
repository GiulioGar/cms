<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  
$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Info utenti';
$areapagina = "iscritti";
$coldx = "no";

require_once('inc_taghead.php');

@$cLdat=$_REQUEST["dat"];
@$nome=$_REQUEST["idval"];
@$azione = $_REQUEST['azione'];
mysqli_select_db($admin,$database_admin);

if ($azione == "ricerca")
{


	if ($nome<>"")
	{
	$array=explode("\n",$nome);
	$Carr=count($array);
	}
	
	
	
	if ($Carr<> 0)
	{
		$del="DELETE FROM t_test";
		$resA = mysqli_query($admin,$del) or die(mysqli_error());
		
		for($i=0; $i<$Carr;$i++) 
		{
		
		$arrV=$array[$i];
		$arrV=trim($arrV);
		
		$inTab="INSERT INTO t_test(uid) VALUES('$arrV')";
		$resTab = mysqli_query($admin,$inTab) or die(mysqli_error());
	
	
		
		}
			
	
	}
	
	$query="SELECT user_id,first_name,second_name,gender,birth_date,(extract(year from now()) - extract(year from (birth_date))) as age, work_id,instr_level_id,province_id,mar_status_id,email,code FROM t_user_info where user_id in (select uid from t_test order by id) ORDER by user_id";
	$resC = mysqli_query($admin,$query) or die(mysqli_error());
	$infoC= mysqli_fetch_array($resC);
	$counter = mysqli_num_rows($resC);
	
/*  

$csvsql = mysqli_query($admin,$query) or die(mysqli_error());
$tot_campi = mysqli_num_fields($csvsql);


 
for($i = 0; $i < $tot_campi; $i++ ) { 
    @$csv .= '"'.mysqli_field_name($csvsql,$i).'";'; 
} 
   
$csv .= "\n"; 
         
while($row = mysqli_fetch_row($csvsql)){ 
             
    foreach($row as $value) { 
             
        $csv .= '"'.$value.'";'; 
    } 
             
    $csv .= "\n"; 
} 
*/


	}

require_once('inc_tagbody.php'); 
?>

<div class="content-wrapper">
 <div class="container">
 
<div class="row">

 <div class="col-md-8 col-sm-8 col-xs-8">
  <div class="panel panel-default">
   <div class="panel-heading">
  INSERIRE ID
   </div> 
 <div class="panel-body recent-users-sec">


<form action="user_info.php" method="POST">

 <div class="form-group">
<textarea class="form-control" name="idval" cols="15" rows="20"></textarea>
</div>

</div>
</div>
</div>

 <div class="col-md-4 col-sm-4 col-xs-4">
  <div class="panel panel-warning">
   <div class="panel-heading">
 Seleziona i dati da visualizzare:
   </div> 

 <div class="panel-body recent-users-sec">
 
   <div class="checkbox">
                <label>
                <input name="dat[0]" value="v1" type="checkbox" />&nbsp;Nome
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
<input class="btn btn-danger" name="submit" type="submit" value="CERCA" /></div></td>


</form>
</div>
</div>

</div>

<?php 
if ($azione =="ricerca")
{
		if ($counter>0)
		{ 
				?>

<div class="row">

 <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
   <div class="panel-heading">
  RISULTATI
   </div> 
 <div class="panel-body recent-users-sec">

<table class="table table-striped table-bordered" style="font-size:12px;" >
				<?php
				echo "<tr>";
				
				echo "<td>ID</td>";
				if ($cLdat[0]=="v1"){echo "<td>NOME</td>"; }
				if ($cLdat[1]=="v2"){echo "<td>EMAIL</td>";}
				if ($cLdat[2]=="v3"){echo "<td>SESSO</td>"; }
				if ($cLdat[3]=="v4"){echo "<td>ET&Agrave;</td>"; }
				if ($cLdat[4]=="v5"){echo "<td>PROVINCIA</td>"; }
				if ($cLdat[8]=="v9"){echo "<td>REGIONE</td>"; }
				if ($cLdat[9]=="v10"){echo "<td>AREA</td>"; }
				if ($cLdat[5]=="v6"){echo "<td>LAVORO</td>";}
				if ($cLdat[6]=="v7"){echo "<td>TITOLO</td>";}
				if ($cLdat[7]=="v8"){echo "<td>STATUS</td>"; }
				if ($cLdat[11]=="v11"){echo "<td>CAP</td>"; }
				echo "<td>&nbsp;</td>";
				echo "</tr>";
				
				
				while($infoC<>0) 
				{
		
						$idView=$infoC['user_id'];
						$nameView=$infoC['first_name'];
						$nameView2=$infoC['second_name'];
						$sexView=$infoC['gender'];
						$mailView=$infoC['email'];
						$ageView=$infoC['age'];
						$yearView=$infoC['birth_date'];
						$proView=$infoC['province_id'];
						$worView=$infoC['work_id'];
						$insView=$infoC['instr_level_id'];
						$stView=$infoC['mar_status_id'];
						$capView=$infoC['code'];
						
						@include('cod_reg.php'); 
						
						echo "<tr>";
						echo "<td>".$idView."</td>";
						if ($cLdat[0]=="v1"){echo "<td>".$nameView." ".$nameView2."</td>"; }
						if ($cLdat[1]=="v2"){echo "<td>".$mailView."</td>"; }
						if ($cLdat[2]=="v3"){echo "<td>".$sexView."</td>"; }
						if ($cLdat[3]=="v4"){echo "<td>".$ageView."</td><td>".$yearView."</td>"; }
						if ($cLdat[4]=="v5"){echo "<td>".$proView."</td>"; }
						if ($cLdat[8]=="v9"){echo "<td>".$reView."</td><td>".$reStamp."</td>"; }
						if ($cLdat[9]=="v10"){echo "<td>".$arView."</td><td>".$arStamp."</td>"; }
						if ($cLdat[5]=="v6"){echo "<td>".$worView."</td>"; }
						if ($cLdat[6]=="v7"){echo "<td>".$insView."</td>"; }
						if ($cLdat[7]=="v8"){echo "<td>".$stView."</td>"; }
						if ($cLdat[11]=="v11"){echo "<td>".$capView."</td>"; }
						echo "<td><form action=\"user.php\" method=\"get\" target=\"_blank\">";
						echo "<input type=\"hidden\" name=\"user_id\" value=\"".$idView."\" />";
						echo "<input type=\"submit\" value=\"VAI\" style=\"width:100%\" />";
						echo "</form></td>";
						
						$infoC = mysqli_fetch_array($resC); 
		
			}
		}


	else 
	{
	if ($Carr>=1) {echo "<td>Nessuna corrispondenza trovata</td>";}
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
{
	 while ($user = mysqli_fetch_assoc($query)); ?>
	  <tr><td colspan="9" align="center">
	  <form action="csv.php" method="post" target="_blank">
	<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
	<input type="hidden" name="filename" value="user_list" />
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
