<?php require_once('../Connections/admin.php'); ?>

<?php
 
/*
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
*/
?>

<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_GET['username'])) {
  echo "ciao";
  $loginUsername=$_GET['username'];
  $password=$_GET['password'];
  $MM_fldUserAuthorization = "roles";
  $MM_redirectLoginSuccess = "homegest.php";
  //$MM_redirectLoginFailed = "homegest.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysqli_select_db($database_admin, $admin);
  
  /*
  $LoginRS__query=sprintf("SELECT name, password, roles FROM t_users WHERE name=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
 */

  $LoginRS__query="SELECT * FROM t_users WHERE name='$loginUsername' AND password='$password'"; 
  //$LoginRS__query="SELECT * FROM t_users"; 

  $LoginRS = mysqli_query($admin,$LoginRS__query);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  
  if ($loginFoundUser) {
    
    //$loginStrGroup  = mysqli_result($LoginRS,0,'roles');
    $loginStrGroup  = "admin";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
    /*
    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    */
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}


$uname=$_GET['username'];
$pass=$_GET['password'];
$sub=$_GET['submit'];
$error="";
$success="";
$sub=htmlspecialchars($sub);

/*
if($sub="ACCEDI"){
  if($uname=="admin"){
    if($pass=="Giu\$Giu$1926"){
      $error="";
      $success="Welcome Admin";
    }
    else{
      $error="Invalid Password!";
      $success="";
    }
  }
  else{
    $error="Invalid Username!";
    $succes="";
  }

}
*/


require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 

?>


  <div class="content-wrapper">
       <div class="container">

 <div class="row">
  <div class="col-md-8 col-sm-8 col-xs-8">
<div class="panel panel-info">
   <div class="panel-heading">
                         LOGIN
                        </div>
  <div class="panel-body">						
  <form role="form" id="form1" name="form1" method="get" >
                                         <div class="form-group">
                                            <label>Nome utente</label>
                                            <input class="form-control" name="username" type="text" id="username" size="40" required />
                                            <p class="help-block">Inserisci nome utente</p>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="password" type="password" id="password" size="40"  required/>
                                            <p class="help-block">Inserisci password</p>
                                        </div>
    <input type="submit" name="sumbit" class="btn btn-info" value="ACCEDI" /></td>
  </form>
  <p><?php echo $error; ?></p>
  <p><?php echo $success; ?></p>
  <p><?php echo $uname; ?></p>
  <p><?php echo $pass; ?></p>
  <p><?php echo $password; ?></p>
  <p><?php echo $password2; ?></p>
  <p><?php echo $password3; ?></p>
  </div>
 </div> 
 </div>
 
</div>

</div>
</div>


<?php 

require_once('inc_footer.php'); 



?>

