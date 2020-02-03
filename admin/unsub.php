<?php

require_once('../Connections/admin.php'); 
mysqli_select_db($database_admin, $admin);



$uid=$_REQUEST['uid'];

$query_user = "INSERT INTO unsub (uid) 
VALUES ('".$uid."')";
mysqli_query($admin,$query_user) or die(mysql_error());

echo "Cancellation successful. Your e-mail address has been removed from the selected list."
?>	