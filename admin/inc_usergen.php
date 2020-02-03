<?php
//GENERATORE DI CODICE UTENTE
$codelength =4; //Lunghezza del codice (usare rand(min,max) per una lunghezza casuale)
$salt = "abcdefghijklmnopqrstuvwxyz0123456789";
$user_id_new='';

for($i=0;$i<=$codelength;$i++)
{

    $user_id_new.=substr($salt,rand(0,strlen($salt)-1),1);
}



$codelength2 =4;
$salt2 = time().microtime()*1000000;

for($i=0;$i<=$codelength2;$i++)
{
    $user_id_new.=substr($salt2,rand(0,strlen($salt2)-1),1);
}
$user_id_new = strtoupper($user_id_new);
//fine generatore di codice utente
?>
