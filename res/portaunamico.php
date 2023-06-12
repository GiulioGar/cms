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
            <div class="col-md-6">
                <div class="contMessage">

                <div class="contEmail">
                <div style="font-size:27px"> <span>Invita un amico!</span>  </div>
                <div style="font-size:16px"> 
                  <ul>
                    <li>Inserisci fino ad un massimo di 3 indirizzi email che ci vuoi suggerire</li><br/>
                    <li>Gli indirizzi inseriti saranno invitati ad iscriversi al nostro Club, su tuo suggerimento.</li><br/>
                    <li>Una volta effettuata l'iscrizione e quando completeranno almeno 1 ricerca riceverai 500 bytes per ogni utente da te suggerito!</li>

                </div>  
                </h5>
                <p> 
                <form>
                    <input style="max-width: 500px;" class="form-control mailpal" type="email" name="mailsend1" placeholder="e-mail amico 1">    
                    <input style="max-width: 500px;" class="form-control mailpal" type="email" name="mailsend2" placeholder="e-mail amico 2">    
                    <input style="max-width: 500px;" class="form-control mailpal" type="email" name="mailsend3" placeholder="e-mail amico 3">    
 
                    <input style="max-width: 300px;" class="form-control uidpal" type="hidden" name="uidPal" value='<?php echo $userId;?>' >    
                    <button class='btn btn-success validation' type='button' >Invia <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </form>
                </p>
            </div>


            </div>
            
            </div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="images/banner-img.png" alt=""></div>
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
                        <h5>Prossimamente la nostra nuova app per Android !</h5>
                        <p class="card-text">Stiamo lavorando per migliorare la tua esperienza con il Club Millebytes!
                            Nei prossimi giorni rilasceremo la nostra nuova app che ti consentirà in maniera semplice e veloce di consultare il punteggio, i premi e le ricerche
                            a disposizione.
                        </p>
                        <!-- <a href="#">READ MORE <i class="fa fa-angle-right" aria-hidden="true"></i></a> -->
                    </div>
                </div>
            </div>
            <div>
                <div class="card text-center"><img class="card-img-top" src="images/news2.jpg" alt="">
                    <div class="card-body text-left pr-0 pl-0">
                    <h5>Prossimamente la nostra nuova app per Apple !</h5>
                        <p class="card-text">Stiamo lavorando per migliorare la tua esperienza con il Club Millebytes!
                            Nei prossimi giorni rilasceremo la nostra nuova app che ti consentirà in maniera semplice e veloce di consultare il punteggio, i premi e le ricerche
                            a disposizione.
                        </p>
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
<footer class="container-fluid" id="gtco-footer">

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
let can= $(".mailpal").val();
let uid= $(".uidpal").val();
let pwd= $(".paspal").val();
let tabtot;
let tabField;

console.log(uid);
  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "paypalMail2.php",

      //Quali dati devo inviare?
      data: "mailPal="+can+"&uidPal="+uid+"&pwd="+pwd, 
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

</script>



</body>
</html>
