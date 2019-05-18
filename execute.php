<?php

$token = "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI";
define('api', "https://api.telegram.org/bot" . $token . "/");

$partecipanti = [
    'giovanni' => [
        'id' => '354008242',
        'chat_name' => '@Jenko😎'
    ],
    'rocco' => [
        'id' => '126810558',
        'chat_name' => '@rolud'
    ],
    'bruno' => [
        'id' => '',
        'chat_name' => ''
    ],
];

$data = file_get_contents("php://input");
$update = json_decode($data, true);


echo $update;
$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['from']['id'];
$gid = $update['message']['chat']['id'];
$roccoid="";
$roccoid=$cid;
var_dump($roccoid);
function apiRequest($metodo)
{
    $req = file_get_contents(api . $metodo);
    echo api . $metodo;
    return $req;
}

function send($id, $text)
{
    if (strpos($text, '\n')) {
        $text = urlencode($text);
    }
    return apiRequest("sendMessage?text=$text&parse_mode=HTML&chat_id=$id");
}

if ($text == "/start") {
    send($cid, "Benvenuto sul bot, il tuo id è $cid");
}

function chat($id, $text)
{
    if (strpos($text, '\n')) {
        $text = urlencode($text);
    }
    return apiRequest("getChat?chat_id=$id");
}

if ($text == "/chat") {
    foreach ($partecipanti as $p):
       $id= $p['id'];
    $nome=$p['chat_name'];
        send("$id", "$nome" );
        endforeach;

}
if($text == "/rocco") {
    send($cid, "il tuo chat id è $cid");
}



var_dump($partecipanti);
//568381122

//$content = file_get_contents("php://input");
//$update = json_decode($content, true);
//
//$content1 = $content;
//var_dump($content1);
//$update1 = $update;
//var_dump($update1);
//
//function apiRequestWebhook($method, $parameters){
//    if (!is_string($method)) {
//        error_log("Method name must be a string\n");
//        return false;
//    }
//
//    if (!$parameters) {
//        $parameters = array();
//    } else if (!is_array($parameters)) {
//        error_log("Parameters must be an array\n");
//        return false;
//    }
//    $parameters["method"] = $method;
//
//
//    header("Content-Type: application/json");
//    echo json_encode($parameters);
//    return true;
//}
//
//
//
//function apiRequest($method, $parameters)
//{
//    if (!is_string($method)) {
//        error_log("Method name must be a string\n");
//        return false;
//    }
//
//    if (!$parameters) {
//        $parameters = array();
//    } else if (!is_array($parameters)) {
//        error_log("Parameters must be an array\n");
//        return false;
//    }
//
//    foreach ($parameters as $key => &$val) {
//        // encoding to JSON array parameters, for example reply_markup
//        if (!is_numeric($val) && !is_string($val)) {
//            $val = json_encode($val);
//        }
//    }
//    $url = API_URL . $method . '?' . http_build_query($parameters);
//
//    $handle = curl_init($url);
//    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
//    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
//
//    return exec_curl_request($handle);
//}
//
//
//function exec_curl_request($handle)
//{
//    $response = curl_exec($handle);
//
//    if ($response === false) {
//        $errno = curl_errno($handle);
//        $error = curl_error($handle);
//        error_log("Curl returned error $errno: $error\n");
//        curl_close($handle);
//        return false;
//    }
//
//    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
//    curl_close($handle);
//
//    if ($http_code >= 500) {
//        // do not wat to DDOS server if something goes wrong
//        sleep(10);
//        return false;
//    } else if ($http_code != 200) {
//        $response = json_decode($response, true);
//        error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
//        if ($http_code == 401) {
//            throw new Exception('Invalid access token provided');
//        }
//        return false;
//    } else {
//        $response = json_decode($response, true);
//        if (isset($response['description'])) {
//            error_log("Request was successful: {$response['description']}\n");
//        }
//        $response = $response['result'];
//    }
//
//    return $response;
//}
//
//function apiRequestJson($method, $parameters)
//{
//    if (!is_string($method)) {
//        error_log("Method name must be a string\n");
//        return false;
//    }
//
//    if (!$parameters) {
//        $parameters = array();
//    } else if (!is_array($parameters)) {
//        error_log("Parameters must be an array\n");
//        return false;
//    }
//
//    $parameters["method"] = $method;
//
//    $handle = curl_init(API_URL);
//    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
//    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
//    curl_setopt($handle, CURLOPT_POST, true);
//    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
//    curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
//
//    return exec_curl_request($handle);
//}
//
//function processMessage($message){
//    // process incoming message
//    $message_id = $message['message_id'];
//    $chat_id = $message['chat']['id'];
//    if (isset($message['text'])) :
//        // incoming text message
//        $text = $message['text'];
//
//        if (strpos($text, "/start") === 0) :
//
//            apiRequestJson("sendMessage", array('chat_id' => $chat_id, "text" => 'Hello', 'reply_markup' => array(
//                'keyboard' => array(array('Hello', 'Hi')),
//                'one_time_keyboard' => true,
//                'resize_keyboard' => true)));
//
//        elseif ($text === "Hello" || $text === "Hi") :
//            apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => '\'Nto culu'));
//        elseif (strpos($text, "/stop") === 0) :
//            // stop now
//        else :
//            apiRequestWebhook("sendMessage", array('chat_id' => $chat_id, "reply_to_message_id" => $message_id, "text" => 'Cool'));
//        endif;
//    else:
//        apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => 'I understand only text messages'));
//    endif;
//}
//
//
//
//
//if (!$update) {
//    // receive wrong update, must not happen
//    exit;
//}
//
//if (isset($update["message"])) {
//    processMessage($update["message"]);
//}
//
//
//


//$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
//$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
//$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
//$date = isset($message['date']) ? $message['date'] : "";
//$text = isset($message['text']) ? $message['text'] : "";
//
//$text = trim($text);
//$text = strtolower($text);

//header("Content-Type: application/json");
//$parameters = array('chat_id' => $chatId, "text" => $text);
//$parameters["method"] = "sendMessage";
//echo json_encode($parameters);
//print_r($parameters);
//
