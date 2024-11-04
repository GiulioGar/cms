<?php
function getQuestions($prj, $sid) {
    $linkDir = ($_SERVER['HTTP_HOST'] === 'localhost') ? "../var" : "/var";
    $directoryPath = $linkDir . "/imr/fields/" . $prj . "/" . $sid . "/";
    $filePath = $directoryPath . $sid . ".sdl";

    if (!file_exists($filePath)) {
        echo "<p>File .sdl non trovato in: $filePath</p>";
        return [];
    }

    $questions = [];
    $vectorOptions = [];
    $currentQuestion = null;

    $fileLines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Primo passaggio: Identifica e salva tutti i vettori multi-linea
    $in_vector = false;
    $vector_name = "";
    $vector_content = [];

    foreach ($fileLines as $line) {
        $line = trim($line);

        // Inizia a leggere un vettore multi-linea
        if (!$in_vector && preg_match('/^vector\s+(\w+)\s*=\s*new\s*vector\s*{/', $line, $matches)) {
            $in_vector = true;
            $vector_name = $matches[1];
            $vector_content = [];
        }
        elseif ($in_vector) {
            // Se il vettore è in corso, continua a leggere fino a "};"
            if (strpos($line, "};") !== false) {
                $vector_content[] = str_replace(["};", '"'], '', $line);
                // Usa array_values per creare indici consecutivi
                $vectorOptions[$vector_name] = array_values(array_filter(array_map('trim', explode(',', implode(",", $vector_content)))));
                $in_vector = false;
            } else {
                // Accumula il contenuto del vettore
                $vector_content[] = str_replace('"', '', $line);
            }
        }
    }

    // Secondo passaggio: Analizza le domande e associa le opzioni dai vettori
    foreach ($fileLines as $line) {
        if (preg_match('/^qst\s*=\s*new\s*question\("choice",\s*(\d+)\);$/', $line, $matches)) {
            if ($currentQuestion) {
                $questions[] = $currentQuestion;
            }
            $currentQuestion = [
                'id' => $matches[1],
                'text' => '',
                'code' => '',
                'options' => []
            ];
        }
        elseif ($currentQuestion && preg_match('/qst\.setProperty\("text",\s*"(.*)"\);$/', $line, $matches)) {
            $currentQuestion['text'] = $matches[1];
        }
        elseif ($currentQuestion && preg_match('/qst\.setProperty\("code",\s*"(.*)"\);$/', $line, $matches)) {
            $currentQuestion['code'] = $matches[1];
        }
        elseif ($currentQuestion && preg_match('/qst\.setProperty\("options",\s*(\w+)\);$/', $line, $matches)) {
            $vector_name = $matches[1];
            $currentQuestion['options'] = array_values($vectorOptions[$vector_name] ?? []);
        }
    }

    if ($currentQuestion) {
        $questions[] = $currentQuestion;
    }

    // Stampa finale per confermare che ogni domanda abbia le opzioni corrette
    // echo "<pre>Contenuto finale di questions con dettagli delle opzioni:\n";
    // foreach ($questions as $question) {
    //     echo "ID: {$question['id']}\n";
    //     echo "Text: {$question['text']}\n";
    //     echo "Code: {$question['code']}\n";
    //     echo "Options:\n";
    //     print_r($question['options']);
    //     echo "\n\n";
    // }
    // echo "</pre>";

    return $questions;
}
?>
