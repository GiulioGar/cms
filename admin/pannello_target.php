
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

	<table style="text-align:center" id='table_tar' class='table table-striped table-bordered'>
	<thead>
	<th style='font-weight:bold'>Target</th>
	<th style='font-weight:bold'>Users Disponibili</th>
	<th style='font-weight:bold'><i class="far fa-thumbs-up"></i> Interviste Possibili</th>
	<th style='font-weight:bold'>Download</th>
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


// csv per download campione

		$query_new = "SELECT user_id,email,first_name,gender,birth_date  FROM t_user_info as info, utenti_target as ute where (ute.target='".$tagInfo."' AND ute.uid=info.user_id )";
		$csv_mvf = mysqli_query($admin,$query_new);


		@$csv="uid;email;firstName;genderSuffix";
		$csv .= "\n";

		while ($row2 = mysqli_fetch_assoc($csv_mvf)) 
		{ 
			
				$uid=$row2['user_id'];
				$mail=$row2['email'];
				$nome=$row2['first_name'];
				$sesso=$row2['gender'];
				
				if($sesso==1){$genderTransform="o";}
				else {$genderTransform="a";}
		
				$csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
				$csv .= "\n";

		} 

//fine csv

//calcolo interviste stimate

$stimate=ceil(($tot_use['total']/100)*55);

?>


<tr class='rowSur' style='background:"<?php echo $colRow; ?>"'>


<td style="width:35%"> <?php echo $row['tag']; ?> </td>
<td> <?php echo $tot_use['total']; ?></td>
<td> <b><?php echo $stimate; ?></b></td>


<td>
<form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="target_list" />
				<input type="hidden" name="filetype" value="target_list" />
				<button type="submit" class="btn btn-secondary"> <span><i class="far fa-arrow-alt-circle-down" aria-hidden="true"></i></span> </button>

				</form>	
</td>

</tr>





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



</div>



 <script>


// script per  tag
$(document).on('click', 'button.add', function()
{

let formDati=$('#aggTag').serialize();


 //chiamata ajax
 $.ajax({

//imposto il tipo di invio dati (GET O POST)
 type: "GET",

 //Dove devo inviare i dati recuperati dal form?
 url: "function_target.php",

 //Quali dati devo inviare?
 dataType: 'html', // what to expect back from the PHP script
   cache: false,
   contentType: false,
   processData: false,
   data: formDati,

success: function(data) 
		{ 
		$("#modalCrea").modal('hide');
	
        }

});

});


// script per  users
$(document).on('click', 'button.addUsers', function()
{

let formDati2=$('#aggUse').serialize();
let nuoviUser;



 //chiamata ajax
 $.ajax({

//imposto il tipo di invio dati (GET O POST)
 type: "GET",

 //Dove devo inviare i dati recuperati dal form?
 url: "function_target.php",

 //Quali dati devo inviare?
 dataType: 'html', // what to expect back from the PHP script
   cache: false,
   contentType: false,
   processData: false,
   data: formDati2,

success: function(data) 
		{ 
		$("#modalUsers").modal('hide');
		nuoviUser=$(data).filter("span#newVal");
		console.log(nuoviUser);
			
        }

});

});


//data table

$(document).ready( function () {
    $('#table_tar').DataTable( {
        "order": [[ 0, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ target"
   					 },
        "pageLength": 25,
		'columnDefs': [ {

						'targets': [3], /* column index */

						'orderable': false, /* true or false */

						}]
    } );
} );

</script>

