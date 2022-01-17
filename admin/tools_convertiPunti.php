


<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($admin,$database_admin );

	//   ini_set('display_errors', 1);
	//   ini_set('display_startup_errors', 1);
	//   error_reporting(E_ALL);

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

@$sid = $_REQUEST['sid'];

$query_cerca = "SELECT * from t_user_info where active =1";
$cerca = mysqli_query($admin,$query_cerca);



?>


  <div class="content-wrapper">
       <div class="container">


	   <table style="font-size:11px" id="table_sur"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >

<thead>
<tr> 
<th>Uid</th>
<th>Livello</th>
<th>Bytes Assegnati</th>
<th>Bytes da assegnare</th>

</tr>
</thead>


<tbody>
<?php

	while ($row = mysqli_fetch_assoc($cerca))
		{
			$usid=$row['user_id'];

			$query_user2 ="SELECT * FROM millebytesdb.t_user_history where user_id='$usid'  order by event_date DESC ;";
			$user2 = mysqli_query($admin,$query_user2) ;
			$row_user2 = mysqli_fetch_assoc($user2);
			$totalRows_user2 = mysqli_num_rows($user2);
			$pbytes=$row_user2['new_level']*250;
          
          echo "<tr class='reg'>
          <td><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:underline \" target='_blank'>".$row['user_id']."</a></td>
          <td class='regcomp'>".$row_user2['new_level']."</td>
          <td class='regcomp'>".$row['points']."</td>
          <td class='regcomp'>".$pbytes."</td>

  		 </tr>";

		   $query_aggiorna = "UPDATE t_user_info SET points=$pbytes where user_id='$usid' ";
			$add_livello = mysqli_query($admin,$query_aggiorna) ;
		}

?>
</tbody>
</table>




</div>
</div>



<?php 

require_once('inc_footer.php'); 
?>
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="jquery.copy-to-clipboard.js"></script>
</body>
</html>