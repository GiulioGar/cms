<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'UTENTI DI TEST';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "tools";
//$coldx = "no";


require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>


<div id="bluebox"><div id="description">
<div class="title">UTENTI PER OPERAZIONI DI TEST</div>
UTENTE <a href="user_test1.php" style="color:#F00">AMP1Y11611</a></div>
 

</div>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>