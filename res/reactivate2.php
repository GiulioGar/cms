<!doctype html>
<!--
	Solution by GetTemplates.co
	URL: https://gettemplates.co
-->
<html lang="en">

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 

//online
$conn = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');

date_default_timezone_set('Europe/Rome');
$today=date("Y-m-d H:i:s");
echo $today;
//test
// $conn = @mysqli_connect('localhost', 'root', '', 'millebytesdb');
// $admin = @mysqli_connect('localhost', 'root', '', 'millebytesdb');

if (!$conn) {
    echo "Error: " . mysqli_connect_error();
	exit();
}


$uidPal=$_GET["uidPal"];

//salva info in db

//originale
// $query_up_email = "UPDATE t_user_info set paypalEmail='$mailPal' where t_user_info.user_id='$uidPal'";
// $upEmail = mysqli_query($admin,$query_up_email);

//lettura password
// $query_cerca_email = sprintf("SELECT pwd FROM t_user_info where t_user_info.user_id='%s'",
// $conn->real_escape_string($uidPal),);
// $results=$conn->query($query_cerca_email);
// $lvl = mysqli_fetch_assoc($results);

// $pwdOriginale=$lvl["pwd"];
// echo $pwdOriginale;


$query_up_email=sprintf("UPDATE t_user_info set active=1,points=1000,provenienza='react', reg_date='%s' where t_user_info.user_id='%s' and active=0; ",
$conn->real_escape_string($today),
$conn->real_escape_string($uidPal));
$results=$conn->query($query_up_email);

echo  "<div class='contOk'>  <h2 class='perfect'>Grazie, il tuo account è stato riattivato hai ricevuto il bonus di 1000 punti!</p></h2></div>";












?>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- owl carousel js-->
<script src="owl-carousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
