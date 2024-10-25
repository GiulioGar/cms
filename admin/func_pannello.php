<?php
require_once('../Connections/admin.php'); 


// Abilita la visualizzazione degli errori PHP per il debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Recupera i dati per il modale (azione fetch)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'fetch') {
    $sur_id = $_POST['sur_id'];

    $query = "SELECT sur_id, description, panel, sex_target, age1_target, age2_target, goal, 
                     DATE_FORMAT(end_field, '%Y-%m-%d') AS end_date, stato 
              FROM t_panel_control 
              WHERE sur_id = ?";
    $stmt = $admin->prepare($query);
    $stmt->bind_param("s", $sur_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // Converte lo stato in "Aperto" o "Chiuso" per la visualizzazione nel modale
    $data['stato'] = ($data['stato'] == 0) ? 'Aperto' : 'Chiuso';

    // Restituisce i dati in formato JSON per popolare il modale
    echo json_encode($data);
    exit;
}

// Aggiornamento dei dati della ricerca (azione update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $sur_id = $_POST['sur_id'];
    $description = $_POST['description'];
    $panel = $_POST['panel'];
    $sex_target = $_POST['sex_target'];
    $age1_target = $_POST['age1_target'];
    $age2_target = $_POST['age2_target'];
    $goal = $_POST['goal'];
    $end_date = $_POST['end_date'];
    $stato = $_POST['stato'];  // 0 per Aperto, 1 per Chiuso

    // Debug: visualizza i dati ricevuti per l'aggiornamento
    var_dump($_POST); // Controlla i dati ricevuti
    echo "<br>";

    // Debug: verifica se i parametri sono settati correttamente
    if (empty($sur_id) || empty($description) || empty($panel) || empty($end_date)) {
        echo json_encode(["status" => "error", "message" => "Alcuni parametri sono mancanti o non validi"]);
        exit;
    }

    $query = "UPDATE t_panel_control 
              SET description = ?, panel = ?, sex_target = ?, age1_target = ?, age2_target = ?, goal = ?, end_field = ?, stato = ? 
              WHERE sur_id = ?";
    $stmt = $admin->prepare($query);
    
    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Errore nella preparazione della query: " . $admin->error]);
        exit;
    }

    $stmt->bind_param("sssssssss", $description, $panel, $sex_target, $age1_target, $age2_target, $goal, $end_date, $stato, $sur_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Dati aggiornati con successo"]);
    } else {
        // Log dell'errore SQL
        echo json_encode(["status" => "error", "message" => "Errore durante l'aggiornamento dei dati: " . $stmt->error]);
    }
    $stmt->close();
    exit;
}


// Recupero parametri DataTables
$limit = isset($_GET['length']) ? intval($_GET['length']) : 10;
$offset = isset($_GET['start']) ? intval($_GET['start']) : 0;
$search_value = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
$draw = isset($_GET['draw']) ? intval($_GET['draw']) : 1;

// Array che mappa gli indici di colonna DataTables alle colonne del database
$columns = ['sur_id', 'description', 'panel', 'complete', 'red_panel', 'red_surv', 'end_field', 'giorni_rimanenti', 'costo', 'bytes', 'stato'];

// Gestione dell'ordinamento multiplo
$order_by = "stato ASC, end_field DESC"; // Ordinamento predefinito

// Verifica se DataTables invia ordini personalizzati
if (isset($_GET['order'])) {
    $order_by = [];
    foreach ($_GET['order'] as $order) {
        $column_index = intval($order['column']);
        $dir = $order['dir'] === 'asc' ? 'ASC' : 'DESC';
        $order_by[] = $columns[$column_index] . " " . $dir;
    }
    $order_by = implode(", ", $order_by);
}

// Creazione della query con ricerca globale e ordinamento multiplo
$query = "SELECT sur_id, description, panel, complete, red_panel, red_surv, end_field, giorni_rimanenti, costo, bytes, stato ,prj
          FROM t_panel_control 
          WHERE (description LIKE '%$search_value%' OR sur_id LIKE '%$search_value%') 
          ORDER BY $order_by
          LIMIT $limit OFFSET $offset";

// Esecuzione della query
$result = mysqli_query($admin, $query);


// Verifica se la query ha successo
if (!$result) {
    echo json_encode([
        "error" => "Errore nell'esecuzione della query: " . mysqli_error($admin)
    ]);
    exit;
}

// Recupero dei dati
while ($row = mysqli_fetch_assoc($result)) {
    $row['stato'] = $row['stato'] == 0 ? 'Aperto' : 'Chiuso';  // Converte lo stato in "Aperto" o "Chiuso"
    $row['panel'] = $row['panel'] == 1 ? 'Interno' : 'Esterno';  // Converte lo stato in "Aperto" o "Chiuso"
    $row['bytes'] = $row['bytes'] ?? '0';  // Gestisce i valori null per bytes, se presenti
    
    // Aggiungi una colonna "Azioni" (può contenere pulsanti o essere vuota)
    $row['actions'] = "<button class='btn btn-primary'>Azione</button>";  // Personalizza questo contenuto come preferisci

    // Aggiungi la riga alla variabile $data
    $data[] = $row;
}

// Conteggio totale dei record
$total_query = "SELECT COUNT(*) as total FROM t_panel_control";
$total_result = mysqli_query($admin, $total_query);
if ($total_result) {
    $total = intval(mysqli_fetch_assoc($total_result)['total']);
}

// Risposta JSON per DataTables
$response = [
    "draw" => $draw,
    "recordsTotal" => $total,
    "recordsFiltered" => $total,
    "data" => $data
];

// Output della risposta JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
