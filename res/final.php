<html>
    <head>
    <?php
    $nat=$_GET['nat'];

    ?>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <title>Complete</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="http://www.primisoft.com/fields/AMP/R2101008C/resources/mod.css">  
    </head>
    <body role="document">

        <div style="border:1px solid #CE295D; height: 400px; -webkit-border-radius: 20px;
        -moz-border-radius: 20px;
        border-radius: 20px;" class="container">

            <div class="row">
            <?php
             $logo="";
             if ($nat==1) {$logo="logoAus"; } 
             else {$logo="logampli";}
            ?>
            <div style="padding:8px;" class="col-xs-3"><img src="http://www.primisoft.com/fields/AMP/R2101008C/resources/<?php echo $logo; ?>.png"/></div>
            </div>

            <br/>
            <br/>
            <br/>
            <br/>
            <br/>

            <div class="row">

                <div id="" class="col-3"></div>
                <div id="titl" style="font-size:30px; text-align:center" class="col-6">
                <?php 
                if ($nat==1) {echo "Thanks for your time! "; } 
                if ($nat==2) {echo "Merci pour le temps que vous avez bien voulu nous accorder !"; } 
                if ($nat==3) {echo "Vielen Dank, dass Sie sich Zeit für uns und unsere Umfrage genommen haben!  "; } 
                if ($nat==4) {echo "Grazie per il tempo che ci ha dedicato!  "; } 
                if ($nat==5) {echo "Thanks for your time! "; } 
                ?>
            </div>
                <div id="" class="col-3"></div>
    
    
               </div>

        </div>
       
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>