<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

$params= $columns = $totatRecords = $data = array();

$params=$_REQUEST;

$columns= array(
    0 => 'uid',
    1=> 'reg_date',
    2=> 'email',
    3=> 'comp',
    4=> 'cont',
    5=> 'active',

);

$where_condition = $sqlTot = $sqlRec = "";
 
if( !empty($params['search']['value']) ) {
    $where_condition .=	" WHERE ";
    $where_condition .= " ( uid LIKE '%".$params['search']['value']."%' ";    
    $where_condition .= " OR regmail LIKE '%".$params['search']['value']."%' )";
}

$sql_query = " SELECT res.uid, SUM(res.status=3) as comp ,SUM(res.status=0) as cont,info.email,first_name,reg_date
FROM t_respint as res, t_user_info as info where info.user_id=res.uid and info.active=1
GROUP BY res.uid";
$sqlTot .= $sql_query;
$sqlRec .= $sql_query;

if(isset($where_condition) && $where_condition != '') {

    $sqlTot .= $where_condition;
    $sqlRec .= $where_condition;
}

 $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

$queryTot = mysqli_query($admin, $sqlTot) or die("Database Error:". mysqli_error($admin));

$totalRecords = mysqli_num_rows($queryTot);


$queryRecords = mysqli_query($admin, $sqlRec) or die("Error to Get the Post details.");

while( $row = mysqli_fetch_row($queryRecords) ) { 
    $data[] = $row;
}	

$json_data = array(
    "draw"            => intval( $params['draw'] ),   
    "recordsTotal"    => intval( $totalRecords ),  
    "recordsFiltered" => intval($totalRecords),
    "data"            => $data
);

echo json_encode($json_data);


?>