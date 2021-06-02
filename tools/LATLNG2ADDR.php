<?php
$APIKey = 'AIzaSyAkcSHfUPapq-imV7lSclFfniLmwQHw4co';
$GeoURI = 'https://maps.googleapis.com/maps/api/geocode/json';

$raw = file_get_contents('../predict/longsor.json');
$arr = json_decode($raw, 1);




echo "Starting...";
foreach($arr as $key => $val){
    $data = $GeoURI.'?latlng='.$val["lon"].','.$val["lat"].'&key='.$APIKey; //Geocode Reverse
    $data = file_get_contents($data);
    $data = json_decode($data, 1);
    $lokasi = $data["results"][0]["address_components"][1]["long_name"];

    $ar[] = array(
        "kondisi" => $val["longsor"],
        "lat" => $val["lat"],
        "lon" => $val["lon"],
        "lokasi" => $lokasi
    );       
}
echo "Saving...";


$result = json_encode($ar);

$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $result);
fclose($myfile);
echo "Done!;"


?>