<?php
$csv = $_POST['csv'];
$filename = $_POST['filename'];
$filetype = $_POST['filetype'];

if ($filetype != "primis") {
 	header("Content-Type: application/text");
	header("Content-Disposition: attachment; filename=$filename.csv");
	print $csv; 
	} else {
	header("Content-Type: plain/text");
	header("Content-Disposition: attachment; filename=$filename.txt");
	print $csv; 
}
?>