<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 


	  
$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
@$var_pagato = $_REQUEST['var_pagato'];  
@$var_esporta = $_REQUEST['var_esporta'];  
@$code = $_REQUEST['code']; 
$id_utente = $_REQUEST['id_utente']; 
$importo=$_REQUEST['importo'];
$email=$_REQUEST['email'];
@$azione = $_REQUEST['azione'];
@$verifica = $_REQUEST['Verifica'];
@$cifra2 = $_REQUEST['cifra2'];
@$cifra5 = $_REQUEST['cifra5'];
@$cifra9 = $_REQUEST['cifra9'];
@$cifra10 = $_REQUEST['cifra10'];
@$cifra15 = $_REQUEST['cifra15'];
@$cifra20 = $_REQUEST['cifra20'];
$data=date("Y-m-d");

@$del= $_REQUEST['del'];
@$idPre= $_REQUEST['idPremio'];

@$premi2euro=$_REQUEST["pr2euro"];
@$premi5euro=$_REQUEST["pr5euro"];
@$premi10euro=$_REQUEST["pr10euro"];
@$premi20euro=$_REQUEST["pr20euro"];
$cyear=date("Y");


mysqli_select_db($admin,$database_admin);

	$cerca_progetto=$_REQUEST['typ'];
	if ($cerca_progetto==""){$cerca_progetto="0";}


require_once('inc_taghead.php');
require_once('inc_tagbody.php');



?>

<div class="content-wrapper">
 <div class="container">



 <div class="row">

 <div id="tabellaPremi" class="col-md-9">


<!-- contenuto tabella premi -->


 </div>



<div id="conteggioPremi" class="col-md-3">

<!-- contenuto tabella premi -->
</div>




</div>

</div>
</div>
<?php
require_once('inc_footer.php'); 
?>

<script>

//tipo premi function
$(document).on("click", "#filPrize", function() {
$('#tabellaPremi').empty();

let valButton=$(this).val();

$.ajax({
//imposto il tipo di invio dati (GET O POST)
type: "GET",
//Dove devo inviare i dati recuperati dal form?
url: "function_premi.php",

//Quali dati devo inviare?
data:"typ="+valButton, 
dataType: "html",
success: function(data) 
			{ 
			var pSin= $(data).filter('#parteSinistra');
			$("#tabellaPremi").append(pSin);

		}
	});
}); 

//PAGAMENTO function
$(document).on("click", "#payPrize", function() {
$('#tabellaPremi').empty();
$('#conteggioPremi').empty();

let valButton=$(this).val();
let idPremio=$(this).data("ide");

$.ajax({
//imposto il tipo di invio dati (GET O POST)
type: "GET",
//Dove devo inviare i dati recuperati dal form?
url: "function_premi.php",

//Quali dati devo inviare?
data:"var_pagato="+valButton, 
dataType: "html",
success: function(data) 
			{ 
			var pSin= $(data).filter('#parteSinistra');
			var pDes= $(data).filter('#parteDestra');
			$("#tabellaPremi").append(pSin);
			$("#conteggioPremi").append(pDes);

		}
	});
}); 

//delete function
$(document).on("click", "#delPrize", function() {
$('#tabellaPremi').empty();

let valButton=$(this).val();
let idPremio=$(this).data("ide");

$.ajax({
//imposto il tipo di invio dati (GET O POST)
type: "GET",
//Dove devo inviare i dati recuperati dal form?
url: "function_premi.php",

//Quali dati devo inviare?
data:"del="+valButton+"&idPremio="+idPremio, 
dataType: "html",
success: function(data) 
			{ 
				var pSin2= $(data).filter('#parteSinistra');
				$("#tabellaPremi").append(pSin2);

		}
	});
}); 

// chiamate ajax	
$(document).ready( function () {
	$("#tabellaPremi").empty();
	$("#conteggioPremi").empty();

 //chiamata ajax
 $.ajax({

//imposto il tipo di invio dati (GET O POST)
 type: "GET",

 //Dove devo inviare i dati recuperati dal form?
 url: "function_premi.php",

success: function(response) 
		 { 
	
			var pSin= $(response).filter('#parteSinistra');
			var pDes= $(response).filter('#parteDestra');
			$("#tabellaPremi").append(pSin);
			$("#conteggioPremi").append(pDes);

	   }

});

});




$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();
    $('#table_sur').DataTable( {
        "order": [[ 3, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ richieste"
   					 },
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "pageLength": 50,
        'columnDefs': [ {

                        'targets': [0,5,6,7], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );

	
} );
</script>




