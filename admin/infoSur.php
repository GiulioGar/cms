<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
	  
mysqli_select_db($admin,$database_admin);

require_once('inc_taghead.php');

?>



<style>

input[type="number"] {
	width:55px;
 }

</style>

<?php
require_once('inc_tagbody.php');




$query_cerca = "SELECT res.uid, SUM(res.status=3) as comp ,SUM(res.status=0) as cont,info.email,first_name,reg_date
FROM t_respint as res, t_user_info as info where info.user_id=res.uid and info.active=1
GROUP BY res.uid ORDER BY comp DESC";
$cerca = mysqli_query($admin,$query_cerca) or die(mysql_error());

/*
// CREO GLI ARRAY

$arrComp = array();
$arrInviti = array();

while($rows =  mysqli_fetch_assoc($cerca))
{
    $arrComp[]=$rows['comp'];

}

$countComp=count($arrComp);
$arrComp=array_unique($arrComp);
*/


// $query_contatto = "SELECT distinct uid, COUNT(uid) AS 'numc',email,first_name FROM t_respint as res, t_user_info as info where info.user_id=res.uid and status=0 GROUP BY uid order by num desc ";
// $contatto = mysqli_query($admin,$query_contatto) or die(mysql_error());

?>

<div class="content-wrapper">
 <div class="container">
<div class="row">



<div class="col-md-9 col-sm-9 col-xs-9">

<table style="font-size:11px"  class="table table-striped table-bordered stats" >


<tr> <th>Uid</th><th>Nome</th><th>Anno</th><th>Email</th><th>Complete</th><th>Inviti</th><th>%</th></tr>

<tr> <th><button id="cerca" type="button">Cerca</button></th>
<th><button id="azzera" type="button">Azzera</button></th>
<th>

<select id="selAnno">
<option value="null">Anno</option>
<?php
$currYear=date("Y");

for ($i=0; $i<=20 ; ++$i)
{
$mostrAnno=$currYear-$i;
echo "<option value='".$mostrAnno."'>".$mostrAnno."</option>";
}


?>

</select>

</th>

<th>&nbsp;</th>

<th>

<input type="number" min="0" max="999" id="selComp">

</th>

<th> 

<input type="number"  min="0" max="999" id="selInviti">
</th>

<th><input type="number"  min="0" max="999" id="selPerc"></th>

</tr>

<?php

	while ($row = mysqli_fetch_assoc($cerca))
		{
           $contatti=$row['comp']+$row['cont'];
           $partec=($row['comp']/$contatti)*100;
            $partec=round($partec);
          

           if($row['comp']>100) {$u100++;}
           if($row['comp']>=51 && $row['comp']<=100) {$u51++;}
           if($row['comp']>=30 && $row['comp']<=50) {$u30++;}
           if($row['comp']>=10 && $row['comp']<=29) {$u10++;}
           if($row['comp']>=2 && $row['comp']<=9) {$u1++;}
           if($row['comp']<=1) {$u0++;}
          
          echo "<tr class='reg'>
          <td><a href=\"user.php?user_id=".$row['uid']."\" style=\"color:#00C; text-decoration:underline \" target='_blank'>".$row['uid']."</a></td>
          <td>".$row['first_name']."</td>
          <td class='regan'>".substr($row['reg_date'], 0, 4)."</td>
          <td class='regmail'>".$row['email']."</td>
          <td class='regcomp'>".$row['comp']."</td>
          <td class='regcont'>".$contatti."</td>
          <td class='regpart'>".$partec." %</td>

  


        </tr>";
		}

?>
</table>

</div>

<div class="col-md-3 col-sm-3 col-xs-3">

<div class="row">
 
    <div class="panel panel-primary">
   <div class="panel-heading">
   RICERCHE
   </div>
   
 <div class="panel-body  recent-users-sec"> 
<table style="font-size:11px"  class="table table-striped table-bordered">
		<tr class='intesta'><th>Numero Ricerche</th><th >Utenti</th></tr>
		<tr>
		<td>OLTRE 100 RICERCHE:</td> 
		<td><?php echo $u100  ?></td>
		</tr>
			
		<tr>
		<td>51-100 RICERCHE:</td> 
		<td><?php echo $u51 ?></td>
		</tr>
		
		
		<tr>
		<td>30-50 RICERCHE:</td>
		<td><?php echo $u30 ?></td>
		</tr>
		
		
		<tr>
		<td>10-29 RICERCHE:</td>
		<td><?php echo $u10 ?></td>
		</tr>

    <tr>
		<td>2-9 RICERCHE:</td>
		<td><?php echo $u1 ?></td>
		</tr>

    <tr>
		<td>0-1 RICERCHE:</td>
		<td><?php echo $u0 ?></td>
		</tr>

</table>
</div>
</div>
</div>
</div>



</div>
</div>
</div>


<script>

$( "#cerca" ).click(function() 
{
let sanno=$("#selAnno").val();
let ncomp=$("#selComp").val();
let ninv=$("#selInviti").val();
let nperc=$("#selPerc").val();

//console.log("Anno"+sanno);
//console.log(typeof sanno);
console.log("Inv"+ninv);
console.log(typeof ninv);
// console.log("Perc"+nperc);

$("tr.reg").each(function() {
	$(this).show();
});

$("td").each(function() {


	let leggoClass=$(this).attr("class");
	let testotd=$(this).text();



if ((leggoClass=="regan" && testotd!=sanno && sanno!=="null") || (leggoClass=="regcomp" && testotd != ncomp && ncomp!=="" ) || (leggoClass=="regcont" && testotd != ninv && ninv!=="" ) || (leggoClass=="regpart" && testotd != nperc && nperc!==""  ))
{ $(this).parent().hide(); console.log("entrato"); }


});

});

</script>

<?php

if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 