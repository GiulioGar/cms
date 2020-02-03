<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
	  
mysqli_select_db($database_admin, $admin);
$liv=$_GET['livello'];
$pr=$_GET['prelivello'];

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

if ($liv !="")
{
$query_cerca = "SELECT level.entity_id,field_user_level_value, us.field_user_id_value, info.user_id, info.first_name,info.second_name,info.email
FROM field_data_field_user_level as level, field_data_field_user_id as us , t_user_info as info
WHERE( ( (field_user_level_value>$pr) AND (field_user_level_value<=$liv)) and ( (us.entity_id=level.entity_id) and (us.field_user_id_value=info.user_id)) )
order by field_user_level_value desc";
$cerca = mysqli_query($admin,$query_cerca) or die(mysql_error());
}

?>

<table align="center" width="70%" class='tabdat'>
        <tr><th colspan="3" align="center"></th></tr>
		<tr class='intesta'> <th>Uid</th><th>Nome</th><th>Cognome</th><th>Email</th><th>livello</th></tr>

<?php
	while ($row = mysqli_fetch_assoc($cerca))
		{
		  echo "<tr><td><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:underline \" target='_blank'>".$row['user_id']."</a></td>
		  <td>".$row['first_name']."</td><td>".$row['second_name']."</td><td>".$row['email']."</td><td>".$row['field_user_level_value']."</td></tr>";
		}

?>
</table>

<?php

if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 