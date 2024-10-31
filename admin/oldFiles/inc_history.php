<?php 
$Hdate=date("Y-m-d H:i:s");
$history_sql= "SELECT score FROM v_users WHERE user_id='".$Huser_id."'";
list($Hscore) = mysql_fetch_row(mysqli_query($history_sql));
if ($Hscore == "") { $Hscore=0; }
if ($Hbytes == "") { $Hbytes=0; }

if ($Hscore != $Hbytes ) { 
mysqli_query("INSERT INTO t_user_history (user_id,date,description,previous_bytes,assigned_bytes) VALUES ('$Huser_id', '$Hdate', '$Hazione', '$Hscore','$Hbytes')")or die(mysql_error());
}
?>