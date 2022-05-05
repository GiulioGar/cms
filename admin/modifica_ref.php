<?php
$jsonString = file_get_contents('referal.json');
$data = json_decode($jsonString, true);
?>


<button type="button" class="btn btn-success apri" data-toggle="modal" data-target="#modalCrea" data-whatever="@mdo"><i class="fas fa-folder-plus" aria-hidden="true"></i> <?php echo $data['referal'][0]['title']; ?></button>


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
      foreach($data as $key => $val)
      {
        echo "<div>".$data()."</div>"
      }

      ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" value="Aggiungi"  name="openSearch" class="btn btn-primary">Aggiungi</button>
      </div>
    </div>
  </div>
</div>
</form>





