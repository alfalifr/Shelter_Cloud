<?php
$data = file_get_contents('input.png');
$img = base64_encode($data);




$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $img);
fclose($myfile);
?>