<?php

$sid="ITA1411150";
$prj="BRS";
$ftp_server="46.37.21.33";
$ftp_user_name="primis";
$ftp_user_pass="Imr_PrimiFields13";
// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


//$delete=ftp_delete($conn_id, "/".$prj."/".$sid."/results/res0001.sre");
$put=ftp_put($conn_id, "/".$prj."/".$sid."/results/res0001.sre","/".$prj."/".$sid."/bak/res0001.sre",FTP_ASCII);
echo "bbb";
?>