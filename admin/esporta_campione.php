<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$tag=$_REQUEST['tag'];
$tag_csv=$_REQUEST['tag_csv'];


mysqli_select_db($database_admin, $admin);
$query_new = "SELECT user_id,email,first_name,gender,birth_date  FROM t_user_info as info, utenti_target as ute where (ute.target='".$tag_csv."' AND ute.uid=info.user_id )";
$csv_mvf = mysqli_query($query_new, $admin) or die(mysql_error());




    @$csv="uid;email;firstName;genderSuffix";
    $csv .= "\n";
	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
           
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
			
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
       
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
            $csv .= "\n";
    } 
?>


		<div class="campioni">
		<div class="intestaDia">DOWNLOAD CAMPIONE</div>		
			<div style="float:left">
			<form style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input type="image" value="submit" src="img/CSV.gif" />
				</form>
			</div>
				
		
		</div>