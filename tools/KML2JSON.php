<?php 
$data = file_get_contents('banjir.kml'); //pilih file kml
$xml = simplexml_load_string($data, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);
$idx = 0;
$result = array();
foreach($array["Document"]["Folder"]["Placemark"] as $data){
    $desc = $data["description"];
    // $desc = substr($desc, strpos($desc, "LONGSOR</B> = ")+14); //Untuk Longsor
    $desc = substr($desc, strpos($desc, "LIMPASAN</B> = ")+15); //Untuk Banjir
    $desc = explode("<BR>", $desc);
    $stat = $desc[0];

    $latlon = $data["Polygon"]["outerBoundaryIs"]["LinearRing"]["coordinates"];
    $latlon = explode(",", preg_replace("/\r|\n/", "", str_replace(' ', '', $latlon)));
    
    $tmp = array(
        'banjir' => $stat,
        'lat' => $latlon[0],
        'lon' => $latlon[1]
    );

    $result[] = $tmp;
    $idx++;
    

}

$danger = array();
foreach($result as $key => $val){
    if($val['banjir'] != "Normal"){
        $danger[] = $val;
    }
}
$danger = json_encode($danger);
$myfile = fopen("output.txt", "w") or die("Unable to open file!");
fwrite($myfile, $danger);
fclose($myfile);

?>