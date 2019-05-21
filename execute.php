<?php
include 'utlis.php';

$token = "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI";
define('api', "https://api.telegram.org/bot" . $token . "/");

$data = file_get_contents("php://input");
$tmp=$data;
file_put_contents('log.json',$tmp);

//$tmp=json_decode($data);
//$array=file_put_contents('log.json');
//$tmpArray = json_decode($array);
//array_push($tempArray, json_decode($tmp));
//$jsonData = json_encode($tempArray);
//file_put_contents('log.json', $jsonData);

$update = json_decode($data, true);

$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['chat']['id'];
$groupid = $update['message']['chat']['id'];
$text_split=explode('@',$text);
$text=$text_split[0];

if ($text == "/start") {
    $prova = send($cid, "Benvenuto sul bot, il tuo id è $cid");
}

if ($text == "/week") {

    $week = date('W');
    $year = date('Y');
    $day = date('l');
    $today = getDataOdierna();

    $day = getDayIta($day);
    $this_week = getTurni($year, $week);
    $week_team = getTeam($this_week);
    $tag1 = getTagPartecipanti($week_team[1]);
    $tag2 = getTagPartecipanti($week_team[2]);
    $tag3 = getTagPartecipanti($week_team[3]);

    $mex = $today . "%0AQuesta settimana:%0A%0AMartedì (Bagno):%0A" . $week_team[1] . " " . $tag1 . "%0A%0AGiovedì (Bagno e Cucina):%0A" . $week_team[2] . " " . $tag2 . "%0A%0AWeekend (Casa):%0A" . $week_team[3] . " " . $tag3;

    send($groupid, $mex);
}




//    $day = getDayNoParam(); //prendo l'array dei giorni per confrontarlo con il giorno attuale
//    if (array_key_exists(date('l'), $day))://confronto con il giorno attuale per inviare la notifica se risulta
//
//        $year = date('Y'); //prendo l'anno
//
//        $week = date('W');//prendo la settimana
//
//        $team = getTurni($year, $week); //prendo i turni di quella settimana
//
//        $settimana = getTeam($team); //prendo il team di quella settimana
//
//        $turno = getDay(date('l'));  //prendo il numero associato al giorno
//
//        $pulitore = $settimana[$turno]; //prendo chi deve fare le pulizie
//
//        if ((date('G') == 14 || (date('G') == 15) || (date('G') == 16))):
//
//            if (date('i') == 04):
//
//                if (date('s') == 00) :
//
//
//                    $today = getDataOdierna();
//                    $section = getPulizie($turno);
//                    $tag = getTagPartecipanti($pulitore);
//                    //$oggi_orario = date('H.i.s');
//                    $testo = $today . "%0AEhi " . $tag . " oggi devi lavare:%0A" . $section;
//                    $id = getPartecipanti($pulitore);
//                    send($id, $testo);
//                    sleep(5);
//                endif;
//            endif;
//
//        endif;
//    endif;



//$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
//$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
//$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
//$date = isset($message['date']) ? $message['date'] : "";
//$text = isset($message['text']) ? $message['text'] : "";
