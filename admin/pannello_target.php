
<?php 
	  

@$id_sur = $_REQUEST['id_sur'];
@$closearch = $_REQUEST['closearch'];
@$openSearch = $_REQUEST['openSearch'];
@$modSearch = $_REQUEST['modSearch'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];

$tag_csv=$_REQUEST['tag_csv'];


	  /////Target
	  $query_trg = "SELECT * FROM elencotag ORDER BY tag ASC";
	  $tot_targ = mysqli_query($admin,$query_trg);     

?>



<?php



$query_ricerche = "SELECT * FROM elencotag  ORDER BY tag ASC";
$tot_ricerche = mysqli_query($admin,$query_ricerche) ;

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

?>


<div class="row">
	 <div class="col col-xs-6">
	</div>
	<div class="col col-xs-6 text-right">
	<?php require_once('modulo_aggiungi_tag.php'); ?>
	</div>
	</div>


<div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
<div class="card card-default">
 <div class="card-body">
  <div class="table-responsive">

	<table id='table_tar' class='table table-striped table-hover dt-responsive display dataTable no-footer'>
	<thead>
	<th style='font-weight:bold'>Tag</th>
	<th style='font-weight:bold'>Utenti</th>
	</thead>


<tbody>
<?php




//AGGIORNO INFO GIORNI RIMANENTI IN DB



//STAMPO LE RICERCHE DOPO AGGIORNAMENTO DEI GIORNI RIMANENTI
$tot_ricerche = mysqli_query($admin,$query_ricerche) ;
$numResults = mysqli_num_rows($tot_ricerche);
$contastamp=0;


while ($row = mysqli_fetch_assoc($tot_ricerche))
{

$tagInfo=$row['tag'];
$query_user = "SELECT COUNT(*) as total FROM utenti_target where target='$tagInfo'";
$tot_user = mysqli_query($admin,$query_user) ;
$tot_use = mysqli_fetch_assoc($tot_user);
	
echo "<tr class='rowSur' style='background:".$colRow."'>";
echo "<td><a target='_blank' href='esporta_campione.php?tag_csv=".$row['tag']."'>".$row['tag']."</a></td>";
echo "<td>".$tot_use['total']."</td>";
echo "</tr>";




?>


<?php
}


?>

</th>
</tbody>	
</table>


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

$(".vaii").click(function(){
 //chiamata ajax
 $.ajax({

//imposto il tipo di invio dati (GET O POST)
 type: "GET",

 //Dove devo inviare i dati recuperati dal form?
 url: "function_target.php",

 //Quali dati devo inviare?
 data: "tag="+tag+"&openSearch="+pr, 
 dataType: "html",
success: function(data) 
		 { 
	   		}

});
});




</script>

