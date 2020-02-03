
<?php

@$id_sur = $_REQUEST['id_sur'];

mysqli_select_db($database_admin, $admin);
$query_ricerche = "SELECT * FROM t_panel_control where sur_id='".$id_sur."' ";
$tot_ricerche = mysqli_query($query_ricerche, $admin) or die(mysql_error());

?>


<div align="left" id="modifica">
<form  style="padding:20px;"  action="pannello.php" method="get">
<div><b>Modifica dati ricerca:</b></div>
<input name="id_sur" type="hide" value="<?php echo $tot_ricerche['sur_id'];?>">
Prj:<input type="text" style="width:40px" value="<?php echo $tot_ricerche['prj'];?>"  name="labprj"><br>
Panel: <select name="panel"><option selected="selected"> <?php echo $tot_ricerche['panel'];?> </option><option value="1">Millebytes</option><option value="0">Esterno</option></select><br>
Target Sesso: <select name="sex_target"><option selected="selected"> <?php echo $tot_ricerche['sex_target'];?><option value="1">Uomo</option><option value="2">Donna</option><option value="3">Uomo/Donna</option></select><br>
Target Età:<input type="text" maxlength="2" style="width:40px" value="<?php echo $tot_ricerche['age1_target'];?>"  name="age1_target">-<input type="text" maxlength="2" value="<?php echo $tot_ricerche['age2_target'];?>" style="width:40px" name="age2_target"><br>
N°Interviste:<input type="text" maxlength="4" value="<?php echo $tot_ricerche['goal'];?>" style="width:80px" id="goal" name="goal"><br/>
End Field:<input type="text" id="datepicker" value="<?php echo $tot_ricerche['end_date'];?>" name="end_date"><br/>
Descrizione:<input type="text" name="descrizione" value="<?php echo $tot_ricerche['descrizione'];?>">
<div><input type="submit" name="modSearch" value="Modifica"></div>
</form>
<p class="chiudi">X</p>
</div>

<div class="overlay" id="overlay" style="display:none;"></div>

 <script>


$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
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