<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname_admin = "localhost"; 
$database_admin = "millebytesdb";
$username_admin = "mbuser";
$password_admin = '$leeple%1598';

$conn = new mysqli($hostname_admin, $username_admin,$password_admin, $database_admin);

if ($conn->connect_error){
    die($conn->connect_error);
}

$uid=$_GET["pseudonym"];
$tic=$_GET["tic"];
$pseudonym=$_GET["pseudonym"];
$c_0034=$_GET["c_0034"];
$target=$_GET["target"];

if (empty($uid) or empty($tic) or empty($c_0034) or empty($target) or ($target != "1" AND $target != "2")) {
    if (empty($uid)){echo "Error: Variable pseudonym is empty.<br>";}
    if (empty($tic)){echo "Error: Variable tic is empty.<br>";}
    if (empty($c_0034)){echo "Error: Variable c_0034 is empty.<br>";}
    if (empty($target)){echo "Error: Variable target is empty.<br>";}
    if ($target!="1" && $target!="2"){echo "Error: Variable target is not valid.<br>";}
  }else{

        //$sql="SELECT * FROM t_respint where sid='TEST2' AND prj_name='GPE' AND uid=$uid";
        $sql = sprintf("SELECT * FROM t_respint where sid='R2201028' AND prj_name='STR' AND uid='%s'",
        $conn->real_escape_string($uid));
        //$sql="SELECT * FROM t_respint where sid='TEST2' AND prj_name='GPE' AND uid='$uid'";
        $results=$conn->query($sql);

        //var_dump($results->num_rows);

        if($results){ 
            if ($results->num_rows==0){
                //$sql_insert="INSERT INTO t_respint (sid, uid, status, iid, prj_name) VALUES ('TEST2', '$uid', '0', '-1','GPE'); ";
                $sql_insert=sprintf("INSERT INTO t_respint (sid, uid, status, iid, prj_name) VALUES ('R2201028', '%s', '0', '-1','STR'); ",
                $conn->real_escape_string($uid));
                $results=$conn->query($sql_insert);
            }
        }



        $linkPrimis="http://www.primisoft.com/primis/run.do?sid=R2201028&prj=STR&uid=$pseudonym&tic=$tic&c_0034=$c_0034&target=$target";
        
        header("location: ".$linkPrimis);
}

?>