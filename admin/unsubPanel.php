<?php

require_once('../Connections/admin.php'); 
mysqli_select_db($database_admin, $admin);



$uid=$_REQUEST['uid'];

if($uid != "")
{
$query_user = "INSERT INTO unsub_panel (uid) 
VALUES ('".$uid."')";
mysqli_query($admin,$query_user);

$query_deluser = "UPDATE t_user_info SET active=0 where user_id='".$uid."'";
mysqli_query($admin,$query_deluser);

?>

<script>
window.location.href ="http://www.primisoft.com/fields/script/deleted.html";
 </script>

<?php
}

?>	