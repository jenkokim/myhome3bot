<?php
include 'utlis.php';

$token = "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI";
define('api', "https://api.telegram.org/bot" . $token . "/");

$data = file_get_contents("php://input");
file_put_contents('log.json', $data);
$update = json_decode($data, true);

$message = $update['message'];
$text = $message['text'];
$cid = $update['message']['chat']['id'];
$groupid = $update['message']['chat']['id'];

$text_split = explode('@', $text);
$text_split_remove = explode(' ', $text);
$text = $text_split[0];

$to_remove = $text_split_remove[1];


if ($text == "/list"):
    $sql = "select * from casa ; ";
    $result = runPDOQuery($sql);
    foreach ($result as $r):
        $list .= $r['id'] . ") " . $r['name'] . "%0A";

    endforeach;
    send($groupid, "cose da comprare:%0A" . $list);
endif;

if ($text == "/add") :
    if ($to_remove==""  ||  $to_remove==" "  || $to_remove==null):



        send($groupid, "Scrivi \add seguito da uno spazio e dall'articolo da inserire");
    else:

         $sql = "INSERT INTO `casa` (`id`, `name`, `date`) VALUES (NULL, '$to_remove', CURRENT_TIMESTAMP); ";
        //    $result = runPDOQuery($sql);
        //  foreach ($result as $r):
        ////       $list .= $r['id'] . ") " . $r['name'] . "%0A";
        //   endforeach;
        send($groupid, "L'oggetto ".$to_remove."è stato aggiunto!");
    endif;
endif;
//$id =
//
//$sql="delete from casa where id = $id ;";


if ($text == "/start") {
    $prova = send($cid, "Benvenuto sul bot, il tuo id è $cid");
    $provag = send($groupid, "Benvenuto sul bot, il tuo id è $groupid");
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


$day = getDayNoParam();//prendo l'array dei giorni per confrontarlo con il giorno attuale

if (array_key_exists(date('l'), $day))://confronto con il giorno attuale per inviare la notifica se risulta

    $year = date('Y'); //prendo l'anno
    $week = date('W');//prendo la settimana
    $team = getTurni($year, $week); //prendo i turni di quella settimana
    $settimana = getTeam($team); //prendo il team di quella settimana
    $turno = getDay(date('l'));  //prendo il numero associato al giorno
    $pulitore = $settimana[$turno]; //prendo chi deve fare le pulizie

    if ((date('G') == 9 || (date('G') == 12) || (date('G') == 17))): //9 12 17
        if ((date('i') > 1) || (date('i') < 59)):

            $today = getDataOdierna();
            $section = getPulizie($turno);
            $tag = getTagPartecipanti($pulitore);

            if ($tag == 'all'):
                $all = getAllPartecipanti();

                foreach ($all as $a):

                    $testo = $today . " (" . $team . ")%0AEhi " . $a['chat_name'] . " oggi è la giornata del buon senso,devi lavare:%0A" . $section . " insieme agli altri!";
                    send($a['id'], $testo);

                endforeach;

            else:

                $testo = $today . " (" . $team . ")%0AEhi " . $tag . " oggi devi lavare:%0A" . $section;
                $id = getPartecipanti($pulitore);
                send($id, $testo);

            endif;
        endif;
    endif;
endif;

