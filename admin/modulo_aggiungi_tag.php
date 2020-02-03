
<div class="apri">Aggiungi Tag</div>

<div align="left" id="aggiungi">
<form  action="pannello_target.php" method="get">
<div style="padding:30px; font-size:16px;">
<div><b>Nuovo Tag:</b></div>
<div style="float:left;">Inserisci Tag:</div><div style="margin-left:130px;"><input type="text" name="tag"></div>
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