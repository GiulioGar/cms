<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

// Include `func_target-field.php` e ottiene `$questions`
$questions = include 'func_target-field.php';

$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$query_last_update = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$last_update = mysqli_query($admin,$query_last_update) ;
$lu = mysqli_fetch_assoc($last_update);
$data_odierna=date("Y-m-d H:i:s");
$ultimo_aggiornamento=$lu['last_update'];
$salva_abilitati=$lu['abilitati'];
$stato_ricerca=$lu['stato'];
$target_sesso=$lu['sex_target'];
$target_age_1=$lu['age1_target'];
$target_age_2=$lu['age2_target'];
$panel_in=$lu['panel'];
$loi=$lu['durata'];
$conta_complete=$lu['complete'];
$redx=$lu['red_surv'];

$newDate = date("d-M", strtotime($lu['end_field']));
$newDateStart = date("d-M", strtotime($lu['sur_date']));
if ($lu['stato']==0){$stato="Aperta"; }
if ($lu['stato']==1){$stato="Chiusa"; }
if ($lu['sex_target']==1){$sex="Uomini";}
if ($lu['sex_target']==2){$sex="Donne";}
if ($lu['sex_target']==3){$sex="Uomini-Donne";}

 //calcolo cpi//
 $loi2=number_format($loi, 0);
 $redx=number_format($redx, 0);

 	if ($loi2<3) {$riga2=0;}
	if ($loi2>=4 && $loi2<=6) {$riga2=1;}
	if ($loi2>=7 && $loi2<=10) {$riga2=2;}
	if ($loi2>=11 && $loi2<=15) {$riga2=3;}
	if ($loi2>=16 && $loi2<=20) {$riga2=4;}
	if ($loi2>=21 && $loi2<=25) {$riga2=5;}
	if ($loi2>=26 && $loi2<=30) {$riga2=6;}
	if ($loi2>=31 && $loi2<=35) {$riga2=7;}
	if ($loi2>=36 && $loi2<=40) {$riga2=8;}
	if ($loi2>=41 && $loi2<=45) {$riga2=9;}
	if ($loi2>=51 && $loi2<=55) {$riga2=10;}
	if ($loi2>55) {$riga2=11;}

	if ($redx>=75) {$colonna2=0;}
	if ($redx>=50  && $redx<=74) {$colonna2=1;}
	if ($redx>=30 && $redx<=49) {$colonna2=2;}
	if ($redx>=20 && $redx<=29) {$colonna2=3;}
	if ($redx>=15 && $redx<=19) {$colonna2=4;}
	if ($redx>=10 && $redx<=14) {$colonna2=5;}
	if ($redx>=7 && $redx<=9) {$colonna2=6;}
	if ($redx>=5 && $redx<=6) {$colonna2=7;}
	if ($redx>=3 && $redx<=4) {$colonna2=8;}
	if ($redx<3) {$colonna2=9;} 
	$matrice2=($riga2*10) +$colonna2;

$arrStime = array(1.35, 1.55, 2.05, 2.80, 3.75, 5.25, 8.00, 11.70, 14.65, 19.85, 1.60, 1.85, 2.35, 3.10, 4.05, 5.55, 8.25, 11.95, 14.95, 20.10, 1.90, 2.15, 2.65, 3.40, 4.35, 5.85, 8.60, 12.30, 15.25, 20.40, 2.20, 2.45, 2.95, 3.70, 4.65, 6.15, 8.90, 12.60, 15.55, 20.75, 2.55, 2.75, 3.25, 4.00, 4.95, 6.45, 9.20, 12.90, 15.85, 21.05, 2.85, 3.05, 3.60, 4.30, 5.30, 6.75, 9.50, 13.20, 16.15, 21.35, 3.50, 3.70, 4.20, 4.95, 5.90, 7.40, 10.15, 13.85, 16.80, 22.00, 4.05, 4.25, 4.80, 5.55, 6.50, 7.95, 10.70, 14.40, 17.35, 22.55, 4.70, 4.90, 5.40, 6.15, 7.10, 8.60, 11.35, 15.05, 18.00, 23.20, 5.10, 5.35, 5.85, 6.60, 7.55, 9.05, 11.75, 15.45, 18.45, 23.60, 5.55, 5.75, 6.30, 7.00, 8.00, 9.45, 12.20, 15.90, 18.85, 24.05, 5.95, 6.20, 6.70, 7.45, 8.40, 9.90, 12.65, 16.35, 19.30, 24.50, 6.40, 6.65, 7.15, 7.90, 8.85, 10.35, 13.05, 16.75, 19.75, 24.90 );

if($conta_complete>9) { $cpiStima=$arrStime[$matrice2]; }
else { $cpiStima="N.D"; }

?>

<link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css">
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>


<div class="sc_wrapper"> <!-- Inizio del wrapper -->

<div class="container" id="page-content-wrapper">


<div class="row mt-4">
  <!-- Navbar allineata a sinistra -->
  <div class="col d-flex align-items-center">
    <nav class="navbar navlateral navbar-expand-lg">
      <button class="btn btn-secondary" id="menu-toggle"><i class="fas fa-list-ul"></i></button>
      <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </div>

  <!-- Menu selezione allineato a destra -->
  <div class="col-auto">
    <div class="menu-selection d-flex justify-content-end">
      <button type="button" class="menu-btn active">
        <i class="fas fa-bullseye"></i> Target/Domande
      </button>
      <button type="button" class="menu-btn">
        <i class="fas fa-check-circle"></i> Qualità
      </button>
      <button onclick="window.open('settingField.php?prj=<?php echo $prj; ?>&sid=<?php echo $sid; ?>');" type="button" class="menu-btn">
        <i class="fas fa-cog"></i> Impostazioni
      </button>
    </div>
  </div>
</div>


<div class="row">

  <!-- Card Ricerca -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <a style="text-decoration: none;" href="controlloField.php?prj=<?php echo $prj; ?>&sid=<?php echo $sid; ?>">
        <h5 class="custom-card-title text-success">Ricerca</h5>
        <p class="custom-card-text"><?php echo $sid; ?></p>
        <p class="custom-card-text"><?php echo $lu['description']; ?></p>
        <div class="custom-card-icon text-success">
          <i class="fas fa-poll-h"></i>
        </div>
      </a>
      </div>
    
    </div>
  </div>

  <!-- Card Target -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-primary">Target</h5>
        <p class="custom-card-text"><strong>Interviste:</strong> <?php echo $lu['goal']; ?></p>
        <p class="custom-card-text"><strong>Sesso:</strong> <?php echo $sex; ?></p>
        <p class="custom-card-text"><strong>Età:</strong> <?php echo $lu['age1_target']."-".$lu['age2_target']." anni"; ?></p>
        <div class="custom-card-icon text-primary">
          <i class="fas fa-bullseye"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Timing e Costi -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-warning">Timing e Costi</h5>
        <p class="custom-card-text"><strong>Inizio Field:</strong> <?php echo $newDateStart; ?></p>
        <p class="custom-card-text"><strong>Fine Field:</strong> <?php echo $newDate; ?></p>
        <p class="custom-card-text text-navy"><strong>CPI stimato:</strong> <?php echo $cpiStima; ?>€</p>
        <div class="custom-card-icon text-warning">
          <i class="fas fa-business-time"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Info -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="custom-card card h-100">
      <div class="custom-card-body">
        <h5 class="custom-card-title text-danger">Info</h5>
        <p class="custom-card-text"><strong>Stato Field:</strong> <?php echo $stato; ?></p>
        <p class="custom-card-text"><strong>Loi:</strong> <span class="text-danger"><?php echo $loi; ?> minuti</span></p>
        <div class="custom-card-icon text-danger">
          <i class="fas fa-info-circle"></i>
        </div>
      </div>
    </div>
  </div>

</div>

    <div class="row">

        <!-- Sezione Domande e Risposte -->
        <div class="row mt-4 custom-qa-section">

            <!-- Colonna Domande -->
<div class="col-md-4 custom-qa-questions">
    <h4 class="question-header">Domande</h4>
    <ul class="question-list scrollable-question-list">
        <?php foreach ($questions as $index => $question): ?>
            <li class="question-item" data-question-id="<?php echo $index; ?>">
                <span class="question-badge"><?php echo htmlspecialchars($question['code']); ?></span>
                <span class="question-text" data-tippy-content="<?php echo htmlspecialchars_decode($question['text']); ?>">
                    <?php 
                        $short_text = htmlspecialchars_decode($question['text']);
                        echo strlen($short_text) > 150 ? substr($short_text, 0, 150) . '...' : $short_text; 
                    ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


     <!-- Colonna Risposte -->
     <div class="col-md-8 custom-qa-answers">
    <div id="default-message">
        <p>Selezionare le domande per visualizzare i risultati</p>
    </div>
    <div class="answer-content">
        <?php foreach ($questions as $index => $question): ?>
            <div class="answer-block" data-answer-id="<?php echo $index; ?>" style="display: none;">
                <?php 
                $totalCounts = array_sum($question['counts']);
                if ($totalCounts == 0): ?>
                    <p class="no-data-message">Non ci sono dati disponibili per questa domanda</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($question['options'] as $optIndex => $option): ?>
                            <?php 
                            $count = $question['counts'][$optIndex];
                            $percentage = ($totalCounts > 0) ? ($count / $totalCounts) * 100 : 0;
                            ?>
                            <li>
                                <div class="option-container">
                                    <span><?php echo htmlspecialchars_decode($option); ?></span>
                                    <span class="answer-count"><?php echo $count; ?></span>
                                </div>
                                <div class="custom-progress-bar">
                                    <div class="custom-progress-fill" style="width: <?php echo round($percentage); ?>%;"></div>
                                </div>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>



        </div>
    </div>


</div>


<?php 

require_once('inc_footer.php');

?>

<script>
// JavaScript per mostrare le risposte corrispondenti alla domanda selezionata
document.querySelectorAll('.question-item').forEach(item => {
    item.addEventListener('click', function () {
        document.querySelectorAll('.question-item').forEach(q => q.classList.remove('active'));
        this.classList.add('active');
        const questionId = this.getAttribute('data-question-id');
        
        // Nascondi il messaggio di default
        document.getElementById('default-message').style.display = 'none';

        // Nascondi tutte le risposte e mostra solo quella selezionata
        document.querySelectorAll('.answer-block').forEach(answer => answer.style.display = 'none');
        document.querySelector(`.answer-block[data-answer-id="${questionId}"]`).style.display = 'block';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    tippy('.question-text', {
        placement: 'top',
        animation: 'scale',
        theme: 'light',
        maxWidth: 400,
        allowHTML: true,
    });
});
</script>
