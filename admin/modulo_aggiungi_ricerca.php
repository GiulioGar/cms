<?php

$query_clienti = "SELECT cliente
FROM t_panel_control
GROUP BY cliente
ORDER BY cliente ASC";
$lista_clienti = mysqli_query($admin,$query_clienti);

?>

<button type="button" class="btn btn-success apri" data-toggle="modal" data-target="#modalCrea" data-whatever="@mdo"><i class="fas fa-folder-plus" aria-hidden="true"></i> PROGETTO</button>


<div class="modal fade" id="modalCrea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuova Ricerca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="pannello.php" method="get">

      <div class="input-group">
      <div class="input-group-prepend">
    <span class="input-group-text" id="">Codice SID Progetto:</span>
      </div>
      <input required="" type="text" class="form-control" id="sid" placeholder="" name="sid">
      </div>

      <div>&nbsp; </div>

      <div class="input-group">
      <div class="input-group-prepend">
      <span class="input-group-text" id="">Codice PRJ Progetto:</span>
      </div>
      <input required="" type="text" class="form-control" id="prj" placeholder="" name="prj">
      </div>

<div>&nbsp; </div>

<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="cliente">Cliente:</label>
</div>
<select  name="cliente" required="" class="custom-select" id="cliente">
<?php
while ($row = mysqli_fetch_assoc($lista_clienti))
			{
			?>
		    <option value="<?php echo $row['cliente'];?>"><?php echo $row['cliente'];?></option>
			<?php
      }
      ?>

</select>
</div>  

<div>&nbsp; </div>

<div class="input-group mb-3">
<div class="input-group-prepend">
<label class="input-group-text" for="cliente">Tipologia:</label>
</div>
<select  name="tipologia" required="" class="custom-select" id="tipologia">
      <option value="CAWI">CAWI</option>
      <option value="CATI">CATI</option>
      <option value="CAPI">CAPI</option>
</select>
</div> 

<div>&nbsp; </div>

      <div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="panel">Panel:</label>
    </div>
      <select  name="panel" required="" class="custom-select" id="panel">
      <option value="1">Millebytes</option>
      <option value="0">Esterno</option>
      <option value="2">Target</option>
      </select>
      </div>

      <div>&nbsp; </div>
      
      <div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="panel">Genere:</label>
    </div>
      <select required="" name="sex_target" required="" class="custom-select" id="sex_target">
      <option value="1">Uomo</option>
      <option value="2">Donna</option>
      <option value="3">Uomo/Donna</option>
      </select>
      </div>

<div>&nbsp; </div>

  <div class="form-row input-group">
  <div class="input-group-prepend">
      <span class="input-group-text" id="">Età:</span>
      </div>
    <div class="col">
    <input name="age1_target" type="number" class="form-control" placeholder="18">
    </div>
    <div class="col">
    <input name="age2_target" type="number" class="form-control" placeholder="65">
    </div>
  </div>

  <div>&nbsp; </div>

  <div class="input-group">
  <div class="input-group-prepend">
      <span class="input-group-text" id="">Interviste:</span>
      </div>
      <input required="" type="number" class="form-control" id="goal" placeholder="0" name="goal">
   </div>

   <div>&nbsp; </div>

   <div class="input-group date">
   <div class="input-group-prepend">
      <span class="input-group-text" id="">Chiusura Field:</span>
      </div>
    <input type="date"  id="date" class="form-control" name="end_date" >
</div>

<div>&nbsp; </div>

<div class="input-group">
<div class="input-group-prepend">
      <span class="input-group-text" id="">Descrizione:</span>
      </div>
      <input required="" type="text" class="form-control" id="descrizione" placeholder="Inserire descrizione" name="descrizione">
      </div>

   <div>&nbsp; </div>

      <div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="panel">Nazione:</label>
    </div>
      <select required="" name="paese" required="" class="custom-select" id="sex_paesetarget">
      <option value="Italia">Italia</option>
      <option value="Uk">Uk</option>
      <option value="Germania">Germania</option>
      <option value="Francia">Francia</option>
      <option value="Spagna">Spagna</option>
      <option value="Altro">Altro</option>
      </select>
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" value="Aggiungi"  name="openSearch" class="btn btn-primary">Aggiungi</button>
      </div>
    </div>
  </div>
</div>
</form>




<script>



</script>
