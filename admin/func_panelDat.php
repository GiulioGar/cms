<?php

$today=date("Y-m-d H:i:s", mktime(date("H")-6,date("i,s,m,d,Y") ));
$mesi1=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-1,date("d"),date("Y")));
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi4=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-4,date("d"),date("Y")));
$mesi6=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-6,date("d"),date("Y")));
$mesi12=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m"),date("d"),date("Y")-1));
$mesi36=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m"),date("d"),date("Y")-3));

//Utenti generici//

//TOT
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1'";
$tot_user = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_use = mysqli_fetch_assoc($tot_user);
//DONNE 
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender='2'";
$tot_userGirl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_useGirl = mysqli_fetch_assoc($tot_userGirl);

//ATTIVI//

//attivi TOTALI 2mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi2' AND story.event_type <>'subscribe'  order by story.event_date";
$tot_att2 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act2 = mysqli_fetch_assoc($tot_att2);


//attivi TOTALI 4mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi4' AND story.event_type <>'subscribe'   order by story.event_date";
$tot_att4 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act4 = mysqli_fetch_assoc($tot_att4);

//attivi TOTALI 6mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi6' AND story.event_type <>'subscribe'   order by story.event_date";
$tot_att6 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act6 = mysqli_fetch_assoc($tot_att6);

//attivi TOTALI 12mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi12' AND story.event_type <>'subscribe'   order by story.event_date";
$tot_att12 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act12 = mysqli_fetch_assoc($tot_att12);


//attivi TOTALI 36mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi36' AND story.event_type <>'subscribe'   order by story.event_date";
$tot_att36 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act36 = mysqli_fetch_assoc($tot_att36);


//attivi DONNE 2mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi2' AND story.event_type <>'subscribe'  AND gender=2   order by story.event_date";
$tot_att2Girl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act2Girl = mysqli_fetch_assoc($tot_att2Girl);

//attivi DONNE 4mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi4' AND story.event_type <>'subscribe'  AND gender=2  order by story.event_date";
$tot_att4Girl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act4Girl = mysqli_fetch_assoc($tot_att4Girl);

//attivi DONNE 6mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi6' AND story.event_type <>'subscribe'  AND gender=2  order by story.event_date";
$tot_att6Girl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act6Girl = mysqli_fetch_assoc($tot_att6Girl);

//attivi DONNE 12mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi12' AND story.event_type <>'subscribe'  AND gender=2  order by story.event_date";
$tot_att12Girl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act12Girl = mysqli_fetch_assoc($tot_att12Girl);


//attivi DONNE 36mesi
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi36' AND story.event_type <>'subscribe'  AND gender=2  order by story.event_date";
$tot_att36Girl = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act36Girl = mysqli_fetch_assoc($tot_att36Girl);





//RICERCHE ESTERNE ITALIA 2014
mysqli_select_db($admin,$database_admin);
$query_user_italia2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_italia2014 = mysqli_query($admin,$query_user_italia2014) or die(mysql_error());
$italia2014 = mysqli_fetch_assoc($ric_italia2014);





mysqli_select_db($admin,$database_admin);
$query_user_italia_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_italia_c2014 = mysqli_query($admin,$query_user_italia_c2014) or die(mysql_error());
$italia_c2014 = mysqli_fetch_assoc($ric_italia_c2014);

if ($italia_c2014['complete_ext']==''){$italia_c2014['complete_ext']=0;}

//RICERCHE ESTERNE UK 2014
mysqli_select_db($admin,$database_admin);
$query_user_uk2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_uk2014 = mysqli_query($admin,$query_user_uk2014) or die(mysql_error());
$uk2014 = mysqli_fetch_assoc($ric_uk2014);



mysqli_select_db($admin,$database_admin);
$query_user_uk_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_uk_c2014 = mysqli_query($admin,$query_user_uk_c2014) or die(mysql_error());
$uk_c2014 = mysqli_fetch_assoc($ric_uk_c2014);

if ($uk_c2014['complete_ext']==''){$uk_c2014['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2014
mysqli_select_db($admin,$database_admin);
$query_user_francia2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_francia2014 = mysqli_query($admin,$query_user_francia2014) or die(mysql_error());
$francia2014 = mysqli_fetch_assoc($ric_francia2014);


mysqli_select_db($admin,$database_admin);
$query_user_francia_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_francia_c2014 = mysqli_query($admin,$query_user_francia_c2014) or die(mysql_error());
$francia_c2014 = mysqli_fetch_assoc($ric_francia_c2014);

if ($francia_c2014['complete_ext']==''){$francia_c2014['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2014
mysqli_select_db($admin,$database_admin);
$query_user_germania2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_germania2014 = mysqli_query($admin,$query_user_germania2014) or die(mysql_error());
$germania2014 = mysqli_fetch_assoc($ric_germania2014);


mysqli_select_db($admin,$database_admin);
$query_user_germania_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_germania_c2014 = mysqli_query($admin,$query_user_germania_c2014) or die(mysql_error());
$germania_c2014 = mysqli_fetch_assoc($ric_germania_c2014);

if ($germania_c2014['complete_ext']==''){$germania_c2014['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2014
mysqli_select_db($admin,$database_admin);
$query_user_spagna2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_spagna2014 = mysqli_query($admin,$query_user_spagna2014) or die(mysql_error());
$spagna2014 = mysqli_fetch_assoc($ric_spagna2014);


mysqli_select_db($admin,$database_admin);
$query_user_spagna_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_spagna_c2014 = mysqli_query($admin,$query_user_spagna_c2014) or die(mysql_error());
$spagna_c2014 = mysqli_fetch_assoc($ric_spagna_c2014);

if ($spagna_c2014['complete_ext']==''){$spagna_c2014['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2014
mysqli_select_db($admin,$database_admin);
$query_user_altro2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_altro2014 = mysqli_query($admin,$query_user_altro2014) or die(mysql_error());
$altro2014 = mysqli_fetch_assoc($ric_altro2014);


mysqli_select_db($admin,$database_admin);
$query_user_altro_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2014%')  and (panel=0 or panel=1))";
$ric_altro_c2014 = mysqli_query($admin,$query_user_altro_c2014) or die(mysql_error());
$altro_c2014 = mysqli_fetch_assoc($ric_altro_c2014);


if ($altro_c2014['complete_ext']==''){$altro_c2014['complete_ext']=0;}







//RICERCHE ESTERNE ITALIA 2018
mysqli_select_db($admin,$database_admin);
$query_user_italia2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_italia2018 = mysqli_query($admin,$query_user_italia2018) or die(mysql_error());
$italia2018 = mysqli_fetch_assoc($ric_italia2018);


mysqli_select_db($admin,$database_admin);
$query_user_italia_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_italia_c2018 = mysqli_query($admin,$query_user_italia_c2018) or die(mysql_error());
$italia_c2018 = mysqli_fetch_assoc($ric_italia_c2018);

if ($italia_c2018['complete_ext']==''){$italia_c2018['complete_ext']=0;}

//RICERCHE ESTERNE UK 2018
mysqli_select_db($admin,$database_admin);
$query_user_uk2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_uk2018 = mysqli_query($admin,$query_user_uk2018) or die(mysql_error());
$uk2018 = mysqli_fetch_assoc($ric_uk2018);

mysqli_select_db($admin,$database_admin);
$query_user_uk_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_uk_c2018 = mysqli_query($admin,$query_user_uk_c2018) or die(mysql_error());
$uk_c2018 = mysqli_fetch_assoc($ric_uk_c2018);

if ($uk_c2018['complete_ext']==''){$uk_c2018['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2018
mysqli_select_db($admin,$database_admin);
$query_user_francia2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_francia2018 = mysqli_query($admin,$query_user_francia2018) or die(mysql_error());
$francia2018 = mysqli_fetch_assoc($ric_francia2018);


mysqli_select_db($admin,$database_admin);
$query_user_francia_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_francia_c2018 = mysqli_query($admin,$query_user_francia_c2018) or die(mysql_error());
$francia_c2018 = mysqli_fetch_assoc($ric_francia_c2018);

if ($francia_c2018['complete_ext']==''){$francia_c2018['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2018
mysqli_select_db($admin,$database_admin);
$query_user_germania2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_germania2018 = mysqli_query($admin,$query_user_germania2018) or die(mysql_error());
$germania2018 = mysqli_fetch_assoc($ric_germania2018);


mysqli_select_db($admin,$database_admin);
$query_user_germania_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_germania_c2018 = mysqli_query($admin,$query_user_germania_c2018) or die(mysql_error());
$germania_c2018 = mysqli_fetch_assoc($ric_germania_c2018);

if ($germania_c2018['complete_ext']==''){$germania_c2018['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2018
mysqli_select_db($admin,$database_admin);
$query_user_spagna2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_spagna2018 = mysqli_query($admin,$query_user_spagna2018) or die(mysql_error());
$spagna2018 = mysqli_fetch_assoc($ric_spagna2018);


mysqli_select_db($admin,$database_admin);
$query_user_spagna_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_spagna_c2018 = mysqli_query($admin,$query_user_spagna_c2018) or die(mysql_error());
$spagna_c2018 = mysqli_fetch_assoc($ric_spagna_c2018);

if ($spagna_c2018['complete_ext']==''){$spagna_c2018['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2018
mysqli_select_db($admin,$database_admin);
$query_user_altro2018 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_altro2018 = mysqli_query($admin,$query_user_altro2018) or die(mysql_error());
$altro2018 = mysqli_fetch_assoc($ric_altro2018);


mysqli_select_db($admin,$database_admin);
$query_user_altro_c2018 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2018%')  and (panel=0 or panel=1))";
$ric_altro_c2018 = mysqli_query($admin,$query_user_altro_c2018) or die(mysql_error());
$altro_c2018 = mysqli_fetch_assoc($ric_altro_c2018);

if ($altro_c2018['complete_ext']==''){$altro_c2018['complete_ext']=0;}




//RICERCHE ESTERNE ITALIA 2016
mysqli_select_db($admin,$database_admin);
$query_user_italia2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_italia2016 = mysqli_query($admin,$query_user_italia2016) or die(mysql_error());
$italia2016 = mysqli_fetch_assoc($ric_italia2016);


mysqli_select_db($admin,$database_admin);
$query_user_italia_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_italia_c2016 = mysqli_query($admin,$query_user_italia_c2016) or die(mysql_error());
$italia_c2016 = mysqli_fetch_assoc($ric_italia_c2016);

if ($italia_c2016['complete_ext']==''){$italia_c2016['complete_ext']=0;}

//RICERCHE ESTERNE UK 2016
mysqli_select_db($admin,$database_admin);
$query_user_uk2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_uk2016 = mysqli_query($admin,$query_user_uk2016) or die(mysql_error());
$uk2016 = mysqli_fetch_assoc($ric_uk2016);

mysqli_select_db($admin,$database_admin);
$query_user_uk_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_uk_c2016 = mysqli_query($admin,$query_user_uk_c2016) or die(mysql_error());
$uk_c2016 = mysqli_fetch_assoc($ric_uk_c2016);

if ($uk_c2016['complete_ext']==''){$uk_c2016['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2016
mysqli_select_db($admin,$database_admin);
$query_user_francia2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_francia2016 = mysqli_query($admin,$query_user_francia2016) or die(mysql_error());
$francia2016 = mysqli_fetch_assoc($ric_francia2016);


mysqli_select_db($admin,$database_admin);
$query_user_francia_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_francia_c2016 = mysqli_query($admin,$query_user_francia_c2016) or die(mysql_error());
$francia_c2016 = mysqli_fetch_assoc($ric_francia_c2016);

if ($francia_c2016['complete_ext']==''){$francia_c2016['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2016
mysqli_select_db($admin,$database_admin);
$query_user_germania2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_germania2016 = mysqli_query($admin,$query_user_germania2016) or die(mysql_error());
$germania2016 = mysqli_fetch_assoc($ric_germania2016);


mysqli_select_db($admin,$database_admin);
$query_user_germania_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_germania_c2016 = mysqli_query($admin,$query_user_germania_c2016) or die(mysql_error());
$germania_c2016 = mysqli_fetch_assoc($ric_germania_c2016);

if ($germania_c2016['complete_ext']==''){$germania_c2016['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2016
mysqli_select_db($admin,$database_admin);
$query_user_spagna2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_spagna2016 = mysqli_query($admin,$query_user_spagna2016) or die(mysql_error());
$spagna2016 = mysqli_fetch_assoc($ric_spagna2016);


mysqli_select_db($admin,$database_admin);
$query_user_spagna_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_spagna_c2016 = mysqli_query($admin,$query_user_spagna_c2016) or die(mysql_error());
$spagna_c2016 = mysqli_fetch_assoc($ric_spagna_c2016);

if ($spagna_c2016['complete_ext']==''){$spagna_c2016['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2016
mysqli_select_db($admin,$database_admin);
$query_user_altro2016 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_altro2016 = mysqli_query($admin,$query_user_altro2016) or die(mysql_error());
$altro2016 = mysqli_fetch_assoc($ric_altro2016);


mysqli_select_db($admin,$database_admin);
$query_user_altro_c2016 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2016%')  and (panel=0 or panel=1))";
$ric_altro_c2016 = mysqli_query($admin,$query_user_altro_c2016) or die(mysql_error());
$altro_c2016 = mysqli_fetch_assoc($ric_altro_c2016);

if ($altro_c2016['complete_ext']==''){$altro_c2016['complete_ext']=0;}








//RICERCHE ESTERNE ITALIA 2017
mysqli_select_db($admin,$database_admin);
$query_user_italia2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_italia2017 = mysqli_query($admin,$query_user_italia2017) or die(mysql_error());
$italia2017 = mysqli_fetch_assoc($ric_italia2017);


mysqli_select_db($admin,$database_admin);
$query_user_italia_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_italia_c2017 = mysqli_query($admin,$query_user_italia_c2017) or die(mysql_error());
$italia_c2017 = mysqli_fetch_assoc($ric_italia_c2017);

if ($italia_c2017['complete_ext']==''){$italia_c2017['complete_ext']=0;}

//RICERCHE ESTERNE UK 2017
mysqli_select_db($admin,$database_admin);
$query_user_uk2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_uk2017 = mysqli_query($admin,$query_user_uk2017) or die(mysql_error());
$uk2017 = mysqli_fetch_assoc($ric_uk2017);

mysqli_select_db($admin,$database_admin);
$query_user_uk_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_uk_c2017 = mysqli_query($admin,$query_user_uk_c2017) or die(mysql_error());
$uk_c2017 = mysqli_fetch_assoc($ric_uk_c2017);

if ($uk_c2017['complete_ext']==''){$uk_c2017['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2017
mysqli_select_db($admin,$database_admin);
$query_user_francia2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_francia2017 = mysqli_query($admin,$query_user_francia2017) or die(mysql_error());
$francia2017 = mysqli_fetch_assoc($ric_francia2017);


mysqli_select_db($admin,$database_admin);
$query_user_francia_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_francia_c2017 = mysqli_query($admin,$query_user_francia_c2017) or die(mysql_error());
$francia_c2017 = mysqli_fetch_assoc($ric_francia_c2017);

if ($francia_c2017['complete_ext']==''){$francia_c2017['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2017
mysqli_select_db($admin,$database_admin);
$query_user_germania2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_germania2017 = mysqli_query($admin,$query_user_germania2017) or die(mysql_error());
$germania2017 = mysqli_fetch_assoc($ric_germania2017);


mysqli_select_db($admin,$database_admin);
$query_user_germania_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_germania_c2017 = mysqli_query($admin,$query_user_germania_c2017) or die(mysql_error());
$germania_c2017 = mysqli_fetch_assoc($ric_germania_c2017);

if ($germania_c2017['complete_ext']==''){$germania_c2017['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2017
mysqli_select_db($admin,$database_admin);
$query_user_spagna2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_spagna2017 = mysqli_query($admin,$query_user_spagna2017) or die(mysql_error());
$spagna2017 = mysqli_fetch_assoc($ric_spagna2017);


mysqli_select_db($admin,$database_admin);
$query_user_spagna_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_spagna_c2017 = mysqli_query($admin,$query_user_spagna_c2017) or die(mysql_error());
$spagna_c2017 = mysqli_fetch_assoc($ric_spagna_c2017);

if ($spagna_c2017['complete_ext']==''){$spagna_c2017['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2017
mysqli_select_db($admin,$database_admin);
$query_user_altro2017 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_altro2017 = mysqli_query($admin,$query_user_altro2017) or die(mysql_error());
$altro2017 = mysqli_fetch_assoc($ric_altro2017);


mysqli_select_db($admin,$database_admin);
$query_user_altro_c2017 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2017%')  and (panel=0 or panel=1))";
$ric_altro_c2017 = mysqli_query($admin,$query_user_altro_c2017) or die(mysql_error());
$altro_c2017 = mysqli_fetch_assoc($ric_altro_c2017);

if ($altro_c2017['complete_ext']==''){$altro_c2017['complete_ext']=0;}








////Calculator
$currentYear=date("Y");
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;

//TOT
mysqli_select_db($admin,$database_admin);
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_user = mysqli_query($admin,$query_user) or die(mysql_error());
$age_use = mysqli_fetch_assoc($age_user);
//DONNE 
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender='2' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_userGirl = mysqli_query($admin,$query_user) or die(mysql_error());
$age_useGirl = mysqli_fetch_assoc($age_userGirl);
//UOMINI
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender='1' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_userMen = mysqli_query($admin,$query_user) or die(mysql_error());
$age_useMen = mysqli_fetch_assoc($age_userMen);


	//Media redemption Panel//
	
	
		//anno2019
	
	$query_conta19 = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2019%'";
	$surClo19 = mysqli_query($admin,$query_conta19) or die(mysql_error());
	$cloSur19 = mysqli_fetch_assoc($surClo19);
	
	mysqli_select_db($admin,$database_admin);
	$query_ric19 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2019%' ";
	$tot_close19 = mysqli_query($admin,$query_ric19) or die(mysql_error());
	
	while ($row = mysqli_fetch_assoc($tot_close19)) { $totRed19=$row['red_panel']+$totRed19;}
	$medRed19=$totRed19/$cloSur19['tot'];
	
	//anno 2018
	$query_conta18 = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2018%'";
	$surClo18 = mysqli_query($admin,$query_conta18) or die(mysql_error());
	$cloSur18 = mysqli_fetch_assoc($surClo18);
	
	mysqli_select_db($admin,$database_admin);
	$query_ric18 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2018%' ";
	$tot_close18 = mysqli_query($admin,$query_ric18) or die(mysql_error());
	
	
	while ($row = mysqli_fetch_assoc($tot_close18)){ $totRed18=$row['red_panel']+$totRed18;}
	$medRed18=$totRed18/$cloSur18['tot'];

	
	//anno2020
	
	$query_conta20 = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2020%'";
	$surClo20 = mysqli_query($admin,$query_conta20) or die(mysql_error());
	$cloSur20 = mysqli_fetch_assoc($surClo20);
	
	mysqli_select_db($admin,$database_admin);
	$query_ric20 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2020%' ";
	$tot_close20 = mysqli_query($admin,$query_ric20) or die(mysql_error());
	
	while ($row = mysqli_fetch_assoc($tot_close20)) { $totRed20=$row['red_panel']+$totRed20;}
	$medRed20=$totRed20/$cloSur20['tot'];
	
	
	
	//anno2017
	
	$query_conta17 = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2017%'";
	$surClo17 = mysqli_query($admin,$query_conta17) or die(mysql_error());
	$cloSur17 = mysqli_fetch_assoc($surClo17);
	
	mysqli_select_db($admin,$database_admin);
	$query_ric17 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2017%' ";
	$tot_close17 = mysqli_query($admin,$query_ric17) or die(mysql_error());
	
	while ($row = mysqli_fetch_assoc($tot_close17)) { $totRed17=$row['red_panel']+$totRed17;}
	$medRed17=$totRed17/$cloSur17['tot'];

	

	// ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($admin,$query_conta) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	mysqli_select_db($admin,$database_admin);
	$query_m2 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($admin,$query_m2) or die(mysql_error());

	while ($row = mysqli_fetch_assoc($m2_close)) { $totRed2=$row['red_panel']+$totRed2; }
	$medRed2=$totRed2/$cloSur2['tot'];
	
	// info 2018 su tutte le ricerche
	
	//tutte
	mysqli_select_db($admin,$database_admin);
	$query_ric = "SELECT COUNT(sur_id) as tot FROM t_panel_control where sur_date like '2018%'  and (panel=0 or panel=1)";
	$surTot = mysqli_query($admin,$query_ric) or die(mysql_error());
	$totSur= mysqli_fetch_assoc($surTot);
	
	//interne ed esterne
	mysqli_select_db($admin,$database_admin);
	$query_ie = "SELECT * FROM t_panel_control where sur_date like '2018%' and (panel=0 or panel=1)";
	$ie = mysqli_query($admin,$query_ie) or die(mysql_error());
	
	$contaInt=0;
	$contaExt=0;
	while ($row = mysqli_fetch_assoc($ie)) 
	{ 
	$intConta=0;
	$extConta=0;
	
	//calcolo complete interne ed esteerne
	$compInt=$row['complete_int']+$compInt;
	$compExt=$row['complete_ext']+$compExt;
	$intConta=$row['complete_int'];
	$extConta=$row['complete_ext'];
	
	$contact=$row['panel_interno']+$contact;
	$incomplete=$row['incomplete']+$incomplete;
	$abili=$row['abilitati']+$abili;
	
	//conta ricerche interne ed esterne
	if ($intConta>0) {$contaInt++;}
	if ($extConta>0) {$contaExt++;}
	
	}
	

	// info 2016 su tutte le ricerche
	
	//tutte
	mysqli_select_db($admin,$database_admin);
	$query_ric16 = "SELECT COUNT(sur_id) as tot FROM t_panel_control where sur_date like '2019%'  and (panel=0 or panel=1)";
	$surTot16 = mysqli_query($admin,$query_ric16) or die(mysql_error());
	$totSur16= mysqli_fetch_assoc($surTot16);
	
	//interne ed esterne
	mysqli_select_db($admin,$database_admin);
	$query_ie16 = "SELECT * FROM t_panel_control where sur_date like '2019%' and (panel=0 or panel=1)";
	$ie16 = mysqli_query($admin,$query_ie16) or die(mysql_error());
	
	$contaInt16=0;
	$contaExt16=0;
	while ($row = mysqli_fetch_assoc($ie16)) 
	{ 
	$intConta16=0;
	$extConta16=0;
	
	//calcolo complete interne ed esteerne
	$compInt16=$row['complete_int']+$compInt16;
	$compExt16=$row['complete_ext']+$compExt16;
	$intConta16=$row['complete_int'];
	$extConta16=$row['complete_ext'];
	
	$contact16=$row['panel_interno']+$contact16;
	$incomplete16=$row['incomplete']+$incomplete16;
	$abili16=$row['abilitati']+$abili16;
	
	//conta ricerche interne ed esterne
	if ($intConta16>0) {$contaInt16++;}
	if ($extConta16>0) {$contaExt16++;}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	// info 2017 su tutte le ricerche
	
	//tutte
	mysqli_select_db($admin,$database_admin);
	$query_ric17 = "SELECT COUNT(sur_id) as tot FROM t_panel_control where sur_date like '2017%' and (panel=0 or panel=1)";
	$surTot17 = mysqli_query($admin,$query_ric17) or die(mysql_error());
	$totSur17= mysqli_fetch_assoc($surTot17);
	
	//interne ed esterne
	mysqli_select_db($admin,$database_admin);
	$query_ie17 = "SELECT * FROM t_panel_control where sur_date like '2017%' and (panel=0 or panel=1)";
	$ie17 = mysqli_query($admin,$query_ie17) or die(mysql_error());
	
	$contaInt17=0;
	$contaExt17=0;
	while ($row = mysqli_fetch_assoc($ie17)) 
	{ 
	$intConta17=0;
	$extConta17=0;
	
	//calcolo complete interne ed esteerne
	$compInt17=$row['complete_int']+$compInt17;
	$compExt17=$row['complete_ext']+$compExt17;
	$intConta17=$row['complete_int'];
	$extConta17=$row['complete_ext'];
	
	$contact17=$row['panel_interno']+$contact17;
	$incomplete17=$row['incomplete']+$incomplete17;
	$abili17=$row['abilitati']+$abili17;
	
	//conta ricerche interne ed esterne
	if ($intConta17>0) {$contaInt17++;}
	if ($extConta17>0) {$contaExt17++;}
	
	}
	
		// conta registrati 2020
			$query_reg20 = "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info where reg_date >='2020-01-01' and  reg_date <='2020-12-31' ";
			$regTot20 = mysqli_query($admin,$query_reg20) or die(mysql_error());
			$totReg20= mysqli_fetch_assoc($regTot20);
	
		// conta registrati 2019
		$query_reg19 = "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info where reg_date >='2019-01-01' and  reg_date <='2019-12-31' ";
		$regTot19 = mysqli_query($admin,$query_reg19) or die(mysql_error());
		$totReg19= mysqli_fetch_assoc($regTot19);
	
	
	
	
	// conta registrati 2018 
		$query_reg18 = "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info where reg_date >='2018-01-01' and  reg_date <='2018-12-31' ";
		$regTot18 = mysqli_query($admin,$query_reg18) or die(mysql_error());
		$totReg18= mysqli_fetch_assoc($regTot18);
		
		// conta registrati 2016 
		$query_reg16 = "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info where reg_date >='2016-01-01' and  reg_date <='2016-12-31'";
		$regTot16 = mysqli_query($admin,$query_reg16) or die(mysql_error());
		$totReg16= mysqli_fetch_assoc($regTot16);
		
		// conta registrati 2017 
		$query_reg17 = "SELECT COUNT(user_id) as tot FROM millebytesdb.t_user_info where reg_date >='2017-01-01' and  reg_date <='2017-12-31' ";
		$regTot17 = mysqli_query($admin,$query_reg17) or die(mysql_error());
		$totReg17= mysqli_fetch_assoc($regTot17);
		
		/*
// conta registrati MV 
$query_regmvf = "SELECT COUNT(uid) as tot FROM millebytesdb.referral ";
$regTotmvf = mysqli_query($query_regmvf, $admin) or die(mysql_error());
$totRegmvf= mysqli_fetch_assoc($regTotmvf);
*/




//complete italia interne 2018
mysqli_select_db($admin,$database_admin);
$query_italia2018 = "SELECT * FROM t_panel_control where sur_date like '2018%' and paese='Italia' and (panel=0 or panel=1)";
$ita2018 = mysqli_query($admin,$query_italia2018) or die(mysql_error());

$italiainterne2018=0;
$italiaesterne2018=0;
$percentualeinterne2018=0;
$percentualeesterne2018=0;
while ($row = mysqli_fetch_assoc($ita2018)) 
{ 
	
	
	//calcolo complete interne ed esteerne
	$italiainterne2018=$row['complete_int']+$italiainterne2018;
	$italiaesterne2018=$row['complete_ext']+$italiaesterne2018;
	
	
}

$percentualeinterne2018=number_format(($italiainterne2018/($italiainterne2018+$italiaesterne2018))*100,2);
$percentualeesterne2018=number_format(($italiaesterne2018/($italiainterne2018+$italiaesterne2018))*100,2);




//complete italia interne 2016
mysqli_select_db($admin,$database_admin);
$query_italia2016 = "SELECT * FROM t_panel_control where sur_date like '2016%' and paese='Italia' and (panel=0 or panel=1)";
$ita2016 = mysqli_query($admin,$query_italia2016) or die(mysql_error());

$italiainterne2016=0;
$italiaesterne2016=0;
$percentualeinterne2016=0;
$percentualeesterne2016=0;
while ($row = mysqli_fetch_assoc($ita2016)) 
{ 
	
	
	//calcolo complete interne ed esteerne
	$italiainterne2016=$row['complete_int']+$italiainterne2016;
	$italiaesterne2016=$row['complete_ext']+$italiaesterne2016;
	
	
}

$percentualeinterne2016=number_format(($italiainterne2016/($italiainterne2016+$italiaesterne2016))*100,2);
$percentualeesterne2016=number_format(($italiaesterne2016/($italiainterne2016+$italiaesterne2016))*100,2);



//complete italia interne 2017
mysqli_select_db($admin,$database_admin);
$query_italia2017 = "SELECT * FROM t_panel_control where sur_date like '2017%' and paese='Italia' and (panel=0 or panel=1)";
$ita2017 = mysqli_query($admin,$query_italia2017) or die(mysql_error());

$italiainterne2017=0;
$italiaesterne2017=0;
$percentualeinterne2017=0;
$percentualeesterne2017=0;
while ($row = mysqli_fetch_assoc($ita2017)) 
{ 
	
	
	//calcolo complete interne ed esteerne
	$italiainterne2017=$row['complete_int']+$italiainterne2017;
	$italiaesterne2017=$row['complete_ext']+$italiaesterne2017;
	
	
}


$percentualeinterne2017=number_format(($italiainterne2017/($italiainterne2017+$italiaesterne2017))*100,2);
$percentualeesterne2017=number_format(($italiaesterne2017/($italiainterne2017+$italiaesterne2017))*100,2);


	
?>


<?php 
$totMen=$tot_use['total']-$tot_useGirl['total'];
$tot_att2Men=$tot_act2['total']-$tot_act2Girl['total'];
$tot_att4Men=$tot_act4['total']-$tot_act4Girl['total'];
$tot_att6Men=$tot_act6['total']-$tot_act6Girl['total'];
$tot_att12Men=$tot_act12['total']-$tot_act12Girl['total'];
$tot_att36Men=$tot_act36['total']-$tot_act36Girl['total'];
$redTot2=$tot_act2['total']/$tot_use['total']*100;
$redTot4=$tot_act4['total']/$tot_use['total']*100;
$redTot6=$tot_act6['total']/$tot_use['total']*100;
$redTot12=$tot_act12['total']/$tot_use['total']*100;
$redTot36=$tot_act36['total']/$tot_use['total']*100;

$percA=$a_ric['total']/$tot_act12['total']*100;
$percB=$b_ric['total']/$tot_act12['total']*100;
$percC=$c_ric['total']/$tot_act12['total']*100;
$percD=$d_ric['total']/$tot_act12['total']*100;
$percE=$e_ric['total']/$tot_act12['total']*100;
$percF=$f_ric['total']/$tot_act12['total']*100;
$percG=$g_ric['total']/$tot_act12['total']*100;
$percH=$h_ric['total']/$tot_act12['total']*100;

?>

