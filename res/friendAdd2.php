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

$mail1=$_GET["mailsend1"];
$mail2=$_GET["mailsend2"];
$mail3=$_GET["mailsend3"];
$uidPal=$_GET["uidPal"];
$today=date('Y-m-d H:i:s');

$getMail="null";

//salva info in db

//originale
// $query_up_email = "UPDATE t_user_info set paypalEmail='$mailPal' where t_user_info.user_id='$uidPal'";
// $upEmail = mysqli_query($admin,$query_up_email);

//lettura password
/*
$query_cerca_email = sprintf("SELECT pwd FROM t_user_info where t_user_info.user_id='%s'",
$conn->real_escape_string($uidPal),);
$results=$conn->query($query_cerca_email);
$lvl = mysqli_fetch_assoc($results);
*/

$mailInserite=0;
for ($i = 1; $i <= 3; $i++) 
{

	if($i==1) {$getMail=$mail1; }
	if($i==2) {$getMail=$mail2; }
	if($i==3) {$getMail=$mail3; }

    if (!empty($getMail)) 
	{
	$query_add_email=sprintf("INSERT INTO portaamico VALUES (NULL,'%s', '%s', '%s',0,0); ",

	$conn->real_escape_string($uidPal),
	$conn->real_escape_string($getMail),
	$conn->real_escape_string($today)
        );
	$results=$conn->query($query_add_email);
    $mailInserite++;
    
	}

  

}

if ($mailInserite>0) { $mText="Grazie!<br/> Inviteremo i tuoi amici quanto prima. <p>Se vuoi invitare altri amici aggiorna questa pagina.</p>&nbsp;<p></p>";}
else { $mText="Non sono stati trovati indirizzi validi";}

echo  "<div class='contOk'>  <h2 class='perfect'>".$mText."</h2></div>";








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
