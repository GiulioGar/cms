<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$query_cerca = "SELECT provenienza, SUM(provenienza NOT LIKE '%ref%' AND provenienza NOT LIKE '%website%' AND provenienza NOT LIKE '%app%' AND provenienza NOT LIKE '%react%') as comp
FROM t_user_info as info where info.active=1 and provenienza IS NOT NULL
GROUP BY provenienza ORDER BY comp DESC";
$cerca = mysqli_query($admin,$query_cerca);

?>


<div class="content-wrapper">
 <div class="container">

<br/>
 <div class="row">
 <div class="col-md-12">

 <table id='table_sur' style="font-size:11px;"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th>User</th>
	 <th>Inviti</th>
	 <th>Iscritti</th>
	 <th>Attivi</th>
	 <th>Bonus</th>
	 <th>Invitati</th>
	</tr>

</thead>
<tbody>	

<?php
while ($row = mysqli_fetch_assoc($cerca))
		{
        if ($row['comp']>0) 
        {
          $prov= $row['provenienza'];


          $query_sub ="SELECT COUNT(user_id) AS total_sub from t_user_info where provenienza='".$prov."' AND active=1";
          $sub_q = mysqli_query($admin,$query_sub);
          $sub = mysqli_fetch_assoc($sub_q);

        $query_actives ="SELECT COUNT(user_id) AS total_active from t_user_info where provenienza='".$prov."' AND actions>0";
        $act_q = mysqli_query($admin,$query_actives);
        $act = mysqli_fetch_assoc($act_q);

        echo"<tr>
        <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['provenienza']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['provenienza']."<br/>".$row['email']."</a></td>
        <td>".$row['comp']."</td>
        <td>".$sub['total_sub']."</td>
        <td>".$act['total_active']."</td>
        <td></td>
        <td></td>
        ";
        }
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

                        'targets': [0,4], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );




</script>