<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

@$user_id = $_REQUEST['user_id'];
mysqli_select_db($database_admin, $admin);
$data=date("Y-m-d H:i:s");

	
for($i=0; $i<1; $i++) {
                $prefix = chr(97+mt_rand(0, 25)).chr(97+mt_rand(0, 25));
                $seed = rand(0, strlen($userId)*($i+1));
                $text = md5(uniqid($seed, true));
                $code = strtoupper($prefix.substr($text, 0, 14));
				echo "il codice è".$code;
                $query_user = "INSERT INTO t_virtual_tickets (code,user_id,valid,received_on,survey_code) VALUES ('$code','$user_id',1,'$data','MANUALE')";
           mysqli_query($query_user, $admin) or die(mysql_error());
            
        }	
	

header("Location: http://cms.interactive-mr.com/admin/user.php?user_id=".$user_id);

?>

