<?php


//Utenti generici//
/*
//TOT
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(*) as total FROM t_user_info, referral, field_data_field_user_id where (t_user_info.active='1' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=t_user_info.user_id)";
$tot_user = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_use = mysqli_fetch_assoc($tot_user);
//DONNE 
$query_user = "SELECT COUNT(*) as total FROM t_user_info, referral, field_data_field_user_id where (t_user_info.active='1' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=t_user_info.user_id) && gender='2'";
$tot_userGirl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_useGirl = mysqli_fetch_assoc($tot_userGirl);
*/



//ATTIVI//
/*
//attivi TOTALI 2mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi2' AND story.event_type <>'subscribe' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att2 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act2 = mysqli_fetch_assoc($tot_att2);
*/



/*
//attivi TOTALI 4mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi4' AND story.event_type <>'subscribe' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att4 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act4 = mysqli_fetch_assoc($tot_att4);
*/



/*
//attivi TOTALI 6mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi6' AND story.event_type <>'subscribe' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att6 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act6 = mysqli_fetch_assoc($tot_att6);
*/




//attivi TOTALI 12mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi12' AND story.event_type <>'subscribe' && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att12 = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act12 = mysqli_fetch_assoc($tot_att12);




/*
//attivi DONNE 2mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi2' AND story.event_type <>'subscribe' AND gender=2 && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att2Girl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act2Girl = mysqli_fetch_assoc($tot_att2Girl);

//attivi DONNE 4mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi4' AND story.event_type <>'subscribe' AND gender=2 && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att4Girl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act4Girl = mysqli_fetch_assoc($tot_att4Girl);

//attivi DONNE 6mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi6' AND story.event_type <>'subscribe' AND gender=2 && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att6Girl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act6Girl = mysqli_fetch_assoc($tot_att6Girl);

//attivi DONNE 12mesi
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info,referral,field_data_field_user_id  where (info.active='1' AND story.user_id=info.user_id 
AND story.event_date > '$mesi12' AND story.event_type <>'subscribe' AND gender=2 && referral.uid=field_data_field_user_id.entity_id && field_data_field_user_id.field_user_id_value=info.user_id)  order by story.event_date";
$tot_att12Girl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_act12Girl = mysqli_fetch_assoc($tot_att12Girl);




//// CONTA RICERCHE ///

//Utenti con meno di 5 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys<5 ";
$ric_a = mysqli_query($query_user, $admin) or die(mysql_error());
$a_ric = mysqli_fetch_assoc($ric_a);

//Utenti 5-9 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>4 and year_surveys <10 ";
$ric_b = mysqli_query($query_user, $admin) or die(mysql_error());
$b_ric = mysqli_fetch_assoc($ric_b);


//Utenti 10-19 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>9 and year_surveys <20 ";
$ric_c = mysqli_query($query_user, $admin) or die(mysql_error());
$c_ric = mysqli_fetch_assoc($ric_c);

//Utenti 20-24 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>19 and year_surveys <25 ";
$ric_d = mysqli_query($query_user, $admin) or die(mysql_error());
$d_ric = mysqli_fetch_assoc($ric_d);

//Utenti 25-29 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>24 and year_surveys <30 ";
$ric_e = mysqli_query($query_user, $admin) or die(mysql_error());
$e_ric = mysqli_fetch_assoc($ric_e);

//Utenti 30-34 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>29 and year_surveys<35 ";
$ric_f = mysqli_query($query_user, $admin) or die(mysql_error());
$f_ric = mysqli_fetch_assoc($ric_f);

//Utenti 35-39 ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>34 and year_surveys<40 ";
$ric_g = mysqli_query($query_user, $admin) or die(mysql_error());
$g_ric = mysqli_fetch_assoc($ric_g);

//Utenti 40+ ricerche
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(distinct info.user_id) as total  FROM t_user_info as info, t_user_stats as story where info.active='1' AND story.user_id=info.user_id 
AND story.last_update > '$mesi12' and year_surveys>39";
$ric_h = mysqli_query($query_user, $admin) or die(mysql_error());
$h_ric = mysqli_fetch_assoc($ric_h);




*/




/*
//RICERCHE ESTERNE ITALIA 2014
mysqli_select_db($database_admin, $admin);
$query_user_italia2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_italia2014 = mysqli_query($query_user_italia2014, $admin) or die(mysql_error());
$italia2014 = mysqli_fetch_assoc($ric_italia2014);





mysqli_select_db($database_admin, $admin);
$query_user_italia_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_italia_c2014 = mysqli_query($query_user_italia_c2014, $admin) or die(mysql_error());
$italia_c2014 = mysqli_fetch_assoc($ric_italia_c2014);

if ($italia_c2014['complete_ext']==''){$italia_c2014['complete_ext']=0;}

//RICERCHE ESTERNE UK 2014
mysqli_select_db($database_admin, $admin);
$query_user_uk2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_uk2014 = mysqli_query($query_user_uk2014, $admin) or die(mysql_error());
$uk2014 = mysqli_fetch_assoc($ric_uk2014);



mysqli_select_db($database_admin, $admin);
$query_user_uk_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_uk_c2014 = mysqli_query($query_user_uk_c2014, $admin) or die(mysql_error());
$uk_c2014 = mysqli_fetch_assoc($ric_uk_c2014);

if ($uk_c2014['complete_ext']==''){$uk_c2014['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2014
mysqli_select_db($database_admin, $admin);
$query_user_francia2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_francia2014 = mysqli_query($query_user_francia2014, $admin) or die(mysql_error());
$francia2014 = mysqli_fetch_assoc($ric_francia2014);


mysqli_select_db($database_admin, $admin);
$query_user_francia_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_francia_c2014 = mysqli_query($query_user_francia_c2014, $admin) or die(mysql_error());
$francia_c2014 = mysqli_fetch_assoc($ric_francia_c2014);

if ($francia_c2014['complete_ext']==''){$francia_c2014['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2014
mysqli_select_db($database_admin, $admin);
$query_user_germania2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_germania2014 = mysqli_query($query_user_germania2014, $admin) or die(mysql_error());
$germania2014 = mysqli_fetch_assoc($ric_germania2014);


mysqli_select_db($database_admin, $admin);
$query_user_germania_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_germania_c2014 = mysqli_query($query_user_germania_c2014, $admin) or die(mysql_error());
$germania_c2014 = mysqli_fetch_assoc($ric_germania_c2014);

if ($germania_c2014['complete_ext']==''){$germania_c2014['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2014
mysqli_select_db($database_admin, $admin);
$query_user_spagna2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_spagna2014 = mysqli_query($query_user_spagna2014, $admin) or die(mysql_error());
$spagna2014 = mysqli_fetch_assoc($ric_spagna2014);


mysqli_select_db($database_admin, $admin);
$query_user_spagna_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_spagna_c2014 = mysqli_query($query_user_spagna_c2014, $admin) or die(mysql_error());
$spagna_c2014 = mysqli_fetch_assoc($ric_spagna_c2014);

if ($spagna_c2014['complete_ext']==''){$spagna_c2014['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2014
mysqli_select_db($database_admin, $admin);
$query_user_altro2014 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_altro2014 = mysqli_query($query_user_altro2014, $admin) or die(mysql_error());
$altro2014 = mysqli_fetch_assoc($ric_altro2014);


mysqli_select_db($database_admin, $admin);
$query_user_altro_c2014 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2014%'))";
$ric_altro_c2014 = mysqli_query($query_user_altro_c2014, $admin) or die(mysql_error());
$altro_c2014 = mysqli_fetch_assoc($ric_altro_c2014);


if ($altro_c2014['complete_ext']==''){$altro_c2014['complete_ext']=0;}







//RICERCHE ESTERNE ITALIA 2015
mysqli_select_db($database_admin, $admin);
$query_user_italia2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_italia2015 = mysqli_query($query_user_italia2015, $admin) or die(mysql_error());
$italia2015 = mysqli_fetch_assoc($ric_italia2015);


mysqli_select_db($database_admin, $admin);
$query_user_italia_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Italia')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_italia_c2015 = mysqli_query($query_user_italia_c2015, $admin) or die(mysql_error());
$italia_c2015 = mysqli_fetch_assoc($ric_italia_c2015);

if ($italia_c2015['complete_ext']==''){$italia_c2015['complete_ext']=0;}

//RICERCHE ESTERNE UK 2015
mysqli_select_db($database_admin, $admin);
$query_user_uk2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_uk2015 = mysqli_query($query_user_uk2015, $admin) or die(mysql_error());
$uk2015 = mysqli_fetch_assoc($ric_uk2015);

mysqli_select_db($database_admin, $admin);
$query_user_uk_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Uk')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_uk_c2015 = mysqli_query($query_user_uk_c2015, $admin) or die(mysql_error());
$uk_c2015 = mysqli_fetch_assoc($ric_uk_c2015);

if ($uk_c2015['complete_ext']==''){$uk_c2015['complete_ext']=0;}

//RICERCHE ESTERNE FRANCIA 2015
mysqli_select_db($database_admin, $admin);
$query_user_francia2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_francia2015 = mysqli_query($query_user_francia2015, $admin) or die(mysql_error());
$francia2015 = mysqli_fetch_assoc($ric_francia2015);


mysqli_select_db($database_admin, $admin);
$query_user_francia_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Francia')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_francia_c2015 = mysqli_query($query_user_francia_c2015, $admin) or die(mysql_error());
$francia_c2015 = mysqli_fetch_assoc($ric_francia_c2015);

if ($francia_c2015['complete_ext']==''){$francia_c2015['complete_ext']=0;}

//RICERCHE ESTERNE GERMANIA 2015
mysqli_select_db($database_admin, $admin);
$query_user_germania2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_germania2015 = mysqli_query($query_user_germania2015, $admin) or die(mysql_error());
$germania2015 = mysqli_fetch_assoc($ric_germania2015);


mysqli_select_db($database_admin, $admin);
$query_user_germania_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='Germania')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_germania_c2015 = mysqli_query($query_user_germania_c2015, $admin) or die(mysql_error());
$germania_c2015 = mysqli_fetch_assoc($ric_germania_c2015);

if ($germania_c2015['complete_ext']==''){$germania_c2015['complete_ext']=0;}


//RICERCHE ESTERNE SPAGNA 2015
mysqli_select_db($database_admin, $admin);
$query_user_spagna2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where ((paese='Spagna')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_spagna2015 = mysqli_query($query_user_spagna2015, $admin) or die(mysql_error());
$spagna2015 = mysqli_fetch_assoc($ric_spagna2015);


mysqli_select_db($database_admin, $admin);
$query_user_spagna_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where ((paese='spagna')AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_spagna_c2015 = mysqli_query($query_user_spagna_c2015, $admin) or die(mysql_error());
$spagna_c2015 = mysqli_fetch_assoc($ric_spagna_c2015);

if ($spagna_c2015['complete_ext']==''){$spagna_c2015['complete_ext']=0;}

//RICERCHE ESTERNE ALTRO 2015
mysqli_select_db($database_admin, $admin);
$query_user_altro2015 = "SELECT COUNT(sur_id) as total  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_altro2015 = mysqli_query($query_user_altro2015, $admin) or die(mysql_error());
$altro2015 = mysqli_fetch_assoc($ric_altro2015);


mysqli_select_db($database_admin, $admin);
$query_user_altro_c2015 = "SELECT SUM(complete_ext) as complete_ext  FROM t_panel_control where (((paese<>'Spagna')AND(paese<>'Germania')AND(paese<>'Francia')AND(paese<>'Uk')AND(paese<>'Italia')||(paese IS NULL))AND(complete_ext>0)AND(sur_date like '2015%'))";
$ric_altro_c2015 = mysqli_query($query_user_altro_c2015, $admin) or die(mysql_error());
$altro_c2015 = mysqli_fetch_assoc($ric_altro_c2015);

if ($altro_c2015['complete_ext']==''){$altro_c2015['complete_ext']=0;}
*/






/*
////Calculator
$currentYear=date("Y");
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;

//TOT
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_user = mysqli_query($query_user, $admin) or die(mysql_error());
$age_use = mysqli_fetch_assoc($age_user);
//DONNE 
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender='2' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_userGirl = mysqli_query($query_user, $admin) or die(mysql_error());
$age_useGirl = mysqli_fetch_assoc($age_userGirl);
//UOMINI
$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender='1' and Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";
$age_userMen = mysqli_query($query_user, $admin) or die(mysql_error());
$age_useMen = mysqli_fetch_assoc($age_userMen);


	//Media redemption Panel//
	
	//anno 2014
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2014%'";
	$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur = mysqli_fetch_assoc($surClo);
	
	mysqli_select_db($database_admin, $admin);
	$query_ric = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2014%' ";
	$tot_close = mysqli_query($query_ric, $admin) or die(mysql_error());
	
	
	while ($row = mysqli_fetch_assoc($tot_close)){ $totRed=$row['red_panel']+$totRed;}
	$medRed=$totRed/$cloSur['tot'];
	
	//anno2015
	
	$query_conta15 = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2015%'";
	$surClo15 = mysqli_query($query_conta15, $admin) or die(mysql_error());
	$cloSur15 = mysqli_fetch_assoc($surClo15);
	
	mysqli_select_db($database_admin, $admin);
	$query_ric15 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2015%' ";
	$tot_close15 = mysqli_query($query_ric15, $admin) or die(mysql_error());
	
	while ($row = mysqli_fetch_assoc($tot_close15)) { $totRed15=$row['red_panel']+$totRed15;}
	$medRed15=$totRed15/$cloSur15['tot'];
	

	

	// ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	mysqli_select_db($database_admin, $admin);
	$query_m2 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($query_m2, $admin) or die(mysql_error());

	while ($row = mysqli_fetch_assoc($m2_close)) { $totRed2=$row['red_panel']+$totRed2; }
	$medRed2=$totRed2/$cloSur2['tot'];
	
	// info 2015 su tutte le ricerche
	
	//tutte
	mysqli_select_db($database_admin, $admin);
	$query_ric = "SELECT COUNT(sur_id) as tot FROM t_panel_control where sur_date like '2015%' ";
	$surTot = mysqli_query($query_ric, $admin) or die(mysql_error());
	$totSur= mysqli_fetch_assoc($surTot);
	
	//interne ed esterne
	mysqli_select_db($database_admin, $admin);
	$query_ie = "SELECT * FROM t_panel_control where sur_date like '2015%'";
	$ie = mysqli_query($query_ie, $admin) or die(mysql_error());
	
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
	
	// conta registrati 2015 
		$query_reg = "SELECT COUNT(uid) as tot FROM millebytesdb.referral";
		$regTot = mysqli_query($query_reg, $admin) or die(mysql_error());
		$totReg= mysqli_fetch_assoc($regTot);
		
*/		
		

	
?>

<div style="margin-bottom:10px;" class="title">DATI CAMPAGNA MVF</div>

<?php 
$totMen=$tot_use['total']-$tot_useGirl['total'];
$tot_att2Men=$tot_act2['total']-$tot_act2Girl['total'];
$tot_att4Men=$tot_act4['total']-$tot_act4Girl['total'];
$tot_att6Men=$tot_act6['total']-$tot_act6Girl['total'];
$tot_att12Men=$tot_act12['total']-$tot_act12Girl['total'];
$redTot2=$tot_act2['total']/$tot_use['total']*100;
$redTot4=$tot_act4['total']/$tot_use['total']*100;
$redTot6=$tot_act6['total']/$tot_use['total']*100;
$redTot12=$tot_act12['total']/$tot_use['total']*100;

$percA=$a_ric['total']/$tot_act12['total']*100;
$percB=$b_ric['total']/$tot_act12['total']*100;
$percC=$c_ric['total']/$tot_act12['total']*100;
$percD=$d_ric['total']/$tot_act12['total']*100;
$percE=$e_ric['total']/$tot_act12['total']*100;
$percF=$f_ric['total']/$tot_act12['total']*100;
$percG=$g_ric['total']/$tot_act12['total']*100;
$percH=$h_ric['total']/$tot_act12['total']*100;

?>
<!--Attività -->
	<div style="float:left;">
	
	<div>
				<table class="tabdat">
				<tr><th colspan="5"  ><span style="color:#032B51"> Attivit&agrave; utenti</span></th></tr>
				<tr class="intesta"><th>Periodo</th><th>Tot.</th><th>%</th><th>Uomini</th><th>Donne</th></tr>
				<tr><td>Totali</td><td><?php echo $tot_use['total']; ?></td> <td>&nbsp;</td> <td><?php echo $totMen; ?></td> <td><?php echo $tot_useGirl['total']; ?></td></tr>
				<tr><td>2 mesi:</td><td><?php echo $tot_act2['total']; ?></td> <td><?php echo sprintf("%01.2f", $redTot2)."%";  ?></td> <td><?php echo $tot_att2Men; ?></td> <td><?php echo $tot_act2Girl['total']; ?></td></tr>
				<tr><td>4 mesi:</td><td><?php echo $tot_act4['total']; ?></td> <td><?php echo sprintf("%01.2f", $redTot4)."%";  ?></td> <td><?php echo $tot_att4Men; ?></td> <td><?php echo $tot_act4Girl['total']; ?></td></tr>
				<tr><td>6 mesi:</td><td><?php echo $tot_act6['total']; ?></td> <td><?php echo sprintf("%01.2f", $redTot6)."%";  ?></td> <td><?php echo $tot_att6Men; ?></td> <td><?php echo $tot_act6Girl['total']; ?></td></tr>
			   <tr><td>12 mesi:</td><td><?php echo $tot_act12['total']; ?></td> <td><?php echo sprintf("%01.2f", $redTot12)."%";  ?></td> <td><?php echo $tot_att12Men; ?></td><td><?php echo $tot_act12Girl['total']; ?></td></tr>
				</table>
		</div>	
		
		
<p style="height:40px">&nbsp;</p>

<!--Panel redemption-->	

	
	<p style="height:10px">&nbsp;</p>
			<div>

			<table width="253px" class="tabdat">
					<tr><th colspan="3"  ><span style="color:#032B51">New user</span></th></tr>
					<tr class="intesta"><th>Periodo</th><th>Tot.</th></tr>
					<tr><td><b>2015</b></td><td><b><?php echo $totReg['tot'];; ?></b></span></td></tr>
					</table>
			</div>		
</div>		
		
		<!--Statistiche anno in corso -->	
<div style="margin-left:20px; float:left; width:250px">
	
	
	
	<p>&nbsp;</p>
	
			<!--Calcolo redemption-->	
	
	
			
</div>

		<!--Conteggio ricerche -->	
		





	

