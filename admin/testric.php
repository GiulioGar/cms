<?php



//Testo da esaminare 
$testo = "Questo è solo un piccolo esempio di qst = new question(\"choice\", 30); per un <tag>Programmatore PHP</tag>.";

//Con Preg Match valuto tutte le stringhe comprese tra i due Tag Segnalati
preg_match_all("(qst = new question\(\"choice\", (.*?)\);)", $testo , $risultato);


echo $risultato[1][0];



?>