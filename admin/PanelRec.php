<?php

//Utenti generici//

//ISCRITTI 2014//

//FACEBOOK
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-06-19 18:00:00' and active='1' and provenienza='facebook_banner'";
$new_fbb = mysqli_query($query_new, $admin) or die(mysql_error());
$fbb_new = mysqli_fetch_assoc($new_fbb);
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-06-19 18:00:00' and active='1'  and provenienza='facebook_millebytes'";
$new_fmb = mysqli_query($query_new, $admin) or die(mysql_error());
$fmb_new = mysqli_fetch_assoc($new_fmb);

//CLASSICA
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-06-19 18:00:00' and active='1'  and provenienza='Registrazione classica da Millebytes'";
$new_mb = mysqli_query($query_new, $admin) or die(mysql_error());
$mb_new = mysqli_fetch_assoc($new_mb);

//MVF CAMPAGNA 1
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-07-21 13:00:00' and reg_date < '2014-09-15 08:00:00' and active='1'  and provenienza='Registrazione classica da Panel'";
$new_mvf = mysqli_query($query_new, $admin) or die(mysql_error());
$mvf_new = mysqli_fetch_assoc($new_mvf);

$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-07-21 13:00:00' and reg_date < '2014-09-15 08:00:00' and active='1'  and provenienza='Registrazione classica da Panel' and gender=2";
$new_mvfGirl = mysqli_query($query_new, $admin) or die(mysql_error());
$mvf_newGirl = mysqli_fetch_assoc($new_mvfGirl);

//MVF CAMPAGNA 2
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-09-15 08:00:00' and active='1'  and provenienza='Registrazione classica da Panel'";
$new_mvf2 = mysqli_query($query_new, $admin) or die(mysql_error());
$mvf_new2 = mysqli_fetch_assoc($new_mvf2);

//MVF CAMPAGNA 2.5
mysqli_select_db($database_admin, $admin);
$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-10-14 08:00:00' and active='1'  and provenienza='Registrazione classica da Panel'";
$new_mvf25 = mysqli_query($query_new, $admin) or die(mysql_error());
$mvf_new25 = mysqli_fetch_assoc($new_mvf25);


$query_new = "SELECT COUNT(*) as total FROM t_user_info where reg_date > '2014-09-15 08:00:00' and active='1'  and provenienza='Registrazione classica da Panel' and gender=2";
$new_mvf2Girl = mysqli_query($query_new, $admin) or die(mysql_error());
$mvf_new2Girl = mysqli_fetch_assoc($new_mvf2Girl);

//DETTAGLI SU CAMPAGNA MVF//

//Mvf 1 attività primo reclutamento
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND info.provenienza='Registrazione classica da Panel' AND story.year_surveys>0 AND reg_date < '2014-09-15 08:00:00'";
$tot_mvfFirst = mysqli_query($query_user, $admin) or die(mysql_error());


$tot_mvf_First = mysqli_fetch_assoc($tot_mvfFirst);
//Mvf 1 attività secondo reclutamento
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND info.provenienza='Registrazione classica da Panel' AND story.year_surveys>0 AND reg_date > '2014-09-15 08:00:00'";
$tot_mvfSec = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_mvf_Sec = mysqli_fetch_assoc($tot_mvfSec);
//Mvf 1 attività
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND info.provenienza='Registrazione classica da Panel' AND story.year_surveys=1";
$tot_mvf1 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_mvf_1 = mysqli_fetch_assoc($tot_mvf1);
//Mvf 2 attività
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND info.provenienza='Registrazione classica da Panel' AND story.year_surveys=2";
$tot_mvf2 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_mvf_2 = mysqli_fetch_assoc($tot_mvf2);
//Mvf +2 attività
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND info.provenienza='Registrazione classica da Panel' AND story.year_surveys>2";
$tot_mvf3 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_mvf_3 = mysqli_fetch_assoc($tot_mvf3);


$newUser=$fbb_new['total']+$fmb_new['total']+$mb_new['total']+$mvf_new['total']+$mvf_new2['total'];

mysqli_select_db($database_admin, $admin);
$query_new = "SELECT user_id,email,first_name,gender,birth_date FROM t_user_info where active='1'  and provenienza='Registrazione classica da Panel'";
$csv_mvf = mysqli_query($query_new, $admin) or die(mysql_error());


//// ESPORTA CAMPIONE MVF IN CSV ////
$anno_corrente=date("Y"); 

    @$csv="uid;email;firstName;genderSuffix;anni";
    $csv .= "\n";
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            $birth_date=$row['birth_date'];
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            $anno_nascita=substr($birth_date,0,4);
            $eta=$anno_corrente-$anno_nascita;
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$eta; 
            $csv .= "\n";
    } 
		
		$mvf_newMen=$mvf_new['total']-$mvf_newGirl['total'];
		$mvf_new2Men=$mvf_new2['total']-$mvf_new2Girl['total'];
		$totalMvf=$mvf_new['total']+$mvf_new2['total'];
		$totalMvfGirl=$mvf_newGirl['total']+$mvf_new2Girl['total'];
		$totalMvfMen=$mvf_newMen+$mvf_new2Men;
		
?>

<div style="margin-bottom:10px;" class="title">RECLUTAMENTO PANEL</div>

<div style="float:left; ">
        <table class='tabdat'>
        <tr><th colspan="5" align="center">Nuove Iscrizioni </th></tr>
        <tr class='intesta'><th>&nbsp; </th><th>Tot </th><th>Uomini </th><th>Donne </th></tr>
        <tr> <td>Banner Facebook</td><td><?php echo $fbb_new['total']; ?></td><td>&nbsp;</td><td>&nbsp;</td></tr>
       <tr> <td>1000bytes Facebook</td><td><?php echo $fmb_new['total']; ?></td><td>&nbsp;</td><td>&nbsp;</td></tr>
       <tr> <td>1000bytes:</td><td><?php echo $mb_new['total']; ?></td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td><span style='color:#1300AF'>MVF Recl. (Lug-Ago):</span></td><td><?php echo $mvf_new['total']; ?></td><td><?php echo $mvf_newMen; ?></td><td><?php echo $mvf_newGirl['total']; ?></td></tr>
             <tr> <td><span style='color:#2F53FF'>MVF Recl. (Set-Ott):</span></td><td><?php echo $mvf_new2['total']; ?></td><td><?php echo $mvf_new2Men; ?></td><td><?php echo $mvf_new2Girl['total']; ?></td></tr>
			 <tr> <td><span style='color:#2F53FF'>MVF Recl. (Ottobre):</span></td><td><?php echo $mvf_new25['total']; ?></td><td>&nbsp;</td><td>&nbsp;</td></tr>
             <tr> <td><b><span style='color:red'>Totale MVF:</span></b></td><td><?php echo $totalMvf; ?></td><td><?php echo $totalMvfMen; ?></td><td><?php echo $totalMvfGirl; ?></td></tr>
            <tr> <td><b>Totale:</b></td><td><?php echo $newUser; ?></td><td>&nbsp;</td><td>&nbsp;</td></tr>
        </table>
</div> 
   
<div style="margin-left:290px;">
		
    <?php

    $total_att=$tot_mvf_1['total']+$tot_mvf_2['total']+$tot_mvf_3['total'];
    $tot_mvf_0=$totalMvf-$total_att;
    $redemp=$total_att/$totalMvf*100;
    $redemp1=$tot_mvf_First['total']/$mvf_new['total']*100;
    $redemp2=$tot_mvf_Sec['total']/$mvf_new2['total']*100;
    ?>
        <table class='tabdat'>
        <tr><th colspan="3" align="center">MVF RED QUALITY</th></tr>
		<tr class='intesta'> <th>N° Attività </th><th>Quantità</th></tr>
        <tr> <td>0 attività </td><td><?php echo $tot_mvf_0; ?></td></tr>
       <tr> <td>1 attività </td><td><?php echo $tot_mvf_1['total']; ?></td></tr>
       <tr> <td>2 attività</td><td><?php echo $tot_mvf_2['total']; ?></td></tr>
        <tr> <td>+2 attività</td><td><?php echo $tot_mvf_3['total']; ?></td></tr>
        <tr> <td><b><span style='color:#1300AF'>Attivi recl.1:</b></span></td><td><b><?php echo $tot_mvf_First['total']; ?></b></td><td><b><?php echo sprintf("%01.2f", $redemp1)."%";  ?></b></td></tr>
         <tr> <td><b><span style='color:#2F53FF'>Attivi recl.2:</b></span></td><td><b><?php echo $tot_mvf_Sec['total']; ?></b></td><td><b><?php echo sprintf("%01.2f", $redemp2)."%";  ?></b></td></tr>
		<tr> <td><b><span style='color:red'>Attivi in totale:</b></span></td><td><b><?php echo $total_att; ?></b></td><td><b><?php echo sprintf("%01.2f", $redemp)."%";  ?></b></td></tr>
        </tr>
        </table>
        
        <form style="position:relative; left:-44px" action="csv.php" method="post" target="_blank">
        <input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
        <input type="hidden" name="filename" value="user_list" />
        <input type="image" value="submit" src="img/CSV.gif" />
        </form>
 
  </div>	