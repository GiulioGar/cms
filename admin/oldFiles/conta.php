<?php
$conta_contatti=0;
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$esci=false;
$conta_mancante=0;
$i=0;
/*
//recupero tutti i file sre dalla cartella
$fl = glob('sre/*.sre');
$contatti=count($fl);
//stampo il numero complessivo
echo 'CONTATTI: ' . $contatti .'<br>';
*/


while($esci==false) {  
$i=$i+1;
//trasformo la i nel formato 0001
$nfile = sprintf('%04d', $i);

//apro il file e leggo la prima riga 
$riga = file("http://www.primisoft.com/fields/AST/GER14P1085/results/res".$nfile.".sre");
$prima_riga=$riga[0]; 

if ($prima_riga<>'')
{
$conta_mancante=0;
$conta_contatti=$conta_contatti+1;
$elementi = explode(";", $prima_riga);
if ($elementi[6]==0){$conta_incomplete=$conta_incomplete+1;}
if ($elementi[6]==3){$conta_complete=$conta_complete+1;}
if ($elementi[6]==4){$conta_filtrati=$conta_filtrati+1;}
if ($elementi[6]==5){$conta_quotafull=$conta_quotafull+1;}
}
else
{
$conta_mancante=$conta_mancante+1;
if ($conta_mancante==2){$esci=true;}
}

}
echo 'CONTATTI: ' . $conta_contatti .'<br>';
echo 'COMPLETE: ' . $conta_complete .'<br>';
echo 'FILTRATE: ' . $conta_filtrati .'<br>';
echo 'QUOTAFULL: ' . $conta_quotafull .'<br>';
echo 'INCOMPLETE: ' . $conta_incomplete .'<br>';


?>