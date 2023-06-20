<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php');


$query_cerca = "SELECT * FROM portaamico,t_user_info where portaamico.user_id=t_user_info.user_id order by campo_data asc";
$cerca = mysqli_query($admin,$query_cerca);

?>


<div class="content-wrapper">
 <div class="container">


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
	 <th>Azioni</th>
	 <th>*</th>
	 <th>*</th>
	</tr>

</thead>
<tbody>	

<?php
while ($row = mysqli_fetch_assoc($cerca))
		{
      $newdate = substr($row['campo_data '],0,strlen($row['campo_data '])-3);

        echo"<tr>
        <td>".$row['idPortaAmico']."</td>
        <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
        <td>".$row['email_invitato']."</td>
        <td>".$newdate."</td>
        <td>".$row['active']."</td>
        <td>".$row['action']."</td>
        <td>*</td>
        <td>*</td>
        ";
    }

    ?>
    </tr>	
    </tbody>
    </table>

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

                        'targets': [0,5,6,7], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );
</script>