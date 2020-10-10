
<button type="button" class="btn btn-success users" data-toggle="modal" data-target="#modalUsers" data-whatever="@mdo"><i class="fas fa-user-plus"></i> AGGIUNGI USERS</button>
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


<form id="aggTag" action="pannello_target.php" method="get">
<input type="hidden" id="aTag" name="azione" value="aggiungiTag">

<div class="input-group">
      <div class="input-group-prepend">
    <span class="input-group-text" id="">Inserisci Tag:</span>
      </div>
      <input required="" type="text" class="form-control" id="tag" placeholder="" name="tag">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="button" value="Aggiungi" id="openSearch"  name="openSearch" class="btn btn-primary add">Aggiungi</button>
      </div>
    </div>
  </div>
</div>
</form>  
</div>
   
<!-- FINESTRA USERS -->

<div class="modal fade" id="modalUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inserisc users in un target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


<form id="aggUse" action="pannello_target.php" method="POST">
<input type="hidden" id="aUser" name="azione" value="aggiungiUser">
<div class="input-group">
<span class="input-group-text">Tag</span>
      <select name="Tag" id="inputState" class="form-control">
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
<br/>
<br/>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Inserisci Uid</span>
  </div>
  <textarea name="idval" cols="15" rows="20" class="form-control" aria-label="With textarea"></textarea>
</div>



      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button  type="button" value="tag" id="addUsers"  name="tag" class="btn btn-primary addUsers">Aggiungi</button>
      </div>
    </div>
  </div>
</div>


</form>  
</div>