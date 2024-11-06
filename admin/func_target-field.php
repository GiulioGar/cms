<?php
$sid = $_REQUEST['sid'];
$prj = $_REQUEST['prj'];

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
    $fileLines = file($filePath, FILE_IGNORE_NEW_LINES);

    // Primo passaggio: Identifica e salva tutti i vettori multi-linea
    $in_vector = false;
    $vector_name = "";
    $vector_content = "";

    foreach ($fileLines as $line) {
        $line = trim($line);
        if (!$in_vector && preg_match('/^vector\s+(\w+)\s*=\s*new\s*vector\s*{/', $line, $matches)) {
            $in_vector = true;
            $vector_name = $matches[1];
            $vector_content = "";
        } elseif ($in_vector) {
            if (strpos($line, "};") !== false) {
                $vector_content .= str_replace("};", "", $line);
                preg_match_all('/"(.*?)"/', $vector_content, $matches);
                $vectorOptions[$vector_name] = $matches[1];
                $in_vector = false;
            } else {
                $vector_content .= $line;
            }
        }
    }

    // Secondo passaggio: Analizza le domande e associa le opzioni
    foreach ($fileLines as $line) {
        if (preg_match('/new\s+question\("choice",\s*(\d+)\);$/', $line, $matches)) {
            $currentQuestion = [
                'id' => $matches[1],
                'text' => '',
                'code' => '',
                'options' => [],
                'counts' => []
            ];
            $is_choice_question = true;
        } elseif ($is_choice_question && preg_match('/setProperty\("text",\s*(.*)\);$/', $line, $matches)) {
            $text_with_vars = $matches[1];
            $text_with_vars = preg_replace('/\b\w+\+/', '', $text_with_vars);
            $text_with_vars = trim($text_with_vars, '"');
            $currentQuestion['text'] = htmlspecialchars_decode($text_with_vars);
        } elseif ($is_choice_question && preg_match('/setProperty\("code",\s*"(.*)"\);$/', $line, $matches)) {
            $currentQuestion['code'] = $matches[1];
        } elseif ($is_choice_question && preg_match('/setProperty\("options",\s*(\w+)\);$/', $line, $matches)) {
            $vector_name = $matches[1];
            $currentQuestion['options'] = array_values($vectorOptions[$vector_name] ?? []);
            $currentQuestion['counts'] = array_fill(0, count($currentQuestion['options']), 0);
            $questions[$currentQuestion['id']] = $currentQuestion;
        }
    }

    return $questions;
}

function processResults($directoryPath, &$questions) {
    $files = glob($directoryPath . "*.sre");

    foreach ($files as $file) {
        $fileHandle = fopen($file, "r");
        if ($fileHandle) {
            $firstLine = fgets($fileHandle);
            $firstLineData = explode(";", $firstLine);
            $id = $firstLineData[3];
            $status = $firstLineData[8];

            while (($line = fgets($fileHandle)) !== false) {
                $lineData = explode(";", trim($line));
                if ($lineData[0] === "choice") {
                    $qid = $lineData[1];
                    $optionsCount = (int)$lineData[2];
                    $answer = $lineData[3];

                    if (!isset($questions[$qid])) continue;

                    if (strlen($answer) <= 2) {
                        $answerIndex = (int)$answer;
                        if (isset($questions[$qid]['counts'][$answerIndex])) {
                            $questions[$qid]['counts'][$answerIndex]++;
                        }
                    } else {
                        for ($i = 0; $i < $optionsCount; $i++) {
                            if (isset($answer[$i]) && $answer[$i] === "1") {
                                $questions[$qid]['counts'][$i]++;
                            }
                        }
                    }
                }
            }
            fclose($fileHandle);
        }
    }
}

$linkDir = ($_SERVER['HTTP_HOST'] === 'localhost') ? "../var" : "/var";
$directoryPath = $linkDir . "/imr/fields/" . $prj . "/" . $sid . "/results/";

// Otteniamo le domande
$questions = getQuestions($prj, $sid);

// Processiamo i risultati aggiornando i conteggi nelle domande
processResults($directoryPath, $questions);

// Restituiamo `$questions` per utilizzarlo in `target_field.php`
return $questions;
?>
