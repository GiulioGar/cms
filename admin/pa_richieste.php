<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$var_csv1 = $_REQUEST['var_esporta1'];  
$var_csv2 = $_REQUEST['var_esporta2'];  


//controllo se presente in database
$query_amico = "SELECT email_invitato FROM portaamico";
$res_amico= mysqli_query($admin,$query_amico);


while ($row = mysqli_fetch_assoc($res_amico))
{
$query_info = "SELECT email FROM t_user_info where email='".$row['email_invitato']."'";
$res_info= mysqli_query($admin,$query_info);
$num_res = mysqli_num_rows($res_info);



if($num_res>0)
{
    mysqli_select_db($admin,$database_admin);
    $query_upStatus = "UPDATE portaamico SET  status=2 WHERE email_invitato='".$row['email_invitato']."'";
    $up_stat2 = mysqli_query($admin,$query_upStatus) ;

echo $query_upStatus."<br/>";
echo $num_res."<br/>";
}

}


$query_cerca = "SELECT * FROM portaamico,t_user_info where portaamico.uid_invitante=t_user_info.user_id order by campo_data asc";
$cerca = mysqli_query($admin,$query_cerca);


@$csv1="email1;email2";
@$csv2="email1;email2";



if($var_csv1=="ESPORTA1")
{


    $query_csv1 = "SELECT * FROM portaamico,t_user_info where uid_invitante=user_id AND status=0";
    $res_csv1 = mysqli_query($admin,$query_csv1);

    while ($row = mysqli_fetch_assoc($res_csv1))
    {
        $csv1 .= "\n";
        $csv1 .=$row['email_invitato'].";".$row['email']; 

        mysqli_select_db($admin,$database_admin);
        $query_aggiorna2 = "UPDATE portaamico SET  status=1 WHERE status=0 and uid_invitante='".$row['uid_invitante']."'";
        $up_ricercha2 = mysqli_query($admin,$query_aggiorna2) ;
    }

}

if($var_csv2=="ESPORTA2")
{

echo "entrato";

    $query_csv2 = "SELECT * FROM portaamico,t_user_info where uid_invitante=user_id AND status=1";
    $res_csv2 = mysqli_query($admin,$query_csv2);

    while ($row = mysqli_fetch_assoc($res_csv2))
    {
        $csv2 .= "\n";
        $csv2 .=$row['email_invitato'].";".$row['email']; 

    }

   echo "Var".$csv2; 

}

?>


<div class="content-wrapper">
 <div class="container">

<br/>
 <div class="row">
 <div class="col-md-12">

 <table id='table_sur' style="font-size:11px;"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th style="max-width:150px;">N</th>
	 <th>Uid Invito</th>
	 <th>Invitato</th>
	 <th>Data</th>
	 <th>Status</th>
	</tr>

</thead>
<tbody>	

<?php
while ($row = mysqli_fetch_assoc($cerca))
		{
        if ($row['status']==0) { $stampStatus="Non inviato";}
        if ($row['status']==1) { $stampStatus="Invitato";}
        if ($row['status']==2) { $stampStatus="Iscritto";}
        echo"<tr>
        <td>".$row['idPortaAmico']."</td>
        <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
        <td>".$row['email_invitato']."</td>
        <td>".$row['campo_data']."</td>
        <td>".$row['status']."</td>
        ";
    }

    ?>
    </tr>	
    </tbody>
    </table>

 </div>

 </div>

 <div class="row">
 <div class="col-md-4">
</div>

<div class="col-md-1">
<div  class="formCsv">

				<form style="text-align:center" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv1 ?>" />
				<input type="hidden" name="filename" value="portAmico" />
				<input type="hidden" name="filetype" value="portAmico" />
				<input style="height: 40px;" class="form-control m1" type="image" src="img/csv.png" />
    
				</form>	

</div>	
</div>

<div class="col-md-3">
                <form style="text-align:center" action="pa_richieste.php" method="post">
				<button class='btn btn-danger creaCamp1' style="min-width:214px;" type='submit'  name='var_esporta1' value='ESPORTA1' >SCARICA NON INVITATI</button>
				</form>	
</div>



<div class="col-md-1">
<div  class="formCsv">
				<form style="text-align:center" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv2 ?>" />
				<input type="hidden" name="filename" value="portAmicoB" />
				<input type="hidden" name="filetype" value="portAmicoB" />
				<input style="height: 40px;" class="form-control m2" type="image" nam='esporta2' value="submit" src="img/csv.png" /> 
				</form>	
                
</div>	

</div>

<div class="col-md-3">
            <form style="text-align:center" action="pa_richieste.php" method="post">
            <button class='btn btn-warning creaCamp2' style="min-width:214px;" type='submit'  name='var_esporta2' value='ESPORTA2' >SCARICA  INVITATI</button>
            </form>	
</div>

</div>


 </div>
</div>



<?php
require_once('inc_footer.php'); 
?>

<script>
$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();
    $('#table_sur').DataTable( {
        "order": [[ 3, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ richieste"
   					 },
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "pageLength": 50,
        'columnDefs': [ {

                        'targets': [0,4], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );


$( ".creaCamp1" ).on( "click", function() {
//$(this).prop('disabled', true);
});

$( ".creaCamp2" ).on( "click", function() {
//$(this).prop('disabled', true);
});


</script>