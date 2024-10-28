

<?php

// seleziono info  da fatture

$query_fatture= "SELECT * FROM cint_fatture order by id DESC";
$selFatture = mysqli_query($admin,$query_fatture);
$contaFatture= mysqli_num_rows($selFatture);



?>


<?php
//phpinfo();
?>

<div class="row">
	 <div class="col col-xs-6">
     <div class="status"></div>
	</div>
	<div class="col col-xs-6 text-right">
	<?php require_once('modulo_aggiungi_fattura.php'); ?>
	</div>
</div>


<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> FATTURE RICEVUTE</h6>
 </div>

<div class="card-body">  


<div id="confatture" class="col-md-12">

<table style="text-align:center" class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Download</th>
      <th scope="col">Fattura</th>
      <th scope="col">Mese</th>
      <th scope="col">Importo</th>
      <th scope="col">Emessa</th>
      <th scope="col">Pagamento</th>
    </tr>
  </thead>
  <tbody class="fatture">

<?php 

while ($row3= mysqli_fetch_assoc($selFatture))
{
 if ($contaFatture>0) 
 {
   $nomeFile= $row3["nomefile"];
   $emissione=$row3["emessa"];
   $pagamento=$row3["pagata"];
  ?>

<tr>
    
    <td><button onclick="window.open('res/<?php echo $nomeFile; ?>');" class="btn"><i class="fa fa-download"></i></button></td>
    <td><?php echo $row3["etichetta"]; ?></td>
    <td><?php echo $row3["mese"]; ?></td>
    <td><?php echo $row3["importo"]; ?>€</td>
    <td>
      <?php 
      if ($emissione=="No")
      {
       ?> 
      <form id="emesso<?php echo $row3["id"]; ?>">
      <input type="hidden" name="azione" value="emetto"/>
      <input type="hidden" name="idval" value="<?php echo $row3["id"]; ?>"/>
      <button  data-toggle="tooltip" data-type="primary"  data-placement="left" title="Clicca se emessa"  id="controlbutton" value="btemesso" type="button" class="btn btn-danger controlbutton">No</button>
      </form>
    <?php  
      }
      else 
      {
       ?> 
        <button type="button" disabled class="btn btn-success">Si</button>
     <?php  
      }
      ?>
    </td>
    <td>

    <?php 
      if ($pagamento=="Non ricevuto")
      {
       ?> 
      <form id="ricezione<?php echo $row3["id"]; ?>">
      <input type="hidden" name="azione" value="ricevo"/>
      <input type="hidden" name="idval" value="<?php echo $row3["id"]; ?>"/>
      <button data-toggle="tooltip" data-type="primary"  data-placement="right" title="Clicca se è stato ricevuto" id="" value="btricezione" type="button" class="btn btn-danger controlbutton">Non ricevuto</button>
      </form>
    <?php  
      }
      else 
      {
       ?> 
        <button type="button" disabled class="btn btn-success">Ricevuto</button>
     <?php  
      }
      ?>

    </td>
  </tr>

 <?php } 
 else 
 {
 ?>
  <tr>
    <th colspan="7" scope="row"><div class="alert alert-warning" role="alert">Non sono presenti fatture</div></th>
  </tr>

  <?php
 }  

}
?>
    
    </tbody>
</table>


</div>



</div>
</div>

</div>


<!-- close row  -->
</div>



<script>

//script bottone aggiungi

$(document).on('click', 'button.add', function()
{
    var file_data = $('#file').prop('files')[0];
    let eti=$("#eti").val();
    let mese=$("#mese").val();
    let importo=$("#importo").val();

    console.log(file_data)
	var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('eti', eti);
  form_data.append('mese', mese);
  form_data.append('importo', importo);
  
let leggorisposta;
let fatture;

//chiamata ajax
$.ajax({      
  
  //imposto il tipo di invio dati (GET O POST)
   type: "POST",

   //Dove devo inviare i dati recuperati dal form?
   url: "function_cint_fatture.php",

   //Quali dati devo inviare?
   dataType: 'html', // what to expect back from the PHP script
   cache: false,
   contentType: false,
   processData: false,
   data: form_data,

   success: function(data) 
                       { 
                        $("#modalCrea").modal('hide');
                        // aggiungi riga a tabella fattura
                        fatture=$(data).filter("#tabfatture");
                        $("#confatture").html(fatture);
                       }    

});


});



//script bottoni emesso pagato

$(document).on('click', 'button', function()
{
  $('[data-toggle="tooltip"]').tooltip("hide");

let valbutton=$(this).val();
let dataForm="";
let tabella="";
let idForm=$(this).parent().attr("id");
console.log(idForm);

if (valbutton=="btemesso") {dataForm=$("#"+idForm).serialize();}
if (valbutton=="btricezione") {dataForm=$("#"+idForm).serialize();}

//chiamata ajax
$.ajax({      
  
  //imposto il tipo di invio dati (GET O POST)
   type: "GET",

   //Dove devo inviare i dati recuperati dal form?
   url: "function_cint_fatture.php",

   //Quali dati devo inviare?
   dataType: 'html', // what to expect back from the PHP script
   cache: false,
   contentType: false,
   processData: false,
   data: dataForm,

   success: function(data2) 
                       { 
                        tabella=$(data2).filter("#tabfatture");
                        $("#confatture").html(tabella);

                        $(document).ready(function(){
                        $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
                                });
                       }    

});


});





// aggiungi nome file caricato

$(".file").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

</script>
