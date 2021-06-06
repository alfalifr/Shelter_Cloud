<?php
$data = file_get_contents('output.txt');
$img = base64_decode($data);




$myfile = fopen("output.png", "w") or die("Unable to open file!");
fwrite($myfile, $img);
fclose($myfile);
?>