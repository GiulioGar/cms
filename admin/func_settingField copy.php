<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../Connections/admin.php'); 

// Verifica del metodo di richiesta e dei parametri
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'riabilitaBloccate') {
    // Controllo dell'esistenza dei parametri sid e prj
    if (!isset($_POST['sid']) || !isset($_POST['prj'])) {
        exit("Parametri mancanti.");
    }

    // Assegnazione dei parametri sid e prj
    $sid = $_POST['sid'];
    $prj = $_POST['prj'];

    // Connessione al database
    // $admin = new mysqli('host', 'username', 'password', 'database');
    if ($admin->connect_error) {
        exit("Connessione fallita: " . $admin->connect_error);
    }

    // Esecuzione della funzione di riabilitazione
    echo riabilitaBloccate($sid, $prj, $admin);
}


function riabilitaBloccate($sid, $prj, $admin) {
    header('Content-Type: application/json');
    ob_clean(); // Pulisce qualsiasi output preesistente

    $linkDir = ($_SERVER['HTTP_HOST'] === 'localhost') ? "../var" : "/var";
    $directoryPath = $linkDir . "/imr/fields/" . $prj . "/" . $sid . "/results/";

    $iidArray = [];
    $query = "SELECT iid FROM t_respint WHERE sid = ? AND status = 7";
    $stmt = $admin->prepare($query);
    $stmt->bind_param("s", $sid);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $iidArray[] = $row['iid'];
    }
    $stmt->close();

    if (!is_dir($directoryPath)) {
        echo json_encode(["error" => "La directory specificata non esiste."]);
        return;
    }

    $riabilitatiCount = 0;
    $totalCount = count($iidArray);

    foreach ($iidArray as $iid) {
        $iidFormatted = ($iid > 999) ? $iid : str_pad($iid, 4, "0", STR_PAD_LEFT);
        $filePath = $directoryPath . "res" . $iidFormatted . ".sre";
        
        if (file_exists($filePath) && unlink($filePath)) {
            $updateQuery = "UPDATE t_respint SET status = 0, iid = -1 WHERE iid = ? AND sid = ?";
            $updateStmt = $admin->prepare($updateQuery);
            $updateStmt->bind_param("is", $iid, $sid);
            $updateStmt->execute();
            $updateStmt->close();

            $riabilitatiCount++;
        }

        // Invio aggiornamento di stato in JSON
        echo json_encode(["current" => $riabilitatiCount, "total" => $totalCount]) . "\n";
        flush();
        ob_flush();
        usleep(100000); // Pausa di 0,1 secondi per consentire l'invio progressivo
    }

    echo json_encode(["message" => "SONO STATI RIABILITATI $riabilitatiCount utenti"]);
}






?>







