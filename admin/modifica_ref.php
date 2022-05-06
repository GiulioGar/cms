<?php
$jsonString = file_get_contents('referal.json');
$data = json_decode($jsonString, true);
?>


<button type="button" class="btn btn-success apri" data-toggle="modal" data-target="#modalCrea" data-whatever="@mdo"><i class="fas fa-edit"></i> Costi</button>


<div class="modal fade" id="modalCrea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="conteggioIscritti.php" method="get">

      <?php 
      foreach($data['referal'] as $val)
      {
        ?>

      <div class="input-group">
      <div class="input-group-prepend">
      <span class="input-group-text" id=""> <?php echo $val['title']; ?> </span>
      </div>
      <input required type="number" value="<?php echo $val['spesa']; ?>" class="form-control" id="eti" placeholder="" name="eti<?php echo $val['id']; ?>">
      </div>
       

   <?php 
   }
  ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" value="Modifica"  name="modCosti" class="btn btn-primary">Modifica</button>
      </div>
    </div>
  </div>
</div>
</form>





