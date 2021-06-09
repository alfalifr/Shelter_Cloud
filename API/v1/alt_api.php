<?php
//Required Connection
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

//Read JSON Arguments
$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);

//Check
if($data != null && $_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($data["_authType"]) != null || isset($data["_authType"]) != ""){
        if($data["_authType"] == "_login" && isset($data["_email"]) && isset($data["_password"])){
            $usr = $data["_email"];
            $pwd = $data["_password"];
            if(($usr != "" || $usr != null) && ($pwd != "" || $pwd != null)){
                $qry = "SELECT * FROM user_auth WHERE _email='$usr' AND _passwd='$pwd' ";
                $tmp =  $conn -> query($qry);
                $arr = $tmp -> fetch_array();
                if($usr == $arr['_email'] && $pwd == $arr['_passwd']){
                    $result = array(
                        'response' => 'success',
                        'data' => array(
                            'id' => $arr['id_auth'],
                            'email' => $arr['_email'],
                            'full_name' => $arr['_fname'],
                            'address' => $arr['_addr'],
                            'gender' => $arr['_gender']
                        )
                    );
                    echo json_encode($result);
                }else{
                    echo failCode('User Not Found!',101);
                }
            }else{
                echo failCode('Data Null or Empty!',101);
            }
        }else if($data["_authType"] == "_register" && isset($data["_email"]) && isset($data["_password"]) && isset($data["_fname"]) && isset($data["_gender"])){
            $usr = $data["_email"];
            $pwd = $data["_password"];
            $nam = $data["_fname"];
            $gnd = $data["_gender"];
                
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
    }else if (isset($data["_requestType"]) != null || isset($data["_requestType"]) != ""){
        if($data["_requestType"] == 1){
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
        }else if($data["_requestType"] == 2){
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
        }else if($data["_requestType"] == "gempa"){
            $data_array = json_decode($gempa_json, 1);
            $filter = "";
            if(isset($data["min"]) && isset($data["max"])){
                $min = $data["min"];
                $max = $data["max"];
                echo filter_minmax($data_array, "Tanggal", $min, $max);
            }else if(isset($data["min"])){
                $min = $data["min"];
                echo filter_min($data_array, "Tanggal", $min);
            }else if(isset($data["max"])){
                $max = $data["max"];
                echo filter_max($data_array, "Tanggal", $max);
            }else if(isset($data["filter"])){
                $filter = $data["filter"];
                echo filter_json($data_array, "Name", $filter);
            }else{
                echo $gempa_json;
            }

        }else if($data["_requestType"] == "city_gempa"){
            $data_array = json_decode($gempa_json, 1);
            echo get_city($data_array, "Name");           
        }else if($data["_requestType"] == "cuaca"){
            $data_array = json_decode($cuaca_json, 1);
            $filter = "";
            if(isset($data["min"]) && isset($data["max"])){
                $min = $data["min"];
                $max = $data["max"];
                echo filter_minmax($data_array, "Date", $min, $max);
            }else if(isset($data["min"])){
                $min = $data["min"];
                echo filter_min($data_array, "Date", $min);
            }else if(isset($data["max"])){
                $max = $data["max"];
                echo filter_max($data_array, "Date", $max);
            }else{
                echo $cuaca_json;
            }
            
        }else if($data["_requestType"] == "longsor"){
            $data_array = json_decode($longsor_json, 1);
            $filter = "";
            if(isset($data["filter"])){
                $filter = $data["filter"];
                echo filter_json($data_array, "lokasi", $filter); 
            }else{
                echo $longsor_json;
            }
        }else if($data["_requestType"] == "city_longsor"){
            $data_array = json_decode($longsor_json, 1);
            echo get_city($data_array, "lokasi");  
        }else if($data["_requestType"] == "karhutla"){
            $data_array = json_decode($karhutla_json, 1);
            $filter = "";
            if(isset($data["min"]) && isset($data["max"])){
                $min = $data["min"];
                $max = $data["max"];
                echo filter_minmax($data_array, "Tanggal", $min, $max);
            }else if(isset($data["min"])){
                $min = $data["min"];
                echo filter_min($data_array, "Tanggal", $min);
            }else if(isset($data["max"])){
                $max = $data["max"];
                echo filter_max($data_array, "Tanggal", $max);
            }else if(isset($data["filter"])){
                $filter = $data["filter"];
                echo filter_json($data_array, "Name", $filter);
            }else{
                echo $karhutla_json;
            }
            
        }else if($data["_requestType"] == "city_karhutla"){
            echo $karhutla_city;
        }else if($data["_requestType"] == "banjir"){
            $data_array = json_decode($banjir_json, 1);
            $filter = "";
            if(isset($data["filter"])){
                $filter = $data["filter"];
                echo filter_json($data_array, "desa", $filter); 
            }else{
                echo $banjir_json;
            }
        }else if($data["_requestType"] == "desa_banjir"){
            $data_array = json_decode($banjir_json, 1);
            echo get_city($data_array, "desa");      
        }else if($data["_requestType"] == "getProfile" && isset($data["id"])){
            $id = $data["id"];
            if(is_string($id)){
                $qry = "SELECT * FROM user_auth WHERE _email = '$id' ";
                $tmp =  $conn -> query($qry);
                $data = $tmp -> fetch_array();
                if($data != null){
                    $result = array(
                        'response' => 'success',
                        'data' => array(
                            'id' => $data['id_auth'],
                            'email' => $data['_email'],
                            'full_name' => $data['_fname'],
                            'address' => $data['_addr'],
                            'gender' => $data['_gender']
                        )
                    );
                }else{
                    $result = array('response' => 'Data Not Found');
                }
            }else{
                $result = array('response' => 'ID Must be String');
            }
            echo json_encode($result);
            
        }else if($data["_requestType"] == "updateProfile" && isset($data["id"]) && isset($data["new_name"]) && isset($data["new_addr"]) && isset($data["new_gender"]) && isset($data["new_pass"]) ){
            $id = $data["id"];
            $_name = $data["new_name"];
            $_addr = $data["new_addr"];
            $_gend = $data["new_gender"];
            $_pass = $data["new_pass"];
            if(is_string($id)){
                $qry = "UPDATE user_auth SET _fname = '$_name', _addr = '$_addr', _gender = '$_gend', _passwd = '$_pass'  WHERE _email = '$id' ";
                $tmp =  $conn -> query($qry);
                $data = mysqli_affected_rows($conn);
                if($data){
                    $result = array('response' => 'Password Successfull Change!');
                }else{
                    $result = array('response' => 'ID Not Registered!');
                }
            }else{
                $result = array('response' => 'ID Must be String!');
            }
            echo json_encode($result);
        }
    }else if((isset($data["_feedback"]) != null || isset($data["_feedback"]) != "") && 
            (isset($data["from"]) != null || isset($data["from"]) != "" ) &&
            (isset($data["type"]) != null || isset($data["type"]) != "" ) &&
            (isset($data["msg"]) != null || isset($data["msg"]) != "" )){
        if($data["_feedback"] == true){
            $_frm = $data["from"];
            $_typ = $data["type"];
            $_msg = $data["msg"];
            if(isset($data["imglink"])){
                $_img = $data["imglink"];
            }else{
                $_img = "No Image";
            }
            

            //Insert Data ti Mysql First
            $qry = "INSERT INTO report(_from, _method, _type, _status, _msg, _photoLink) VALUES ('$_frm', DEFAULT ,'$_typ', DEFAULT ,'$_msg', '$_img')";
            $tmp = $conn -> query($qry);

            $last_id = mysqli_insert_id($conn);
            $msg = "";

            //Return To Telegram Bot
            if($tmp){        
                $msg = $msg."CASE ID : ".$last_id."\n\n";
                $msg = $msg."From : ".$_frm."\n";
                $msg = $msg."Time : ".date("Y-m-d")."\n";
                $msg = $msg."Type : ".$_typ."\n";
                $msg = $msg."Message : ".$_msg."\n";
                $msg = $msg."Picture : ".$_img."\n";
                telegram ($msg);
                echo json_encode(array('response' => 'success'));
            }else{
                echo json_encode(array('response' => 'failed'));
            }
        }else{
            echo json_encode(array('response' => 'failed'));
        } 
    }else{
        echo failCode('failed',102);
    }

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

function filter_minmax($str, $type, $min, $max){
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

function filter_min($str, $type, $min){
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

function filter_max($str, $type, $max){
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
?>