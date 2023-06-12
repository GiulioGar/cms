<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"


//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 

//$con = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$con = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');
//$admin = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}

/*
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT * FROM t_user_info WHERE user_id = '6HDPX0NOH1'";
$user = mysqli_query($admin,$query_user);
$row_user = mysqli_fetch_assoc($user);
*/

//data
$data=date("Y-m-d H:i:s");

//Variabili da link
$userId=$_GET["user_id"];
$prj=$_GET["prj"];
$sid=$_GET["sid"];
$iid=$_GET["iid"];
$nuovoPunteggio;

$today=date("Y-m-d h:i:s");

// echo "Data ".$today."<br/>";


//lettura livello
$query_cerca_livello = "SELECT points FROM t_user_info where t_user_info.user_id='$userId'";
$cerca_livello = mysqli_query($admin,$query_cerca_livello);
$lvl = mysqli_fetch_assoc($cerca_livello);

//lettura punteggio da assegnare
$query_cerca_punteggio = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='prize_complete'";
$cerca_punteggio = mysqli_query($admin,$query_cerca_punteggio);
$punteggio = mysqli_fetch_assoc($cerca_punteggio);

//status intervista
$query_cerca_status = "SELECT * FROM millebytesdb.t_respint where uid='$userId' and sid='$sid' and prj_name='$prj'";
$cerca_status = mysqli_query($admin,$query_cerca_status);
$status = mysqli_fetch_assoc($cerca_status);

//status ricerca
$query_ricerca = "SELECT * FROM millebytesdb.t_surveys where sid='$sid'";
$cerca_ricerca = mysqli_query($admin,$query_ricerca);
$ricerca = mysqli_fetch_assoc($cerca_ricerca);

//lettura in history
$query_cerca_storico = "SELECT * FROM millebytesdb.t_user_history where user_id='$userId' and event_info LIKE '%$sid,$prj%'";
$cerca_storico = mysqli_query($admin,$query_cerca_storico);
$num_storico = mysqli_num_rows($cerca_storico);

$puntAttuale=$lvl['points'];
$puntAssegnato=$punteggio['value'];
$statusRicerca=$status['status'];
$statusProgetto=$ricerca['status'];

$nuovoPunteggio=$puntAttuale+$puntAssegnato;

// echo "Punti attuali: ".$puntAttuale;
// echo "<br/>Punti da assegnare: ".$puntAssegnato;
// echo "<br/>Status Ricerca: ".$statusRicerca;
// echo "<br/>Status progetto: ".$statusProgetto;
// echo "<br/>Righe Storico: ".$num_storico;

$eventinfo="(".$iid.",".$sid.",".$prj.")";

if($num_storico==0 && $statusRicerca==3 && $statusProgetto==2)
{

    $query_upPoints= "UPDATE t_user_info SET points= $nuovoPunteggio where user_id='$userId'";
    $upPoints = mysqli_query($admin,$query_upPoints);

    $query_aggStory= "INSERT INTO t_user_history (user_id,event_date,event_type,event_info,prev_level,new_level) values ('$userId','$today','interview_complete','$eventinfo',$puntAttuale,$nuovoPunteggio)";
    $aggiungiStory = mysqli_query($admin,$query_aggStory);


    echo  "<br/><br/>Nuovo Punteggio assegnato: ".$nuovoPunteggio;   

}    

else 
{
    echo "<br/><br/>Punteggio non assegnato";
}


?>



<body>

</body>

<script>
    
window.location.href = "https://millebytes.com/res/final_it.php?user_id=<?php echo $userId ?>";
</script>
