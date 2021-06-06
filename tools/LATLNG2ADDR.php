<?php
$APIKey = 'AIzaSyAkcSHfUPapq-imV7lSclFfniLmwQHw4co'; //Your API Key
$GeoURI = 'https://maps.googleapis.com/maps/api/geocode/json';

$raw = file_get_contents('../predict/banjir.json'); //Your Json 
/*
[
    {
        "lat" : "",
        "lon" : ""
    },
    {
        "lat" : "",
        "lon" : ""
    }
]
*/
$arr = json_decode($raw, 1);

echo "Starting...";
foreach($arr as $key => $val){
    $data = $GeoURI.'?latlng='.$val["lon"].','.$val["lat"].'&key='.$APIKey; //Geocode Reverse
    // echo $data . "\n";
    $data = file_get_contents($data);
    $data = json_decode($data, 1);
    $index_kota = count($data["results"][0]["address_components"]);
    $faddr = $data["plus_code"]["compound_code"];

    $arr = explode(", ", $faddr);
    $arr = substr($arr[0], 8);
    $ar[] = array(
        "kondisi" => $val["banjir"],
        "lat" => $val["lat"],
        "lon" => $val["lon"],
        "alamat_lengkap" => $faddr,
        "desa" => $arr
    );
}
echo "Saving...";




$result = json_encode($ar);

$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $result);
fclose($myfile);
echo "Done!;"


?>