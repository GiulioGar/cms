
<style>

.task:nth-child(odd) { background:#e5e5e5; width:100%; padding:10px; margin-bottom:5px; border:1px solid gray;}
.task:nth-child(even) { background:#9DCE6B; width:100%; padding:10px; margin-bottom:5px; border:1px solid gray;}
.campSel { color:#9b0017;}
</style>
	   
 
 
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

<div class="form-group col-md-12">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Ricerca:</label>
  </div>
  <select class="custom-select surv" id="inputGroupSelect01 " name="sid">
  <option value="">No select</option>
<?php
    while ($row = mysqli_fetch_assoc($csv_sur)) 
    {
	 echo "<option class='".$row['prj']."' data-age1='".$row['age1_target']."' data-age2='".$row['age2_target']."' data-sesso='".$row['sex_target']."' value='".$row['sur_id']."'>".$row['sur_id']." (".$row['prj'].") - ".$row['description']."</option>";
	}
?>
</select>

</div>
<input class="form-control prj" type="hidden" value=""  name="prj" />
</div>


</div>

<hr />

<div class="form-row">

<div class="col-xl-6 col-lg-6">
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

<div class="form-row">
<div class="col-xl-6 col-lg-5">
<label><h6 class="m-0 font-weight-bold text-primary">Ampiezza:</h6></label>
<select name="ampiezza[]" class="selectpicker show-tick amp"  multiple title="Scegli l'ampiezza...">
  <option value="1">1-149.999</option>
  <option value="2">150.000-499.999</option>
  <option value="3">500.000-999.9999</option>
  <option value="4">1 milione e oltre</option>
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

<div class="form-group col-md-12">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Iscritto dal:</label>
  </div>
	   <input required class="form-control iscrizione" type="text" maxlength="4"  value="1990"  name="iscrizione" />
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
<input class="btn btn-primary addInfo" type="button" name="azione" value="AGGIUNGI" />


</div>
 </div>


 </form>

 
 
</div>

</div>


<!-- Seconda colonna -->
<div class="col-xl-6 col-lg-5">

<!-- Box Campione -->
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<span><h6 class="m-0 font-weight-bold text-primary"> CAMPIONE </h6></span> <span style="cursor:pointer" class="deltask"><i style="color:#007bff" class="fas fa-trash"></i></span>
            
    </div>

<div class="card-body">                       

<div class="ugenera"> 
<form action="campioni.php" method="get"  class="formC" >
<div class="ubody"> 

</div>

  <div style="padding:5px" class="form-row">

    <div class="form-group col-md-8">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" style="background-color:#0050CE!important; font-weight:bold; color:#fff" for="inputGroupSelect01"><i class="fas fa-users"> </i> &nbsp; Utenti:</label>
  </div>
	 <input class="form-control goal" type="text" maxlength="4" value=""  name="goal" />
</div>
</div>

    <div class="form-group col-md-4">
    <input style="float:right" class="btn btn-primary creaCamp" type="button" name="azione" value="CREA" />
   


    </div>

    </div>

</form>
</div> 


<div class="alert alert-secondary messCampione" role="alert" style="display:none"> Caricamento in corso... </div>

</div>

<!--fine box campione-->
</div>

<BR/>

<!-- Box Dati-->
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> DATI </h6></span>
    </div>

<div class="card-body">                       
<div class="udisp"> </div> 
<div class="ug2"> </div> 
<div class="alert alert-secondary messDati" role="alert" style="display:none"> Caricamento in corso... </div>

</div>

<!--fine box dati-->
</div>

<!--fine seconda colonna-->
</div>



</div>



<script>
 $('.formC').hide(); 

//al click dei disponibili
$(".dispo").click(function()
{

    $('div.ugenera').fadeOut(); 
    $('div.udisp').fadeOut(); 
    $('.messDati').fadeIn();

 

 let sid= $("select.surv").val();
 let pr= $("input.prj").val();
 let reg= $("select.reg").val();
 let area= $("select.area").val();
 let amp= $("select.amp").val();
 let sex= $("select.sex_target").val();
 let ag1= $("input.ag1").val();
 let ag2= $("input.ag2").val();
 let isc= $("input.iscrizione").val();
 let tag= $("select.tag").val();
 let act= $(this).val();


  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "appoggio.php",

      //Quali dati devo inviare?
      data: "id_sur="+sid+"&prj="+pr+"&sex_target="+sex+"&age1_target="+ag1+"&age2_target="+ag2+"&aree="+area+"&reg="+reg+"&ampiezza="+amp+"&iscrizione="+isc+"&tag="+tag+"&azione="+act, 
      dataType: "html",
	  success: function(data) 
	  					{ 
              $('.messDati').fadeOut(); 
              $('div.ugenera').fadeIn(); 
              $('div.udisp').fadeIn(); 
							$("div.udisp").html(data);
						}

    });
  });


//AGGIUNGO LE INFO
let nCamp=0;
let allInfo="";
$(".addInfo").click(function()
{
 $(".creaCamp").prop("disabled", true);
 $('div.udisp').fadeOut(); 
 $('div.udisp').html(""); 
if(nCamp>=0) { $('.formC').fadeIn();   $("#golP").val(0).prop("disabled", false);}

nCamp++;

let reg2= $("select.reg").val();
let area2= $("select.area").val();
let amp2= $("select.amp").val();
let sex2= $("select.sex_target").val();
let isc2= $("input.iscrizione").val();
let tag2= $("select.tag").val();
let act2= $(this).val();
let goal= $("input.goal").val();

let sid3= $("select.surv").val();
let pr3= $("input.prj").val();
let reg3= $("select.reg").find(":selected").text();
let area3= $("select.area").find(":selected").text();
let amp3= $("select.amp").find(":selected").text();
let sex3= $('.sex_target').find(":selected").text();
let ag13= $("input.ag1").val();
let ag23= $("input.ag2").val();
let isc3= $("input.iscrizione").find(":selected").text();
let tag3= $("select.tag").find(":selected").text();

// parte testuale
let selRegione="";
let selAmpiezza="";
let selArea="";
let selIscritti="";
let selTarget="";
if(reg3.length >0) { selRegione="<b>Regione</b>: "+reg3+"<br/>";}
if(area3.length >0) { selArea="<b>Area</b>: "+area3+"<br/>";}
if(amp3.length >0) { selAmpiezza="<b>Ampiezza</b>: "+amp3+"<br/>";}
if(isc3.length >0) { selIscritti="<b>Iscritti dal:</b>: "+isc3+"<br/>";}
if(tag3 != "No select") { selTarget="<b>Target:</b>: "+tag3+"<br/>";}
// input hidden




allInfo=`<div id="cmp`+nCamp+`" class="task">
<div class="campSel"><u><b>Campione:`+nCamp+`</b></u></div>
<b>Genere</b>:`+sex3+`<br/>
<b>Età</b>: `+ag13+` anni - `+ag23+` anni<br/>`
+selRegione+selArea+selAmpiezza+selIscritti+selTarget+`
<br/>
<div style="padding-left:0" class="form-group col-md-12">
<div class="input-group mb-3">
<div class="input-group-prepend">
    <label class="input-group-text" style="background-color:#CE3200!important; font-weight:bold; color:#fff" for="inputGroupSelect01"><i class="fas fa-percentage"></i> &nbsp; Campione:</label>
  </div>
	 <input id="golP" class="form-control goalPerc`+nCamp+`" style="max-width:110px"  type="number" max="100" maxlength="3" value=""   name="goalPerc" />
</div>
</div>


</div>
<input id="idsur" class="ids`+nCamp+`" name="id_sur`+nCamp+`" type="hidden" value=`+sid3+` />
<input id="prsur" class="prs`+nCamp+`" name="prj`+nCamp+`" type="hidden" value=`+pr3+` />
<input id="se" class="se`+nCamp+`" name="sex`+nCamp+`" type="hidden" value=`+sex2+` />
<input id="ag" class="age`+nCamp+`" name="aged`+nCamp+`" type="hidden" value=`+ag13+` />
<input id="agb" class="ageb`+nCamp+`" name="agedb`+nCamp+`" type="hidden" value=`+ag23+` />
<input id="re" class="re`+nCamp+`" name="red`+nCamp+`" type="hidden" value=`+reg2+` />
<input id="are" class="are`+nCamp+`" name="ared`+nCamp+`" type="hidden" value=`+area2+` />
<input id="am" class="amp`+nCamp+`" name="ampd`+nCamp+`" type="hidden" value=`+amp2+` />
<input id="is" class="iscr`+nCamp+`" name="iscrd`+nCamp+`" type="hidden" value=`+isc2+` />
<input id="tg" class="tgr`+nCamp+`" name="tgrd`+nCamp+`" type="hidden" value=`+tag2+` />





`

$("div.ubody").append(allInfo);


 //chiamata ajax

 });


  //al click crea campione

  $(".creaCamp").click(function()
  {

    //$('div.ugenera').fadeOut(); 
   // $('div.udisp').fadeOut(); 
   // $('.messCampione').fadeIn();

let sid2= $("#idsur").val();
let pr2= $("#prsur").val();
 
   const currentYear = new Date().getFullYear();

// creo la query
 let idxQuery="";
 let sumQuery="";
 let nc=0;

 let campSel=$(".task").length;
  
 let getTarget;
 let fromTag="";
 let infoQuery="";
 let addSex;
 let year1;
 let year2;
 let addArea;
 let addReg;
 let addAmp;
 let addTag;
 let iscrizione;
 let goal;
 let y1=18;
 let y2=99;
 let limit=0;

 let itemArea="";
 let nitemArea;
 let valPeople;
 let queryTag="";
let idx=0;
let act2= $(this).val();

 var areaArr;
 var regArr;
 var ampArr;

 $( ".task" ).each(function( index ) 
 {

  idx++;

  getTarget=$(".tg"+idx).val();
  addSex=$(".se"+idx).val(); 
  y1=$(".age"+idx).val(); 
  y2=$(".ageb"+idx).val(); 
  year1=currentYear-y1;
  year2=currentYear-y2;
  addArea=$(".are"+idx).val(); 
  addReg=$(".re"+idx).val(); 
  addAmp=$(".amp"+idx).val(); 
  addTag=$(".tg"+idx).val(); 
  iscrizione=$(".iscr"+idx).val(); 
  totalgoal=$(".goal").val(); 
  goalPerc=$(".goalPerc"+idx).val(); 

  if(totalgoal.length ==0) { totalgoal=99999;}
  if(iscrizione.length ==0) { iscrizione="1900-01-01";}
  limit=totalgoal-(totalgoal/100)*goalPerc;
  limit=Math.ceil(limit);
  limit=totalgoal-limit;

console.log("totalgoal:"+totalgoal);  
console.log("goalPerc:"+goalPerc);
console.log("limit:"+limit);


if (addSex !=3) { infoQuery="gender="+addSex;  }
else { infoQuery="gender!= 0 ";  }

if(addArea!="null")
{
  nitemArea=0;
  itemArea="";
  areaArr= addArea.split(',');
  nitemArea= areaArr.length-1;


  jQuery.each( areaArr, function( i, val ) {



    if(i==0) { itemArea=" (area="+val; }
    else {itemArea=itemArea+" OR area="+val; }
    if(i==nitemArea) { itemArea=itemArea+")"; }


    });

  infoQuery=infoQuery+" AND" +itemArea;

}

if(addReg!="null")
{
  nitemArea=0;
  itemArea="";
  areaReg= addReg.split(',');
  nitemArea= areaReg.length-1;


  jQuery.each( areaReg, function( i, val ) {



    if(i==0) { itemArea=" (reg="+val; }
    else {itemArea=itemArea+" OR reg="+val; }
    if(i==nitemArea) { itemArea=itemArea+")"; }


    });

  infoQuery=infoQuery+" AND" +itemArea;
}


if(addAmp!="null")
{

  nitemArea=0;
  itemArea="";
  areaAmp= addAmp.split(',');
  nitemArea= areaAmp.length-1;


  jQuery.each( areaAmp, function( i, val ) {

    if(val==1) { valPeople="(amp>=0 AND amp <=149999)"; }
	  if(val==2) { valPeople="(amp>=150000 AND amp <=499999)"; }
	  if(val==3) { valPeople="(amp>=500000 AND amp <=999999)"; }
	  if(val==4) { valPeople="(amp>=1000000)"; }

    if(i==0) { itemArea="("+valPeople; }
    else {itemArea=itemArea+" OR "+valPeople; }
    if(i==nitemArea) { itemArea=itemArea+")"; }


    });

  infoQuery=infoQuery+"AND "+itemArea;
}


if(getTarget!=0) {fromTag=", utenti_target t"; queryTag=="target='"+addTag+"' AND i.user_id=t.uid AND "; }

if (idx>1) {sumQuery += "UNION DISTINCT";}

  idxQuery=`(SELECT * FROM t_user_info i `+fromTag+` where `+infoQuery+` AND  active=1 AND Year(birth_date)<'`+year1+`' and Year(birth_date)>'`+year2+`' and reg_date >= `+iscrizione+` and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='`+sid2+`')  ORDER BY RAND()  LIMIT `+limit+` )`;

  sumQuery +=idxQuery;


});



 //chiamata ajax
   $.ajax({

    //imposto il tipo di invio dati (GET O POST)
     type: "GET",

     //Dove devo inviare i dati recuperati dal form?
     url: "appoggio.php",

     //Quali dati devo inviare?
     data:"que="+sumQuery+"&azione="+act2+"&id_sur="+sid2+"&prj="+pr2, 
     dataType: "html",
   success: function(data) 
             { 
        
              $('.messCampione').fadeOut();
              $('div.udisp').fadeIn(); 
              $("div.udisp").append(data);
            console.log(sumQuery);
           }

   });
   

 });

 


//AUTO IMPUTAZIONE RICERCA

$( "select.surv" ).change(function() 
{
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


let opz=0;
let sum=0;
let nTask=0;

$(document).on('change', '#golP', function(){
sum=0;
nTask=$(".task").length;




    if (nTask==1)
    {
       $("#golP").val(100).prop("disabled", true);

    }
    for (let i = 1; i <= nTask; i++) {
        sum+=Number($(".goalPerc"+i).val());
    }


    if(sum !=100) { $(".creaCamp").prop("disabled", true); }
    else { $(".creaCamp").prop("disabled", false); }

//console.log("Somma:"+sum);

});


function delTask()
{
  nCamp=0;
  $(".ugenera").empty().append("<div class=\"ubody\"></div>");
}

$(".deltask").click(function() { delTask(); });

</script>


