<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//$hostname_admin = "46.37.21.33"; 
$hostname_admin = "localhost"; 
$database_admin = "millebytesdb";
$username_admin = "mbuser";
$password_admin = '$leeple%1598';
//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 
$connnessione="test";
$cn=strpos()
//$con = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$con = @mysqli_connect('localhost', 'mbuser', '$leeple%1598', 'millebytesdb');
//$admin = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('localhost', 'mbuser', '$leeple%1598', 'millebytesdb');

$con -> set_charset("utf8");
$admin -> set_charset("utf8");


if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}



?>
