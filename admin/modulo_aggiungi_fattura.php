

<button type="button" class="btn btn-success apri" data-toggle="modal" data-target="#modalCrea" data-whatever="@mdo"><i class="fas fa-folder-plus"></i> FATTURA</button>


<div class="modal fade" id="modalCrea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuova Fattura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addfattura"  method="POST" enctype="multipart/form-data">

      <div class="input-group">
      <div class="input-group-prepend">
    <span class="input-group-text" id="">Etichetta fattura</span>
      </div>
      <input required type="text" class="form-control" id="eti" placeholder="" name="eti">
      </div>

      <div>&nbsp; </div>

      <div class="form-row">

      <div class="col">
      <div class="input-group">
      <div class="input-group-prepend">
      <span class="input-group-text" id="">Mese</span>
      </div>
      <input required type="text" class="form-control" id="mese" placeholder="" name="mese">
      </div>
      </div>

      <div class="col">
      <div class="input-group">
      <div class="input-group-prepend">
      <span class="input-group-text" id="">Importo</span>
      </div>
      <input required  type="number" class="form-control" id="importo" placeholder="" name="importo">
      </div>
      </div>
      </div>



<div>&nbsp; </div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" name="file" class="custom-file-input file" id="file">
    <label style="text-align:left" class="custom-file-label" for="inputGroupFile01"></label>
  </div>
</div>


</div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" value="Aggiungi"  name="openSearch" class="btn btn-primary add">Aggiungi</button>
      </div>
    </div>
  </div>
</div>
</form>




<script>



</script>
 

