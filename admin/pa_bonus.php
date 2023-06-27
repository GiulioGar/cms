<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

@$var_pagato = $_REQUEST['var_pagato'];  
@$id_pre = $_REQUEST['id_pre'];

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

 <table id='table_sur' style="font-size:11px; text-align:center"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th>User</th>
	 <th>Inviti</th>
	 <th>Iscritti</th>
	 <th>Attivi</th>
	 <th>Bonus maturato</th>
	 <th>Bonus pagato</th>
	 <th>Bonus rimanente</th>
	 <th>Invitati</th>
	 <th>*</th>
	</tr>

</thead>
<tbody>	

<?php
$bouns=0;

while ($row = mysqli_fetch_assoc($cerca))
		{

        $infoUid="";
        $infoMail="";
        $infoActions="";

        if ($row['comp']>0) 
        {
        $prov= $row['provenienza'];

        //leggo mail associate
        $query_contacts ="SELECT *  from t_user_info where provenienza='".$prov."'";
        $cont_q = mysqli_query($admin,$query_contacts);
        
        while ($row2 = mysqli_fetch_assoc($cont_q))
		{
          $infoUid.=";".$row2['user_id'];
          $infoMail.=";".$row2['email'];
          $infoActions.=";".$row2['actions'];
        }


        
        $query_sub ="SELECT COUNT(user_id) AS total_sub from t_user_info where provenienza='".$prov."' AND active=1";
        $sub_q = mysqli_query($admin,$query_sub);
        $sub = mysqli_fetch_assoc($sub_q);

        $query_actives ="SELECT COUNT(user_id) AS total_active from t_user_info where provenienza='".$prov."' AND actions>0";
        $act_q = mysqli_query($admin,$query_actives);
        $act = mysqli_fetch_assoc($act_q);

        $bonus=($sub['total_sub']*50)+($act['total_active']*250);

        $query_bonusMaturato = "UPDATE t_user_info SET home_phone=".$bonus." WHERE user_id='".$prov."'";
        $add_bonusMaturato = mysqli_query($admin,$query_bonusMaturato) ;


        //LEGGO I BONUS
        $query_mail = "SELECT email as infoMail, home_phone as bonM, id_bacheca as bonP
        FROM t_user_info where user_id='".$prov."'";
        $mail_q = mysqli_query($admin,$query_mail);
        $mail = mysqli_fetch_assoc($mail_q);
    
        $bonR=$mail['bonM']-$mail['bonP'];

        echo"<tr>
        <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['provenienza']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['provenienza']."<br/>".$mail['infoMail']."</a></td>
        <td>".$row['comp']."</td>
        <td>".$sub['total_sub']."</td>
        <td>".$act['total_active']."</td>
        <td>".$mail['bonM']."</td>
        <td>".$mail['bonP']."</td>
        <td>".$bonR."</td>
        <td><div class='apriMod' data-toggle='modal' data-target='#".$prov."' data-userid=".$infoUid." data-mail=".$infoMail." data-actions=".$infoActions."><i style='color:#9DCE6B; font-size:21px;' class='fa-solid fa-users-gear'></i></div></td>";

        if ($bonR>0){					
			echo "<td>
			<form  action='pa_bonus.php' method='POST'>
			<input name='id_pre' type='hidden' value='".$prov."' >
			<button class='btn btn-primary' style='min-width:54px;' type='submit'  name='var_pagato' value='ASSEGNA' >ASSEGNA</button>
			</form>
			</td>	";	
			}
			else {echo "<td><button class='btn btn-light' style='min-width:54px;' >PAGATI</button></td>"; }

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

<!-- FINESTRA MODALE ISCRITTI -->

<script>
$( ".apriMod" ).on( "click", function() {

$('.modal-body').empty();

let idAssigned=$(this).data("target").substring(1);
let usid=$(this).data("userid").substring(1);
let umail=$(this).data("mail").substring(1);
let uact=$(this).data("actions").substring(1);

let arrUid=usid.split(";");
let arrMail=umail.split(";");
let arrAct=uact.split(";");
let addContact=`
<table class='table table-striped'>
<thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">uid</th>
      <th scope="col">email</th>
      <th scope="col">azioni</th>
    </tr>
  </thead>`;

$.each(arrUid, function(index, value){
    addContact+=`<tr>`;
    addContact+=`<td>${index+1}</td><td>${value}</td><td>${arrMail[index]}</td><td>${arrAct[index]}</td>`;
    addContact+=`</tr>`;
});

addContact+="</table>"
$('.modal-body').append(addContact);



$('.fade').attr('id', idAssigned);


} );
</script>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">ISCRITTI ASSOCIATI:</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
   
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

</div>
</div>	
</div>	






<!-- FINESTRA MODALE ISCRITTI -->




<?php
if($var_pagato=="ASSEGNA")
{

    $numliv=0;
    $query_bm = "SELECT home_phone as bonusM
    FROM t_user_info where user_id='$id_pre'";
    $bm_q = mysqli_query($admin,$query_bm);
    $bm = mysqli_fetch_assoc($bm_q);



    $query_bp = "SELECT id_bacheca as bonusP
    FROM t_user_info where user_id='$id_pre'";
    $bp_q = mysqli_query($admin,$query_bp);
    $bp = mysqli_fetch_assoc($bp_q);

    $numliv=$bm['bonusM']-$bp['bonusP'];

    $query_aggiorna = "UPDATE t_user_info SET points=points+$numliv, id_bacheca=id_bacheca+$numliv WHERE user_id='$id_pre'";
    $add_livello = mysqli_query($admin,$query_aggiorna) ;

?>


<script>

window.onload = function() {
	if(!window.location.hash) {
		window.location = window.location + '#loaded';
		window.location.reload();
	}
}

</script>


	
		
	
<?php }	


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
