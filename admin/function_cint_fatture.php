<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

//////CARICAMENTO FILE //////////



/*
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) 
{
    echo "<div class='allert'>Non hai inviato nessun file...</div>";
    exit; 
}

//percorso della cartella dove mettere i file caricati dagli utenti
$uploaddir = 'res/';

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
    //Se l'operazione è andata a buon fine...
    echo "<div class='allert'>File inviato con successo.</div>";
  }else{
    //Se l'operazione è fallta...
    echo "<div class='allert'>Upload NON valido!</div>"; 
  }

*/
$etichetta=$_REQUEST['eti'];
$mese=$_REQUEST['mese'];
$importo=$_REQUEST['importo'];

$azione=$_REQUEST['azione'];
$idval=$_REQUEST['idval'];


if ($azione=="emetto")
{
$query_upemes= "UPDATE cint_fatture SET emessa='Si' where id=".$idval." ";
$upemess = mysqli_query($admin,$query_upemes);
}

if ($azione=="ricevo")
{
$query_uppaga= "UPDATE cint_fatture SET pagata='Ricevuto' where id=".$idval." ";
$uppaga = mysqli_query($admin,$query_uppaga);
}

$filepresente=false;



if (isset($_FILES['file']['name'])) {
    if (0 < $_FILES['file']['error']) {
        echo '<span class="allert" style="color:red;">Error during file upload ' . $_FILES['file']['error'] . '</span>';
    } else {
        if (file_exists('res/' . $_FILES['file']['name'])) {
            $filepresente=true;
            echo '<div class="alert alert-warning" role="alert">File già presente in cartella res/' . $_FILES['file']['name'] . '</span>';
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], 'res/' . $_FILES['file']['name']);
            echo '<div class="alert alert-success" role="alert">File caricato correttamente</div>';
        }
    }
} 
echo nl2br("\n");

if ($filepresente==false)
{
//aggiungo i dati nella tabella cint_fatture
$query_aggfatt= "INSERT INTO cint_fatture (etichetta,nomefile,mese,importo) values ('".$etichetta."','".$_FILES['file']['name']."','".$mese."',".$importo.")";
$aggiungiFatt = mysqli_query($admin,$query_aggfatt);

} 




//leggo la tabella
$query_fatture= "SELECT * FROM cint_fatture order by id DESC";
$selFatture = mysqli_query($admin,$query_fatture);
$contaFatture= mysqli_num_rows($selFatture);

?>


<table id="tabfatture" style="text-align:center" class="table table-striped">
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
      <button  data-toggle="tooltip"  data-type="primary" data-placement="left" title="Clicca se emessa"  id="controlbutton" value="btemesso" type="button" class="btn btn-danger controlbutton">No</button>
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
      <button data-toggle="tooltip"  data-type="primary" data-placement="right" title="Clicca se è stato ricevuto" id="" value="btricezione" type="button" class="btn btn-danger controlbutton">Non ricevuto</button>
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

