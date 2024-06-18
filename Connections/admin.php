<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//$hostname_admin = "46.37.21.33"; 
$hostname_admin = "localhost"; 
$database_admin = "millebytesdb";
$username_admin = "root";
$password_admin = '';
//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 

$con = @mysqli_connect('localhost', 'root', '', 'millebytesdb');
//$admin = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('localhost', 'root', '', 'millebytesdb');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
?>
