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

$con = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');
//$admin = @mysqli_connect('46.37.21.33', 'mbuser', '$leeple%1598', 'millebytesdb');
$admin = @mysqli_connect('195.231.2.30', 'mbuser', '$leeple%1598', 'millebytesdb');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}

$userId=$_GET["user_id"];

//lettura livello
$query_cerca_livello = "SELECT points FROM t_user_info where t_user_info.user_id='$userId'";
$cerca_livello = mysqli_query($admin,$query_cerca_livello);
$lvl = mysqli_fetch_assoc($cerca_livello);

$puntAttuale=$lvl['points'];
$puntManc=2000-$lvl['points'];

if($puntAttuale>=2000) {$msgPre="Puoi ritirare un premio!";}
else 
{
    $msgPre="Ti mancano $puntManc bytes per un premio";
}


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

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" id="gtco-main-nav">
    <div class="container"><a class="navbar-brand">Millebytes.com</a>
        <button class="navbar-toggler" data-target="#my-nav" onclick="myFunction(this)" data-toggle="collapse"><span
                class="bar1"></span> <span class="bar2"></span> <span class="bar3"></span></button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="https://millebytes.com/">Home</a></li>

                <li class="nav-item"><a class="nav-link" href="mailto:millebytes@interactive-mr.com"><span class="__cf_email__">Contatti</span></a></li>
            </ul>

        </div>
    </div>
</nav>
<div class="container-fluid gtco-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1> <span>Ricerca completata con successo!</span>  </h1>
                <p> Collegati al sito Millebytes e verifica se hai altre ricerche a disposzione </p>
                <a href="https://millebytes.com/">Dashboard <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-md-6">
                <div class="card"><img class="card-img-top img-fluid" src="images/banner-img.png" alt=""></div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid gtco-features" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h2> Controlla i tuoi punti e i tuoi premi!</h2>
                <p> Collegati alla tua Dashboard, potrai controllare il tuo punteggio e se hai premi da poter ritirare. </p>
                <a href="https:/millebytes.com/">Vai al sito <i class="fa fa-angle-right" aria-hidden="true"></i></a></div>
            <div class="col-lg-8">
                <svg id="bg-services"
                     width="100%"
                     viewBox="0 0 1000 800">
                    <defs>
                        <linearGradient id="PSgrad_02" x1="64.279%" x2="0%" y1="76.604%" y2="0%">
                            <stop offset="0%" stop-color="rgb(1,230,248)" stop-opacity="1"/>
                            <stop offset="100%" stop-color="rgb(29,62,222)" stop-opacity="1"/>
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" opacity="0.102" fill="url(#PSgrad_02)"
                          d="M801.878,3.146 L116.381,128.537 C26.052,145.060 -21.235,229.535 9.856,312.073 L159.806,710.157 C184.515,775.753 264.901,810.334 338.020,792.380 L907.021,652.668 C972.912,636.489 1019.383,573.766 1011.301,510.470 L962.013,124.412 C951.950,45.594 881.254,-11.373 801.878,3.146 Z"/>
                </svg>
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="images/web-design.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">Il tuo punteggio</h3>
                                <p class="card-text"><b><?php echo $puntAttuale ?> bytes</b></p>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="oval"><img class="card-img-top" src="images/marketing.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">Status Premio</h3>
                                <p class="card-text"><b><?php echo $msgPre ?></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                        <div style="position: relative; top:40%" class="card text-center">
                            <div class="oval"><img class="card-img-top" src="images/graphics-design.png" alt=""></div>
                            <div class="card-body">
                                <h3 class="card-title">Password</h3>
                                <p class="card-text"> Clicca sotto per recuperare la password. <br/><a target="_blank" href="https://millebytes.com/lost">Recupera <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
                            </div>
                        </div>
                    </div>
                </div>
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
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- owl carousel js-->
<script src="owl-carousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
