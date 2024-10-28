<?php


 ini_set ('display_errors', 1);
 ini_set ('display_startup_errors', 1);
 error_reporting (E_ALL); 



 
 $success = mail('g.arciello@interactive-mr.com', 'My Subject', 'prova');
 if (!$success) {
     $errorMessage = error_get_last()['message'];
     echo $errorMessage;
 }




                    ?>