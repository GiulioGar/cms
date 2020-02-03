
<div class="btn btn-default apri">Aggiungi Ricerca</div>

<div align="left" id="aggiungi">
<form  action="pannello.php" method="get">
<div style="padding:30px; font-size:16px;">
<div><b>Nuova ricerca:</b></div>
<div style="float:left;">Inserisci sid:</div><div style="margin-left:130px;"><input type="text" name="sid"></div>
<div style="float:left;">Inserisci prj:</div> <div style="margin-left:130px;"><input type="text" name="prj"></div>
<div style="float:left;">Panel: </div><div style="margin-left:130px;"><select name="panel"><option value="1">Millebytes</option><option value="0">Esterno</option><option value="2">Target</option></select></div>
<div style="float:left;">Target Sesso:</div><div style="margin-left:130px;"> <select name="sex_target"><option value="1">Uomo</option><option value="2">Donna</option><option value="3">Uomo/Donna</option></select></div>
<div style="float:left;">Target Età:</div><div style="margin-left:130px;"><input type="text" maxlength="2" style="width:40px"  name="age1_target">-<input type="text" maxlength="2" style="width:40px" name="age2_target"></div>
<div style="float:left;">N°Interviste:</div><div style="margin-left:130px;"><input type="text" maxlength="4" style="width:80px" id="goal" name="goal"></div>
<div style="float:left;">End Field:</div><div style="margin-left:130px;"><input type="text" id="datepicker" name="end_date"></div>
<div style="float:left;">Descrizione:</div><div style="margin-left:130px;"><input type="text" name="descrizione"></div>
<div style="float:left;">Paese: </div><div style="margin-left:130px;"><select name="paese"><option value="Italia">Italia</option><option value="Uk">Uk</option><option value="Germania">Germania</option><option value="Francia">Francia</option><option value="Spagna">Spagna</option><option value="Altro">Altro</option></select></div>
<div><input type="submit" name="openSearch" value="Aggiungi"></div>
</form>
</div>
<p class="chiudi">X</p>
</div>

<div class="overlay" id="overlay" style="display:none;"></div>

 <script>


$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
});


</script>

<script type='text/javascript'>
$(document).ready(function() {
    $("input,select").on("focusin", function()
                  { $(this).css("border-color","red").parent().prev().css("font-weight","bold"); }
                 );   
        $("input,select").on("focusout", function()
                  { $(this).css("border-color","").parent().prev().css("font-weight",""); }
                 );  

});


</script>

<script>
$(".apri").click(
     function(){
         $('#overlay').fadeIn('fast');
         $('#aggiungi').fadeIn('slow');
     });
 
     $(".chiudi").click(
     function(){
     $('#overlay').fadeOut('fast');
     $('#aggiungi').hide();
     });
 
     //chiusura emergenza
     $("#overlay").click(
     function(){
     $(this).fadeOut('fast');
     $('#aggiungi').hide();
     });
 
</script>