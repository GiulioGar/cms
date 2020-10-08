
<button type="button" class="btn btn-success apri" data-toggle="modal" data-target="#modalCrea" data-whatever="@mdo"><i class="fas fa-folder-plus" aria-hidden="true"></i> AGGIUNGI TAG</button>

<div class="modal fade" id="modalCrea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuovo Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


<form  action="pannello_target.php" method="get">

<div class="input-group">
      <div class="input-group-prepend">
    <span class="input-group-text" id="">Inserisci Tag:</span>
      </div>
      <input required="" type="text" class="form-control" id="tag" placeholder="" name="tag">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="button" value="Aggiungi"  name="openSearch" class="btn btn-primary vaii">Aggiungi</button>
      </div>
    </div>
  </div>
</div>
</div>
</form>     

