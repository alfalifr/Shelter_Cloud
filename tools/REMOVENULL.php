<?php 
$raw = file_get_contents('../predict/longsor.json');
$arr = json_decode($raw, 1);

$res = array();
foreach($arr as $key => $val){
    if($val["lokasi"] != null){
        $res[] = $val;
    }
}


$result = json_encode($res);

$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $result);
fclose($myfile);
echo "Done!;"
?>