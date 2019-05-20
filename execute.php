<?php
include 'utlis.php';

$token = "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI";
define('api', "https://api.telegram.org/bot" . $token . "/");

$data = file_get_contents("php://input");
$update = json_decode($data, true);

$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['from']['id'];
$groupid = $update['message']['chat']['id'];


$text = explode('@', $text);

function apiRequest($metodo)
{
    $req = file_get_contents(api . $metodo);
    return $req;
}


if ($text[0] == "/start") {
    $prova = send($cid, "Benvenuto sul bot, il tuo id è $cid");
}


if ($text[0] == "/week") {
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
while (true):
    $day = getDayNoParam(); //prendo l'array dei giorni per confrontarlo con il giorno attuale
    if (array_key_exists(date('l'), $day))://confronto con il giorno attuale per inviare la notifica se risulta

        $year = date('Y'); //prendo l'anno

        $week = date('W');//prendo la settimana

        $team = getTurni($year, $week); //prendo i turni di quella settimana

        $settimana = getTeam($team); //prendo il team di quella settimana

        $turno = getDay(date('l'));  //prendo il numero associato al giorno

        $pulitore = $settimana[$turno]; //prendo chi deve fare le pulizie

        if ((date('G') == 19 || (date('G') == 17) || (date('G') == 18))):

            if (date('i') == 10):

                if (date('s') == 40) :


                    $today = getDataOdierna();
                    $section = getPulizie($turno);
                    $tag = getTagPartecipanti($pulitore);
                    $oggi_orario = date('H.i.s');
                    $text = $today . "%0AEhi " . $tag . " oggi devi lavare:%0A" . $section;
                    $id = getPartecipanti($pulitore);
                    send($id, $text);
                    sleep(5);
                endif;
            endif;

        endif;
    endif;
endwhile;


//$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
//$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
//$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
//$date = isset($message['date']) ? $message['date'] : "";
//$text = isset($message['text']) ? $message['text'] : "";
//
//$text = trim($text);
//$text = strtolower($text);


//è necessario aggiungere bot prima del nostro token
//You must add bot before our token
//$botToken = "bot" . "589789293:AAGfEsknWMFSSayCUWqSZIZePRx9mGm8NXY";
//
////Recuperiamo l'input che riceveremo dal bot
////We retrieve the input we receive from bot
//$TelegramRawInput = file_get_contents("php://input");
//// php://input restituisce i dati raw (testo), andremo quindi a formattare il tutto in un array, i dati che riceveremo saranno in formato Json quindi un json_decode farà al caso nostro.
//// php // input returns the raw data (text), then we will format everything in an array, the data we receive will be in Json format so a json_decode will be for us.
//$update = json_decode($TelegramRawInput, TRUE);
//
////Assicuriamoci di aver ricevuto un update, altrimenti interrompiamo l'esecuzione
////Make sure you have received an update, otherwise we interrupt execute
//if (!$update) {
//    exit;
//}
//
////Recuperiamo l'oggetto message dal json
////We recover the message object from json
//$MessageObj = $update['message'];
////Recuperiamo il chatId, che utilizzeremo per rispondere all'utente che ci ha appena invocato
////We recover the chatId table which we will use to respond to the user who has just invoked
//$chatId = $MessageObj['chat']['id'];
//
////Salvo il json ricevuto per analizzarlo in seguito
////We save the json received to parse it later
//saveInJsonFile($update, "ricevuto.json");
//
////Rispondiamo HelloWorld
////We answer HelloWorld
//$out = sendMsg($botToken, $chatId, "Hello World!");
//
////Salvo il json ricevuto per analizzarlo in seguito
////We save the json received to parse it later
//saveInJsonFile($out, "inviato.json");
//
//
///**
// *
// * FUNCTION AREA
// *
// */
//
////Funzione per far inviare un messaggio da parte del bot
////Function to send a message from the bot
//function sendMsg($tkn, $cId, $msgTxt)
//{
//    /*
//        Creiamo la URL per richiamare la API Telegram apposita, nel nostro caso sarà la sendMessage.
//        Questa API richiede due parametri obbligatori, chatId e Testo del messaggio
//        NB: La chiamata alla API sarà in GET, quindi è consigliato (fortemente consigliato) di inviare il testo all'interno di un urlencode().
//
//
//        Create the URL to invoke the appropriate API in this case will be the Telegram sendMessage.
//        This API requires two required parameters, chatId and message text
//        NOTE: the call to the API will GET, so it is recommended (strongly recommended) to send the text within a urlencode ().
//    */
//    $TelegramUrlSendMessage = "https://api.telegram.org/" . $tkn . "/sendMessage?chat_id=" . $cId . "&text=" . urlencode($msgTxt);
//
//    //Come return della funzione restituiremo l'output di file_get_contents della URL appena creata.
//    //As a return of the function we will return the output of file_get_contents of the URL just created.
// return file_get_contents($TelegramUrlSendMessage);
//}
//
////Questa è la funzione che utilizzo per salvare il json nei file
////This is the function i use to save the json in file
//function saveInJsonFile($data, $filename)
//{
//    if (file_exists($filename))
//        unlink($filename);
//    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
//}

