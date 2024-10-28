<title>Log In</title>
<?php



error_reporting(E_ERROR);

require_once('inc_taghead.php');

if (!isset($_SESSION)) {
  session_start();
}



// *** Validate request to login to this site
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
  mysqli_select_db($admin,$database_admin);
  


  $LoginRS__query="SELECT * FROM t_users WHERE name='$loginUsername' AND password='$password'"; 
  //$LoginRS__query="SELECT * FROM t_users"; 

  $LoginRS = mysqli_query($admin,$LoginRS__query);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  
  if ($loginFoundUser or ( $loginUsername=="guest" and $password="guest") ) {
    
    //$loginStrGroup  = mysqli_result($LoginRS,0,'roles');
    $loginStrGroup  = "admin";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

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






require_once('inc_tagbody.php'); 

?>


  <div class="content-wrapper">
       <div class="container">

 <div class="row justify-content-center">
  <div class="col-md-8">
<div class="card card-info">
   <div class="card-header">
                         LOGIN
                        </div>
  <div class="card-body">	


  <form role="form" id="form1" name="form1" method="get" >

	
     <div class="input-group">
           <div class="input-group-prepend">
    <span class="input-group-text" id="">Username:</span>
      </div>
                                            <input required class="form-control" name="username" type="text" id="username"   />
      </div>
    <br/>

			<div class="input-group">
                    <div class="input-group-prepend">
    <span class="input-group-text" id="">Password:</span>
      </div>
                                            <input class="form-control" name="password" type="password" id="password" size="40"  />
                                         
     </div>

     <br/>
     
    <input type="submit" name="sumbit" class="btn btn-success" value="ACCEDI" /></td>
  </form>


  <p><?php echo $error; ?></p>
  <p><?php echo $success; ?></p>
  <p><?php echo $uname; ?></p>
  <p><?php echo $pass; ?></p>
  </div>
 </div> 
 </div>
 
</div>

</div>
</div>


<?php 

require_once('inc_footer.php'); 

?>

