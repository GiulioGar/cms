    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

.info { color:red; font-size:12px; position:relative; left:40%; }
.finale { color:blue; font-size:14px; position:relative; font-weight:bold; }
.subfinale { color:gray; font-size:11px; position:relative; margin-top:15px; }


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
  
  <?php

require_once('../Connections/admin.php'); 

mysqli_select_db($database_admin, $admin);	


$errore=0;

$data=date("Y-m-d");

// Recupero i valori inseriti nel form
$invitante = $_POST['invitante'];
$invitato = $_POST['invitato'];
$status= $_POST['send'];

if ($status=="inviata")
{

// la stringa rispetta il formato classico di una mail?
if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $invitato)) {
	$errore=1;
	$txterrore=$txterrore."<div class='info'>L'indirizzo email dell'invitato non risulta valido</div>";
}


	
if ($invitante==$invitato)
						 {
						 $errore=1;
						 $txterrore=$txterrore."<div class='info'>L'indirizzo email dell'invitante non può essere lo stesso dell'invitato</div>";
						 }
	

$query_conta = "SELECT COUNT(email_invitante) as tot  FROM PortaAmico where email_invitante='".$invitante."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>50)
{
	$errore=1;
	$txterrore=$txterrore."<div class='info'>L'invitante ha superato il numero massimo di inviti</div>";
}	

						 
$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$invitato."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>0)
{
	$errore=1;
	$txterrore=$txterrore."<div class='info'>L'indirizzo email dell'invitato risulta essere già registrato al sito</div>";
}



$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$invitante."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']==0)
{
	$errore=1;
	$txterrore=$txterrore."<div class='info'>L'indirizzo email dell'invitante non risulta essere registrato al sito</div>";
}





$query_conta = "SELECT COUNT(email_invitato) as tot  FROM PortaAmico where email_invitato='".$invitato."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>0)
{
	$errore=1;
	$txterrore=$txterrore."<div class='info'>L'indirizzo email dell'invitato risulta essere già stato invitato da un altro utente</div>";
}

}



if ($errore==0 && $status=="inviata")
{
$query_user = "INSERT INTO PortaAmico (email_invitante,email_invitato,campo_data) 
VALUES ('".$invitante."','".$invitato."','".$data."')";
mysqli_query($query_user, $admin) or die(mysql_error());

}

if ($errore==1)
{
echo $txterrore;
}

?>
  
  <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <table  bgcolor="#ffffff" width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent" align="center"  style='font-family:Helvetica, Arial,serif;'>
  <tbody>
   <tr><td height='10'> </td></tr>
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
    	<td height='75' class="spechide"></td>
        
        <!-- =============================== Body ====================================== -->
    </tr>
    <tr>
      <td class='movableContentContainer ' valign='top'>
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
                                  <p style='text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#222222;'><span class="specbundle2"><span class="font1">Porta un amico nel</span></span></p>
                                </div>
                              </div></td>
      <td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable">
                                  <p style='text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#CD3301;'><span class="font">CLUB MILLEBYTES</span> </p>
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
                            <td valign='top' align='center'>
                              <div class="contentEditableContainer contentImageEditable">
                                <div class="contentEditable">
                                  <img src="img/line.png" width='251' height='43' alt='' data-default="placeholder" data-max-width="560">
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
        </div>
        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr><td height='55'></td></tr>
				<tr>
					<td align='left'>
						<div class="contentEditableContainer contentTextEditable">
							<div class="contentEditable" >
								<p >
                                    <ul>
									<li>Inserisci il tuo indirizzo e mail e quello dell'amico che vuoi invitare.</li>								
									<li>Fai iscrivere il tuo amico al club Millebytes.</li>							
									<li>Dopo lo svolgimento della prima ricerca da parte dell'amico invitato riceverai il livello bonus.</li>
									</ul>
								</p>
							</div>
						</div>
					</td>
				</tr>
                          <tr>
                            <td align='left'>
                              <div class="contentEditableContainer contentTextEditable">
                                <div class="contentEditable" align='center'>
									<h2 ><form method="post" action="portaunamico.php">
										Inserisci il tuo indirizzo email<br>
										<input type="text" name="invitante"><br><br><br>
										Inserisci indirizzo email da invitare<br>
										<input type="text" name="invitato"><br>
								</h2>
                                </div>
                              </div>
                            </td>
                          </tr>

                          <tr><td height='1'> </td></tr>

                         

                          <tr><td height='1'></td></tr>

                          <tr>
                            <td align='center'>
                              <table>
                                <tr>
                                  <td width="100" align='center' bgcolor='#1A54BA' style='background:#DC2828; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;'>
                                    <div class="contentEditableContainer contentTextEditable">
                                      <div class="contentEditable" align='center'>
										  <input style="padding:15px 18px;" name="send" class="bot" type="submit" value="inviata">
									  </form>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
							 <?php if ($errore==0 && $status=="inviata")
								{?>
							
								<p>
								<div class='finale'>
							 La tua richiesta è andata a buon fine!
							 <p class="subfinale">
							 Contatta ora il tuo amico e fallo iscrivere al club, appena parteciperà alla prima ricerca
							 riceverai il livello bonus!
							 </p>
								</div>
								</p>
								<?php } ?>
                            </td>
                          </tr>
                          <tr><td height='20'></td></tr>
                        </table>
        </div>
        <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height='65'>
    </tr>
    <tr>
      <td  style='border-bottom:1px solid #DDDDDD;'></td>
    </tr>
    <tr><td height='25'></td></tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" class="specbundle"><div class="contentEditableContainer contentTextEditable">
                                      <div class="contentEditable" align='center'>
                                        <p  style='text-align:left;color:#CCCCCC;font-size:12px;font-weight:normal;line-height:20px;'>
                                        
                                          <a target='_blank' href="http://millebytes.com/it/user/register">Registrazione</a><br>
                                          <a target="_blank" class='link1' class='color:#382F2E;' href="http://millebytes.com/">Home page</a>
                                          <br>
                                          <a target='_blank' class='link1' class='color:#382F2E;' href="mailto:millebytes@interactive-mr.com">Contattaci</a>
                                        </p>
                                      </div>
                                    </div></td>
      <td valign="top" width="30" class="specbundle">&nbsp;</td>
      <td valign="top" class="specbundle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
	<td valign="top" width="180" class="specbundle">&nbsp;</td>
      <td valign='top' width='52'>
                                    <div class="contentEditableContainer contentFacebookEditable">
                                      <div class="contentEditable">
                                        <a target='_blank' href="https://it-it.facebook.com/Millebytes-1474771096088455/"><img src="img/facebook.png" width='52' height='53' alt='facebook icon' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
                                      </div>
                                    </div>
                                  </td>
      <td valign="top" width="1">&nbsp;</td>
      <td valign='top' width='52'>
                                    <div class="contentEditableContainer contentTwitterEditable">
                                      <div class="contentEditable">
                                        <a target='_blank' href="https://twitter.com/millebytes"><img src="img/twitter.png" width='52' height='53' alt='twitter icon' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
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
    <tr><td height='88'></td></tr>
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

    <!--Default Zone

      <div class="customZone" data-type="image">
          <div class="movableContent">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
            <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td height='42'>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <div class="contentEditableContainer contentImageEditable">
                      <div class="contentEditable">
                          <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/temp_img_1.png" data-default="placeholder" data-max-width="540">
                      </div>
                  </div>
                </td>
              </tr>
            </table>
            </td></tr></table>
          </div>
      </div>
      
      <div class="customZone" data-type="text">
          <div class='movableContent'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                          <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr><td height='10'>&nbsp;</td></tr>
                            <tr>
                              <td align='left' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <h2>We’re going to blow your mind.</h2>
                                </div>
                      </div>
                              </td>
                            </tr>
                            <tr><td height='15'>&nbsp;</td></tr>
                            <tr>
                              <td align='left' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                <br><br>
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                </div>
                      </div>
                              </td>
                            </tr>
                            <tr><td height='25'>&nbsp;</td></tr>
                            <tr>
                              <td align='right' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <a target='_blank' href="#" class='link1'>Read more →</a>
                                </div>
                      </div>
                              </td>
                            </tr>
                          </table>
                          </td></tr></table>
                    </div>
      </div>
      
      <div class="customZone" data-type="imageText">
          <div class='movableContent'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                      <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr><td height='10'>&nbsp;</td></tr>
                        <tr>
                          <td valign='top'>
                            <div class="contentEditableContainer contentImageEditable">
                              <div class="contentEditable" >
                                <img src="images/macCat.jpg" alt='product image' data-default="placeholder" data-max-width="255" width='255' height='154'>
                              </div>
                            </div>
                          </td>

                          <td valign='top'>
                            <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                <table width="255" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td valign='top'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <h2>Chresmographion</h2>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='12'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-right:30px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <p >Chamber between the pronaos and the cella in Greek temples where oracles were delivered.</p>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='25'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-bottom:15px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <a target='_blank' href="#" class='link1'>Find out more →</a>
                                      </div>
                            </div>
                                    </td>
                                  </tr>
                                </table>
                          </td>
                        </tr>
                      </table>
                      </td></tr></table>
                    </div>
      </div>
      
      <div class="customZone" data-type="Textimage">
          <div class='movableContent'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                      <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr><td height='10'>&nbsp;</td></tr>
                        <tr>
                          <td valign='top'>
                                <table width="255" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td valign='top'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <h2>Chresmographion</h2>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='12'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-right:30px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <p >Chamber between the pronaos and the cella in Greek temples where oracles were delivered.</p>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='25'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-bottom:15px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <a target='_blank' href="#" class='link1'>Find out more →</a>
                                      </div>
                            </div>
                                    </td>
                                  </tr>
                                </table>
                          </td>

                          <td valign='top'>
                            <div class="contentEditableContainer contentImageEditable">
                              <div class="contentEditable" >
                                <img src="images/macCat.jpg" alt='product image' data-default="placeholder" data-max-width="255" width='255' height='154'>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </table>
                      </td></tr></table>
                    </div>
      </div>

      <div class="customZone" data-type="textText">
          <div class='movableContent'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                      <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr><td height='10'>&nbsp;</td></tr>
                        <tr>
                          <td valign='top'>
                                <table width="255" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td valign='top'>
                                       <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <h2>Barrel Vault</h2>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='12'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-right:30px;'>
                                       <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <p >An architectural element formed by the extrusion of a single curve (or pair of curves, in the case of a pointed barrel vault) along a given distance.</p>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='25'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-bottom:15px;'>
                                       <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <a target='_blank' href="#" class='link1'>Find out more →</a>
                                      </div>
                            </div>
                                    </td>
                                  </tr>
                                </table>
                          </td>

                          <td valign='top'>
                                <table width="255" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td valign='top'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <h2>Chresmographion</h2>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='12'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-right:30px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <p >Chamber between the pronaos and the cella in Greek temples where oracles were delivered.</p>
                                      </div>
                            </div>
                                    </td>
                                  </tr>

                                  <tr><td height='25'></td></tr>

                                  <tr>
                                    <td valign='top' style='padding-bottom:15px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable" >
                                      <a target='_blank' href="#" class='link1'>Find out more →</a>
                                      </div>
                            </div>
                                    </td>
                                  </tr>
                                </table>
                          </td>
                        </tr>
                      </table>
                      </td></tr></table>
                    </div>
      </div>

      <div class="customZone" data-type="qrcode">
          <div class="movableContent">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                  <table width='520' cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:10px;">
                    <tr>
                    <td height='42'>&nbsp;</td>
                    <td height='42'>&nbsp;</td>
              </tr>
                      <tr>
                          <td valign='top' valign="top" width="75" style='padding:0 20px;'>
                              <div class="contentQrcodeEditable contentEditableContainer">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/qr_code.png" width="75" height="75">
                                  </div>
                              </div>
                          </td>
                          <td valign='top' valign="top" style="padding:0 20px 0 20px;">
                              <div class="contentTextEditable contentEditableContainer">
                                  <div class="contentEditable">
                                      <p >Etiam bibendum nunc in lacus bibendum porta. Vestibulum nec nulla et eros ornare condimentum. Proin facilisis, dui in mollis blandit. Sed non dui magna, quis tincidunt enim. Morbi vehicula pharetra lacinia. Cras tincidunt, justo at fermentum feugiat, eros orci accumsan dolor, eu ultricies eros dolor quis sapien.</p>
                                      <p >Integer in elit in tortor posuere molestie non a velit. Pellentesque consectetur, nisi a euismod scelerisque.</p>
                                      <p style='text-align:right;margin:0;font-family:Georgia, serif;'><a target='_blank' href='#' class='link1'>Read more →</a></p>
                                      <br>
                                      <br>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>
              </td></tr></table>
          </div>
      </div>
      
      <div class="customZone" data-type="gmap">
          <div class="movableContent">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>

                  <table width='520' cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:10px;">
                    <tr>
                    <td height='42'>&nbsp;</td>
                    <td height='42'>&nbsp;</td>
              </tr>
                      <tr>
                          <td valign='top' style='padding:0 20px;'>
                              <div class="contentEditableContainer contentGmapEditable">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/gmap_example.png" width="175" data-default="placeholder">
                                  </div>
                              </div>
                          </td>
                          <td valign='top' style="padding:0 20px 0 20px;">
                              <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
                                      <h2>This is a subtitle</h2>
                                      <p >Etiam bibendum nunc in lacus bibendum porta. Vestibulum nec nulla et eros ornare condimentum. Proin facilisis, dui in mollis blandit. Sed non dui magna, quis tincidunt enim. Morbi vehicula pharetra lacinia. Cras tincidunt, justo at fermentum feugiat, eros orci accumsan dolor, eu ultricies eros dolor quis sapien.</p>
                                      <p >Integer in elit in tortor posuere molestie non a velit. Pellentesque consectetur, nisi a euismod scelerisque.</p>
                                      <p style='text-align:right;margin:0;'><a target='_blank' href="#" class='link1'>Read more →</a></p>
                                      <br>
                                      <br>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>
              </td></tr></table>
          </div>
      </div>

      <div class="customZone" data-type="social">
          <div class="movableContent">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                  <table width='520' cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                    <td height='42' colspan='4'>&nbsp;</td>
              </tr>
                      <tr>
                          <td valign='top' colspan="4" style='padding:0 20px;'>
                              <div class="contentTextEditable contentEditableContainer">
                                  <div class="contentEditable">
                                      <h2 >This is a subtitle</h2>
                                  </div>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td width='62' valign='top' valign="top" width="62" style='padding:0 0 0 20px;'>
                              <div class="contentEditableContainer contentTwitterEditable">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/icon_twitter.png" width="42" height="42" data-customIcon="true" data-max-width='42' data-noText="false">
                                  </div>
                              </div>
                          </td>
                          <td width='216' valign='top' >
                              <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
                                      <p >Follow us on twitter to stay up to date with company news and other information.</p>
                                  </div>
                              </div>
                          </td>
                          <td width='62' valign='top' valign="top" width="62">
                              <div class="contentEditableContainer contentFacebookEditable">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/icon_facebook.png" width="42" height="42" data-customIcon="true" data-max-width='42' data-noText="false">
                                  </div>
                              </div>
                          </td>
                          <td width='216' valign='top' style='padding:0 20px 0 0;'>
                              <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
                                      <p >Like us on Facebook to keep up with our news, updates and other discussions.</p>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>
              </td></tr></table>
          </div>
      </div>

      <div class="customZone" data-type="twitter">
          <div class="movableContent">
          <table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                  <table width='520' cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                    <td height='42'>&nbsp;</td>
                    <td height='42'>&nbsp;</td>
              </tr>
                      <tr>
                          <td valign='top' valign="top" width="62" style='padding:0 0 0 20px;'>
                              <div class="contentEditableContainer contentTwitterEditable">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/icon_twitter.png" width="42" height="42" data-customIcon="true" data-max-width='42' data-noText="false">
                                  </div>
                              </div>
                          </td>
                          <td valign='top' style='padding:0 20px 0 0;'>
                              <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
                                      <p >Follow us on twitter to stay up to date with company news and other information.</p>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>
              </td></tr></table>
          </div>
      </div>
      
      <div class="customZone" data-type="facebook">
          <div class="movableContent">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                  <table width='520' cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                    <td height='42'>&nbsp;</td>
                    <td height='42'>&nbsp;</td>
              </tr>
                      <tr>
                          <td valign='top' valign="top" width="62" style='padding:0 0 0 20px;'>
                              <div class="contentEditableContainer contentFacebookEditable">
                                  <div class="contentEditable">
                                      <img src="/applications/Mail_Interface/3_3/modules/User_Interface/core/v31_campaigns/images/neweditor/default/icon_facebook.png" width="42" height="42" data-customIcon="true" data-max-width='42' data-noText="false">
                                  </div>
                              </div>
                          </td>
                          <td valign='top' style='padding:0 20px 0 0;'>
                              <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
                                      <p >"Like us on Facebook to keep up with our news, updates and other discussions.</p>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>
              </td></tr></table>
          </div>
      </div>

      <div class="customZone" data-type="line">
          <div class='movableContent'>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
              <table width="520" border="0" cellspacing="0" cellpadding="0" align="center" >
                <tr><td height='10'>&nbsp;</td></tr>
                <tr><td style='border-bottom:1px solid #DDDDDD'></td></tr>
                <tr><td height='10'>&nbsp;</td></tr>
              </table>
              </td></tr></table>
            </div>
      </div>

      
      <div class="customZone" data-type="colums1v2"><div class='movableContent'>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                          <table width="520" border="0" cellspacing="0" cellpadding="0" align="center" >
                            <tr><td height="10">&nbsp;</td></tr>
                            <tr>
                              <td align="left" valign="top">
                                <table width='100%'  border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                                  <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                                  <tr>
                                    <td width='25'>&nbsp;</td>
                                    <td class="newcontent">
                                  
                                    </td>
                                    <td width='25'>&nbsp;</td>
                                  </tr>
                                  <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                          </td></tr></table>
                    </div>
      </div>

      <div class="customZone" data-type="colums2v2"><div class='movableContent'>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                      <table width="520" border="0" cellspacing="0" cellpadding="0" align="center" valign='top'>
                        <tr><td height="10" colspan='3'>&nbsp;</td></tr>
                        <tr>
                          <td width='250'  valign='top' >
                            <table width='100%' border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                              <tr>
                                <td width='25'>&nbsp;</td>
                                <td class="newcontent">
                              
                                </td>
                                <td width='25'>&nbsp;</td>
                              </tr>
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                            </table>
                          </td>

                          <td width='20'>&nbsp;</td>
                          
                          <td width='250' valign='top' >
                            <table width='100%' border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                              <tr>
                                <td width='25'>&nbsp;</td>
                                <td class="newcontent">
                              
                                </td>
                                <td width='25'>&nbsp;</td>
                              </tr>
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                        
                      </table>
                      </td></tr></table>
                    </div>
      </div>

      <div class="customZone" data-type="colums3v2"><div class='movableContent'>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td>
                      <table width="520" border="0" cellspacing="0" cellpadding="0" align="center" valign='top'>
                        <tr><td height="10" colspan='5'>&nbsp;</td></tr>
                        <tr>
                          <td width='165'  valign='top' >
                            <table width='100%' border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                              <tr>
                                <td width='25'>&nbsp;</td>
                                <td class="newcontent">
                              
                                </td>
                                <td width='25'>&nbsp;</td>
                              </tr>
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                            </table>
                          </td>

                          <td width='12'>&nbsp;</td>
                          
                          <td width='165'  valign='top' >
                            <table width='100%' border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                              <tr>
                                <td width='25'>&nbsp;</td>
                                <td class="newcontent">
                              
                                </td>
                                <td width='25'>&nbsp;</td>
                              </tr>
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                            </table>
                          </td>

                          <td width='12'>&nbsp;</td>
                          
                          <td width='165'  valign='top' >
                            <table width='100%' border="0" cellspacing="0" cellpadding="0" align="center" valign='top'  >
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                              <tr>
                                <td width='25'>&nbsp;</td>
                                <td class="newcontent">
                              
                                </td>
                                <td width='25'>&nbsp;</td>
                              </tr>
                              <tr><td colspan='3' height='25'>&nbsp;</td></tr>
                            </table>
                          </td>
                        </tr>
                        
                      </table>
                      </td></tr></table>
                    </div>
      </div>

      <div class="customZone" data-type="textv2">
        <table border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr><td height='10'>&nbsp;</td></tr>
                            <tr>
                              <td align='left' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <h2>We’re going to blow your mind.</h2>
                                </div>
                      </div>
                              </td>
                            </tr>
                            <tr><td height='15'>&nbsp;</td></tr>
                            <tr>
                              <td align='left' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <p >Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                </div>
                      </div>
                              </td>
                            </tr>
                            <tr><td height='25'>&nbsp;</td></tr>
                            <tr>
                              <td align='right' valign='top'>
                                <div class="contentEditableContainer contentTextEditable">
                        <div class="contentEditable" >
                                <a target='_blank' href="#" class='link1'>Read more →</a>
                                </div>
                      </div>
                              </td>
                            </tr>
                          </table>
      </div>



    -->
    <!--Default Zone End-->

      </body>
      </html>


