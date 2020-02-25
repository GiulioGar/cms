
<?php 
	  

@$id_sur = $_REQUEST['id_sur'];
@$closearch = $_REQUEST['closearch'];
@$openSearch = $_REQUEST['openSearch'];
@$modSearch = $_REQUEST['modSearch'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$tag=$_REQUEST['tag'];
$tag_csv=$_REQUEST['tag_csv'];


	  /////Target
	  mysqli_select_db($database_admin, $admin);
	  $query_trg = "SELECT * FROM elencotag ORDER BY tag ASC";
	  $tot_targ = mysqli_query($admin,$query_trg) or die(mysql_error());     

?>





<?php
if($openSearch=="Aggiungi")
{
mysqli_select_db($database_admin, $admin);	  
$query_surv = "SELECT tag  FROM elencotag";
$controlSur = mysqli_query($admin,$query_surv) or die(mysql_error());

$duplicate=0;
while ($row = mysqli_fetch_assoc($controlSur))
{
	$verId=$row['tag'];
	if ($verId==$tag) { $duplicate=$duplicate+1;}
}
if($duplicate>0) { ?> 



<div title="Attenzione!" class="dialog-message">Attenzione questo tag &egrave; gi&agrave; stato inserito!</div>

 <?php  }

	else{
	mysqli_select_db($database_admin, $admin);	  
	$query_user = "INSERT INTO elencotag (tag) 
	VALUES ('".$tag."')";
	mysqli_query($admin,$query_user) or die(mysql_error());
	}
}






mysqli_select_db($database_admin, $admin);
$query_ricerche = "SELECT * FROM elencotag  ORDER BY tag ASC";
$tot_ricerche = mysqli_query($admin,$query_ricerche) or die(mysql_error());

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

?>


<div class="row">

<?php require_once('modulo_aggiungi_tag.php'); ?>
</div>


<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
<div class="panel panel-default">
 <div class="panel-body text-center recent-users-sec">
  <div class="table-responsive">
<?php


echo "<table class='table table-striped table-bordered' ><tr>";


//AGGIORNO INFO GIORNI RIMANENTI IN DB



//STAMPO LE RICERCHE DOPO AGGIORNAMENTO DEI GIORNI RIMANENTI
$tot_ricerche = mysqli_query($admin,$query_ricerche) or die(mysql_error());
$numResults = mysqli_num_rows($tot_ricerche);
$contastamp=0;
$counter=0;

while ($row = mysqli_fetch_assoc($tot_ricerche))
{
	if ($contastamp==0) 
	{	
	echo "<td>";
	echo "<table class='table table-striped table-bordered'>"; 
	echo "<tr class='intesta'>";
	echo "<td  style='font-weight:bold'>Tag</td>";
	echo "<td style='font-weight:bold'>Utenti</td>";
	echo "</tr>";
	}
	
$tagInfo=$row['tag'];
$query_user = "SELECT COUNT(*) as total FROM utenti_target where target='$tagInfo'";
$tot_user = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_use = mysqli_fetch_assoc($tot_user);
	
echo "<tr class='rowSur' style='background:".$colRow."'>";
echo "<td><a target='_blank' href='esporta_campione.php?tag_csv=".$row['tag']."'>".$row['tag']."</a></td>";
echo "<td>".$tot_use['total']."</td>";
echo "</tr>";

$counter++;

if ( $contastamp==9) {	echo "</table></td>"; $contastamp=0;}
else { $contastamp++;}

if ( $counter==$numResults) {	echo "</table></td>"; }


?>


<?php
}

echo "</tr>";
echo "</table>";

?>

 </div>
 
 </div>
 
</div>
</div>


</div>

<div class="row">
 <div class="col-md-8 col-sm-8 col-xs-8">

 <div class="panel panel-default">
 <div class="panel-body text-center recent-users-sec">
  <div class="table-responsive">

<form action="crea_target2.php" method="POST">
 <div class="form-group">
<textarea class="form-control" name="idval" cols="15" rows="20"></textarea>
</div>

</div>
</div>
</div>
</div>


 <div class="col-md-4 col-sm-4 col-xs-4">
 
 <div class="panel panel-default">
 <div class="panel-body text-center recent-users-sec">
  <div class="table-responsive">
 
 <select class="form-control" name="Tag">
			<?php
			while ($row = mysqli_fetch_assoc($tot_targ))
			{
			?>
		    <option value="<?php echo $row['tag'];?>"><?php echo $row['tag'];?></option>
			<?php
			}
			?>
				
			</select>
<input class="btn btn-danger" type="submit" value="TAG">			
</form>			
 </div>
 </div>
 </div>
 </div>

</div>
</div>



 <script>
$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
});
</script>

