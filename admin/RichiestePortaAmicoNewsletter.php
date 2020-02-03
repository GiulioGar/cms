<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
mysqli_select_db($database_admin, $admin);	

require_once('inc_taghead.php');
require_once('inc_tagbody.php');


$cerca_registrati=$_REQUEST['reg'];
if ($cerca_registrati==""){$cerca_registrati="%";}

$utenti = isset($_POST['utenti']) ? $_POST['utenti'] : array();
foreach($utenti as $utente) {
	
	$u = explode("|", $utente);
	
	
	?>

	
	<?php
	
	

	$header = "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$header .= 'From: "Millebytes" <millebytes@interactive-mr.com>';
	$destinatario = $u[1];
	
	
	$oggetto = "Club Millebytes: Un tuo amico ti ha invitato!";
	
	
	$messaggio = '
	<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Porta un amico</title>
      <style type="text/css">
      body {
       padding-top: 0 !important;
       padding-bottom: 0 !important;
       padding-top: 0 !important;
       padding-bottom: 0 !important;
       margin:0 !important;
       width: 100% !important;
	-webkit-text-size-adjust: 100% !important;
	-ms-text-size-adjust: 100% !important;
	-webkit-font-smoothing: antialiased !important;
	}
	.tableContent img {
	border: 0 !important;
	display: block !important;
	outline: none !important;
	}
	a{
	color:#382F2E;
    }
	
    p, h1{
	color:#382F2E;
	margin:0;
    }
	p{
	text-align:left;
	color:#999999;
	font-size:14px;
	font-weight:normal;
	line-height:19px;
    }
	
    a.link1{
	color:#382F2E;
    }
    a.link2{
	font-size:16px;
	text-decoration:none;
	color:#ffffff;
    }
	
	.link2{
	font-size:16px;
	text-decoration:none;
	color:#ffffff;
	}
	
    h2{
	text-align:left;
	color:#222222; 
	font-size:19px;
	font-weight:normal;
    }
    div,p,ul,h1{
	margin:0;
    }
	
    .bgBody{
	background: #ffffff;
    }
    .bgItem{
	background: #ffffff;
    }
	
	@media only screen and (max-width:480px)
	
	{
	
	table[class="MainContainer"], td[class="cell"] 
	{
	width: 100% !important;
	height:auto !important; 
	}
	td[class="specbundle"] 
	{
	width:100% !important;
	float:left !important;
	font-size:13px !important;
	line-height:17px !important;
	display:block !important;
	padding-bottom:15px !important;
	}
	
	td[class="spechide"] 
	{
	display:none !important;
	}
	img[class="banner"] 
	{
	width: 100% !important;
	height: auto !important;
	}
	td[class="left_pad"] 
	{
	padding-left:15px !important;
	padding-right:15px !important;
	}
	
	}
	
	@media only screen and (max-width:540px) 
	
	{
	
	table[class="MainContainer"], td[class="cell"] 
	{
	width: 100% !important;
	height:auto !important; 
	}
	td[class="specbundle"] 
	{
	width:100% !important;
	float:left !important;
	font-size:13px !important;
	line-height:17px !important;
	display:block !important;
	padding-bottom:15px !important;
	}
	
	td[class="spechide"] 
	{
	display:none !important;
	}
	img[class="banner"] 
	{
	width: 100% !important;
	height: auto !important;
	}
	.font {
	font-size:18px !important;
	line-height:22px !important;
	
	}
	.font1 {
	font-size:18px !important;
	line-height:22px !important;
	
	}
	
	
	}
	
	li {margin-bottom:20px;}
	.bot 
	{
	background-color:#DC2828; border:0px;
	font-size:16px;
	text-decoration:none;
	color:#ffffff;
	width:100%;
	height:100%;
	}
	.bot:hover {cursor: pointer}
	
	input[type=text] { min-width:400px;}
	.contieni {border:1px solid gray; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;}
	
    </style>
	<script type="colorScheme" class="swatch active">
	{
    "name":"Default",
    "bgBody":"ffffff",
    "link":"382F2E",
    "color":"999999",
    "bgItem":"ffffff",
    "title":"222222"
	}
	</script>
	</head>
	<body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <table  bgcolor="#ffffff" width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent" align="center"  style=\'font-family:Helvetica, Arial,serif;\'>
	<tbody>
	<tr><td height=\'10\'> </td></tr>
    <tr>
	<td>
	<table class="contieni" width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" class="MainContainer">
	<tbody>
    <tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td valign="top" width="40">&nbsp;</td>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
	<!-- =============================== Header ====================================== -->   
    <tr>
	<td height=\'75\' class="spechide"></td>
	
	<!-- =============================== Body ====================================== -->
    </tr>
    <tr>
	<td class=\'movableContentContainer \' valign=\'top\'>
	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td height="35"></td>
    </tr>
    <tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td valign="top" align="center" class="specbundle"><div class="contentEditableContainer contentTextEditable">
	<div class="contentEditable">
	<p style=\'text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#222222;\'><span class="specbundle2"><span class="font1">Sei stato invitato nel</span></span></p>
	</div>
	</div></td>
	<td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">
	<div class="contentEditable">
	<p style=\'text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#CD3301;\'><span class="font">CLUB MILLEBYTES</span> </p>
	</div>
	</div></td>
    </tr>
	</tbody>
	</table>
	</td>
    </tr>
	</tbody>
	</table>
	</div>
	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	<td valign=\'top\' align=\'center\'>
	<div class="contentEditableContainer contentImageEditable">
	<div class="contentEditable">
	<img src="http://stats.primisoft.com/cms/resources/mail/images/line.png" width=\'251\' height=\'43\' alt=\'\' data-default="placeholder" data-max-width="560">
	</div>
	</div>
	</td>
	</tr>
	</table>
	</div>
	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height=\'55\'></td></tr>
	<tr>
	<td align=\'left\'>
	<div class="contentEditableContainer contentTextEditable">
	<div class="contentEditable" >
	<p >
	Ciao,
	<br><br>
	il tuo amico: '.$u[0].' ti ha invitato ad unirti al nostro Club!
	<br><br>
	Il Club Millebytes ti da la possibilit&agrave; di guadagnare buoni amazon partecipando a dei semplici sondaggi.
	<br><br>
	Clicca sul seguente sito per completare la registrazione
	<br><br>
	<a target=\'_blank\' href="http://millebytes.com/it/user/register">Registrazione</a><br>
	</p>
	</div>
	</div>
	</td>
	</tr>
	<tr>
	<td align=\'left\'>
	<div class="contentEditableContainer contentTextEditable">
	<div class="contentEditable" align=\'center\'>
	</div>
	</div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	<tr><td height=\'20\'></td></tr>
	</table>
	</div>
	<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td height=\'65\'>
    </tr>
    <tr>
	<td  style=\'border-bottom:1px solid #DDDDDD;\'></td>
    </tr>
    <tr><td height=\'25\'></td></tr>
    <tr>
	<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">
	<div class="contentEditable" align=\'center\'>
	<p  style=\'text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;\'>
	
	<a target=\'_blank\' href="http://millebytes.com/it/user/register">Registrazione</a><br>
	<a target="_blank" class=\'link1\' class=\'color:#382F2E;\' href="http://millebytes.com/">Home page</a>
	<br>
	<a target=\'_blank\' class=\'link1\' class=\'color:#382F2E;\' href="mailto:millebytes@interactive-mr.com">Contattaci</a>
	</p>
	</div>
	</div></td>
	<td valign="top" width="30" class="specbundle">&nbsp;</td>
	<td valign="top" class="specbundle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
    <tr>
	<td valign="top" width="180" class="specbundle">&nbsp;</td>
	<td valign=\'top\' width=\'52\'>
	<div class="contentEditableContainer contentFacebookEditable">
	<div class="contentEditable">
	<a target=\'_blank\' href="#"><img src="http://stats.primisoft.com/cms/resources/mail/images/facebook.png" width=\'52\' height=\'53\' alt=\'facebook icon\' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
	</div>
	</div>
	</td>
	<td valign="top" width="1">&nbsp;</td>
	<td valign=\'top\' width=\'52\'>
	<div class="contentEditableContainer contentTwitterEditable">
	<div class="contentEditable">
	<a target=\'_blank\' href="#"><img src="http://stats.primisoft.com/cms/resources/mail/images/twitter.png" width=\'52\' height=\'53\' alt=\'twitter icon\' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
	</div>
	</div>
	</td>
    </tr>
	</tbody>
	</table>
	</td>
    </tr>
	</tbody>
	</table>
	</td>
    </tr>
    <tr><td height=\'88\'></td></tr>
	</tbody>
	</table>
	
	</div>
	
	<!-- =============================== footer ====================================== -->
	
	</td>
    </tr>
	</tbody>
	</table>
	</td>
	<td valign="top" width="40">&nbsp;</td>
    </tr>
	</tbody>
	</table>
	</td>
    </tr>
	</tbody>
	</table>
	</td>
    </tr>
	</tbody>
	</table>
	';
	
	/*
	
	*/
	
	mail($destinatario, $oggetto, $messaggio, $header);	
	
	
	
	
	
	
	

 

}



$query_cerca = "SELECT * FROM PortaAmico";
$cerca = mysqli_query($query_cerca, $admin) or die(mysql_error());


?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type='text/javascript'>
function toggleChecked(status) {
$('.checkbox').each( function() {
$(this).attr('checked', status) ;
}) ;
if (status) $('.checkall_label').text('Deseleziona tutti') ;
else $('.checkall_label').text('Seleziona tutti') ;
} ;

</script>
</head>



<form name="modulo_cerca_registrati" style="height:50px; margin-left:150px; max-width:500px; position:relative; top:10px; " action="RichiestePortaAmicoNewsletter.php" method="get">
	<select name="reg">
	<option value="">[REG/No REG]</option>
	<option value="REG" <?php if ($cerca_registrati=="REG") {echo 'selected="selected"';} ?>>REGISTRATI</option>
	<option value="REN" <?php if ($cerca_registrati=="REN") {echo 'selected="selected"';} ?>>NON REGISTRATI</option>
	</select>
	<input type="submit" value="Filtra"></td>
	</form>



<form method="post" action="RichiestePortaAmicoNewsletter.php">

	<input type="checkbox" onclick="toggleChecked(this.checked);"/><span class="checkall_label">Seleziona tutti</span>
	<table>
		<tr><th></th><th>Invitante</th><th>Invitato</th><th>Data</th><th>Stato Registrazione</th><th>Stato Ricerca</th><th>Livello</th></tr>

<?php

	while ($row = mysqli_fetch_assoc($cerca))
		{
		
			$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$row['email_invitato']."'";
			$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
			$cloSur = mysqli_fetch_assoc($surClo);
			
			if ($row['assegnato']==1){$txt='disabled'; $livello='ASSEGNATO';}
								      else
									  {$txt='';  $livello='NON ASSEGNATO';}
			
			if ($cloSur['tot']>0)
			{
			$stato='<span style="background-color:green;">REGISTRATO</span>';
			$contaregistrato=$contaregistrato+1;
			}
			else
			{
			$stato='<span style="background-color:red;">NON REGISTRATO</span>';
            $contaNonregistrato=$contaNonregistrato+1;			
			}
			
			
			
		?>
		
		
	
		
		
	
		<?php
			
			
		
	    
		/*
		$query_cerca_livello = "SELECT field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$row['email_invitato']."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
        $cerca_livello = mysqli_query($query_cerca_livello, $admin) or die(mysql_error());
        $lvl = mysqli_fetch_assoc($cerca_livello);
		*/
	
		$query_cerca_uid = "SELECT user_id FROM t_user_info where t_user_info.email='".$row['email_invitato']."'";
		$cerca_uid = mysqli_query($query_cerca_uid, $admin) or die(mysql_error());
		$uidtrovato = mysqli_fetch_assoc($cerca_uid);
			
		
		$user_id=$uidtrovato['user_id'];
		
		/*
		$query_conta = "SELECT COUNT(uid) as tot  FROM t_respint where ((uid ='$user_id') AND ((status=1)||(status=3)||(status=4)||(status=5))) limit 10";
		$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
		$cloSur = mysqli_fetch_assoc($surClo);
		
		
		
		if ($cloSur['tot']>0)
		{
		$testostato="SVOLTA";
		}
		else
		{
		$testostato="NON SVOLTA";
		}
		*/
		
		
		
		if ((($stato=='<span style="background-color:green;">REGISTRATO</span>')&&($cerca_registrati=="%" || $cerca_registrati=="REG"))|| (($stato=='<span style="background-color:red;">NON REGISTRATO</span>')&&($cerca_registrati=="%" || $cerca_registrati=="REN")))
        {		
		echo "<tr><td><input class=\"checkbox\" type=\"checkbox\"  ".$txt." name=\"utenti[]\" value=\"".$row['email_invitante'].'|'.$row['email_invitato']."\"/></td><td>".$row['email_invitante']."</td><td>".$row['email_invitato']."</td><td>".$row['campo_data']."</td><td>".$stato."</td><td>".$testostato."</td><td>".$livello."</td></tr>";
		}
		}
		
	

$totale=$contaregistrato+$contaNonregistrato;	
		

?>
</table>
<input type="submit" value="Assegna"/>
</form>

<table>
<tr><th>TOTALI</th><th>REGISTRATI</th><th>NON REGISTRATI</th></tr>
<tr><td><?php echo $totale;?></td><td><?php echo $contaregistrato;?></td><td><?php echo $contaNonregistrato;?></td></tr>
</table>

<?php

require_once('inc_footer.php'); 