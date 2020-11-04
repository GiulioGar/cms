

	   
 <div class="row">

 
   <div class="col-xl-6 col-lg-5">
   <div class="card shadow mb-6">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> CREA CAMPIONE </h6></span>
                        </div>
   <div class="card-body">

<form action="campioni.php" method="get"  class="myform" >
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>" />

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Ricerca:</label>
  </div>
  <select class="custom-select surv" id="inputGroupSelect01 " name="sid">
  <option value="">No select</option>
<?php
    while ($row = mysqli_fetch_assoc($csv_sur)) 
    {
	 echo "<option class='".$row['prj']."' data-age1='".$row['age1_target']."' data-age2='".$row['age2_target']."' data-sesso='".$row['sex_target']."' value='".$row['sur_id']."'>".$row['sur_id']."</option>";
	}
?>
</select>
</div>
</div>

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Progetto:</label>
  </div>

  <input class="form-control prj" type="text" maxlength="10" style="width:130px" value=""  name="prj" />
</div>
</div>

</div>

<hr/>
<div class="form-row">

<div class="col-xl-6 col-lg-5">
<label><h6 class="m-0 font-weight-bold text-primary">Regione:</h6></label>
<select name="reg[]" class="selectpicker show-tick reg"  multiple title="Scegli la regione...">
  <option value="1">ABRUZZO</option>
  <option value="2">BASILICATA</option>
  <option value="3">CALABRIA</option>
  <option value="4">CAMPANIA</option>
  <option value="5">EMILIA-ROMAGNA</option>
  <option value="6">FRIULI-VENEZIA GIULIA</option>
  <option value="7">LAZIO</option>
  <option value="8">LIGURIA</option>
  <option value="9">LOMBARDIA</option>
  <option value="10">MARCHE</option>
  <option value="11">MOLISE</option>
  <option value="12">PIEMONTE</option>
  <option value="13">PUGLIA</option>
  <option value="14">SARDEGNA</option>
  <option value="15">SICILIA</option>
  <option value="16">TOSCANA</option>
  <option value="17">TRENTINO-ALTO ADIGE</option>
  <option value="18">UMBRIA</option>
  <option value="19">VALLE D'AOSTA</option>
  <option value="20">VENETO</option>
</select>
</div>

<div class="col-xl-6 col-lg-5">
<label><h6 class="m-0 font-weight-bold text-primary">Area:</h6></label>
<select name="aree[]" class="selectpicker show-tick area"  multiple title="Scegli l'area...">
  <option value="1">Nord-Ovest</option>
  <option value="2">Nord-Est</option>
  <option value="3">Centro</option>
  <option value="4">Sud</option>
</select>
</div>

</div>


<hr />

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Sesso:</label>
  </div>
  <select class="custom-select sex_target" id="inputGroupSelect01 " name="sex_target">
<option value="3">Uomo/Donna</option>
<option value="1">Uomo</option>
<option value="2">Donna</option>
</select>
</div>
</div>



<div class="form-group col-md-6">

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Età da:</label>
  </div>
 <input   class="form-control ag1" type="number" maxlength="2" style="width:90px" value="18"  name="age1_target" required />  
</div>
<div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Età a&nbsp;&nbsp;:</label>
  </div> 

	  <input   class="form-control ag2" type="number" maxlength="2" value="65" style="width:90px" name="age2_target" required /> 
  </div>

     </div>
</div>
</div>

<div style="padding:5px" class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Iscritto dal:</label>
  </div>
	   <input required class="form-control iscrizione" type="text" maxlength="4"  value="1990"  name="iscrizione" />
</div>
</div>


<div class="form-group col-md-6">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">N° Utenti:</label>
  </div>
	 <input class="form-control goal" type="text" maxlength="4" value=""  name="goal" />
</div>
</div>

</div>

<div style="padding:5px" class="form-row">

<div class="form-group col-md-12">
<div class="input-group mb-6">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Target:</label>
  </div>
  <select class="custom-select tag" id="inputGroupSelect01 " name="tag">
  <option value="">No select</option>
  <?php
			while ($row = mysqli_fetch_assoc($tot_targ))
			{
			?>
		    <option value="<?php echo $row['tag'];?>"><?php echo $row['tag'];?></option>
			<?php
			}
			?>
</select>
</div>
</div>
<div class="input-group mb-6"></div>
</div>

</hr></hr>

<div class="form-row">
<div class="form-group col-md-12"  style="text-align:right; padding:20px;" >

<input class="btn btn-primary dispo" type="button" name="azione" value="DISPONIBILI" />
<input class="btn btn-primary genera" type="button" name="azione" value="CREA" />


</div>
 </div>


 </form>

 
 
</div>

</div>



<div class="col-xl-6 col-lg-5">
   <div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> DATI </h6></span>
                        </div>

<div class="card-body">                       
<div class="udisp"> </div> 
<div class="ugenera"> </div> 
<div class="alert alert-secondary mess" role="alert" style="display:none"> Caricamento in corso... </div>

</div>

<!--fine div8-->
</div>

<!--fine row-->
</div>

</div>



<script>

//al click dei disponibili
  $(".dispo").click(function(){

    $('div.ugenera').fadeOut(); 
    $('div.udisp').fadeOut(); 
    $('.mess').fadeIn();

 

 let sid= $("select.surv").val();
 let pr= $("input.prj").val();
 let reg= $("select.reg").val();
 let area= $("select.area").val();
 let sex= $("select.sex_target").val();
 let ag1= $("input.ag1").val();
 let ag2= $("input.ag2").val();
 let isc= $("input.iscrizione").val();
 let goal= $("input.goal").val();
 let tag= $("select.tag").val();
 let act= $(this).val();

  console.log("Cliccato")

  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "appoggio.php",

      //Quali dati devo inviare?
      data: "id_sur="+sid+"&prj="+pr+"&sex_target="+sex+"&age1_target="+ag1+"&age2_target="+ag2+"&aree="+area+"&reg="+reg+"&iscrizione="+isc+"&goal="+goal+"&tag="+tag+"&azione="+act, 
      dataType: "html",
	  success: function(data) 
	  					{ 
              $('.mess').fadeOut(); 
              $('div.ugenera').fadeIn(); 
              $('div.udisp').fadeIn(); 
							$("div.udisp").html(data);
						}

    });
  });


  //al click crea campione

  $(".genera").click(function(){

    $('div.ugenera').fadeOut(); 
    $('div.udisp').fadeOut(); 
    $('.mess').fadeIn();


let sid2= $("select.surv").val();
let pr2= $("input.prj").val();
let reg2= $("select.reg").val();
let area2= $("select.area").val();
let sex2= $("select.sex_target").val();
let ag12= $("input.ag1").val();
let ag22= $("input.ag2").val();
let isc2= $("input.iscrizione").val();
let goal2= $("input.goal").val();
let tag2= $("select.tag").val();
let act2= $(this).val();


 //chiamata ajax
   $.ajax({

    //imposto il tipo di invio dati (GET O POST)
     type: "GET",

     //Dove devo inviare i dati recuperati dal form?
     url: "appoggio.php",

     //Quali dati devo inviare?
     data: "id_sur="+sid2+"&prj="+pr2+"&sex_target="+sex2+"&age1_target="+ag12+"&age2_target="+ag22+"&aree="+area2+"&reg="+reg2+"&iscrizione="+isc2+"&goal="+goal2+"&tag="+tag2+"&azione="+act2, 
     dataType: "html",
   success: function(data) 
             { 
              $('.mess').fadeOut();
              $('div.ugenera').fadeIn(); 
             $("div.ugenera").html(data);
           }

   });
 });



// OBBLIGO RICERCA


let selSid;
let selPr;

$( document ).ready(function() 
{
$(".genera").prop("disabled",true);

});

$( "select.surv" ).change(function() {

selSid=$("select.surv").val();
selPr= $("input.prj").val();

if (selSid !="" && selPr !="") {$(".genera").prop("disabled",false); }
else  {$(".genera").prop("disabled",true); }
});

$("input.prj").change(function() {

selSid=$("select.surv").val();
selPr= $("input.prj").val();

if (selSid !="" && selPr !="") {$(".genera").prop("disabled",false); }
else  {$(".genera").prop("disabled",true); }
});

//AUTO IMPUTAZIONE RICERCA

$( "select.surv" ).change(function() {
 let leggoClasse;
 let leggoAge1;
 let leggoAge2;
 let leggoSesso;

 leggoClasse= $("option:selected").attr("class");
 leggoAge1= $("option:selected").attr("data-age1");
 leggoAge2= $("option:selected").attr("data-age2");
 leggoSesso= $("option:selected").attr("data-sesso");
 $("input.prj").val(leggoClasse);
 $("input.ag1").val(leggoAge1);
 $("input.ag2").val(leggoAge2);
 $("select.sex_target").val(leggoSesso);
 console.log(leggoClasse);

});


</script>


