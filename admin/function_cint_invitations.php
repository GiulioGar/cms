<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

$todaydate=date ("Y/m/d H:i:s");

@$creaCamp = $_REQUEST['creaCamp'];



//$offButton="";
// if ($num_rows==0) { $offButton="disabled='disabled'"; }


if ($creaCamp=="DOWNLOAD")	
{  

$query_new = "SELECT * FROM cint_invites c, t_user_info i where i.user_id=c.member_id AND expires >= CURDATE() AND inviti=0";
$csv_mvf = mysqli_query($admin,$query_new);

        //// ESPORTA CAMPIONE MVF IN CSV ////
    
    
        @$csv="uid;email;firstName;genderSuffix;link;scade";
        $csv .= "\n";
        
        
        while ($row = mysqli_fetch_assoc($csv_mvf)) 
        { 
                
                $uid=$row['user_id'];
                
                $mail=$row['email'];
                $nome=$row['first_name'];
                $urlsend=$row['survey_url'];
                $sesso=$row['gender'];
                $prid=$row['project_id'];
                $exp=$row['expires'];
                $scad = date("d-m-Y H:i", strtotime($exp));
                if($sesso==1){$genderTransform="o";}
                else {$genderTransform="a";}
                
                $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$urlsend.";".$scad; 
                $csv .= "\n";



            //aggiorno ultimo id salvato
            $query_aggInv= "UPDATE cint_invites SET inviti=1 where member_id='$uid' and project_id='$prid'";
            $aggInv = mysqli_query($admin,$query_aggInv);
        

        }
        ?>

<form id="mycsv" action="csv.php" method="post" target="_blank">
<input type="hidden" name="csv" value="<?php echo$csv ?>" />
<input type="hidden" name="filename" value="user_list" />
<input type="hidden" name="filetype" value="csv" />
<input type='submit' style="display:none" value='sumbit' />
 </form>


<?php
    }
   
//query inviti disponibili
$query_cintInviti = "SELECT id,member_id,project_id,loi,ir,survey_url,date_to_send,expires,email,gender,inviti,scadenza FROM cint_invites c, t_user_info i where i.user_id=c.member_id AND inviti=0 AND scadenza <> 'Scaduto' ORDER BY id DESC";
$cintInviti = mysqli_query($admin,$query_cintInviti);
$num_rows = mysqli_num_rows($cintInviti);    

?>


<div class="rowDisp">

<div class="card shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary">INVITI DISPONIBILI <?php echo $num_rows;?> </h6></span>
</div>


<div class="card-body"> 

<div class="table-responsive">
<?php
echo "<table id='tabInviti' style='font-size:11px' class='table table-striped table-bordered table-hover'>";
echo "<tr class='intesta'>";
echo "<th style='font-weight:bold'>Id Intervista</th>";
echo "<th style='font-weight:bold'>Uid </th>";
echo "<th style='font-weight:bold'>Genere </th>";
echo "<th style='font-weight:bold'>Email </th>";
echo "<th style='font-weight:bold'>Progetto</th>";
echo "<th style='font-weight:bold'>Loi</th>";
echo "<th style='font-weight:bold'>Ir</th>";
echo "<th style='font-weight:bold'>Link</th>";
echo "<th style='font-weight:bold'>Scadenza</th>";
echo "<th style='font-weight:bold'>Inviti</th>";
echo "</tr>";

if ($num_rows==0)
{
    echo "<tr><td colspan='10' style='text-align:center'><button id='alert4' class='btn btn-alert btn-warning alcasi' type='button'>NON CI SONO INVITI DISPONIBILI !</button></td></tr>"; 
}

else 
{
while ($row = mysqli_fetch_assoc($cintInviti)) 
    {

        $strStart = $row['expires'];
        $strEnd   = $todaydate; 
        $dteStart = new DateTime($strStart);
        $dteEnd   = new DateTime($strEnd); 
        $dteDiff  = $dteStart->diff($dteEnd); 
        

        echo "<tr>";

        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['member_id']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['project_id']."</td>";
        echo "<td>".$row['loi']."</td>";
        echo "<td>".$row['ir']."</td>";
        echo "<td>".$row['survey_url']."</td>";
        if ($dteStart>=$dteEnd )
        { echo "<td>". $dteDiff->format("%h ore %i minuti")."</td>";}
        else
        { echo "<td style='color:red'>Scaduto</td>";}
        echo "<td>".$row['inviti']."</td>";

        

        echo "</tr>";
    
    }

}

  echo "</table>"  ;
?>
</div>
</div>
</div>
</div>
</div>


