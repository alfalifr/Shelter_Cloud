<?php
include "../../config/dbConnection.php";

// Set your Bot ID and Chat ID.
$telegrambot='1799597083:AAEv7_W5uDOBt5VSYo1mWI96iv8vVOD3lUY';
$telegramchatid=-430782219;

//Open Json FILE
$gempa_json = file_get_contents('../../predict/gempa.json');
$cuaca_json = file_get_contents('../../predict/cuaca.json');
$longsor_json = file_get_contents('../../predict/longsor.json');
$banjir_json = file_get_contents('../../predict/banjir.json');
$karhutla_json = file_get_contents('../../predict/karhutla.json');
$karhutla_city = file_get_contents('../../predict/karhutla_city.json');

// //GCP API
// $APIKey = 'AIzaSyAkcSHfUPapq-imV7lSclFfniLmwQHw4co';
// $GeoURI = 'https://maps.googleapis.com/maps/api/geocode/json';

$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);
$keys = array();
if($data != null && $_SERVER['REQUEST_METHOD']=="POST"){
    foreach($data as $key => $val){
        array_push($keys, $key);
    }

    if(!isset($_SESSION)){
        session_start();
    }

    if($keys[0] == "_authType"){
        if ($data[$keys[0]] == "_login" && count($keys) == 3){
            if($keys[1] == "_email" && $keys[2] == "_password"){
                $usr = $data[$keys[1]];
                $pwd = $data[$keys[2]];
                $qry = "SELECT * FROM user_auth WHERE _email='$usr' AND _passwd='$pwd' ";
                $tmp =  $conn -> query($qry);
                $data = $tmp -> fetch_array();
                if($usr == $data['_email'] && $pwd == $data['_passwd']){
                    $result[] = array(
                        'response' => 'success',
                        'data' => array(
                            'id' => $data['id_auth'],
                            'email' => $data['_email'],
                            'full_name' => $data['_fname'],
                            'gender' => $data['_gender']
                        )
                    );
                    echo json_encode($result);
                }else{
                   echo failCode('failed',101);
                }
            }
        }else if ($data[$keys[0]] == "_register" && count($keys) == 5){ //Max Parameter+
            if($keys[1] == "_email" && $keys[2] == "_password" && $keys[3] == "_fname" && $keys[4] == "_gender"){
                $usr = $data[$keys[1]];
                $pwd = $data[$keys[2]];
                $nam = $data[$keys[3]];
                $gnd = $data[$keys[4]];
                
                $qry = "SELECT * FROM user_auth WHERE _email='$usr' AND _passwd='$pwd' ";
                $tmp =  $conn -> query($qry);
                $data = $tmp -> fetch_array();
                if($usr != $data['_email']){
                    $qry = "INSERT INTO user_auth(_email, _passwd, _fname, _addr, _gender) VALUES ('$usr','$pwd','$nam', DEFAULT ,'$gnd')";
                    $exe = $conn -> query($qry);
                    if($exe){
                        echo failCode('success',104);
                    }else{
                        echo failCode('failed',105);
                    }
                }else{
                   echo failCode('failed',103);
                }
            } 
        } 
    }else if ($keys[0] == "_requestType"){
        if($data[$keys[0]] == 1){
            $qry = "SELECT * FROM news WHERE _type = 1 ORDER BY _timestamp ASC";
            $tmp = $conn -> query($qry);
            $result = array();

            while($data = $tmp -> fetch_array()){
                $arrTmp = [
                    'id' => $data['id_news'],
                    'title' => $data['_title'],
                    'desc' => $data['_briefDesc'],
                    'imgLink' => $data['_linkImage'],
                    'link' => $data['_link'],
                    'timestamp' => $data['_timestamp']
                ];
                array_push($result, $arrTmp);
            }
            echo json_encode($result);
        }else if($data[$keys[0]] == 2){
            $qry = "SELECT * FROM news WHERE _type = 2 ORDER BY _timestamp ASC";
            $tmp = $conn -> query($qry);
            $result = array();

            while($data = $tmp -> fetch_array()){
                $arrTmp = [
                    'id' => $data['id_news'],
                    'title' => $data['_title'],
                    'desc' => $data['_briefDesc'],
                    'imgLink' => $data['_linkImage'],
                    'link' => $data['_link'],
                    'timestamp' => $data['_timestamp']
                ];
                array_push($result, $arrTmp);
            }
            echo json_encode($result);
        }else if($data[$keys[0]] == "gempa"){
            $data_array = json_decode($gempa_json, 1);
            $filter = "";
            if(isset($keys[1])){
                if($keys[1] == "filter"){
                    $filter = $data[$keys[1]];
                    echo filter_json($data_array, "Name", $filter);
                }   
            }else{
                echo $gempa_json;
            }
        }else if($data[$keys[0]] == "city_gempa"){
            $data_array = json_decode($gempa_json, 1);
            echo get_city($data_array, "Name");
        }else if($data[$keys[0]] == "cuaca"){
            $data_array = json_decode($cuaca_json, 1);
            $filter = "";
            if(isset($keys[1]) && isset($keys[2]) || isset($keys[2]) && isset($keys[1])){
                $min = $data[$keys[1]];
                $max = $data[$keys[2]];
                echo filter_cuaca_1($data_array, "Date", $min, $max);
            }else if(isset($keys[1])){
                if($keys[1] == "min"){ //Extra Parameter {min}
                    $min = $data[$keys[1]];
                    echo filter_cuaca_2($data_array, "Date", $min);
                }else if($keys[1] == "max"){ //Extra Parameter {max}
                    $max = $data[$keys[1]];
                    echo "F";
                    echo filter_cuaca_3($data_array, "Date", $max);
                }
            }else{
                echo $cuaca_json;
            }
        }else if($data[$keys[0]] == "longsor"){
            $data_array = json_decode($longsor_json, 1);
            $filter = "";
            if(isset($keys[1])){
                if($keys[1] == "filter"){
                    $filter = $data[$keys[1]];
                    echo filter_json($data_array, "lokasi", $filter);
                }   
            }else{
                echo $longsor_json;
            }
        }else if($data[$keys[0]] == "city_longsor"){
            $data_array = json_decode($longsor_json, 1);
            echo get_city($data_array, "lokasi");
        }else if($data[$keys[0]] == "karhutla"){
            $data_array = json_decode($karhutla_json, 1);
            $filter = "";
            if(isset($keys[1])){
                if($keys[1] == "filter_city" && $keys[2] == "value"){
                    $filter = $data[$keys[1]];
                    $field = $data[$keys[2]];
                    echo filter_json($data_array, $filter, $field);
                }
            }else{
                echo $karhutla_json;
            }
        }else if($data[$keys[0]] == "city_karhutla"){
            echo $karhutla_city;
        }else if($data[$keys[0]] == "banjir"){
            $data_array = json_decode($banjir_json, 1);
            $filter = "";
            if(isset($keys[1])){
                if($keys[1] == "filter"){
                    $filter = $data[$keys[1]];
                    echo filter_json($data_array, "desa", $filter);
                }   
            }else{
                echo $banjir_json;
            }

            
        }else if($data[$keys[0]] == "desa_banjir"){
            $data_array = json_decode($banjir_json, 1);
            echo get_city($data_array, "desa");
        }
    }else if($keys[0] == "_feedback"){
        
        if($data[$keys[0]] == true){
            $_frm = $data[$keys[1]];
            $_typ = $data[$keys[2]];
            $_msg = $data[$keys[3]];
            // if($data[])
            // $_img = $data[$keys[]];

            //Insert Data ti Mysql First
            $qry = "INSERT INTO report(_from, _method, _type, _status, _msg) VALUES ('$_frm', DEFAULT ,'$_typ', DEFAULT ,'$_msg')";
            $tmp = $conn -> query($qry);

            $last_id = mysqli_insert_id($conn);
            $msg = "";

            //Return To Telegram Bot
            if($tmp){        
                $msg = $msg."CASE ID : ".$last_id."\n\n";
                $msg = $msg."From : ".$_frm."\n";
                $msg = $msg."Waktu : ".date("Y-m-d")."\n";
                $msg = $msg."Type : ".$_typ."\n";
                $msg = $msg."Pesan : ".$_msg."\n";
                telegram ($msg);
            }else{
                echo "Fail";
            }
        }
    }
    else{
        echo failCode('failed',102);
    }       
}else{
    echo failCode('failed',102);
}

function failCode($res, $code){
    $result = array(
        'response' => $res,
        'response_code' => $code
    );
    return json_encode($result);
}

function telegram($msg) {
    global $telegrambot,$telegramchatid;
    $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';
    $data=array(
        'chat_id' => $telegramchatid,
        'text'    => $msg
    );
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data),
        ),
    );
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}

function filter_json($str, $type, $var){
    $res = array();
    foreach($str as $key => $val){
        if(strtolower($val[$type]) == strtolower($var)){
            $res[] = $val;
        }
    }
    return json_encode($res);
}

function filter_cuaca_1($str, $type, $min, $max){
    $res = array();
    $_min = strtotime($min);
    $_max = strtotime($max);
    foreach($str as $key => $val){
        $_data = strtotime($val[$type]);
        if($_data >= $_max && $_data <= $_min  || $_data >= $_min && $_data <= $_max){
            $res[] = $val;
        }
    }
    return json_encode($res);
}

function filter_cuaca_2($str, $type, $min){
    $res = array();
    $_min = strtotime($min);
    foreach($str as $key => $val){
        $_data = strtotime($val[$type]);
        if($_data >= $_min){
            $res[] = $val;
        }
    }
    return json_encode($res);
}

function filter_cuaca_3($str, $type, $max){
    $res = array();
    $_max = strtotime($max);
    foreach($str as $key => $val){
        $_data = strtotime($val[$type]);
        if($_data <= $_max){
            $res[] = $val;
        }
    }
    return json_encode($res);
}

function get_city($arr, $field){
    $res = array();
    foreach($arr as $key => $val){   
        $res[] = $val[$field];
    }
    $res = array_unique($res);
    foreach($res as $key => $val){
        $rex[] = (object)[
            $val
        ];
    }
    sort($rex);
    
    return json_encode($rex);
}

function get_key($arr){
    foreach($arr as $key => $val) {
        echo "KEY IS: $key<br/>";
        
    }
}
?>
