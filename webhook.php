<?php
include "config/dbConnection.php";
$data = file_get_contents("https://api.telegram.org/bot1799597083:AAEv7_W5uDOBt5VSYo1mWI96iv8vVOD3lUY/getUpdates");
$data = utf8_encode($data);
$data = json_decode($data, true);
$telegramchatid=-430782219;

@$last_idx = count($data['result']);
while(true){
    try{
        $data = file_get_contents("https://api.telegram.org/bot1799597083:AAEv7_W5uDOBt5VSYo1mWI96iv8vVOD3lUY/getUpdates");
        $data = utf8_encode($data);
        $data = json_decode($data, true);
        $data_len = count($data['result']);


        if($last_idx < $data_len){
            $rst = ($data['result'][$data_len-1]['message']['text']);
            
            $len = count(explode("#", $rst));

            if(explode("#", $rst)[0] == "close"){
                list($par, $id, $res) = explode("#", $rst);

                $qry = "UPDATE report SET _response = '$res', _status = 1 WHERE id_report = '$id' ";
                $exe = $conn -> query($qry);
                if($exe){
                    telegram("Case : ".$id."\nSelesai!");
                }else{
                    telegram("Gagal Menutup Case : ".$id);
                }

            }else if (explode("#", $rst)[0] == "list"){
                $qry = "SELECT * FROM report WHERE _status = 0";
                $exe = $conn -> query($qry);
                
                $mail = "";
                while($dat = $exe -> fetch_array()){
                    if(isset($dat['_email'])){
                        $mail = $dat['_email'];
                    }else{
                        $mail = "Anonim";
                    }
                    $msg = "";
                    $msg = $msg."CASE ID : ".$dat['id_report']."\n\n";
                    $msg = $msg."From : ".$mail."\n";
                    $msg = $msg."Time : ".$dat['_timestamp']."\n";
                    $msg = $msg."Type : ".$dat['_type']."\n";
                    $msg = $msg."Message : ".$dat['_msg']."\n";
                    $msg = $msg."Picture : ".$dat['_photoLink']."\n";
                    telegram($msg);
                }
            }else if (explode("#", $rst)[0] == "done"){
                $qry = "SELECT * FROM report WHERE _status = 1";
                $exe = $conn -> query($qry);
                
                $mail = "";
                while($dat = $exe -> fetch_array()){
                    if(isset($dat['_email'])){
                        $mail = $dat['_email'];
                    }else{
                        $mail = "Anonim";
                    }
                    $msg = "";
                    $msg = $msg."CASE ID : ".$dat['id_report']."\n\n";
                    $msg = $msg."From : ".$mail."\n";
                    $msg = $msg."Time : ".$dat['_timestamp']."\n";
                    $msg = $msg."Type : ".$dat['_type']."\n";
                    $msg = $msg."Message : ".$dat['_msg']."\n";
                    $msg = $msg."Picture : ".$dat['_photoLink']."\n";
                    $msg = $msg."Respon Admin : ".$dat['_response']."\n";
                    telegram($msg);
                }
            }
            
            $last_idx++;
        }
    }catch (Exception $e){
        echo 'Error: ' .  $e->getMessage() . "\n";
    }
    sleep(1);
}

function telegram($msg) {
    global $telegrambot,$telegramchatid;
    $url='https://api.telegram.org/bot1799597083:AAEv7_W5uDOBt5VSYo1mWI96iv8vVOD3lUY/sendMessage';
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

?>
