
<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

@$azione = $_REQUEST['azione'];


$query_ver = "SELECT * FROM t_user_info WHERE active=1 and user_id NOT IN (SELECT uid FROM cint_users)";
$res_ver = mysqli_query($admin,$query_ver);
$num_ver = mysqli_num_rows($res_ver);   


if($num_ver==0)
{
?>

<div class="qver alert alert-success" role="alert"><i class="fas fa-users"></i><span style="display:none" class='numusi'><?php echo $num_ver ?></b></span> &nbsp;Tutti gli utenti sono correttamente sincronizzati!  </div>
<?php } 

else 
{
?>
<div class="qver alert alert-danger"> <i class="fas fa-user-times"></i>&nbsp; <b><span class='numusi'><?php echo $num_ver ?></b></span> utenti non sono sincronizzati!  </div>
<?php }  ?>

