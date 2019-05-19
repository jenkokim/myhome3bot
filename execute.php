<?php

$token = "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI";
define('api', "https://api.telegram.org/bot" . $token . "/");



$data = file_get_contents("php://input");
$update = json_decode($data, true);


$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['from']['id'];
$groupid = $update['message']['chat']['id'];


function apiRequest($metodo)
{
    $req = file_get_contents(api . $metodo);
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

//if ($text == "/chat") {
//    foreach ($partecipanti as $p):
//        $id = $p['id'];
//        $nome = $p['chat_name'];
//        send("$id", "$nome");
//    endforeach;
//
//}
if ($text == "/rocco") {
    send($cid, "il tuo chat id è $cid");
}

if ($text == "/week") {
    $week = date('W');
    $year = date('Y');
    $day = date('l');
    $today= date('d m Y');
    $day = getDayIta($day);
    $this_week = getTurni($year, $week);
    $week_team = getTeam($this_week);
    $tag1=getTagPartecipanti($week_team[1]);
    $tag2=getTagPartecipanti($week_team[2]);
    $tag3=getTagPartecipanti($week_team[3]);

    $mex= $today."<br>Questa settimana i turni sono:<br>Martedì a " .$week_team[1]. ($tag1)." tocca il Bagno <br>Giovedì a ". $week_team[2] .($tag2). " tocca il Bagno e la Cucina<br>Nel Weekend a ". $week_team[3]. ($tag3)." tocca Tutta la Casa ";



    send('354008242', "ciao");
}

//  $week = date('W');
//    $year = date('Y');
//    $day = date('l');
//    $today= date('d m Y');
//    $day = getDayIta($day);
//    $this_week = getTurni($year, $week);
//    $week_team = getTeam($this_week);
//    $tag1=getTagPartecipanti($week_team[1]);
//    $tag2=getTagPartecipanti($week_team[2]);
//    $tag3=getTagPartecipanti($week_team[3]);
//
//    $mex= $today."<br>Questa settimana i turni sono:<br>Martedì a " .$week_team[1]. ($tag1)." tocca il Bagno <br>Giovedì a ". $week_team[2] .($tag2). " tocca il Bagno e la Cucina<br>Nel Weekend a ". $week_team[3]. ($tag3)." tocca Tutta la Casa ";
//
//var_dump($mex);





function getTurni($year, $week)
{

    $turni = [
        '2019' => [
            '20' => 'team1', '21' => 'team2', '22' => 'team3', '23' => 'team4',
            '24' => 'team1', '25' => 'team2', '26' => 'team3', '27' => 'team4',
            '28' => 'team1', '29' => 'team2', '30' => 'team3', '31' => 'team4',
            '32' => 'team1', '33' => 'team2', '34' => 'team3', '35' => 'team4',
            '36' => 'team1', '37' => 'team2', '38' => 'team3', '39' => 'team4',
            '40' => 'team1', '41' => 'team2', '42' => 'team3', '43' => 'team4',
            '44' => 'team1', '45' => 'team2', '46' => 'team3', '47' => 'team4',
            '48' => 'team1', '49' => 'team2', '50' => 'team3', '51' => 'team4',
            '52' => 'team1'
        ],
        '2020' => [
            '1' => 'team2', '2' => 'team3', '3' => 'team4', '4' => 'team1',
            '5' => 'team2', '6' => 'team3', '7' => 'team4', '8' => 'team1',
            '9' => 'team2', '10' => 'team3', '11' => 'team4', '12' => 'team1',
            '13' => 'team2', '14' => 'team3', '15' => 'team4', '16' => 'team1',
            '17' => 'team2', '18' => 'team3', '19' => 'team4', '20' => 'team1',
            '21' => 'team2', '22' => 'team3', '23' => 'team4', '24' => 'team1',
            '25' => 'team2', '26' => 'team3', '27' => 'team4', '28' => 'team1',
            '29' => 'team2', '30' => 'team3', '31' => 'team4', '32' => 'team1',
            '33' => 'team2', '34' => 'team3', '35' => 'team4', '36' => 'team1',
            '37' => 'team2', '38' => 'team3', '39' => 'team4', '40' => 'team1',
            '41' => 'team2', '42' => 'team3', '43' => 'team4', '44' => 'team1',
            '45' => 'team2', '46' => 'team3', '47' => 'team4', '48' => 'team1',
            '49' => 'team2', '50' => 'team3', '51' => 'team4', '52' => 'team1'
        ],
    ];
    return $turni[$year][$week];
}


function getDay($d){
    $day = [
        'Tuesday' => '1',
        'Thursday'=> '2',
        'Saturday'=> '3',
        'Sunday' => '3'
    ];
    return $day[$d];
}

function getTeam($team)
{

    $squadre = [
        'team1' => [
            '1' => 'Bruno',
            '2' => 'Giovanni',
            '3' => 'Tutti'
        ],
        'team2' => [
            '1' => 'Rocco',
            '2' => 'Bruno',
            '3' => 'Giovanni'
        ],
        'team3' => [
            '1' => 'Tutti',
            '2' => 'Rocco',
            '3' => 'Bruno'
        ],
        'team4' => [
            '1' => 'Giovanni',
            '2' => 'Tutti',
            '3' => 'Rocco'
        ],
    ];
    return $squadre[$team];
}

function getPulizie($day){

    $tipo_pulizia = [
        '1' => 'Bagno',
        '2' => 'Bagno e Cucina',
        '3' => 'Tutta la Casa'
    ];
    return $tipo_pulizia[$day];
}


function getDayIta($day){

    $traslate=[
        'Monday' => 'Lunedì',
        'Tuesday' => 'Martedì',
        'Wednesday' => 'Mercoledì',
        'Thursday'=> 'Giovedì',
        'Friday' => 'Venerdì',
        'Saturday'=> 'Sabato',
        'Sunday' => 'Domenica'
    ];
    return $traslate[$day];
}

function getTagPartecipanti($nome){

    $partecipanti = [
        'Giovanni' => [
            'id' => '354008242',
            'chat_name' => '@jenko_11'
        ],
        'Rocco' => [
            'id' => '126810558',
            'chat_name' => '@rolud'
        ],
        'Bruno' => [
            'id' => '',
            'chat_name' => ''
        ],
        'Tutti' => [
            'id' => '',
            'chat_name' => '@jenko_11 , @rolud , @Semone96'
        ],
    ];
    return $partecipanti[$nome]['chat_name'];
}
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

