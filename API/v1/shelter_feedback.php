<?php
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

// Set your Bot ID and Chat ID.
$telegrambot='1799597083:AAEv7_W5uDOBt5VSYo1mWI96iv8vVOD3lUY';
$telegramchatid=-430782219;

// Function call with your own text or variable
$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);
$keys = array();
if($data != null){
    foreach($data as $key => $val){
        array_push($keys, $key);
    }
    if ($keys[0] == "_feedback"){
        $msg = "";
        if($data[$keys[0]] == true){
            
            $msg = $msg."From : ".$data[$keys[1]]."\n";
            $msg = $msg."Waktu : ".date("Y-m-d")."\n";
            $msg = $msg."Type : ".$data[$keys[2]]."\n";
            $msg = $msg."Pesan : ".$data[$keys[3]]."\n";
            telegram ($msg);
            // echo $msg;
        }
    }
}

?>