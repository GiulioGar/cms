<!doctype html>
<!--
	Solution by GetTemplates.co
	URL: https://gettemplates.co
-->
<html lang="en">

<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"


//$admin = mysql_pconnect($hostname_admin, $username_admin, $password_admin) or trigger_error(mysql_error(),E_USER_ERROR); 

//online
//$conn = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');
//$admin = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');

//test
 $conn = @mysqli_connect('localhost', 'root', '', 'millebytesdb');
 $admin = @mysqli_connect('localhost', 'root', '', 'millebytesdb');

if (!$conn) {
    echo "Error: " . mysqli_connect_error();
	exit();
}

$userId=$_GET["user_id"];



?>



<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- awesone fonts css-->
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Millebytes</title>
    <style>

.contOk { display: none;}

.mailAlert { color:red; font-size:13px; }

.copy-text {
	position: relative;
	background: #fff;
	border: 1px solid #ddd;
	border-radius: 10px;
	display: flex;
    padding:3%;
    
}
.copy-text input.text {
	padding: 10px;
	font-size: 15px!important;
	color: #555;
	border: none;
	outline: none;
}
.copy-text button {
	padding: 10px;
	background: #5784f5;
	color: #fff;
	font-size: 15px!important;
	border: none;
	outline: none;
	border-radius: 10px;
	cursor: pointer;
}

.copy-text button:active {
	background: #809ce2;
}
.copy-text button:before {
	content: "Copiato";
	position: absolute;
	top: -45px;
	right: 0px;
	background: #5c81dc;
	padding: 8px 10px;
	border-radius: 20px;
	font-size: 15px;
	display: none;
}
.copy-text button:after {
	content: "";
	position: absolute;
	top: -20px;
	right: 25px;
	width: 10px;
	height: 10px;
	background: #5c81dc;
	transform: rotate(45deg);
	display: none;
}
.copy-text.active button:before,
.copy-text.active button:after {
	display: block;
}

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
    <div class="container"><a class="navbar-brand" href="https://millebytes.com/" >Millebytes.com</a>
        <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              
                <li class="nav-item"><a class="nav-link" href="https://millebytes.com/lost">Recupero Password</a></li>

                <li class="nav-item"><a class="nav-link" href="mailto:millebytes@interactive-mr.com"><span class="__cf_email__">Contatti</span></a></li>
            </ul>

        </div>
    </div>
</nav>
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="contMessage">

                <div class="contEmail">
                <h2> <span><b>Invita i tuoi amici e gudagna!</b></span>  </h2><br/>
                <h4> <span>Come funziona:</span>  </h4><br/>
                <h5> <span>Ci sono 2 modi per invitare i tuoi amici: <br/>
                1) Ti daremo un link tutto tuo da girare ai tuoi amici<br/>
                2) Potrai segnalarci qui gli indirizzi email dei tuoi amici, <br/>invieremo noi un invito. <br/>
                <br/><br/>
                <h4> <span>Cosa ci guadagno:</span>  </h4><br/>
                <h5> <span>Per ogni amico che si iscriverà al nostro Club per te<b> 50 punti bytes</b><br/> e appena il tuo amico completerà una ricerca riceverai  altri <b>300 punti bytes</b>! <br/> </span>  </h5><br/>
                
                <h5> <span>Anche il tuo amico sarà premiato con un bonus di Benvenuto di <b>300 bytes</b>! <br/> </span>  </h5>
                <h5> <span style='font-size:13px'><i>Puoi trovare le condizioni in fondo a questa pagina.</i> <br/> </span>  </h5>


                <div class="row">
                <div class="col-md-6">
                <p> 
                <h4> <span>Inserisci gli indirizzi email dei tuoi amici:</span>  </h4><br/>
                <form id="form1" name="form1">
                    <input style="max-width: 300px;" class="form-control mail1" type="email" name="mailsend1" placeholder="e-mail 1">    
                    <input style="max-width: 300px;" class="form-control mail2" type="email" name="mailsend2" placeholder="e-mail 2">    
                    <input style="max-width: 300px;" class="form-control mail3" type="email" name="mailsend3" placeholder="e-mail 3">    
                    <input style="max-width: 300px;" class="form-control uidpal" type="hidden" name="uidPal" value='<?php echo $userId;?>' >    
                    <button class='btn btn-success validation' type='button' >Invia <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </form>
                
                </p>
            </div>

            <div class="col-md-6">
                <p> 
                <h4> <span>Copia il link e condividilo con i tuoi amici:</span>  </h4><br/>

                <div class="copy-text">
                <input style="position:absolute; left:2500px;" type="text" id="refLink" class="text" value="https://millebytes.com/registrazione/pro/<?php echo $userId;?>" />


                <div>
                https://millebytes.com/registrazione/pro/<?php echo $userId;?> 
                <button><i class="fa fa-clone"></i></button>
                </div>

		        
		        
	            </div>

                </p>
            </div>
            </div>

            


            </div>

        


            </div>

            </div>
            <div class="col-md-4">
                <div class="card"><img class="card-img-top img-fluid" src="images/friends.png" alt=""></div>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid gtco-news" id="news">
    <div class="container">
        <h2>News dal Club</h2>
        <div class="owl-carousel owl-carousel2 owl-theme">
            <div>
                <div class="card text-center"><img class="card-img-top" src="images/news1.png" alt="">
                    <div class="card-body text-left pr-0 pl-0">
                        <h5>Scarica la nostra app sul tuo dispositivo Android</h5>
                        <p class="card-text">Scarica la nostra app direttamente dal play store di Google e mantenere sempre aggiornata l'app.
                            Nei prossimi giorni rilasceremo la nostra nuova app che ti consentirà in maniera semplice e veloce di consultare il punteggio, i premi e le ricerche
                            a disposizione.
                        </p>
                        <p><a href="https://play.google.com/store/apps/details?id=com.interactive.millebytes&gl=IT">Download<i class="fa fa-cloud-download" aria-hidden="true"></i></a></p>
                        <!-- <a href="#">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top" src="images/news2.jpg" alt="">
                    <div class="card-body text-left pr-0 pl-0">
                    <h5>Scarica la nostra nuova app sul tuo dispositivo Apple</h5>
                        <p class="card-text">Scarica l'app direttamente dall App Store di Apple e mantenerla sempre aggiornata.
                        </p>
                        <p><a href="https://apps.apple.com/it/app/millebytes/id1623646742">Download<i class="fa fa-cloud-download" aria-hidden="true"></i></a></p>
                        <!-- <a href="#">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                    </div>
                </div>
            </div>


            <div>
                <div class="card text-center"><img class="card-img-top" src="images/news3.jpg" alt="">
                    <div class="card-body text-left pr-0 pl-0">
                        <h5> Cambia il regolamento </h5>
                        <p class="card-text"> Cambia la modalità di partecipazione del Club, per te maggiori premi e maggiori opportunità di guadagno. </p>
                        <a href="https://millebytes.com/regolamento">Regolamento <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer style="background-color:#FB8610 ;" class="container-fluid" id="gtco-footer">
<p><b>Regolamento</b>:</p>

<div style="font-size:12px; padding:1%">
<b>L'iniziativa è soggetta a condizioni invitiamo l'utente a prenderne visione:</b><br/><br/>

1) Gli indirizzi inviati dovranno essere indirizzi validi appartenenti a persone esistenti.<br/>
2) Gli utenti invitati non possono essere già iscritti al Club Millebytes.<br/>
3) I nostri responsabili verificheranno la validità e l'esistenza degli indirizzio, in caso di violazione dei punti 1 e 2 ci sarà l'esclusione dal Club.<br/>
4) I punti bonus saranno assegnati al termine delle verifiche, l'assegnazione NON SARA' IMMEDIATA<br/>
5) Ogni utente potrà accumulare un massimo di 15.000 punti bonus.<br/>
<br/>
<p>Per ulteriori info: <a href="mailto:millebytes@interactive-mr.com"><span class="__cf_email__">Contattaci</span></a></p>


</div>


</footer>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- owl carousel js-->
<script src="owl-carousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>


<script>

//al click dei disponibili
  $(".validation").on('click', function() {

$(".wrong").hide();
$(".perfect").hide();
let can1= $(".mail1").val();
let can2= $(".mail2").val();
let can3= $(".mail3").val();
let uid= $(".uidpal").val();
let tabtot;
let tabField;

console.log(uid);
  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "friendAdd2.php",

      //Quali dati devo inviare?
      data: "mailsend1="+can1+"&mailsend2="+can2+"&mailsend3="+can3+"&uidPal="+uid, 
      dataType: "html",
	  success: function(data) 
	  					{ 
                        tabField=$(data).filter(".contOk").html();
                          //$(".contEmail").hide();
                          console.log("risposta"+tabField);
                          $(".contMessage").append(tabField);

                          if (tabField.indexOf('Grazie')>-1) 
                          {
                           $(".contEmail").hide();
                          }
						}

    });
  });

  let copyText = document.querySelector(".copy-text");
copyText.querySelector("button").addEventListener("click", function () {
	let input = copyText.querySelector("input.text");
	input.select();
	document.execCommand("copy");
	copyText.classList.add("active");
	window.getSelection().removeAllRanges();
	setTimeout(function () {
		copyText.classList.remove("active");
	}, 2500);
});


function isEmail(email) {
  var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return EmailRegex.test(email);
}

function CheckEmail()
{
$(".mailAlert").remove();

var m1=$(".mail1").val();
var m2=$(".mail2").val();
var m3=$(".mail3").val();

var ml1=$(".mail1").val().length;
var ml2=$(".mail2").val().length;
var ml3=$(".mail3").val().length;
var udl=$(".uidpal").val().length;
var sumMail=ml1+ml2+ml3;

console.log("A"+ml1);
console.log("B"+ml2);
console.log("C"+ml3);

  var Email1=isEmail(m1);
  var Email2=isEmail(m2);
  var Email3=isEmail(m3);
  
if (udl==0 || sumMail==0 || ( (Email1==false && ml1>0) || (Email2==false && ml2>0) || (Email3==false && ml3>0) )) { 
    $(".btn-success").prop('disabled', true).after("<div class='mailAlert'>Attenzione verificare che le email siano corrette!</div>");
}

else {
    $(".btn-success").prop('disabled', false); 
    $(".mailAlert").remove();
}


}

$("input").on( "change", function() { CheckEmail(); });
//$("input").keypress(function(){ CheckEmail(); });
$("body").mousemove(function(){ CheckEmail(); });


</script>



</body>
</html>
