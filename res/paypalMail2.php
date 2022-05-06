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


//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 

//online
$conn = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');

//test
//$conn = @mysqli_connect('localhost', 'root', '', 'millebytesdb');
//$admin = @mysqli_connect('localhost', 'root', '', 'millebytesdb');

if (!$conn) {
    echo "Error: " . mysqli_connect_error();
	exit();
}

$mailPal=$_GET["mailPal"];
$uidPal=$_GET["uidPal"];


//salva info in db

//originale
// $query_up_email = "UPDATE t_user_info set paypalEmail='$mailPal' where t_user_info.user_id='$uidPal'";
// $upEmail = mysqli_query($admin,$query_up_email);

$query_up_email=sprintf("UPDATE t_user_info set paypalEmail='%s' where t_user_info.user_id='%s'; ",
$conn->real_escape_string($mailPal),
$conn->real_escape_string($uidPal));
$results=$conn->query($query_up_email);



echo  "<br/>Query:".$query_up_email;




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
