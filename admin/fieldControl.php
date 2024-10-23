<?php
$data = date("Y-m-d");
$contaField = 0;

function getRicercheAttive($admin) {
    $query = "SELECT * FROM t_panel_control WHERE stato=0 ORDER BY stato, giorni_rimanenti ASC, id DESC";
    return mysqli_query($admin, $query);
}

function countRicercheAttive($admin) {
    $query = "SELECT COUNT(sur_id) AS tot FROM t_panel_control WHERE stato=0";
    $result = mysqli_query($admin, $query);
    return mysqli_fetch_assoc($result);
}

$tot_attive = getRicercheAttive($admin);
$opSur = countRicercheAttive($admin);

echo "<div class='custom-table-responsive'>";
echo "<table class='custom-table'>";
echo "<thead class='custom-thead'>";
echo "<tr class='custom-tr'>";
echo "<th scope='col'><i class='fas fa-id-badge'></i> ID</th>";
echo "<th scope='col'><i class='fas fa-info-circle'></i> Info</th>";
echo "<th scope='col'><i class='fas fa-chart-line'></i> Andamento</th>";
echo "<th scope='col'><i class='fas fa-clock'></i> Chiusura</th>";
echo "<th scope='col'><i class='fas fa-users'></i> Panel</th>";
echo "</tr></thead><tbody>";

while ($row = mysqli_fetch_assoc($tot_attive)) {
    $stati = [
        0 => ['Aperta', '#28a745'],
        1 => ['Chiusa', '#dc3545']
    ];
    list($stato, $colSat) = $stati[$row['stato']];

    $panels = [
        0 => 'Esterno',
        1 => 'Millebytes',
        2 => 'Target'
    ];
    $panel = $panels[$row['panel']];
	$time = strtotime($row['end_field']);
    $newDate = date("d-m-Y", strtotime($row['end_field']));

    $obiet = round($row['goal']);
    $progress = min(100, round(($row['complete'] / $obiet) * 100));

    // Definiamo un colore dinamico per la barra di progresso
    $progressColor = $progress < 50 ? 'bg-danger' : ($progress < 80 ? 'bg-warning' : 'bg-success');

    echo "<tr class='custom-tr'>";
    echo "<td><a href='controlloField.php?prj=" . $row['prj'] . "&sid=" . $row['sur_id'] . "'><i class='far fa-folder-open'></i> " . $row['sur_id'] . "</a></td>";
    echo "<td><span data-toggle='tooltip' title='" . $row['description'] . "'>" . substr($row['description'], 0, 30) . "...</span></td>";
    echo "<td>
            <div class='custom-progress'>
                <div class='custom-progress-bar $progressColor' role='progressbar' aria-valuenow='$progress' aria-valuemin='0' aria-valuemax='100' style='width: $progress%;'>$progress%</div>
            </div>
          </td>";
    echo "<td><div class='custom-crono' id='countdown'>$newDate</div></td>";
    echo "<td>$panel</td>";
    echo "</tr>";

    $contaField++;


}
echo "</tbody></table></div>";
?>

<!-- JavaScript per il tooltip e countdown incluso nella stessa pagina -->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();  // Inizializzazione tooltip
});
</script>
