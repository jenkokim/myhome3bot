<?php
include "bot.php";

define('api' , "https://api.telegram.org/bot" .token . "/");
$data = file_get_contents("php://input");
$update = json_decode($data, true);
$text="";
$cid="";
$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['from']['id'];

function apiRequest($metodo){
    $req= file_get_contents(api.$metodo);
    return $req;
}
function send($id, $text){
     if(strpos($text,"\n")){
         $text=urlencode($text);
     }
     return apiRequest("sendMessage?text=$text&parse_mode=HTML&chat_id=$id");
}













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
